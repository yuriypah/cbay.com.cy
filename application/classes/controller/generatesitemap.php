<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );
class Controller_Generatesitemap extends Controller_System_Page {
    
    public function action_index(){
        if($this->request->method() == "POST"){
            Sitemapgenerate::build();
            Messages::success(__('messages.generatesitemap'));
        }
    }
}
?>
