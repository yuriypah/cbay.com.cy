<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Navigation
 * @subpackage Page
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Mvc.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * Represents a page that is defined using module, controller, action, route
 * name and route params to assemble the href
 *
 * @category   Zend
 * @package    Zend_Navigation
 * @subpackage Page
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class Navigation_Page_Mvc extends Navigation_Page
{
	/**
	 * Action name to use when assembling URL
	 *
	 * @var string
	 */
	protected $_action;

	/**
	 * Controller name to use when assembling URL
	 *
	 * @var string
	 */
	protected $_controller;

	/**
	 * Module name to use when assembling URL
	 *
	 * @var string
	 */
	protected $_directory = '';

	/**
	 * Params to use when assembling URL
	 *
	 * @see getHref()
	 * @var array
	 */
	protected $_params = array();

	/**
	 * Route name to use when assembling URL
	 *
	 * @see getHref()
	 * @var string
	 */
	protected $_route = 'default';

	/**
	 * Whether params should be reset when assembling URL
	 *
	 * @see getHref()
	 * @var bool
	 */
	protected $_resetParams = TRUE;

	/**
	 * Cached href
	 *
	 * The use of this variable minimizes execution time when getHref() is
	 * called more than once during the lifetime of a request. If a property
	 * is updated, the cache is invalidated.
	 *
	 * @var string
	 */
	protected $_hrefCache;

	
	public function __construct($options = NULL)
	{
		$default_options = array(
			'controller' => 'index',
			'action' => 'index',
			'directory' => '',
		);
		
		if(isset($options['route']))
		{
			$this->set('route', $options['route']);
			unset($options['route']);
		}
		
		$route_options = Route::get($this->getRoute())->defaults();
		
		$default_options = Arr::merge($default_options, $route_options);

		$options = Arr::merge($default_options, $options);
		
		parent::__construct($options);
	}

	// Accessors:

	/**
	 * Returns whether page should be considered active or not
	 *
	 * This method will compare the page properties against the request object
	 * that is found in the front controller.
	 *
	 * @param  bool $recursive  [optional] whether page should be considered
	 *                          active if any child pages are active. Default is
	 *                          FALSE.
	 * @return bool             whether page should be considered active or not
	 */
	public function isActive($recursive = FALSE)
	{
		if (!$this->_active) 
		{
			$front = Request::current();
			$reqParams = array(
				'directory' => $front->directory(),
				'controller' => $front->controller(),
				'action' => $front->action()
			);

			$myParams = $this->_params;
			
			$myParams['directory'] = $this->_directory;
			$myParams['controller'] = $this->_controller;
			$myParams['action'] = $this->_action;


			if (count(array_intersect_assoc($reqParams, $myParams)) == count($myParams)) 
			{
				$this->_active = TRUE;
				return TRUE;
			}
		}

		return parent::isActive($recursive);
	}

	/**
	 * Returns href for this page
	 *
	 * This method uses {@link Zend_Controller_Action_Helper_Url} to assemble
	 * the href based on the page's properties.
	 *
	 * @return string  page href
	 */
	public function getHref()
	{
		if ($this->_hrefCache) 
		{
			return $this->_hrefCache;
		}

		$params = $this->getParams();

		if ($param = $this->getDirectory())
		{
			$params['directory'] = $param;
		}

		if ($param = $this->getController())
		{
			$params['controller'] = $param == 'index' ? '' : $param;
		}

		if ($param = $this->getAction()) 
		{
			$params['action'] = $param == 'index' ? '' : $param;
		}
		
		$params = Arr::merge($params, $this->getCustomProperties());

		$url = URL::site(Route::url($this->getRoute(), $params));

		return $this->_hrefCache = $url;
	}

	/**
	 * Sets action name to use when assembling URL
	 *
	 * @see getHref()
	 *
	 * @param  string $action             action name
	 * @return Zend_Navigation_Page_Mvc   fluent interface, returns self
	 * @throws Zend_Navigation_Exception  if invalid $action is given
	 */
	public function setAction($action)
	{
		if (NULL !== $action && !is_string($action) && !is_integer($action))
		{
			throw new Kohana_Exception(
				'Invalid argument: ":action". Action must be a string or NULL. ',
			array(':action' => $action));
		}

		$this->_action = $action;
		$this->_hrefCache = NULL;
		return $this;
	}

	/**
	 * Returns action name to use when assembling URL
	 *
	 * @see getHref()
	 *
	 * @return string|NULL  action name
	 */
	public function getAction()
	{
		return $this->_action;
	}

	/**
	 * Sets controller name to use when assembling URL
	 *
	 * @see getHref()
	 *
	 * @param  string|NULL $controller    controller name
	 * @return Zend_Navigation_Page_Mvc   fluent interface, returns self
	 * @throws Zend_Navigation_Exception  if invalid controller name is given
	 */
	public function setController($controller)
	{
		if (NULL !== $controller && !is_string($controller)) 
		{
			throw new Kohana_Exception(
					'Invalid argument: Controller must be a string or NULL');
		}

		$this->_controller = $controller;
		$this->_hrefCache = NULL;
		return $this;
	}

	/**
	 * Returns controller name to use when assembling URL
	 *
	 * @see getHref()
	 *
	 * @return string|NULL  controller name or NULL
	 */
	public function getController()
	{
		return $this->_controller;
	}

	/**
	 * Sets module name to use when assembling URL
	 *
	 * @see getHref()
	 *
	 * @param  string|NULL $module        module name
	 * @return Zend_Navigation_Page_Mvc   fluent interface, returns self
	 * @throws Zend_Navigation_Exception  if invalid module name is given
	 */
	public function setDirectory($directory)
	{
		if (NULL !== $directory && !is_string($directory)) 
		{
			throw new Kohana_Exception(
				'Invalid argument: $module must be a string or NULL');
		}

		$this->_directory = $directory;
		$this->_hrefCache = NULL;
		return $this;
	}

	/**
	 * Returns module name to use when assembling URL
	 *
	 * @see getHref()
	 *
	 * @return string|NULL  module name or NULL
	 */
	public function getDirectory()
	{
		return $this->_directory;
	}

	/**
	 * Sets params to use when assembling URL
	 *
	 * @see getHref()
	 *
	 * @param  array|NULL $params        [optional] page params. Default is NULL
	 *                                   which sets no params.
	 * @return Zend_Navigation_Page_Mvc  fluent interface, returns self
	 */
	public function setParams(array $params = NULL)
	{
		if (NULL === $params) 
		{
			$this->_params = array();
		} 
		else 
		{
			// TODO: do this more intelligently?
			$this->_params = $params;
		}

		$this->_hrefCache = NULL;
		return $this;
	}

	/**
	 * Returns params to use when assembling URL
	 *
	 * @see getHref()
	 *
	 * @return array  page params
	 */
	public function getParams()
	{
		return $this->_params;
	}

	/**
	 * Sets route name to use when assembling URL
	 *
	 * @see getHref()
	 *
	 * @param  string $route              route name to use when assembling URL
	 * @return Zend_Navigation_Page_Mvc   fluent interface, returns self
	 * @throws Zend_Navigation_Exception  if invalid $route is given
	 */
	public function setRoute($route)
	{
		if (NULL !== $route && (!is_string($route) || strlen($route) < 1)) 
		{
			throw new Kohana_Exception(
				 'Invalid argument: $route must be a non-empty string or NULL');
		}

		$this->_route = $route;
		$this->_hrefCache = NULL;
		return $this;
	}

	/**
	 * Returns route name to use when assembling URL
	 *
	 * @see getHref()
	 *
	 * @return string  route name
	 */
	public function getRoute()
	{
		return $this->_route;
	}

	/**
	 * Sets whether params should be reset when assembling URL
	 *
	 * @see getHref()
	 *
	 * @param  bool $resetParams         whether params should be reset when
	 *                                   assembling URL
	 * @return Zend_Navigation_Page_Mvc  fluent interface, returns self
	 */
	public function setResetParams($resetParams)
	{
		$this->_resetParams = (bool) $resetParams;
		$this->_hrefCache = NULL;
		return $this;
	}

	/**
	 * Returns whether params should be reset when assembling URL
	 *
	 * @see getHref()
	 *
	 * @return bool  whether params should be reset when assembling URL
	 */
	public function getResetParams()
	{
		return $this->_resetParams;
	}

	// Public methods:

	/**
	 * Returns an array representation of the page
	 *
	 * @return array  associative array containing all page properties
	 */
	public function toArray()
	{
		return array_merge(
			parent::toArray(),
			array(
				'action'       => $this->getAction(),
				'controller'   => $this->getController(),
				'directory'    => $this->getDirectory(),
				'params'       => $this->getParams(),
				'route'        => $this->getRoute(),
				'reset_params' => $this->getResetParams()
			));
	}
}