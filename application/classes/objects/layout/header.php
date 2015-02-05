<?php defined('SYSPATH') or die('No direct script access.');

class Objects_Layout_Header extends Model_Object {

	protected function _execute()
	{
                $indexpage = false;
                if(Request::current()->uri() == "/")
                    $indexpage = true;
		$new_messages = 0;
		if ( Auth::instance()->logged_in() )
		{
			$new_messages = ORM::factory('message')
				->count_new(Auth::instance()->get_user());
		}
		$this->_data['indexpage'] = $indexpage;
		$this->_data['messages'] = (int) $new_messages;
	}
}