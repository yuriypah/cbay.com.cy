<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Reflink extends Controller_System_Controller
{

    public function action_index()
    {
        $id = $this->request->param('id');
        if ($id !== NULL) {
            $reflink = ORM::factory('user_reflink', $id);

            try {
                $status = $reflink->confirm();

                switch ($reflink->type) {
                    case Model_User_Reflink::FORGOT_PASSWORD:
                        $this->_forgot($reflink, $status);
                        $this->request->redirect(Route::url('user', array('action' => 'login')));
                        break;

                    case Model_User_Reflink::CHANGE_EMAIL:
                        $this->_change_email($status);
                        $reflink->delete($reflink);
                        Messages::success(__('messages.email.changeemail.success'));
                        $this->request->redirect('profile/settings');

                        break;

                    case Model_User_Reflink::REGISTERED:
                        $this->_register($reflink);
                        $this->request->redirect('/');
                        break;
                }
            } catch (Exception $exc) {
                $this->request->redirect('/');
            }
        }
    }

    protected function _change_email($new_email)
    {

    }

    protected function _forgot($reflink, $new_password)
    {
        Messages::success(__('messages.email.forgot_password.forgot_success'));

        Email::factory(__('messages.email.forgot_password.forgotted_title'))
            ->from($this->ctx->config['email']['support'], __('messages.email.name'))
            ->to($reflink->user->email)
            ->message(View::factory('messages/email/forgotted', array(
                'name' => ucwords($reflink->user->profile->name),
                'password' => $new_password
            )))
            ->send();

        $reflink->delete();
    }

    protected function _register($reflink)
    {
        Email::factory(__('messages.email.register.registered_title'))
            ->from($this->ctx->config['email']['support'], __('messages.email.name'))
            ->to($reflink->user->user->email)
            ->message(View::factory('messages/email/registered', array(
                'name' => ucwords($reflink->user->profile->name)
            )))
            ->send();

        $reflink->delete();
    }
}