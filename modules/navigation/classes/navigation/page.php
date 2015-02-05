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
 * @category  Zend
 * @package   Zend_Navigation
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Page.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * Base class for Zend_Navigation_Page pages
 *
 * @category  Zend
 * @package   Zend_Navigation
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class Navigation_Page extends Navigation_Container
{
	/**
	 * Page label
	 *
	 * @var string|NULL
	 */
	protected $_label;

	/**
	 * Page id
	 *
	 * @var string|NULL
	 */
	protected $_id;

	/**
	 * Style class for this page (CSS)
	 *
	 * @var string|NULL
	 */
	protected $_class;

	/**
	 * A more descriptive title for this page
	 *
	 * @var string|NULL
	 */
	protected $_title;

	/**
	 * This page's target
	 *
	 * @var string|NULL
	 */
	protected $_target;

	/**
	 * Forward links to other pages
	 *
	 * @link http://www.w3.org/TR/html4/struct/links.html#h-12.3.1
	 *
	 * @var array
	 */
	protected $_rel = array();

	/**
	 * Reverse links to other pages
	 *
	 * @link http://www.w3.org/TR/html4/struct/links.html#h-12.3.1
	 *
	 * @var array
	 */
	protected $_rev = array();

	/**
	 * Page order used by parent container
	 *
	 * @var int|NULL
	 */
	protected $_order;

	/**
	 * Page roles
	 *
	 * @var string|NULL
	 */
	protected $_roles = NULL;

	/**
	 * Whether this page should be considered active
	 *
	 * @var bool
	 */
	protected $_active = FALSE;

	/**
	 * Whether this page should be considered visible
	 *
	 * @var bool
	 */
	protected $_visible = TRUE;

	/**
	 * Parent container
	 *
	 * @var Zend_Navigation_Container|NULL
	 */
	protected $_parent;

	/**
	 * Custom page properties, used by __set(), __get() and __isset()
	 *
	 * @var array
	 */
	protected $_properties = array();

	/**
	 * The type of page to use when it wasn't set
	 *
	 * @var string
	 */
	protected static $_defaultPageType;

	// Initialization:

	/**
	 * Factory for Zend_Navigation_Page classes
	 *
	 * A specific type to construct can be specified by specifying the key
	 * 'type' in $options. If type is 'uri' or 'mvc', the type will be resolved
	 * to Zend_Navigation_Page_Uri or Zend_Navigation_Page_Mvc. Any other value
	 * for 'type' will be considered the full name of the class to construct.
	 * A valid custom page class must extend Zend_Navigation_Page.
	 *
	 * If 'type' is not given, the type of page to construct will be determined
	 * by the following rules:
	 * - If $options contains either of the keys 'action', 'controller',
	 *   'module', or 'route', a Zend_Navigation_Page_Mvc page will be created.
	 * - If $options contains the key 'uri', a Zend_Navigation_Page_Uri page
	 *   will be created.
	 *
	 * @param  array|Zend_Config $options  options used for creating page
	 * @return Zend_Navigation_Page        a page instance
	 * @throws Zend_Navigation_Exception   if $options is not array/Zend_Config
	 * @throws Zend_Exception              if 'type' is specified and
	 *                                     Zend_Loader is unable to load the
	 *                                     class
	 * @throws Zend_Navigation_Exception   if something goes wrong during
	 *                                     instantiation of the page
	 * @throws Zend_Navigation_Exception   if 'type' is given, and the specified
	 *                                     type does not extend this class
	 * @throws Zend_Navigation_Exception   if unable to determine which class
	 *                                     to instantiate
	 */
	public static function factory($options)
	{	
		if (!is_array($options)) 
		{
			throw new Kohana_Exception(
				'Invalid argument: $options must be an array');
		}

		if (isset($options['type'])) 
		{
			$type = $options['type'];
		} 
		elseif(self::getDefaultPageType()!= NULL) 
		{
			$type = self::getDefaultPageType();
		}

		if(isset($type)) 
		{
			if (is_string($type) && !empty($type)) 
			{
				switch (strtolower($type)) 
				{
					case 'mvc':
						$type = 'Navigation_Page_Mvc';
						break;
					case 'uri':
						$type = 'Navigation_Page_Uri';
						break;
					case 'separator':
						$type = 'Navigation_Page_Separator';
						break;
				}

				$page = new $type($options);
				if (!$page instanceof Navigation_Page) 
				{
					throw new Kohana_Exception(sprintf(
							'Invalid argument: Detected type "%s", which ' .
							'is not an instance of Zend_Navigation_Page',
							$type));
				}
				return $page;
			}
		}

		$hasUri = isset($options['uri']);
		$hasMvc = isset($options['action']) || isset($options['controller']) ||
				  isset($options['module']) || isset($options['route']);

		if ($hasMvc) 
		{
			return new Navigation_Page_Mvc($options);
		} 
		elseif ($hasUri) 
		{
			return new Navigation_Page_Uri($options);
		} 
		else 
		{
			throw new Kohana_Exception(
				'Invalid argument: Unable to determine class to instantiate');
		}
	}

	/**
	 * Page constructor
	 *
	 * @param  array|Zend_Config $options   [optional] page options. Default is
	 *                                      NULL, which should set defaults.
	 * @throws Zend_Navigation_Exception    if invalid options are given
	 */
	public function __construct($options = NULL)
	{
		if (is_array($options)) 
		{
			$this->setOptions($options);
		}

		// do custom initialization
		$this->_init();
	}

	/**
	 * Initializes page (used by subclasses)
	 *
	 * @return void
	 */
	protected function _init()
	{
	}

	/**
	 * Sets page properties using options from an associative array
	 *
	 * Each key in the array corresponds to the according set*() method, and
	 * each word is separated by underscores, e.g. the option 'target'
	 * corresponds to setTarget(), and the option 'reset_params' corresponds to
	 * the method setResetParams().
	 *
	 * @param  array $options             associative array of options to set
	 * @return Zend_Navigation_Page       fluent interface, returns self
	 * @throws Zend_Navigation_Exception  if invalid options are given
	 */
	public function setOptions(array $options)
	{
		foreach ($options as $key => $value) 
		{
			$this->set($key, $value);
		}

		return $this;
	}

	// Accessors:

	/**
	 * Sets page label
	 *
	 * @param  string $label              new page label
	 * @return Zend_Navigation_Page       fluent interface, returns self
	 * @throws Zend_Navigation_Exception  if empty/no string is given
	 */
	public function setLabel($label)
	{
		if (NULL !== $label && !is_string($label)) 
		{
			throw new Kohana_Exception(
					'Invalid argument: $label must be a string or NULL');
		}

		$this->_label = __($label);
		return $this;
	}

	/**
	 * Returns page label
	 *
	 * @return string  page label or NULL
	 */
	public function getLabel()
	{
		return $this->_label;
	}

	/**
	 * Sets page id
	 *
	 * @param  string|NULL $id            [optional] id to set. Default is NULL,
	 *                                    which sets no id.
	 * @return Zend_Navigation_Page       fluent interface, returns self
	 * @throws Zend_Navigation_Exception  if not given string or NULL
	 */
	public function setId($id = NULL)
	{
		if (NULL !== $id && !is_string($id) && !is_numeric($id)) 
		{
			throw new Kohana_Exception(
					'Invalid argument: $id must be a string, number or NULL');
		}

		$this->_id = NULL === $id ? $id : (string) $id;

		return $this;
	}

	/**
	 * Returns page id
	 *
	 * @return string|NULL  page id or NULL
	 */
	public function getId()
	{
		return $this->_id;
	}

	/**
	 * Sets page CSS class
	 *
	 * @param  string|NULL $class         [optional] CSS class to set. Default
	 *                                    is NULL, which sets no CSS class.
	 * @return Zend_Navigation_Page       fluent interface, returns self
	 * @throws Zend_Navigation_Exception  if not given string or NULL
	 */
	public function setClass($class = NULL)
	{
		if (NULL !== $class && !is_string($class)) 
		{
			throw new Kohana_Exception(
					'Invalid argument: $class must be a string or NULL');
		}

		$this->_class = $class;
		return $this;
	}

	/**
	 * Returns page class (CSS)
	 *
	 * @return string|NULL  page's CSS class or NULL
	 */
	public function getClass()
	{
		return $this->_class;
	}

	/**
	 * Sets page title
	 *
	 * @param  string $title              [optional] page title. Default is
	 *                                    NULL, which sets no title.
	 * @return Zend_Navigation_Page       fluent interface, returns self
	 * @throws Zend_Navigation_Exception  if not given string or NULL
	 */
	public function setTitle($title = NULL)
	{
		if (NULL !== $title && !is_string($title)) 
		{
			throw new Kohana_Exception(
					'Invalid argument: $title must be a non-empty string');
		}

		$this->_title = __($title);
		return $this;
	}

	/**
	 * Returns page title
	 *
	 * @return string|NULL  page title or NULL
	 */
	public function getTitle()
	{
		return $this->_title;
	}

	/**
	 * Sets page target
	 *
	 * @param  string|NULL $target        [optional] target to set. Default is
	 *                                    NULL, which sets no target.
	 * @return Zend_Navigation_Page       fluent interface, returns self
	 * @throws Zend_Navigation_Exception  if target is not string or NULL
	 */
	public function setTarget($target = NULL)
	{
		if (NULL !== $target && !is_string($target)) 
		{
			throw new Kohana_Exception(
					'Invalid argument: $target must be a string or NULL');
		}

		$this->_target = $target;
		return $this;
	}

	/**
	 * Returns page target
	 *
	 * @return string|NULL  page target or NULL
	 */
	public function getTarget()
	{
		return $this->_target;
	}

	/**
	 * Sets the page's forward links to other pages
	 *
	 * This method expects an associative array of forward links to other pages,
	 * where each element's key is the name of the relation (e.g. alternate,
	 * prev, next, help, etc), and the value is a mixed value that could somehow
	 * be considered a page.
	 *
	 * @param  array|Zend_Config $relations  [optional] an associative array of
	 *                                       forward links to other pages
	 * @return Zend_Navigation_Page          fluent interface, returns self
	 */
	public function setRel($relations = NULL)
	{
		$this->_rel = array();

		if (NULL !== $relations) 
		{
			if (!is_array($relations)) {
				throw new Kohana_Exception(
						'Invalid argument: $relations must be an ' .
						'array or an instance of Zend_Config');
			}

			foreach ($relations as $name => $relation) 
			{
				if (is_string($name)) 
				{
					$this->_rel[$name] = $relation;
				}
			}
		}

		return $this;
	}

	/**
	 * Returns the page's forward links to other pages
	 *
	 * This method returns an associative array of forward links to other pages,
	 * where each element's key is the name of the relation (e.g. alternate,
	 * prev, next, help, etc), and the value is a mixed value that could somehow
	 * be considered a page.
	 *
	 * @param  string $relation  [optional] name of relation to return. If not
	 *                           given, all relations will be returned.
	 * @return array             an array of relations. If $relation is not
	 *                           specified, all relations will be returned in
	 *                           an associative array.
	 */
	public function getRel($relation = NULL)
	{
		if (NULL !== $relation) 
		{
			return isset($this->_rel[$relation]) ?
				   $this->_rel[$relation] :
				   NULL;
		}

		return $this->_rel;
	}

	/**
	 * Sets the page's reverse links to other pages
	 *
	 * This method expects an associative array of reverse links to other pages,
	 * where each element's key is the name of the relation (e.g. alternate,
	 * prev, next, help, etc), and the value is a mixed value that could somehow
	 * be considered a page.
	 *
	 * @param  array|Zend_Config $relations  [optional] an associative array of
	 *                                       reverse links to other pages
	 * @return Zend_Navigation_Page          fluent interface, returns self
	 */
	public function setRev($relations = NULL)
	{
		$this->_rev = array();

		if (NULL !== $relations) 
		{
			if (!is_array($relations)) 
			{
				throw new Kohana_Exception(
						'Invalid argument: $relations must be an ' .
						'array');
			}

			foreach ($relations as $name => $relation) 
			{
				if (is_string($name)) 
				{
					$this->_rev[$name] = $relation;
				}
			}
		}

		return $this;
	}

	/**
	 * Returns the page's reverse links to other pages
	 *
	 * This method returns an associative array of forward links to other pages,
	 * where each element's key is the name of the relation (e.g. alternate,
	 * prev, next, help, etc), and the value is a mixed value that could somehow
	 * be considered a page.
	 *
	 * @param  string $relation  [optional] name of relation to return. If not
	 *                           given, all relations will be returned.
	 * @return array             an array of relations. If $relation is not
	 *                           specified, all relations will be returned in
	 *                           an associative array.
	 */
	public function getRev($relation = NULL)
	{
		if (NULL !== $relation) 
		{
			return isset($this->_rev[$relation]) ?
				   $this->_rev[$relation] :
				   NULL;
		}

		return $this->_rev;
	}

	/**
	 * Sets page order to use in parent container
	 *
	 * @param  int $order                 [optional] page order in container.
	 *                                    Default is NULL, which sets no
	 *                                    specific order.
	 * @return Zend_Navigation_Page       fluent interface, returns self
	 * @throws Zend_Navigation_Exception  if order is not integer or NULL
	 */
	public function setOrder($order = NULL)
	{
		if (is_string($order)) 
		{
			$temp = (int) $order;
			if ($temp < 0 || $temp > 0 || $order == '0') 
			{
				$order = $temp;
			}
		}

		if (NULL !== $order && !is_int($order)) {
			throw new Kohana_Exception(
					'Invalid argument: $order must be an integer or NULL, ' .
					'or a string that casts to an integer');
		}

		$this->_order = $order;

		// notify parent, if any
		if (isset($this->_parent)) 
		{
			$this->_parent->notifyOrderUpdated();
		}

		return $this;
	}

	/**
	 * Returns page order used in parent container
	 *
	 * @return int|NULL  page order or NULL
	 */
	public function getOrder()
	{
		return $this->_order;
	}


	/**
	 * Sets whether page should be considered active or not
	 *
	 * @param  bool $active          [optional] whether page should be
	 *                               considered active or not. Default is TRUE.
	 * @return Zend_Navigation_Page  fluent interface, returns self
	 */
	public function setActive($active = TRUE)
	{
		$this->_active = (bool) $active;
		return $this;
	}

	/**
	 * Returns whether page should be considered active or not
	 *
	 * @param  bool $recursive  [optional] whether page should be considered
	 *                          active if any child pages are active. Default is
	 *                          FALSE.
	 * @return bool             whether page should be considered active
	 */
	public function isActive($recursive = FALSE)
	{
		if (!$this->_active && $recursive) 
		{
			foreach ($this->_pages as $page) 
			{
				if ($page->isActive(TRUE))
				{
					return TRUE;
				}
			}
			return FALSE;
		}

		return $this->_active;
	}

	public function hasAccess($user)
	{
		$roles = $this->getRoles();
		if(!empty($roles))
		{
			if($user instanceof Kohana_ORM)
			{
				return $user->has_role($this->getRoles(), FALSE);
			}
			
			return FALSE;
		}
		
		return TRUE;
	}
	
	public function getRoles()
	{
		if($this->_roles !== NULL)
		{
			return $this->_roles;
		}

		if($this->getParent() instanceof Navigation_Page AND $page_roles = $this->getParent()->getRoles())
		{
			$this->_roles = $page_roles;
			return $page_roles;
		}
		
		return FALSE;
	}
	
	public function setRoles($roles)
	{
		$this->_roles = $roles;
		return $this;
	}

	/**
	 * Proxy to isActive()
	 *
	 * @param  bool $recursive  [optional] whether page should be considered
	 *                          active if any child pages are active. Default
	 *                          is FALSE.
	 * @return bool             whether page should be considered active
	 */
	public function getActive($recursive = FALSE)
	{
		return $this->isActive($recursive);
	}

	/**
	 * Sets whether the page should be visible or not
	 *
	 * @param  bool $visible         [optional] whether page should be
	 *                               considered visible or not. Default is TRUE.
	 * @return Zend_Navigation_Page  fluent interface, returns self
	 */
	public function setVisible($visible = TRUE)
	{
		$this->_visible = (bool) $visible;
		return $this;
	}

	/**
	 * Returns a boolean value indicating whether the page is visible
	 *
	 * @param  bool $recursive  [optional] whether page should be considered
	 *                          invisible if parent is invisible. Default is
	 *                          FALSE.
	 * @return bool             whether page should be considered visible
	 */
	public function isVisible($recursive = FALSE)
	{
		if ($recursive && isset($this->_parent) &&
			$this->_parent instanceof Navigation_Page) 
		{
			if (!$this->_parent->isVisible(TRUE)) 
			{
				return FALSE;
			}
		}

		return $this->_visible;
	}

	/**
	 * Proxy to isVisible()
	 *
	 * Returns a boolean value indicating whether the page is visible
	 *
	 * @param  bool $recursive  [optional] whether page should be considered
	 *                          invisible if parent is invisible. Default is
	 *                          FALSE.
	 * @return bool             whether page should be considered visible
	 */
	public function getVisible($recursive = FALSE)
	{
		return $this->isVisible($recursive);
	}

	/**
	 * Sets parent container
	 *
	 * @param  Zend_Navigation_Container $parent  [optional] new parent to set.
	 *                                            Default is NULL which will set
	 *                                            no parent.
	 * @return Zend_Navigation_Page               fluent interface, returns self
	 */
	public function setParent(Navigation_Container $parent = NULL)
	{
		if ($parent === $this) {
			throw new Kohana_Exception(
				'A page cannot have itself as a parent');
		}

		// return if the given parent already is parent
		if ($parent === $this->_parent) 
		{
			return $this;
		}

		// remove from old parent
		if (NULL !== $this->_parent) 
		{
			$this->_parent->removePage($this);
		}

		// set new parent
		$this->_parent = $parent;

		// add to parent if page and not already a child
		if (NULL !== $this->_parent && !$this->_parent->hasPage($this, FALSE)) 
		{
			$this->_parent->addPage($this);
		}

		return $this;
	}

	/**
	 * Returns parent container
	 *
	 * @return Zend_Navigation_Container|NULL  parent container or NULL
	 */
	public function getParent()
	{
		return $this->_parent;
	}

	/**
	 * Sets the given property
	 *
	 * If the given property is native (id, class, title, etc), the matching
	 * set method will be used. Otherwise, it will be set as a custom property.
	 *
	 * @param  string $property           property name
	 * @param  mixed  $value              value to set
	 * @return Zend_Navigation_Page       fluent interface, returns self
	 * @throws Zend_Navigation_Exception  if property name is invalid
	 */
	public function set($property, $value)
	{
		if (!is_string($property) || empty($property)) 
		{
			throw new Kohana_Exception(
					'Invalid argument: $property must be a non-empty string');
		}

		$method = 'set' . self::_normalizePropertyName($property);

		if ($method != 'setOptions' && $method != 'setConfig' &&
			method_exists($this, $method)) 
		{
			$this->$method($value);
		} 
		else 
		{
			$this->_properties[$property] = $value;
		}

		return $this;
	}

	/**
	 * Returns the value of the given property
	 *
	 * If the given property is native (id, class, title, etc), the matching
	 * get method will be used. Otherwise, it will return the matching custom
	 * property, or NULL if not found.
	 *
	 * @param  string $property           property name
	 * @return mixed                      the property's value or NULL
	 * @throws Zend_Navigation_Exception  if property name is invalid
	 */
	public function get($property)
	{
		if (!is_string($property) || empty($property)) 
		{
			throw new Kohana_Exception(
					'Invalid argument: $property must be a non-empty string');
		}

		$method = 'get' . self::_normalizePropertyName($property);

		if (method_exists($this, $method)) 
		{
			return $this->$method();
		} 
		elseif (isset($this->_properties[$property])) 
		{
			return $this->_properties[$property];
		}

		return NULL;
	}

	// Magic overloads:

	/**
	 * Sets a custom property
	 *
	 * Magic overload for enabling <code>$page->propname = $value</code>.
	 *
	 * @param  string $name               property name
	 * @param  mixed  $value              value to set
	 * @return void
	 * @throws Zend_Navigation_Exception  if property name is invalid
	 */
	public function __set($name, $value)
	{
		$this->set($name, $value);
	}

	/**
	 * Returns a property, or NULL if it doesn't exist
	 *
	 * Magic overload for enabling <code>$page->propname</code>.
	 *
	 * @param  string $name               property name
	 * @return mixed                      property value or NULL
	 * @throws Zend_Navigation_Exception  if property name is invalid
	 */
	public function __get($name)
	{
		return $this->get($name);
	}

	/**
	 * Checks if a property is set
	 *
	 * Magic overload for enabling <code>isset($page->propname)</code>.
	 *
	 * Returns TRUE if the property is native (id, class, title, etc), and
	 * TRUE or FALSE if it's a custom property (depending on whether the
	 * property actually is set).
	 *
	 * @param  string $name  property name
	 * @return bool          whether the given property exists
	 */
	public function __isset($name)
	{
		$method = 'get' . self::_normalizePropertyName($name);
		if (method_exists($this, $method)) 
		{
			return TRUE;
		}

		return isset($this->_properties[$name]);
	}

	/**
	 * Unsets the given custom property
	 *
	 * Magic overload for enabling <code>unset($page->propname)</code>.
	 *
	 * @param  string $name               property name
	 * @return void
	 * @throws Zend_Navigation_Exception  if the property is native
	 */
	public function __unset($name)
	{
		$method = 'set' . self::_normalizePropertyName($name);
		if (method_exists($this, $method)) 
		{
			throw new Kohana_Exception(sprintf(
					'Unsetting native property "%s" is not allowed',
					$name));
		}

		if (isset($this->_properties[$name])) 
		{
			unset($this->_properties[$name]);
		}
	}

	/**
	 * Returns page label
	 *
	 * Magic overload for enabling <code>echo $page</code>.
	 *
	 * @return string  page label
	 */
	public function __toString()
	{
		return $this->_label;
	}

	// Public methods:

	/**
	 * Adds a forward relation to the page
	 *
	 * @param  string $relation      relation name (e.g. alternate, glossary,
	 *                               canonical, etc)
	 * @param  mixed  $value         value to set for relation
	 * @return Zend_Navigation_Page  fluent interface, returns self
	 */
	public function addRel($relation, $value)
	{
		if (is_string($relation)) 
		{
			$this->_rel[$relation] = $value;
		}
		return $this;
	}

	/**
	 * Adds a reverse relation to the page
	 *
	 * @param  string $relation      relation name (e.g. alternate, glossary,
	 *                               canonical, etc)
	 * @param  mixed  $value         value to set for relation
	 * @return Zend_Navigation_Page  fluent interface, returns self
	 */
	public function addRev($relation, $value)
	{
		if (is_string($relation)) 
		{
			$this->_rev[$relation] = $value;
		}
		return $this;
	}

	/**
	 * Removes a forward relation from the page
	 *
	 * @param  string $relation      name of relation to remove
	 * @return Zend_Navigation_Page  fluent interface, returns self
	 */
	public function removeRel($relation)
	{
		if (isset($this->_rel[$relation])) 
		{
			unset($this->_rel[$relation]);
		}

		return $this;
	}

	/**
	 * Removes a reverse relation from the page
	 *
	 * @param  string $relation      name of relation to remove
	 * @return Zend_Navigation_Page  fluent interface, returns self
	 */
	public function removeRev($relation)
	{
		if (isset($this->_rev[$relation])) 
		{
			unset($this->_rev[$relation]);
		}

		return $this;
	}

	/**
	 * Returns an array containing the defined forward relations
	 *
	 * @return array  defined forward relations
	 */
	public function getDefinedRel()
	{
		return array_keys($this->_rel);
	}

	/**
	 * Returns an array containing the defined reverse relations
	 *
	 * @return array  defined reverse relations
	 */
	public function getDefinedRev()
	{
		return array_keys($this->_rev);
	}

	/**
	 * Returns custom properties as an array
	 *
	 * @return array  an array containing custom properties
	 */
	public function getCustomProperties()
	{
		return $this->_properties;
	}

	/**
	 * Returns a hash code value for the page
	 *
	 * @return string  a hash code value for this page
	 */
	public final function hashCode()
	{
		return spl_object_hash($this);
	}

	/**
	 * Returns an array representation of the page
	 *
	 * @return array  associative array containing all page properties
	 */
	public function toArray()
	{
		return array_merge(
			$this->getCustomProperties(),
			array(
				'label'     => $this->getlabel(),
				'id'        => $this->getId(),
				'class'     => $this->getClass(),
				'title'     => $this->getTitle(),
				'target'    => $this->getTarget(),
				'rel'       => $this->getRel(),
				'rev'       => $this->getRev(),
				'order'     => $this->getOrder(),
				'roles'		=> $this->getRoles(),
				'active'    => $this->isActive(),
				'visible'   => $this->isVisible(),
				'type'      => get_class($this),
				'pages'     => parent::toArray()
			));
	}

	// Internal methods:

	/**
	 * Normalizes a property name
	 *
	 * @param  string $property  property name to normalize
	 * @return string            normalized property name
	 */
	protected static function _normalizePropertyName($property)
	{
		return str_replace(' ', '', ucwords(str_replace('_', ' ', $property)));
	}

	public static function setDefaultPageType($type = NULL) {
		if($type !== NULL && !is_string($type)) 
		{
			throw new Kohana_Exception(
				'Cannot set default page type: type is no string but should be'
			);
		}

		self::$_defaultPageType = $type;
	}

	public static function getDefaultPageType() 
	{
		return self::$_defaultPageType;
	}

	// Abstract methods:

	/**
	 * Returns href for this page
	 *
	 * @return string  the page's href
	 */
	abstract public function getHref();
}