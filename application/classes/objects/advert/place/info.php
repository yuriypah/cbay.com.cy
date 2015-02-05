<?php defined('SYSPATH') or die('No direct script access.');

class Objects_Advert_Place_Info extends Model_Object {
	
	protected function _execute()
	{
		//$this->_template = 'blocks/advert/place/info_'.I18n::lang();
        $this->_template = 'blocks/advert/place/info';
		parent::_execute();
	}
}