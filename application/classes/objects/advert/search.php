<?php defined('SYSPATH') or die('No direct script access.');

class Objects_Advert_Search extends Model_Object {
	
	protected function _execute()
	{
		$categories = clone(Model_Advert_Category::$categories);
		$categories = $categories->flatten()
			->as_array('id');		

		$_categories = array();
		foreach ($categories as $id => $category) 
		{
			$title = '---'.$category->title. '---';
			if($category->parent_id != 0)
			{
				$title = $category->title;
			}
			
			$_categories['value'][$id]= $title;
                        $_categories['parent'][$id] = $category->parent_id;
		}
		
		$_categories['value'] =  ARR::merge(array(
			__('search.label.all_categories')
		), $_categories['value']);

		$cities = Arr::merge(array(__('map.city.everywere')), Model_Map::$cities);
				
		$this->_data['categories'] = $_categories;
		$this->_data['cities'] = $cities;
		parent::_execute();
	}
}