<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_Help extends Controller_System_Page
{

	public function before()
	{
        parent::before();
	}

	public function action_index()
	{
	    $local = I18n::lang();
		$this->left_sidebar = TRUE;
	    $art = $this->request->param('article');
        $this->template->content = "hello";
        if($art == true){
    	    $this->template->content = View::factory('help/'.$local.'/'.$art);
        }
        else {
            $this->template->content = View::factory('help/'.$local.'/index');
        }
	}
}
