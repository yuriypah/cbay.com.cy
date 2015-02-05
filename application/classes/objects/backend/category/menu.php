<?php defined('SYSPATH') or die('No direct script access.');

class Objects_Backend_Category_Menu extends Model_Object {
	
	protected function _execute()
	{
		$this->_data['categories'] = ORM::factory( 'advert_category' )
			->tree()
			->as_array(NULL, 'id', 'title', 3);
	}
}