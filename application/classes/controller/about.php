<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_About extends Controller_System_Page
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
        if($art == true){
            $this->template->content = View::factory('about/'.$local.'/'.$art);
        }
        else {
            $this->template->content = View::factory('about/'.$local.'/index');
        }
    }
}