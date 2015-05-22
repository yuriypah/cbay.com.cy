<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Adverts extends Controller_System_Page
{

    public function action_index()
    {
        $view_types = array('list-img', 'tiles', 'list');
        $sort_types = array('price', 'date');
        $filter_types = array('all', 'private', 'company');
        $category = Input::get('c');
        $category_title = ORM::factory('lang_part')->get_cat_name('advert_categories', $category);
        if ($category_title)
            $this->ctx->page->title = $category_title[0]['title'];
        $this->ctx->page->meta_description = __('adverts_page.seo.description', array('category' => $category_title[0]['title']));
        /*if($category){
            $titles = ORM::factory('lang_part')->get_category_options($category);
            $keywords = $category_title[0]['title'];
            foreach($titles as $title){
                $keywords .= ','.$title['title'];
            }
            $this->ctx->page->meta_keywords = $keywords;
        }*/

        $adverts = ORM::factory('advert')
            ->find_all_by_filter();
        $vip_res = ORM::factory('advert')
            ->find_vip();
        $vip_adverts = array();
        $vip_count = count($vip_res);
        if ($vip_count > 0) {
            $limit = 3;
            if ($vip_count < 3) {
                $limit = $vip_count;
            }
            shuffle($vip_res);
            for ($i = 0; $i < $limit; $i++) {
                $vip_adverts[] = $vip_res[$i];
            }
        }

        /*echo '<pre>';
        print_r($adverts[0]);
        echo '</pre>';*/
        $view_type = Input::get('v', Cookie::get('advert_view_type', 'list-img'));

        if (!in_array($view_type, $view_types)) {
            $view_type = $this->ctx->config['default_view_type'];
        }

        Cookie::set('advert_view_type', $view_type);

        $this->template->content->view_type = $view_type;
        $this->template->content->view_types = $view_types;
        $this->template->content->sort_types = $sort_types;
        $this->template->content->filter_types = $filter_types;
        $this->template->content->adverts = $adverts[0];
        $this->template->content->pagination = $adverts[1]->render();
        $this->template->pagination = $adverts[1]->render();
        $this->template->content->vip_adverts = $vip_adverts;

    }

    public function action_view()
    {
        $id = (int)$this->request->param('id');
        $draft = (int)$this->request->query('draft');
        $this->template->content->message = NULL;
        if ($draft) {
            $message = ORM::factory('message')
                ->get_drafts($this->ctx->user->id, $draft);
            $this->template->content->message = $message[0];
        }
        $advert = ORM::factory('advert')
//            ->with('advert_option')
            ->where('id', '=', $id)
            //->where('status', '=', Model_Advert::STATUS_PUBLISHED);
            //->where('finished', '>=', DB::expr('NOW()'))
            ->find();
        $show = ORM::factory('advert_show');
        $show->add_shows($id);

        if (!$advert->loaded()) {
            throw new HTTP_Exception_404('Advert not found');
        } else if ($advert->finished() AND
            (($this->ctx->auth->logged_in() AND $advert->user_id != $this->ctx->user->id) OR !$this->ctx->auth->logged_in())
        ) {
            throw new HTTP_Exception_404('Advert is expired');
        }
        $show_data = $show->get_shows($id);
        if ($this->ctx->auth->logged_in() AND $advert->user_id == $this->ctx->user->id) {
            $show_data['this_user'] = true;
        } else {
            $show_data['this_user'] = false;
        }

        $this->template->content->options_for_view = array_merge(
            Model_Advert_Option::get_options_for_view($id),
            Model_Advert_Option_String::get_strings($id));

        $this->request->query('c', $advert->category_id);
        $this->request->query('l', $advert->city_id);

        $this->ctx->page->title = $advert->part()->title;
        $this->ctx->page->meta_description = $advert->part()->description;
        $this->ctx->page->meta_keywords = $advert->part()->keywords;
        $this->template->content->advert = $advert;

        $this->template->content->shows = $show_data;

        $this->blocks['wrapper_top'] = array(
            'name' => 'Advert_Breadcrumbs',
            'advert' => $advert
        );

        $this->blocks['wrapper_bottom'] = array(
            'name' => 'Advert_Related',
            'advert' => $advert
        );

        $this->template->scripts[] = 'libs/jquery.validation.js';
        $this->template->scripts[] = 'libs/fancybox2/jquery.fancybox.pack.js';
        $this->template->styles[] = 'libs/fancybox2/jquery.fancybox.css';
    }

    public function action_publish()
    {
        $ids = $this->request->param('id');
        $ids = explode(':', $ids);
        $data = array();
        foreach ($ids as $id) {
            $advert = ORM::factory('advert', $id);
            $advert->set_status(Model_Advert::STATUS_PUBLISHED);
            $data[] = $advert;
        }
        $this->template->content->data = $data;
    }

    public function action_unpublish()
    {
        $id = $this->request->param('id');
        if ($this->request->method() === Request::POST AND $this->request->post('unpublish')) {
            $this->auto_render = FALSE;

            $reason = $this->request->post('reason');
            $ids = $this->request->post('advert_id');
            $ids = explode(':', $ids);
            foreach ($ids as $id) {
                $advert = ORM::factory('advert', (int)$id);
                $advert->set_status($reason);
            }
            $this->go(Route::url('profile'));
        }

        $this->template->content->id = $id;
    }

    public function action_delete()
    {
        $ids = $this->request->param('id');
        $ids = explode(':', $ids);
        foreach ($ids as $id) {
            $advert = ORM::factory('advert', $id);
            $advert->delete();
        }
        $this->go_back();
    }

    public function action_phone()
    {
        $this->auto_render = FALSE;
        $string = str_replace(array("-", " "), "", base64_decode(Input::get("id")));
        $im = imagecreatetruecolor(strlen($string) * 9, 30);
        $red = imagecolorallocate($im, 0xF9, 0xF9, 0xF9);
        $black = imagecolorallocate($im, 0x00, 0x00, 0x00);
        imagefilledrectangle($im, 0, 0, 299, 99, $red);
        $font_file = 'resources/fonts/VeraSe.ttf';
        imagefttext($im, 10, 0, 2, 20, $black, $font_file, $string);
        $this->response->headers('Content-type', 'image/png');
        imagepng($im);
        imagedestroy($im);
    }
}
