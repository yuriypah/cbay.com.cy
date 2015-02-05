<?php
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
 * @version    $Id: Navigation.php 23953 2011-05-03 05:47:39Z ralph $
 */

/**
 * A simple container class for {@link Zend_Navigation_Page} pages
 *
 * @category  Zend
 * @package   Zend_Navigation
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd     New BSD License
 */
class Navigation extends Navigation_Container
{
	protected static $_instance = array();

	public static function instance($resource = 'sitemap')
	{
		if(!isset(self::$_instance[$resource]))
		{
			self::$_instance[$resource] = new Model_Navigation($resource);
			return self::$_instance[$resource];
		}

		return self::$_instance[$resource];
	}

		/**
     * Creates a new navigation container
     *
     * @param array|Zend_Config $pages    [optional] pages to add
     * @throws Zend_Navigation_Exception  if $pages is invalid
     */
    public function __construct($pages = null)
    {
        if (is_array($pages)) 
		{
            $this->addPages($pages);
        } 
		elseif (null !== $pages) 
		{
            throw new Kohana_Exception(
                    'Invalid argument: $pages must be an array or null');
        }
    }
}