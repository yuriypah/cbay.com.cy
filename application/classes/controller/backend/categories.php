<?php

defined('SYSPATH') or die ('No direct script access.');

class Controller_Backend_Categories extends Controller_System_Backend
{
    public function action_index()
    {
        $this->left_sidebar = TRUE;
        $this->template->scripts [] = 'libs/jquery-treeview/jquery.treeview.js';
        $this->template->styles [] = 'libs/jquery-treeview/jquery.treeview.css';

        $id = $this->request->query('cid');
        $category = ORM::factory('advert_category', $id);
        $options = array();
        if ($category->loaded()) {
            $options = $category->options->with_locale()->find_all();
        } elseif ($id === NULL) {
            $options = ORM::factory('advert_category_option')->with_locale()->find_all();
        }
        $this->template->content->parts = ( array )ORM::factory('lang_part')->get_item_list($category);
        $this->template->content->options = VIEW::factory('/backend/categories/options', array(
            'options' => $options,
            'id' => $id,
            'categories' => ORM::factory('advert_category')
                ->tree()
                ->as_array(NULL, 'id', 'title', 3)
        ));


    }

    public function action_add($category = NULL)
    {
        if ($category === NULL) {
            $category = ORM::factory('advert_category');
        }

        if ($category->loaded()) {
            $this->ctx->page->title .= ' ' . $category->locale()->title;
        }
        if (!$category->parent_id) {
            $category->parent_id = Arr::get($_GET, 'cid');
        }
        $old_post_data = Session::instance()->get('category_post_data', array());
        $category->values($old_post_data);

        $this->template->content->category = $category;
        $this->template->content->groups = ORM::factory('advert_category')->groups();
        $this->template->content->parts = ORM::factory('lang_part')->get_item_list($category);
    }

    public function action_edit()
    {
        Session::instance()->delete('category_post_data');
        $this->template->content->set_filename('backend/categories/add');

        $category_id = ( int )$this->request->param('id');

        $category = ORM::factory('advert_category', $category_id);
        if ($category_id !== 0 and !$category->loaded()) {
            throw new HTTP_Exception_404 ('Category not found');
        }

        return $this->action_add($category);
    }

    public function action_remove()
    {
        $id = $this->request->param('id');
        $category = ORM::factory('advert_category', $id);
        $category->delete();
        $this->go("/backend/categories");
    }

    public function action_savecategorieslang()
    {
        $category = ORM::factory('advert_category', $_POST['category_id']);
        ORM::factory('lang_part')->add_item($category, array(
            'title' => $_POST['langs']['ru']
        ), 'ru');
        if ($_POST['langs']['en'] != '') {
            ORM::factory('lang_part')->add_item($category, array(
                'title' => $_POST['langs']['en']
            ), 'en');
        }
        if ($_POST['langs']['gr'] != '') {
            ORM::factory('lang_part')->add_item($category, array(
                'title' => $_POST['langs']['gr']
            ), 'gr');
        }
        if ($_POST['langs']['zh'] != '') {
            ORM::factory('lang_part')->add_item($category, array(
                'title' => $_POST['langs']['zh']
            ), 'zh');
        }
    }
}