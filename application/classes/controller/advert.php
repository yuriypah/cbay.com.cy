<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_Advert extends Controller_System_Page
{

    public function action_edit()
    {
        $this->right_sidebar = TRUE;
        $this->template->scripts[] = 'libs/jquery.uploader.js';
//		$this->template->scripts[] = 'libs/tinymce/tiny_mce.js';

        $id = (int)$this->request->param('id');
        $advert = ORM::factory('advert', $id);
        if (!$advert->loaded()) {
            Messages::success(__('Advert not found'));
            $this->go_back();
        }

        $city = $advert->city_id;

        $data = $advert->as_array();
        $data['option'] = $advert->get_options();
//        if($data == false){
        $data['title'] = $advert->part()->title;
        $data['description'] = $advert->part()->description;
//        }
        $images = array();

        if (!empty($advert->image)) {
            $images[] = $advert->image('135_90');
        }

        foreach ($advert->images->find_all() as $image) {
            $images[] = $image->image('135_90');
        }

        $data['images'] = $images;

        $advert_data = Session::instance()->get('advert_place_data', array());

        if (isset($advert_data['images'])) {
            foreach ($advert_data['images'] as $id => $image) {
                $data['images'][] = $image;
            }
        }

        if (isset($data['images'])) {
            $data['images'] = array_unique($data['images']);
        }

        $this->template->content->city = $city;
        $this->template->content->data = $data;
        $this->template->content->categories = ORM::factory('advert_category')
            ->tree()
            ->as_array('title', 'id', 'title', 3);

        $this->template->content->action = 'edit';

        if ($this->request->method() === Request::POST) {
            return $this->_place($advert);
        }
    }

    public function action_place()
    {

        $lang = I18n::lang();
        if (Auth::instance()->logged_in()) {
            $lang = Auth::instance()->get_user()->profile->default_locale;
        }
        Model_Advert_Category::build_js();

        $this->right_sidebar = TRUE;
        $this->template->scripts[] = 'libs/jquery.uploader.js';
//		$this->template->scripts[] = 'libs/tinymce/tiny_mce.js';

        $city = Model_Map::$current_city;
        if (isset($this->ctx->user->profile->city_id) AND $this->ctx->user->profile->city_id !== NULL) {
            $city = $this->ctx->user->profile->city_id;
        }

        $this->template->content->city = $city;
        $this->template->content->data = $this->session->get('advert_place_data', array());

        if (isset($this->template->content->data['option']))
            $this->template->content->cat_options = json_encode($this->template->content->data['option']);

        $this->template->content->categories = ORM::factory('advert_category')
            ->tree()
            ->as_array('title', 'id', 'title', 3);

        $this->template->content->action = 'place';

        if ($this->request->method() === Request::POST) {
            return $this->_place();
        }
    }

    protected function _place($advert = NULL)
    {
        $data = $this->request->post();
        if ($advert instanceof Model_Advert) {
            $data['advert_id'] = $advert->id;
            $data['city_id'] = $advert->city_id;
            $data['category_id'] = $advert->category_id;
        }

        $this->session->set('advert_place_data', $data);
        if (Arr::get($data, 'action') == 'reset') { // Удаляем данные из сессии
            $this->session->delete('advert_place_data');
            $this->go_back();
        }

        $validation = Validation::factory($data)
            ->rules('title', array(
                array('not_empty')
            ))

            ->rules('phone', array(
                array('phone', array(':value', Model_User_Profile::PHONE_LENGTH)),
                array('not_empty'),
            ))
            ->rules('city_id',
                array(array('not_empty'), array('numeric'), array('regex', array(':value', '/[^0]/')))
            )
            ->rules('package_id', array(
                array('not_empty'),
                array('array_key_exists', array(':value', Model_Package::$packages))
            ));
//                         ->rules('keywords', array(
//                                 array('not_empty')
//                         ))
        if ($data['category_id'] != 20) {
            $validation->rules('amount',
                array(array('not_empty'), array('numeric'), array('regex', array(':value', '/[^0]/')))
            );
        } else {
            $validation->rules('amount', array(
                array('not_empty'),
                array('array_key_exists', array(':value', array('0',0)))
            ));
        }
            $validation->rule('token', 'Security::check', array(':value'));

        if (!$this->ctx->auth->logged_in()) {
            $validation
                ->rules('type', array(
                    array('not_empty'),
                    array('array_key_exists', array(':value', Model_User_Profile::$types))
                ))
                ->rules('name', array(
                    array('not_empty')
                ))
                ->rules('email', array(
                    array('not_empty'),
                    array('email')
                ));
        }

        if (!$validation->check()) {
            Messages::errors($validation->errors('validation'));
            $this->go_back();
        }

        $this->go(Route::url('default', array(
            'controller' => 'advert', 'action' => 'confirm'
        )));
    }

    public function action_confirm()
    {
        $data = $this->session->get('advert_place_data');
        if (count($data['option']) > 0) {
            foreach ($data['option'] as $key => $value) {
                if ($value == '') {
                    unset($data['option'][$key]);
                }
            }
        }

        $captcha = Captcha::instance();
        $captcha->render(true);
        $data['captcha'] = $captcha;
        if (Auth::instance()->logged_in()) {
            $locale = Auth::instance()->get_user()->profile->default_locale;
        } else {
            $locale = I18n::lang();
        }
        $data['language'] = $locale;
        $route = array(
            'controller' => 'advert', 'action' => 'place'
        );

        if ($data == NULL) {
            $this->go(Route::url('default', array(
                'controller' => 'advert', 'action' => 'place'
            )));
        }
        if (empty($data['email'])) {
            $this->go(Route::url('default', array(
                'controller' => 'advert', 'action' => 'place'
            )));
        }
        if (($advert_id = Arr::get($data, 'advert_id')) > 0) {
            $route['action'] = 'edit';
            $route['id'] = $advert_id;
        }

        // Проверяем хочет ли пользователь получать вопросы от покупателей по e-mail
        if (
            Arr::get($data, 'allow_mails', 1) == 'no' OR
            Arr::get($data, 'allow_mails', 1) === Model_Advert::MAILS_NOT_ALLOW
        ) {
            $data['allow_mails'] = Model_Advert::MAILS_NOT_ALLOW; // Нет
        } else {
            $data['allow_mails'] = Model_Advert::MAILS_ALLOW; // Да
        }

        // Поиск пользователя в БД
        $data['registered'] = FALSE;

        $user = ORM::factory('user', array(
            'email' => $data['email']
        ));

        if ($user->loaded()) {
            $data['registered'] = TRUE;
        }

        $data['title'] = Kses::filter($data['title']);
        $data['description'] = Kses::filter($data['description'], $this->ctx->config['allowed_html_tags']);

        $this->session->set('advert_place_data', $data);

        if ($data['category_id'] == '0') {
            Messages::errors(__('place.error.no_category'));
            $this->go_back();
        }
        $category = Model_Advert_Category::$categories
            ->find_by_id($data['category_id'])
            ->current();

        $this->template->content->category = array_reverse($category->get_keys_path('title'));
        $this->template->content->data = $data;


//		$this->template->content->options = json_encode($data['option']);
        $this->template->content->options_for_view = Model::factory('advert_option')
            ->get_options_for_view($data['option']);

        $this->template->content->auth_form = View::factory('advert/blocks/register_form', array(
            'data' => $data
        ));
        // Если пользователь авторизирован
        if ($this->ctx->auth->logged_in()) {
            $user = $this->ctx->user;
            $this->template->content->auth_form = NULL;
        } // Если пользователь зарегестрирован, показываем ему форму авторизации
        elseif ($data['registered'] === TRUE) {
            $this->template->content->auth_form->set_filename('advert/blocks/auth_form');
        }

        if ($this->request->method() === Request::POST) {
            $data_confirm = $this->request->post();
            $data_confirm['user_action'] = 'register';
            $data_confirm['email'] = $data['email'];

            // Если пользователь авторизирован
            if ($this->ctx->auth->logged_in()) {
                $data_confirm['user_action'] = 'logged_in';
            } // Если пользователь зарегестрирован, то поле 'user_action' нет и добавляем вручную
            elseif ($data['registered'] === TRUE) {
                $data_confirm['user_action'] = 'registered';
            }

            // Если пользователь нажал на кнопку, отличную от Next
            if (Arr::get($data_confirm, 'action') == 'back') { // Возвращаем на страницу ввода данных
                $this->go(Route::url('default', $route));
            } elseif (Arr::get($data_confirm, 'action') == 'reset') { // Удаляем данные из сессии
                $this->session->delete('advert_place_data');
                $this->go(Route::url('default', $route));
            }
            if (!Captcha::valid($data_confirm['captcha'])) {
                Messages::errors(__('error.label.captcha'));
                $this->go_back();
            }
            $this->_confirm($data_confirm, $user);
        }
    }

    private function _confirm($data_confirm, $user)
    {

        $validation = Validation::factory($data_confirm);

        switch ($data_confirm['user_action']) {
            case 'noregister': // не сейчас
                $validation
                    ->rule('password', 'not_empty')
                    ->rule('password', 'min_length', array(':value', Model_User::PASSWORD_LENGTH))
                    ->rule('password_confirm', 'matches', array(':data', ':field', 'password'))
                    ->rule('agree', 'not_empty');
//                                         ->rule('keywords', 'not_empty');
                break;

            case 'register': // хочу зарегистрироваться
                $validation
                    ->rule('email', 'not_empty')
                    ->rule('email', 'email')
                    ->rule('email', array($user, 'unique'), array('email', ':value'))
                    ->rule('password', 'not_empty')
                    ->rule('password', 'min_length', array(':value', Model_User::PASSWORD_LENGTH))
                    ->rule('password_confirm', 'matches', array(':data', ':field', 'password'))
                    ->rule('agree', 'not_empty');
//                                         ->rule('keywords', 'not_empty');
                break;

            case 'registered': // уже зарегистрирован
                $validation
                    ->rule('email', 'not_empty')
                    ->rule('email', 'email')
                    ->rule('email', array($user, 'unique'), array('email', ':value'))
                    ->rule('password', 'not_empty');
//                                         ->rule('keywords', 'not_empty');
                break;

            default:
                break;
        }

        $this->session->set('advert_confirm_data', $data_confirm);

        if (!$validation->check()) {
            Messages::errors($validation->errors('validation'));
            $this->go_back();
        }

        $advert_data = $this->session->get('advert_place_data');

        $new_advert = TRUE;
        if (isset($advert_data['advert_id'])) {
            $new_advert = FALSE;
        }

        switch ($data_confirm['user_action']) {
            case 'register': // хочу зарегистрироваться
                try {
                    // Создаем новую транзакцию
                    Database::instance()->begin();

                    // Создаем профиль
                    $advert_data['default_locale'] = $advert_data['language'];

                    $profile = ORM::factory('user_profile')
                        ->values($advert_data, array(
                            'phone', 'name', 'type',
                            'default_locale', 'city_id'
                        ))
                        ->create();

                    $data_confirm['username'] = 'user_' . uniqid();

                    // Создаем пользователя
                    $user
                        ->create_user($data_confirm, array('email', 'password', 'username'));
//
                    $role = ORM::factory('role', array('name' => 'login'));

                    // Добавляем пользователю роль и профиль
                    $user
                        ->add('roles', $role)
                        ->values(array(
                            'profile_id' => $profile->id
                        ))
                        ->update();

                    // Если все ок, делаем коммит
                    Database::instance()->commit();
                } catch (Exception $exc) {
                    // Если проблемы, делаем откат
                    Database::instance()->rollback();
                    Messages::errors(array($exc->getMessage()));
                    return;
                }
                break;
        }

        // Авторизируем пользователя на сайте
        if (!$this->ctx->auth->logged_in()) {
            Auth::instance()->login($user, $data_confirm['password'], TRUE);
        }

        $advert_data['user_id'] = $user->id;
        $advert_data['created'] = date('Y-m-d H:i:s'); // Дата создания.
        $advert_data['moderated'] = 0; // при редактировании, сбросить модерацию
        $advert_data['status'] = $this->ctx->config['advert']['moderation'] === TRUE ? Model_Advert::STATUS_MODERATION : Model_Advert::STATUS_PUBLISHED;
        try {
            Database::instance()->begin();

            if (!$new_advert) {
                $advert = ORM::factory('advert', (int)$advert_data['advert_id']);
            } else {
                $advert = ORM::factory('advert');
            }

            $advert->values($advert_data, array(
                'user_id', 'city_id', 'allow_mails', 'phone', 'skype', 'amount', 'category_id', 'created', 'moderated', 'status'
            ))
                ->save();

            if (!$new_advert) {
                ORM::factory('advert_part')->update_item($advert, $advert_data, $advert_data['language']);
            } else {
                ORM::factory('advert_part')->add_item($advert, $advert_data, $advert_data['language']);
            }

//            ORM::factory('advert_option')->put_options($advert->id,$advert_data['option']);


            if ($advert_data['option']) {
                Model_Advert_Option::put_options($advert->id, $advert_data['option']);
            }
            Database::instance()->commit();
        } catch (Exception $exc) {
            Database::instance()->rollback();
            //Messages::errors($advert_data['option']);
            //Messages::errors(array($exc->getMessage()));
            $this->go_back();
        }

        if (isset($advert_data['images']) AND !empty($advert_data['images'])) {
            if (isset($advert_data['main_image']) AND !empty($advert_data['main_image'])) {
                for ($i = 0; $i < count($advert_data['images']); $i++) {
                    $image_name = explode('/', $advert_data['images'][$i]);
                    if ($image_name[count($image_name) - 1] == $advert_data['main_image']) {
                        $advert->add_images($advert_data['images'][$i], 'image', $advert_data['image_rotation'][$i]);
                        unset($advert_data['images'][$i]);
                        break;
                    }
                }
            } else {
                // Добавляем картинку к объявлению
                $advert->add_images($advert_data['images'][0], 'image', $advert_data['image_rotation'][0]);
                // Удаляем её из общего списка картинок, чтобы не дублировалась
                unset($advert_data['images'][0]);
            }

//			// Добавляем картинку к объявлению
//			$advert->add_images($advert_data['images'][0], 'image');
//
//			// Удаляем её из общего списка картинок, чтобы не дублировалась
//			unset($advert_data['images'][0]);
            // Сохраняем остальные
            ORM::factory('advert_image')->add_related_images($advert, $advert_data['images']);
        }
//                
//                if(isset($advert_data['main_image']) AND !empty($advert_data['main_image'])){
//                    ORM::factory('advert')->change_main_image($advert_data['main_image'], $advert->id);
//                }
        // Чистим данные, сохраненые в сессии
        $this->session
            ->set('advert', $advert);

        if (isset($advert_data['package_id'])) {
            $package_id = $advert_data['package_id'];
            $package = Model_Package::$packages[$package_id];

            if ($package->amount() == 0) {
                $advert->add_package($package);
            } else {
                $this->go(Route::url('default', array(
                        'controller' => 'packages', 'action' => 'pay'
                    )) . URL::query(array(
                        'advert_id' => $advert->id,
                        'package_id' => $package_id
                    )));
            }
        }
        try { // send notify to admin
            $email = Email::factory('Новое объявление', "Далее: <a href='http://cbay.com.cy/backend/adverts'>http://cbay.com.cy/backend/adverts</a>", 'text/html')
                ->to('admin@cbay.com.cy')
                ->from('support@cbay.com.cy', 'CBAY.COM.CY')
                ->send();
        } catch (Exception $e) {

        }
        $this->go(Route::url('default', array(
            'controller' => 'advert', 'action' => $new_advert ? 'finish' : 'update'
        )));

    }

    public function action_finish()
    {
        $advert = $this->session->get_once('advert');
        $advert_data = $this->session->get('advert_place_data');
        $this->session->delete('advert_place_data')
            ->delete('advert_confirm_data')
            ->delete('advert');
        if ($advert === NULL) {
            $this->go(Route::url('default', array(
                'controller' => 'advert', 'action' => 'place'
            )));
        }
        if (isset($advert_data['addpackege']) AND $advert_data['addpackege'] != '') {
            $path = Route::url('default', array(
                'controller' => 'packages', 'action' => 'pay'
            ));
            $this->request->initial()->redirect($path . '?advert=' . $advert->id . '&package=' . $advert_data['addpackege']);
        }

        $this->template->content->advert = $advert;
    }

    public function action_update()
    {
        $advert = $this->session->get_once('advert');
        $this->session->delete('advert_place_data')
            ->delete('advert_confirm_data')
            ->delete('advert');
        if ($advert === NULL) {
            $this->go(Route::url('default', array(
                'controller' => 'advert', 'action' => 'edit'
            )));
        }

        $this->template->content->advert = $advert;
    }

}