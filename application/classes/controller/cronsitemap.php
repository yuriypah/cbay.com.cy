<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );
class Controller_Cronsitemap extends Controller {
    
    public function action_index(){
        if(empty($_SERVER['SERVER_NAME'])){
            Sitemapgenerate::build();
            echo 'ok ';
            exit;
        }
        $this->request->initial()->redirect('/');
    }
}
?>
