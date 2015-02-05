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
 * @category   Zend
 * @package    View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: HelperAbstract.php 23775 2011-03-01 17:25:24Z ralph $
 */

/**
 * Base class for navigational helpers
 *
 * @category   Zend
 * @package    View
 * @subpackage Helper
 * @copyright  Copyright (c) 2005-2011 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
abstract class Navigation_Helper_Abstract {
    /**
     * Container to operate on by default
     *
     * @var Navigation_Container
     */
    protected $_container;

    /**
     * The minimum depth a page must have to be included when rendering
     *
     * @var int
     */
    protected $_minDepth;

    /**
     * The maximum depth a page can have to be included when rendering
     *
     * @var int
     */
    protected $_maxDepth;

    /**
     * Indentation string
     *
     * @var string
     */
    protected $_indent = '';

    /**
     * Translator
     *
     * @var Translate_Adapter
     */
    protected $_useTranslator = TRUE;

    /**
     * ACL to use when iterating pages
     *
     * @var Acl
     */
    protected $_acl;

    /**
     * Wheter invisible items should be rendered by this helper
     *
     * @var bool
     */
    protected $_renderInvisible = false;

    // Accessors:

    /**
     * Sets navigation container the helper operates on by default
     *
     * Implements {@link View_Helper_Navigation_Interface::setContainer()}.
     *
     * @param  Navigation_Container $container        [optional] container
     *                                                     to operate on.
     *                                                     Default is null,
     *                                                     meaning container
     *                                                     will be reset.
     * @return View_Helper_Navigation_HelperAbstract  fluent interface,
     *                                                     returns self
     */
    public function setContainer(Navigation_Container $container = null)
    {
        $this->_container = $container;
        return $this;
    }

    /**
     * Returns the navigation container helper operates on by default
     *
     * Implements {@link View_Helper_Navigation_Interface::getContainer()}.
     *
     * If a helper is not explicitly set in this helper instance by calling
     * {@link setContainer()} or by passing it through the helper entry point,
     * this method will look in {@link Registry} for a container by using
     * the key 'Navigation'.
     *
     * If no container is set, and nothing is found in Registry, a new
     * container will be instantiated and stored in the helper.
     *
     * @return Navigation_Container  navigation container
     */
    public function getContainer()
    {
        if (null === $this->_container) 
		{
            $this->_container = new Navigation();
        }

        return $this->_container;
    }

    /**
     * Sets the minimum depth a page must have to be included when rendering
     *
     * @param  int $minDepth                               [optional] minimum
     *                                                     depth. Default is
     *                                                     null, which sets
     *                                                     no minimum depth.
     * @return View_Helper_Navigation_HelperAbstract  fluent interface,
     *                                                     returns self
     */
    public function setMinDepth($minDepth = null)
    {
        if (null === $minDepth || is_int($minDepth)) 
		{
            $this->_minDepth = $minDepth;
        }
		else
		{
            $this->_minDepth = (int) $minDepth;
        }
		
        return $this;
    }

    /**
     * Returns minimum depth a page must have to be included when rendering
     *
     * @return int|null  minimum depth or null
     */
    public function getMinDepth()
    {
        if (!is_int($this->_minDepth) || $this->_minDepth < 0) 
		{
            return 0;
        }

        return $this->_minDepth;
    }

    /**
     * Sets the maximum depth a page can have to be included when rendering
     *
     * @param  int $maxDepth                               [optional] maximum
     *                                                     depth. Default is
     *                                                     null, which sets no
     *                                                     maximum depth.
     * @return View_Helper_Navigation_HelperAbstract  fluent interface,
     *                                                     returns self
     */
    public function setMaxDepth($maxDepth = null)
    {
        if (null === $maxDepth || is_int($maxDepth)) 
		{
            $this->_maxDepth = $maxDepth;
        } 
		else 
		{
            $this->_maxDepth = (int) $maxDepth;
        }

        return $this;
    }

    /**
     * Returns maximum depth a page can have to be included when rendering
     *
     * @return int|null  maximum depth or null
     */
    public function getMaxDepth()
    {
        return $this->_maxDepth;
    }

    /**
     * Set the indentation string for using in {@link render()}, optionally a
     * number of spaces to indent with
     *
     * @param  string|int $indent                          indentation string or
     *                                                     number of spaces
     * @return View_Helper_Navigation_HelperAbstract  fluent interface,
     *                                                     returns self
     */
    public function setIndent($indent)
    {
        $this->_indent = $this->_getWhitespace($indent);
        return $this;
    }

    /**
     * Returns indentation
     *
     * @return string
     */
    public function getIndent()
    {
        return $this->_indent;
    }

    /**
     * Return renderInvisible flag
     *
     * @return bool
     */
    public function getRenderInvisible()
    {
        return $this->_renderInvisible;
    }

    /**
     * Render invisible items?
     *
     * @param  bool $renderInvisible                       [optional] boolean flag
     * @return View_Helper_Navigation_HelperAbstract  fluent interface
     *                                                     returns self
     */
    public function setRenderInvisible($renderInvisible = true)
    {
        $this->_renderInvisible = (bool) $renderInvisible;
        return $this;
    }

    /**
     * Sets whether translator should be used
     *
     * Implements {@link View_Helper_Navigation_Helper::setUseTranslator()}.
     *
     * @param  bool $useTranslator                         [optional] whether
     *                                                     translator should be
     *                                                     used. Default is true.
     * @return View_Helper_Navigation_HelperAbstract  fluent interface,
     *                                                     returns self
     */
    public function setUseTranslator($useTranslator = true)
    {
        $this->_useTranslator = (bool) $useTranslator;
        return $this;
    }

    /**
     * Returns whether translator should be used
     *
     * Implements {@link View_Helper_Navigation_Helper::getUseTranslator()}.
     *
     * @return bool  whether translator should be used
     */
    public function getUseTranslator()
    {
        return $this->_useTranslator;
    }

    // Magic overloads:

    /**
     * Magic overload: Proxy calls to the navigation container
     *
     * @param  string $method             method name in container
     * @param  array  $arguments          [optional] arguments to pass
     * @return mixed                      returns what the container returns
     * @throws Navigation_Exception  if method does not exist in container
     */
    public function __call($method, array $arguments = array())
    {
        return call_user_func_array(
                array($this->getContainer(), $method),
                $arguments);
    }

    /**
     * Magic overload: Proxy to {@link render()}.
     *
     * This method will trigger an E_USER_ERROR if rendering the helper causes
     * an exception to be thrown.
     *
     * Implements {@link View_Helper_Navigation_Helper::__toString()}.
     *
     * @return string
     */
    public function __toString()
    {
        try 
		{
            return $this->render();
        } 
		catch (Exception $e) 
		{
            $msg = get_class($e) . ': ' . $e->getMessage();
            trigger_error($msg, E_USER_ERROR);
            return '';
        }
    }

    // Public methods:

    /**
     * Finds the deepest active page in the given container
     *
     * @param  Navigation_Container $container  container to search
     * @param  int|null                  $minDepth   [optional] minimum depth
     *                                               required for page to be
     *                                               valid. Default is to use
     *                                               {@link getMinDepth()}. A
     *                                               null value means no minimum
     *                                               depth required.
     * @param  int|null                  $minDepth   [optional] maximum depth
     *                                               a page can have to be
     *                                               valid. Default is to use
     *                                               {@link getMaxDepth()}. A
     *                                               null value means no maximum
     *                                               depth required.
     * @return array                                 an associative array with
     *                                               the values 'depth' and
     *                                               'page', or an empty array
     *                                               if not found
     */
    public function findActive(Navigation_Container $container,
                               $minDepth = null,
                               $maxDepth = -1)
    {
        if (!is_int($minDepth)) 
		{
            $minDepth = $this->getMinDepth();
        }
        if ((!is_int($maxDepth) || $maxDepth < 0) && null !== $maxDepth) 
		{
            $maxDepth = $this->getMaxDepth();
		}

        $found  = null;
        $foundDepth = -1;
        $iterator = new RecursiveIteratorIterator($container,
                RecursiveIteratorIterator::CHILD_FIRST);

        foreach ($iterator as $page) 
		{
            $currDepth = $iterator->getDepth();

            if ($currDepth < $minDepth || $this->accept($page))
			{
                // page is not accepted
                continue;
            }

            if ($page->isActive(false) && $currDepth > $foundDepth) 
			{
                // found an active page at a deeper level than before
                $found = $page;
                $foundDepth = $currDepth;
            }
        }

        if (is_int($maxDepth) && $foundDepth > $maxDepth) 
		{
            while ($foundDepth > $maxDepth) 
			{
                if (--$foundDepth < $minDepth) 
				{
                    $found = null;
                    break;
                }

                $found = $found->getParent();
                if (!$found instanceof Navigation_Page) 
				{
                    $found = null;
                    break;
                }
            }
        }

        if ($found) 
		{
            return array('page' => $found, 'depth' => $foundDepth);
        } 
		else 
		{
            return array();
        }
    }

    /**
     * Checks if the helper has a container
     *
     * Implements {@link View_Helper_Navigation_Helper::hasContainer()}.
     *
     * @return bool  whether the helper has a container or not
     */
    public function hasContainer()
    {
        return null !== $this->_container;
    }

    /**
     * Checks if the helper has an ACL role
     *
     * Implements {@link View_Helper_Navigation_Helper::hasRole()}.
     *
     * @return bool  whether the helper has a an ACL role or not
     */
    public function hasRole()
    {
        return null !== $this->_role;
    }

    /**
     * Returns an HTML string containing an 'a' element for the given page
     *
     * @param  Navigation_Page $page  page to generate HTML for
     * @return string                      HTML string for the given page
     */
    public function htmlify(Navigation_Page $page)
    {
        // get label and title for translating
        $label = $page->getLabel();
        $title = $page->getTitle();

        if ($this->getUseTranslator()) 
		{
            if (is_string($label) && !empty($label)) 
			{
                $label = __($label);
            }
            if (is_string($title) && !empty($title)) 
			{
                $title = __($title);
            }
        }

        // get attribs for anchor element
        $attribs = array(
            'id'     => $page->getId(),
            'class'  => $page->getClass(),
            'target' => $page->getTarget()
        );
		
		return HTML::anchor($page->getHref(), $label, $attribs);
    }

    // Iterator filter methods:

    /**
     * Determines whether a page should be accepted when iterating
     *
     * Rules:
     * - If a page is not visible it is not accepted, unless RenderInvisible has
     *   been set to true.
     * - If helper has no ACL, page is accepted
     * - If helper has ACL, but no role, page is not accepted
     * - If helper has ACL and role:
     *  - Page is accepted if it has no resource or privilege
     *  - Page is accepted if ACL allows page's resource or privilege
     * - If page is accepted by the rules above and $recursive is true, the page
     *   will not be accepted if it is the descendant of a non-accepted page.
     *
     * @param  Navigation_Page $page      page to check
     * @param  bool                $recursive  [optional] if true, page will not
     *                                         be accepted if it is the
     *                                         descendant of a page that is not
     *                                         accepted. Default is true.
     * @return bool                            whether page should be accepted
     */
    public function accept(Navigation_Page $page, $recursive = true)
    {
        // accept by default
        $accept = true;

        if (!$page->isVisible(false) && !$this->getRenderInvisible()) 
		{
			
            // don't accept invisible pages
            $accept = false;
        }

        if ($accept && $recursive) 
		{
            $parent = $page->getParent();
            if ($parent instanceof Navigation_Page) 
			{
                $accept = $this->accept($parent, true);
            }
        }

        return $accept;
    }

    // Util methods:

    /**
     * Retrieve whitespace representation of $indent
     *
     * @param  int|string $indent
     * @return string
     */
    protected function _getWhitespace($indent)
    {
        if (is_int($indent)) 
		{
            $indent = str_repeat(' ', $indent);
        }

        return (string) $indent;
    }

    /**
     * Normalize an ID
     *
     * Overrides {@link View_Helper_HtmlElement::_normalizeId()}.
     *
     * @param  string $value
     * @return string
     */
    protected function _normalizeId($value)
    {
        $prefix = get_class($this);
        $prefix = strtolower(trim(substr($prefix, strrpos($prefix, '_')), '_'));

        return $prefix . '-' . $value;
    }
}
