<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Backend_Options extends Controller_System_Backend
{

    public function action_add($option = NULL)
    {
        if ($option === NULL) {
            $option = ORM::factory('advert_category_option');
        }

        $old_post_data = Session::instance()->get('options_post_data', array());
        $option->values($old_post_data);
        $this->template->content->option = $option;
        $this->template->content->values = View::factory('backend/options/values', array(
            'values' => $option->values->find_all()
        ));

        $this->template->content->related_options = $option->parents();

        $this->template->content->types = DB::select()
            ->from('fields_types')
            ->execute()
            ->as_array('id', 'type');

        $this->template->content->categories = ORM::factory('advert_category')
            ->tree()
            ->as_array('title', 'id', 'title', 3);

        $this->template->content->parts = ORM::factory('lang_part')->get_item_list($option);
        Model_Advert_Category::build_js();
    }

    public function action_edit()
    {
        Session::instance()->delete('options_post_data');
        $this->template->content->set_filename('backend/options/add');

        $option_id = (int)$this->request->param('id');

        $option = ORM::factory('advert_category_option', $option_id);

        if ($option_id !== 0 AND !$option->loaded()) {
            throw new HTTP_Exception_404('Option not found');
        }

        return $this->action_add($option);
    }

    public function action_getlangoptions()
    {
        $value = ORM::factory('advert_category_option_value', $_POST['option_id']);

        $parts = ORM::factory('lang_part')->get_item_list($value);
        die(json_encode(array(
            'langs' => array(
                'ru' => $parts['ru']->title,
                'en' => $parts['en']->title,
                'gr' => $parts['gr']->title,
                'zh' => $parts['zh']->title)
        )));
    }

    public function action_savelangoptions()
    {
        $value = ORM::factory('advert_category_option_value', $_POST['option_id']);

        ORM::factory('lang_part')->add_item($value, array(
            'title' => $_POST['langs']['ru']
        ), 'ru');
        ORM::factory('lang_part')->add_item($value, array(
            'title' => $_POST['langs']['en']
        ), 'en');
        ORM::factory('lang_part')->add_item($value, array(
            'title' => $_POST['langs']['gr']
        ), 'gr');
        ORM::factory('lang_part')->add_item($value, array(
            'title' => $_POST['langs']['zh']
        ), 'zh');
        Model_Advert_Category::build_js();

    }

    public function action_saveindex()
    {
        $this->auto_render = FALSE;

        $data = $_POST['data'];
        for ($i = 0; $i < count($data); $i++) {
            DB::update('advert_category_option_values')
                ->set(array('index' => $data[$i]['index']))
                ->where('id', '=', $data[$i]['id'])
                ->execute();
        }
        Model_Advert_Category::build_js();
    }

    public function action_saveparentindex()
    {
        $this->auto_render = FALSE;
        $data = $_POST['data'];
        for ($i = 0; $i < count($data); $i++) {
            DB::update('advert_categories_options')
                ->set(array('parent_index' => $data[$i]['index']))
                ->where('option_id', '=', $data[$i]['id'])
                ->execute();
        }
        Model_Advert_Category::build_js();
    }
}