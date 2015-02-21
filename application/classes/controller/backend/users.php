<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Backend_Users extends Controller_System_Backend
{

    public function action_index()
    {
        $users = ORM::factory('user')
            ->with('profile')
            ->order_by('profile.name', 'asc')
            ->find_all();

        $this->template->content->users = $users;
    }

    public function action_view()
    {
        $id = $this->request->param('id');
        $user = ORM::factory('user', $id);

        if (!$user->loaded()) {
            throw new HTTP_Exception_404('User not found');
        }

        $count_adverts = ORM::factory('advert')
            ->where('user_id', '=', $user->id)
            ->count_all();

        $this->template->content->count_adverts = $count_adverts;
        $this->template->content->user = $user;
        $this->template->content->permissions = ORM::factory('role')->find_all();
        $this->template->content->user_permissions = $user->roles->find_all()->as_array(NULL, 'id');
    }

    public function action_blockuser()
    {
        $id = $this->request->param('id');
        ORM::factory('user')->block_user_and_advs($id);
        $this->go_back();
    }

    public function action_unblockuser()
    {
        $id = $this->request->param('id');
        ORM::factory('user')->unblock_user_and_advs($id);
        $this->go_back();
    }
}