<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Index extends Controller_System_Page {

    public $template = 'global/index';

    public function action_index() {
        $adverts = ORM::factory('advert')->where(DB::expr('now()'), '<=', DB::expr('TIMESTAMP(finished)'))->find_all();
      
        $this->ctx->page->title = __('index_page.text.title');
        $this->ctx->page->meta_description = __('index_page.text.meta_description');
        $this->ctx->page->meta_keywords = __('index_page.text.keywords');
        $this->template->adverts_count = $adverts->count();
        $this->scripts[] = 'libs/jquery.measurer.js';
        $this->scripts[] = 'libs/jquery.gradienttext.js';

        $this->ctx->page->qwe = 'asdasd';
    }
    public function action_feedbackmessage() {

    }
    public function action_mailer()
    {
        $data = $this->request->post();
        if(!$data['email']) {
         return;
        }
        $email = Email::factory('Новое объявление', "Добро пожаловать в сервис бронирования автомобилей на Кипре.", 'text/html')
            ->to($data['email'])
            ->from('support@cbay.com.cy', 'RENTCAR | CBAY')
            ->send();
        $this->auto_render = FALSE;
        die(json_encode(array('sended' => true)));
    }

}