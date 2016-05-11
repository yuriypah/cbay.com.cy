<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Profile extends Controller_System_Page
{

    public function action_index()
    {
        $this->session->delete('advert_place_data')
            ->delete('advert_confirm_data')
            ->delete('advert');

        $adverts = ORM::factory('advert')
            ->where('user_id', '=', $this->ctx->user->id)
            ->and_where('finished', '>=', DB::expr('NOW()'))
            ->and_where('status', '=', Model_Advert::STATUS_PUBLISHED)
            ->with_part()
            ->order_by('finished', 'asc')
            ->find_all();

        $this->template->content->adverts = $adverts;
        $this->template->content->counts = $this->getCountsAdverts();
    }

    public function getCountsAdverts()
    {
        return array(
            'active' => ORM::factory('advert')
                ->where('user_id', '=', $this->ctx->user->id)
                ->and_where('finished', '>=', DB::expr('NOW()'))
                ->and_where('status', '=', Model_Advert::STATUS_PUBLISHED)
                ->with_part()
                ->order_by('finished', 'asc')
                ->count_all(),
            'ended' => ORM::factory('advert')
                ->where('user_id', '=', $this->ctx->user->id)
                ->and_where_open()
                ->where('finished', '<', DB::expr('NOW()'))
                ->or_where('status', 'IN', array(Model_Advert::STATUS_SOLD_OTHER, Model_Advert::STATUS_SOLD_SITE, Model_Advert::STATUS_OFF))
                ->and_where_close()
                ->with_part()
                ->order_by('finished', 'asc')
                ->count_all(),
            'blocked' => ORM::factory('advert')
                ->where('user_id', '=', $this->ctx->user->id)
                ->and_where('status', 'IN', array(Model_Advert::STATUS_BLOCKED_REPOST, Model_Advert::STATUS_BLOCKED_RULES))
                ->with_part()
                ->order_by('finished', 'asc')
                ->count_all(),
            'moderated' => ORM::factory('advert')
                ->where('user_id', '=', $this->ctx->user->id)
                ->and_where('finished', '>=', DB::expr('NOW()'))
                ->and_where('status', 'IN', array(Model_Advert::STATUS_MODERATION))
                ->with_part()
                ->order_by('finished', 'asc')
                ->count_all()
        );
    }

    public function action_ended()
    {
        $adverts = ORM::factory('advert')
            ->where('user_id', '=', $this->ctx->user->id)
            ->and_where_open()
            ->where('finished', '<', DB::expr('NOW()'))
            ->or_where('status', 'IN', array(Model_Advert::STATUS_SOLD_OTHER, Model_Advert::STATUS_SOLD_SITE, Model_Advert::STATUS_OFF))
            ->and_where_close()
            ->with_part()
            ->order_by('finished', 'asc')
            ->find_all();

        $this->template->content->adverts = $adverts;
        $this->template->content->counts = $this->getCountsAdverts();
    }

    public function action_blocked()
    {
        $adverts = ORM::factory('advert')
            ->where('user_id', '=', $this->ctx->user->id)
            ->and_where('status', 'IN', array(Model_Advert::STATUS_BLOCKED_REPOST, Model_Advert::STATUS_BLOCKED_RULES))
            ->with_part()
            ->order_by('finished', 'asc')
            ->find_all();

        $this->template->content->adverts = $adverts;
        $this->template->content->counts = $this->getCountsAdverts();
    }

    public function action_moderated()
    {
        $adverts = ORM::factory('advert')
            ->where('user_id', '=', $this->ctx->user->id)
            ->and_where('finished', '>=', DB::expr('NOW()'))
            ->and_where('status', 'IN', array(Model_Advert::STATUS_MODERATION))
            ->with_part()
            ->order_by('finished', 'asc')
            ->find_all();

        $this->template->content->adverts = $adverts;
        $this->template->content->counts = $this->getCountsAdverts();
    }


    public function action_wallet()
    {

    }

    public function action_settings()
    {
        $count_adverts = ORM::factory('advert')
            ->where('user_id', '=', $this->ctx->user->id)
            ->count_all();

        $this->template->content->count_adverts = $count_adverts;
        $this->template->content->user = $this->ctx->user;
    }

    public function action_changeemail()
    {
        $this->template->content->data = $this->session->get_once('email_change_data', array());

        if ($this->request->method() !== Request::POST) {
            return;
        }

        $data = $_POST;

        $validation = Validation::factory($data)
            ->rule('token', 'Security::check', array(':value'))
            ->rules('email', array(
                array('not_empty'),
                array('email')
            ));

        if (!$validation->check()) {
            $this->session->set('email_change_data', $data);
            Messages::errors($validation->errors('validation'));
            $this->go_back();
        }

        $reflink = ORM::factory('user_reflink')->generate(
            $this->ctx->user,
            Model_User_Reflink::CHANGE_EMAIL,
            $data['email']
        );

        if ($reflink !== NULL) {
            Email::factory(__('messages.email.changeemail.reflink_title'))
                ->from($this->ctx->config['email']['support'], __('messages.email.name'))
                ->to($data['email']/*$this->ctx->user->email*/)
                ->message(View::factory('messages/email/changeemail', array(
                    'name' => ucwords($this->ctx->user->profile->name),
                    'link' => HTML::anchor(URL::site(Route::url('reflink', array('id' => $reflink)), TRUE)),
                    'email' => $data['email']
                )))
                ->send();

            Messages::success(__('messages.email.changeemail.reflink', array(':address' => $this->ctx->user->email)));
        }
        $this->go(Route::url('default', array('controller' => 'profile', 'action' => 'settings')));
    }

    public function action_changeprofiletype()
    { // изменить тип профиля (физ. лицо/компания)
        $this->template->content->user = $this->ctx->user;
        if ($this->request->method() !== Request::POST) {
            return;
        } else {
            ORM::factory('user')->changeprofiletype(Input::post('profiletype'), $this->ctx->user->profile_id);
        }
        $this->go(Route::url('default', array('controller' => 'profile', 'action' => 'settings')));
    }

    public function action_delete()
    {
        $token = Input::post('token');
        if (empty($token) OR !Security::check($token)) {
            throw new Exception('Security token not check');
        }

        if ($this->request->method() !== Request::POST) {
            $this->go_home();
        }

        if (Input::post('delete') == 'confirm') {
            $user_id = $this->ctx->user->id;

            $this->ctx->user->profile->delete();
            $this->ctx->auth->logout();
            Session::instance()->destroy();

            Messages::success(__('messages.profile.delete'));

            Observer::notify('user_profile_deleted', $user_id);

            $this->go_home();
        }
    }
}