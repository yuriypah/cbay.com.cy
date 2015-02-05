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
 * @version    $Id: Container.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * Zend_Navigation_Container
 *
 * Container class for Zend_Navigation_Page classes.
 *
 * @category  Zend
 * @package   Zend_Navigation
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class Navigation_Container implements RecursiveIterator, Countable
{
	/**
	 * Contains sub pages
	 *
	 * @var array
	 */
	protected $_pages = array();

	/**
	 * An index that contains the order in which to iterate pages
	 *
	 * @var array
	 */
	protected $_index = array();

	/**
	 * Whether index is dirty and needs to be re-arranged
	 *
	 * @var bool
	 */
	protected $_dirtyIndex = FALSE;

	// Internal methods:

	/**
	 * Sorts the page index according to page order
	 *
	 * @return void
	 */
	protected function _sort()
	{
		if ($this->_dirtyIndex) 
		{
			$newIndex = array();
			$index = 0;

			foreach ($this->_pages as $hash => $page) 
			{
				$order = $page->getOrder();
				if ($order === NULL) 
				{
					$newIndex[$hash] = $index;
					$index++;
				}
				else
				{
					$newIndex[$hash] = $order;
				}
			}

			asort($newIndex);
			$this->_index = $newIndex;
			$this->_dirtyIndex = FALSE;
		}
	}

	// Public methods:

	/**
	 * Notifies container that the order of pages are updated
	 *
	 * @return void
	 */
	public function notifyOrderUpdated()
	{
		$this->_dirtyIndex = TRUE;
	}

	/**
	 * Adds a page to the container
	 *
	 * This method will inject the container as the given page's parent by
	 * calling {@link Zend_Navigation_Page::setParent()}.
	 *
	 * @param  Zend_Navigation_Page|array|Zend_Config $page  page to add
	 * @return Zend_Navigation_Container                     fluent interface,
	 *                                                       returns self
	 * @throws Zend_Navigation_Exception                     if page is invalid
	 */
	public function addPage($page)
	{
		if ($page === $this) 
		{
			throw new Kohana_Exception('A page cannot have itself as a parent');
		}

		if (is_array($page)) 
		{
			$page = Navigation_Page::factory($page);
		} 
		elseif (!$page instanceof Navigation_Page) 
		{
			throw new Kohana_Exception(
					'Invalid argument: $page must be an instance of ' .
					'Zend_Navigation_Page or an array');
		}

		$hash = $page->hashCode();

		if (array_key_exists($hash, $this->_index)) 
		{
			// page is already in container
			return $this;
		}

		// adds page to container and sets dirty flag
		$this->_pages[$hash] = $page;
		$this->_index[$hash] = $page->getOrder();
		$this->_dirtyIndex = TRUE;

		// inject self as page parent
		$page->setParent($this);

		return $this;
	}

	/**
	 * Adds several pages at once
	 *
	 * @param  array|Zend_Config $pages   pages to add
	 * @return Zend_Navigation_Container  fluent interface, returns self
	 * @throws Zend_Navigation_Exception  if $pages is not array or Zend_Config
	 */
	public function addPages($pages)
	{
		if(Kohana::$profiling === TRUE)
		{
			$benchmark = Profiler::start('Navigation', __METHOD__);
		}
		
		if (!is_array($pages)) 
		{
			throw new Kohana_Exception(
					'Invalid argument: $pages must be an array');
		}

		foreach ($pages as $page) 
		{
			$this->addPage($page);
		}
		
		if(isset($benchmark))
		{
			Profiler::stop($benchmark);
		}

		return $this;
	}

	/**
	 * Sets pages this container should have, removing existing pages
	 *
	 * @param  array $pages               pages to set
	 * @return Zend_Navigation_Container  fluent interface, returns self
	 */
	public function setPages(array $pages)
	{
		$this->removePages();
		return $this->addPages($pages);
	}

	/**
	 * Returns pages in the container
	 *
	 * @return array  array of Zend_Navigation_Page instances
	 */
	public function getPages()
	{
		return $this->_pages;
	}

	/**
	 * Removes the given page from the container
	 *
	 * @param  Zend_Navigation_Page|int $page  page to remove, either a page
	 *                                         instance or a specific page order
	 * @return bool                            whether the removal was
	 *                                         successful
	 */
	public function removePage($page)
	{
		if ($page instanceof Navigation_Page) 
		{
			$hash = $page->hashCode();
		} elseif (is_int($page)) 
		{
			$this->_sort();
			if (!$hash = array_search($page, $this->_index)) 
			{
				return FALSE;
			}
		} 
		else 
		{
			return FALSE;
		}

		if (isset($this->_pages[$hash])) 
		{
			unset($this->_pages[$hash]);
			unset($this->_index[$hash]);
			$this->_dirtyIndex = TRUE;
			return TRUE;
		}

		return FALSE;
	}

	/**
	 * Removes all pages in container
	 *
	 * @return Zend_Navigation_Container  fluent interface, returns self
	 */
	public function removePages()
	{
		$this->_pages = array();
		$this->_index = array();
		return $this;
	}

	/**
	 * Checks if the container has the given page
	 *
	 * @param  Zend_Navigation_Page $page       page to look for
	 * @param  bool                 $recursive  [optional] whether to search
	 *                                          recursively. Default is FALSE.
	 * @return bool                             whether page is in container
	 */
	public function hasPage(Navigation_Page $page, $recursive = FALSE)
	{
		if (array_key_exists($page->hashCode(), $this->_index)) 
		{
			return TRUE;
		} 
		elseif ($recursive) 
		{
			foreach ($this->_pages as $childPage) 
			{
				if ($childPage->hasPage($page, TRUE)) 
				{
					return TRUE;
				}
			}
		}

		return FALSE;
	}

	/**
	 * Returns TRUE if container contains any pages
	 *
	 * @return bool  whether container has any pages
	 */
	public function hasPages()
	{
		return count($this->_index) > 0;
	}

	/**
	 * Returns a child page matching $property == $value, or NULL if not found
	 *
	 * @param  string $property           name of property to match against
	 * @param  mixed  $value              value to match property against
	 * @return Zend_Navigation_Page|NULL  matching page or NULL
	 */
	public function findOneBy($property, $value)
	{
		$iterator = new RecursiveIteratorIterator($this,
							RecursiveIteratorIterator::SELF_FIRST);

		foreach ($iterator as $page) 
		{
			if ($page->get($property) == $value) 
			{
				return $page;
			}
		}

		return NULL;
	}
	
	public function findOneByUri($current_uri)
	{
		if(Kohana::$profiling === TRUE)
		{
			$benchmark = Profiler::start('Navigation', __METHOD__ . '(' . $current_uri . ')');
		}

		$iterator = new RecursiveIteratorIterator($this,
							RecursiveIteratorIterator::SELF_FIRST);

		$default_params = array('controller', 'action', 'directory');
		$current_uri = trim($current_uri, '/');

		foreach ($iterator as $page) 
		{
			$route = $page->getRoute();
			$current_uri = trim($current_uri, '/');

			$route_params = Route::get($route)->matches($current_uri);
			$match = TRUE;

			if(  is_array( $route_params ))
			{
				foreach ($route_params as $key => $value)
				{
					if(in_array($key, $default_params))
					{
						if($page->$key != $value)
						{
							$match = FALSE;
						}
						unset($route_params[$key]);
					}
				}
			}
			else
			{
				$match = FALSE;
			}
			
			
			
			if($match === FALSE)
			{
				continue;
			}
			
			if(isset($benchmark))
			{
				Profiler::stop($benchmark);
			}

			return $page;
		}
		
		if(isset($benchmark))
		{
			Profiler::stop($benchmark);
		}

		return NULL;
	}


	/**
	 * Returns all child pages matching $property == $value, or an empty array
	 * if no pages are found
	 *
	 * @param  string $property  name of property to match against
	 * @param  mixed  $value     value to match property against
	 * @return array             array containing only Zend_Navigation_Page
	 *                           instances
	 */
	public function findAllBy($property, $value)
	{
		$found = array();

		$iterator = new RecursiveIteratorIterator($this,
							RecursiveIteratorIterator::SELF_FIRST);

		foreach ($iterator as $page) 
		{
			if ($page->get($property) == $value) 
			{
				$found[] = $page;
			}
		}

		return $found;
	}

	/**
	 * Returns page(s) matching $property == $value
	 *
	 * @param  string $property  name of property to match against
	 * @param  mixed  $value     value to match property against
	 * @param  bool   $all       [optional] whether an array of all matching
	 *                           pages should be returned, or only the first.
	 *                           If TRUE, an array will be returned, even if not
	 *                           matching pages are found. If FALSE, NULL will
	 *                           be returned if no matching page is found.
	 *                           Default is FALSE.
	 * @return Zend_Navigation_Page|NULL  matching page or NULL
	 */
	public function findBy($property, $value, $all = FALSE)
	{
		if ($all) 
		{
			return $this->findAllBy($property, $value);
		} 
		else 
		{
			return $this->findOneBy($property, $value);
		}
	}

	/**
	 * Magic overload: Proxy calls to finder methods
	 *
	 * Examples of finder calls:
	 * <code>
	 * // METHOD                    // SAME AS
	 * $nav->findByLabel('foo');    // $nav->findOneBy('label', 'foo');
	 * $nav->findOneByLabel('foo'); // $nav->findOneBy('label', 'foo');
	 * $nav->findAllByClass('foo'); // $nav->findAllBy('class', 'foo');
	 * </code>
	 *
	 * @param  string $method             method name
	 * @param  array  $arguments          method arguments
	 * @throws Zend_Navigation_Exception  if method does not exist
	 */
	public function __call($method, $arguments)
	{
		if (@preg_match('/(find(?:One|All)?By)(.+)/', $method, $match)) 
		{
			return $this->{$match[1]}($match[2], $arguments[0]);
		}

		throw new Kohana_Exception(sprintf(
				'Bad method call: Unknown method %s::%s',
				get_class($this),
				$method));
	}

	/**
	 * Returns an array representation of all pages in container
	 *
	 * @return array
	 */
	public function toArray()
	{
		$pages = array();

		$this->_dirtyIndex = TRUE;
		$this->_sort();
		$indexes = array_keys($this->_index);
		foreach ($indexes as $hash) 
		{
			$pages[] = $this->_pages[$hash]->toArray();
		}
		return $pages;
	}

	// RecursiveIterator interface:

	/**
	 * Returns current page
	 *
	 * Implements RecursiveIterator interface.
	 *
	 * @return Zend_Navigation_Page       current page or NULL
	 * @throws Zend_Navigation_Exception  if the index is invalid
	 */
	public function current()
	{
		$this->_sort();
		current($this->_index);
		$hash = key($this->_index);

		if (isset($this->_pages[$hash])) 
		{
			return $this->_pages[$hash];
		} 
		else 
		{
			throw new Kohana_Exception(
					'Corruption detected in container; ' .
					'invalid key found in internal iterator');
		}
	}

	/**
	 * Returns hash code of current page
	 *
	 * Implements RecursiveIterator interface.
	 *
	 * @return string  hash code of current page
	 */
	public function key()
	{
		$this->_sort();
		return key($this->_index);
	}

	/**
	 * Moves index pointer to next page in the container
	 *
	 * Implements RecursiveIterator interface.
	 *
	 * @return void
	 */
	public function next()
	{
		$this->_sort();
		next($this->_index);
	}

	/**
	 * Sets index pointer to first page in the container
	 *
	 * Implements RecursiveIterator interface.
	 *
	 * @return void
	 */
	public function rewind()
	{
		$this->_sort();
		reset($this->_index);
	}

	/**
	 * Checks if container index is valid
	 *
	 * Implements RecursiveIterator interface.
	 *
	 * @return bool
	 */
	public function valid()
	{
		$this->_sort();
		return current($this->_index) !== FALSE;
	}

	/**
	 * Proxy to hasPages()
	 *
	 * Implements RecursiveIterator interface.
	 *
	 * @return bool  whether container has any pages
	 */
	public function hasChildren()
	{
		return $this->hasPages();
	}

	/**
	 * Returns the child container.
	 *
	 * Implements RecursiveIterator interface.
	 *
	 * @return Zend_Navigation_Page|NULL
	 */
	public function getChildren()
	{
		$hash = key($this->_index);

		if (isset($this->_pages[$hash])) 
		{
			return $this->_pages[$hash];
		}

		return NULL;
	}

	// Countable interface:

	/**
	 * Returns number of pages in container
	 *
	 * Implements Countable interface.
	 *
	 * @return int  number of pages in the container
	 */
	public function count()
	{
		return count($this->_index);
	}
}