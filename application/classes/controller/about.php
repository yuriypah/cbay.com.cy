<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_About extends Controller_System_Page
{

    public function before()
    {
        parent::before();
	    $local = I18n::lang();
        $this->template->content = View::factory('about/'.$local.'/index');
    }
	public function action_index()
	{

	}
}