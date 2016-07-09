<?php defined('SYSPATH') or die('No direct script access.');

class Objects_Advert_Categoriesindex extends Model_Object {
	
	protected function _execute()
	{
		$this->_data = ORM::factory( 'advert_category' )
			->tree()
			->get();
		
		parent::_execute();
	}
}