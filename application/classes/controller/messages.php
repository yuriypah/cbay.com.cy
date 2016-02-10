<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Messages extends Controller_System_Page
{

    public function action_index()
    {
        $this->template->content->messages = ORM::factory('message')
            ->get_all($this->ctx->user->id);
    }

    public function action_inbox()
    {
        $this->template->content->messages = ORM::factory('message')
            ->get_inbox($this->ctx->user->id);
    }

    public function action_drafts()
    {
        $this->template->content->messages = ORM::factory('message')
            ->get_drafts($this->ctx->user->id);
    }


    public function action_view()
    {
        $this->template->scripts[] = 'libs/tinymce/tiny_mce.js';

        $id = $this->request->param('id');

        $message = ORM::factory('message')->get_one($id, $this->ctx->user->id);

        if (!$message->loaded()) {
            throw new HTTP_Exception_404('Message not found');
        }

        $message->mark_read($this->ctx->user->id);

        $this->ctx->page->label = $message->title;

        $this->template->content->message = $message;
    }

    public function action_inboxview()
    {

        $this->template->scripts[] = 'libs/tinymce/tiny_mce.js';

        $id = $this->request->param('id');

        $message = ORM::factory('message')->inbox_read($id, $this->ctx->user->id);
        if (!$message) {
            throw new HTTP_Exception_404('Message not found');
        }
        $this->ctx->page->label = $message->title;

        $this->template->content->message = $message;
    }

}