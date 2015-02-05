<?php defined('SYSPATH') or die('No direct script access.');

class Model_Navigation extends Model {
	
	protected $_navigation = NULL;
	protected $_menu = array();

	public function __construct($resource = 'sitemap') 
	{
		$sitemap = Kohana::$config->load($resource)->as_array();
		
		if(empty($sitemap))
		{
			throw new Exception('Site map '.$resource.' not found');
		}

		Navigation_Page::setDefaultPageType('mvc');
		
		if(Kohana::$caching === TRUE)
		{
			$this->_navigation = Kohana::cache('navigation.'.$resource);

			if($this->_navigation === NULL)
			{
				$this->_navigation = new Navigation($sitemap);
				Kohana::cache('navigation.'.$resource, $this->_navigation, 3600);
			}
		}
		else
		{
			$this->_navigation = new Navigation($sitemap);
		}
		
		unset($sitemap);
	}
	
	public function pages()
	{
		return $this->_navigation;
	}
	
	public function menu()
	{
		if(empty($this->_menu))
		{
			$this->_menu = $this->_build_menu($this->_navigation->getChildren());
		}

		return $this->_menu;
	}
	
	protected function _build_menu($pages, $children = FALSE)
	{
		$user = Auth::instance()->get_user();
		$menu = array();
		if($pages === NULL)
		{
			return array();
		}
		foreach($pages as $page)
		{
			$secured = $page->hasAccess($user);
			$code = $page->hashCode();
			
			if($page->visible === TRUE)
			{
				if($children === TRUE AND $secured === FALSE)
				{
					continue;
				}
				
				$menu[$code] = array(
					'secured' => $secured,
					'label' => $page->label,
					'href' => $page->href,
					'class' => $page->class,
					'active' => $page->isActive(TRUE),
					'separator' => $page->separator,
					'icon' => $page->icon,
					'children' => array()
				);				

				if($page->hasPages())
				{
					$menu[$code]['children'] = $this->_build_menu($page->getPages(), TRUE);
				}
			}
		}
		
		return $menu;
	}
}