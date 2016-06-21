<?php defined('SYSPATH') or die('No direct script access.');

class Controller_User extends Controller_System_Page
{

    public $template = 'global/frontend';
    public $auto_render = TRUE;

    public function before()
    {
        parent::before();

        if (
            $this->request->action() != 'logout'
            AND
            $this->ctx->auth->logged_in()
        ) {
            $this->go_home();
        }
    }

    public function action_register()
    {
        if ($this->request->method() == Request::POST) {
            $this->_register();
        }


        $data['license'] = file_get_contents('resources/license.txt', true);

        $this->template->content = View::factory('user/register', $data);
    }


    private function _register()
    {
        $data = $_POST;
        $user = ORM::factory('user');

        $data['username'] = 'user_' . uniqid();

        $validation = Validation::factory($data)
            ->rules('username', array(
                array('not_empty'),
                array('max_length', array(':value', 32))
            ))
            ->rules('password', array(
                array('not_empty'),
                array('min_length', array(':value', Model_User::PASSWORD_LENGTH))
            ))
            ->rules('email', array(
                array('not_empty'),
                array('email'),
                array(array($user, 'unique'), array('email', ':value')),
            ))
            ->rule('password_confirm', 'matches', array(':validation', ':field', 'password'))
            ->rules('seturity_token', array(
                array('not_empty'),
                array('Security::check', array(':value'))
            ))
            ->rules('name', array(
                array('not_empty'),
                array('min_length', array(':value', 2)),
                array('max_length', array(':value', 32))
            ))
            ->rules('phone', array(
                array('phone', array(':value', Model_User_Profile::PHONE_LENGTH))
            ))
            ->rules('default_locale', array(
                array('not_empty'),
                array('array_key_exists', array(':value', Model_Lang_Part::$languages))
            ))
            ->rules('type', array(
                array('not_empty'),
                array('array_key_exists', array(':value', Model_User_Profile::$types))
            ));

        if (!$validation->check()) {
            Messages::errors($validation->errors('validation'));
            $this->go_back();
        }
        $adverts = ORM::factory('advert');
        $bad_ip = $adverts
            ->where('status', '=', 3)
            ->and_where('ip', '=', $adverts->ip2int(Request::$client_ip))
            ->find();
        if ($bad_ip->loaded()) {
            Messages::errors(array('Ваш IP заблокирован'));
            $this->go_back();
        }
        try {
            Database::instance()->begin();

            $user
                ->values($data, array('username', 'email', 'password'))
                ->create();

            $user->add('roles', ORM::factory('role', array('name' => 'login')));

            $profile = ORM::factory('user_profile')
                ->values($data, array('name', 'phone', 'skype', 'type', 'city_id', 'default_locale'))
                ->create();

            $user->profile_id = $profile->id;

            $wallet = ORM::factory('wallet');
            $wallet->id = $user->id;

            $endpromo = strtotime('20-11-2013');
            $now = strtotime('midnight');
            if ($endpromo > $now) {
                $users_ip = ORM::factory('user')
                    ->where('gerip', '=', $user->ip2int(Request::$client_ip))
                    ->find();
                if (!$users_ip->loaded()) {
                    $wallet->amount = 5;
                }
            }

            $user->gerip = $user->int2ip(Request::$client_ip);
            $user->update();

            $wallet->save();

            Database::instance()->commit();
            $header = __('usermessages.header');
            $message = __('usermessages.content', array(
                ':username' => $data['name'],
                ':email' => $data['email'],
                ':password' => $data['password']
            ));
            try {
                $email = Email::factory($header, $message, 'text/html')
                    ->to($data['email'])
                    ->from('support@cbay.com.cy', 'CBAY.COM.CY')
                    ->send();
            } catch (Exception $e) {

            }
            /*$email = Email::factory('Регистрация на cbay.com.cy');
            $message = View::factory('user/regemail', array(
                'user' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ));
            $email->message($message, 'text/html')
                ->to($data['email'])
                ->from('support@cbay.com.cy', 'CBAY.COM.CY')
                ->send();


            $message_title = 'Приветствуем Вас на CBAY.COM.CY';
            $message_text = View::factory('messages/welcomemessage');
            ORM::factory('message')
                ->send($message_title, $message_text, 1, $user->id, FALSE);
*/
            Auth::instance()->login($user, $data['password'], TRUE);
            $this->go('profile');
        } catch (Exception $e) {
            Database::instance()->rollback();
            Messages::errors($e->getMessage());
            $this->go_back();
        }
    }

    public function action_login()
    {
        if ($this->request->method() == Request::POST) {
            $this->_login();
        }

        $this->template->content = View::factory('user/login');

    }

    private function _login()
    {
        $array = $_POST;

        $user = ORM::factory('user');
        $fieldname = Valid::email($array['username']) ? 'email' : 'username';
        $label = $user->labels();
        $rule = $user->rules();

        $array = Validation::factory($array)
            ->label('username', 'Username / Email')
            ->label('password', $label['password'])
            ->rules('username', array(
                array('not_empty')
            ))
            ->rules('password', $rule['password'])
            ->rules('seturity_token', array(
                array('not_empty'),
                array('Security::check', array(':value'))
            ));


        // Get the remember login option
        $remember = isset($array['remember']);

        if ($array->check()) {
            // Attempt to load the user
            $user
                ->where($fieldname, '=', $array['username'])
                ->and_where('status', '=', 1)
                ->find();

            if (
                $user->loaded()
                AND
                Auth::instance()->login($user, $array['password'], $remember)
            ) {
                Observer::notify('user_login', $user);

//				$next_page = Input::post( 'next', '/' );
//				$this->request->redirect( $next_page );
                $this->go('profile');
            } else {
                $array->error('username', 'incorrect');
            }
        }

        Messages::errors($array->errors('validation'));

        $this->go_back();
    }

    public function action_forgot()
    {
        if ($this->request->method() == Request::POST) {
            $this->_forgot();
        }

        $this->template->content = View::factory('user/forgot');
    }

    private function _forgot()
    {
        $array = $_POST;
        $user = ORM::factory('user');

        $fieldname = Valid::email($array['username']) ? 'email' : 'username';

        $array = Validation::factory($array)
            ->label('username', 'Username / Email')
            ->rules('username', array(
                array('not_empty')
            ))
            ->rules('seturity_token', array(
                array('not_empty'),
                array('Security::check', array(':value'))
            ));

        if ($array->check()) {
            // Attempt to load the user
            $user
                ->where($fieldname, '=', $array['username'])
                ->find();

            if ($user->loaded()) {
                $reflink = ORM::factory('user_reflink')
                    ->generate($user, Model_User_Reflink::FORGOT_PASSWORD, Text::random());

                if ($reflink) {
                    Observer::notify('user_forgot', $user);
                    /*try {
                        $email = Email::factory($header, $message, 'text/html')
                            ->to($data['email'])
                            ->from('support@cbay.com.cy', 'CBAY.COM.CY')
                            ->send();
                    } catch (Exception $e) {

                    }*/
                    try {
                        Email::factory(__('messages.email.forgot_password.title'))
                            ->from($this->ctx->config['email']['support'], __('messages.email.name'))
                            ->to($user->email)
                            ->message(View::factory('messages/email/forgot', array(
                                'name' => ucwords($user->profile->name),
                                'link' => HTML::anchor(URL::site(Route::url('reflink', array('id' => $reflink)), TRUE))
                            )))
                            ->send();
                    } catch (Exception $e) {

                    }
                    Messages::success(__('messages.email.forgot_password.success', array(':address' => $user->email)));
                }

                $this->go(Route::url('user', array('action' => 'login')));
            } else {
                $array->error('username', 'not_found', array(':value' => $array['username']));
            }
        }

        Messages::errors($array->errors('validation'));
        $this->go_back();
    }

    public function action_logout()
    {
        $this->auto_render = FALSE;

        $this->ctx->auth->logout();
        Session::instance()->destroy();
        $this->go_home();
    }

    public function after()
    {
        /*		$this->template->styles = array(
                    $this->respath . 'css/login.css'
                );*/

        $this->template->scripts = array();

        parent::after();
    }


}