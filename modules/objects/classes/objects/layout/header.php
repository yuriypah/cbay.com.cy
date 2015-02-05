<?php defined('SYSPATH') or die('No direct script access.');

class Objects_Layout_Header extends Model_Object {
	
	protected function _execute()
	{
		$this->_data = 'Header';
		parent::_execute();
	}
}