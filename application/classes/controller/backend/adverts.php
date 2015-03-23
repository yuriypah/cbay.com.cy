<?php

defined('SYSPATH') or die ('No direct script access.');

class Controller_Backend_Adverts extends Controller_System_Backend
{
    public function action_index()
    {
        $id = $this->request->param('id');
        $ip = Input::get('ip');
        $adverts = $this->_getnew($id, $ip);
        $this->template->content->adverts = $adverts;
        $this->template->content->new_count = $adverts->count();
        $user = null;
        $adderes = null;
        if ($id)
            $user = $id . '/';
        $this->template->content->id = $user;
        if ($ip)
            $adderes = '/?ip=' . $ip;
        $this->template->content->ip = $adderes;
    }

    public function action_managepacks()
    {
        switch (Input::post('action')) {
            case 'delete':
                ORM::factory('advert')->remove_package(Input::post('id'), Input::post('advert'));
                $advert = ORM::factory('advert')->get_one(Input::post('advert'));
                switch (Input::post('id')) {
                    case 'vip':
                        $advert->vip = null;
                        break;
                    case 'selected':
                        $advert->selected = null;
                        break;
                    case 'top':
                        $advert->top = null;
                        break;
                    case 'premium':
                        $advert->premium = null;
                        break;
                }
                $advert->update();
                die("");
                break;
            case 'update':
                $advert = ORM::factory('advert')->get_one(Input::post('advert'));
                $date = date("Y-m-d", strtotime(Input::post('long_value')));
                switch (Input::post('id')) {
                    case 'vip':
                        $advert->vip = $date . " 23:59:00";
                        break;
                    case 'selected':
                        $advert->selected = $date . " 23:59:00";
                        break;
                    case 'top':
                        $advert->top = $date . " 23:59:00";
                        break;
                    case 'premium':
                        $advert->premium = $date . " 23:59:00";
                        break;
                }
                $advert->update();
                die("");
                break;
            default:
                $advert = ORM::factory('advert')->get_one(Input::post('id'));
                $this->template->content->advert = $advert;
                break;
        }

    }

    public function action_getlangparts()
    {
        $ap = ORM::factory('advert_part');
        $advert_parts = $ap->get_item($_POST['advert_id']);

        die(json_encode(array(
            'langs' => array(
                'ru' => $advert_parts[2],
                'en' => $advert_parts[0],
                'gr' => $advert_parts[1],
                'zh' => $advert_parts[3]
            )
        )));
    }

    public function action_setlangparts()
    {
        $ap = ORM::factory('advert_part');
        $ap->save_changes($_POST['advert'], $_POST['advert_id']);
    }

    public function action_enabled()
    {
        $id = $this->request->param('id');
        $ip = Input::get('ip');
        $adverts = ORM::factory('advert')->where('advert.moderated', '!=', Model_Advert::STATUS_MODERATION);
        $adverts = $adverts->and_where_open();
        $adverts = $adverts->or_where_open();
        $adverts = $adverts->or_where('advert.status', '=', Model_Advert::STATUS_PUBLISHED); // опубликованные
        $adverts = $adverts->or_where('advert.status', '>', 3); // проданные
        $adverts = $adverts->or_where_close();
        $adverts = $adverts->and_where_close();
        if ($id)
            $adverts = $adverts->and_where('advert.user_id', '=', $id);
        $adverts = $adverts->with_part()->with_author()->order_by('finished', 'asc')->find_all();
        $new = $this->_getnew();
        $this->template->content->adverts = $adverts;
        $this->template->content->new_count = $new->count();

        $user = null;
        $adderes = null;
        if ($id)
            $user = $id . '/';
        $this->template->content->id = $user;
        if ($ip)
            $adderes = '/?ip=' . $ip;
        $this->template->content->ip = $adderes;
    }

    public function action_blocked()
    {
        $id = $this->request->param('id');
        $ip = Input::get('ip');
        $adverts = ORM::factory('advert')->where('advert.moderated', '!=', Model_Advert::STATUS_MODERATION)->and_where('advert.status', '=', Model_Advert::STATUS_BLOCKED_RULES);
        if ($id)
            $adverts = $adverts->and_where('advert.user_id', '=', $id);
        $adverts = $adverts->with_part()->with_author()->order_by('finished', 'asc')->find_all();
        $new = $this->_getnew();
        $this->template->content->adverts = $adverts;
        $this->template->content->new_count = $new->count();

        $user = null;
        $adderes = null;
        if ($id)
            $user = $id . '/';
        $this->template->content->id = $user;
        if ($ip)
            $adderes = '/?ip=' . $ip;
        $this->template->content->ip = $adderes;
    }

    function _getnew($id = null, $ip = null)
    {
        $query = ORM::factory('advert')->where('moderated', '=', Model_Advert::STATUS_MODERATION)->where('finished', '>=', DB::expr('NOW()'));
        if ($id)
            $query = $query->and_where('user_id', '=', $id);
        if ($ip)
            $query = $query->and_where('ip', '=', $query->ip2int($ip));
        return $query->with_part()->with_author()->order_by('finished', 'asc')->find_all();
    }

    public function action_block()
    {
        $id = $this->request->param('id');
        $advert = ORM::factory('advert')->where('id', '=', $id)->find();
        $advert->moderated = 1;
        $advert->status = 3;
        $advert->update();
        $this->go_back();
    }

    public function action_approve()
    {
        $id = $this->request->param('id');
        $advert = ORM::factory('advert')->where('id', '=', $id)->find();
        $advert->moderated = 1; // отмодерировано
        $advert->status = 1; // одобрено
        $advert->update();
        $this->go_back();
    }

    public function action_unblock()
    {
        $id = $this->request->param('id');
        $advert = ORM::factory('advert')->where('id', '=', $id)->find();
        $advert->moderated = 1;
        $advert->status = 1;
        $advert->update();
        $this->go_back();
    }

    public function action_manyblock()
    {
        $id = $this->request->param('id');
        $ids = explode(':', $id);

        DB::update('adverts')->set(array(
            'moderated' => 1,
            'status' => 3
        ))->where('id', 'IN', $ids)->execute();
        $this->go_back();
    }

    public function action_manyunblock()
    {
        $id = $this->request->param('id');
        $ids = explode(':', $id);

        DB::update('adverts')->set(array(
            'moderated' => 1,
            'status' => 1
        ))->where('id', 'IN', $ids)->execute();
        $this->go_back();
    }

    public function action_manyapprove()
    {
        $id = $this->request->param('id');
        $ids = explode(':', $id);

        DB::update('adverts')->set(array(
            'moderated' => 1
        ))->where('id', 'IN', $ids)->execute();
        $this->go_back();
    }
}