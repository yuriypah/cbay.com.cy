<?php defined('SYSPATH') or die('No direct script access.');

class Objects_Advert_Counter extends Model_Object {
	
	protected function _execute()
	{
		$category = (int) Input::get('c');
		$categories = clone(Model_Advert_Category::$categories);
		
		if($category > 0)
		{
			$categories = $categories->find_by_id($category);
			$categories = $categories->current()->children();
		}
		else
		{
			$categories = $categories->get();
		}

		$this->_data = $categories;

		parent::_execute();
	}
}