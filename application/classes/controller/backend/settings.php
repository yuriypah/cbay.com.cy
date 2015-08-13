<?php

defined('SYSPATH') or die ('No direct script access.');

class Controller_Backend_Settings extends Controller_System_Backend
{
    var $imgdir = "resources/images/redactor/";

    public function action_index()
    {
        if ($this->request->method() == Request::POST) {
            return $this->_save();
        }
        $query = ORM::factory('advert')->where('moderated', '=', Model_Advert::STATUS_MODERATION)->where('finished', '>=', DB::expr('NOW()'));
        if ($id)
            $query = $query->and_where('user_id', '=', $id);
        if ($ip)
            $query = $query->and_where('ip', '=', $query->ip2int($ip));
        $this->template->content->new_adverts  =  $query->with_part()->with_author()->order_by('finished', 'asc')->find_all()->count();
    }

    private function _save()
    {
        $data = $_POST ['setting'];

        Model_Setting::save_from_array($data);

        $this->go_back();
    }

    public function action_addkey()
    {
        $query = DB::insert('lang_static_parts')
            ->columns(array(
                'key', 'desc', 'category'
            ));
        $query->values(array(
            'key' => strtolower($_POST['key']),
            'desc' => $_POST['desc'],
            'category' => $_POST['category']
        ));
        $query->execute();
        die(json_encode(array(
            'status' => 1
        )));
    }

    public function action_removekey()
    {
        DB::delete('lang_static_parts')
            ->where('id', '=', $_POST['id'])
            ->execute();
        die("");
    }

    public function action_translate()
    {
        /*  $i18n_jsons = array(
              'ru' => ( array )json_decode(file_get_contents("application/i18n/old/ru.json"), true),
              'en' => ( array )json_decode(file_get_contents("application/i18n/old/en.json"), true),
              'el' => ( array )json_decode(file_get_contents("application/i18n/old/el.json"), true)
          );
          foreach($i18n_jsons['ru'] as $key => $value) {
              DB::update('lang_static_parts')
                  ->set(array(
                      'ru' => $value
                  ))
                  ->where('key', '=', $key)
                  ->execute();
          }
          foreach($i18n_jsons['en'] as $key => $value) {
              DB::update('lang_static_parts')
                  ->set(array(
                      'en' => $value
                  ))
                  ->where('key', '=', $key)
                  ->execute();
          }
          foreach($i18n_jsons['el'] as $key => $value) {
              DB::update('lang_static_parts')
                  ->set(array(
                      'el' => $value
                  ))
                  ->where('key', '=', $key)
                  ->execute();
          }*/

        if ($_POST['category'] != '') {
            $html = "<table class='table'>
                       ";
            $items = DB::select('*')
                ->from('lang_static_parts')
                ->where('category', '=', $_POST['category'])
                ->execute();
            if ($items) {
                foreach ($items as $item) {
                    $html .= "<tr>";
                    $html .= "<td style='vertical-align:middle' title=" . $item['key'] . "><span style='font-weight:700'>" . $item['desc'] . "</span></td>";
                    $html .= "<td><img class='lang_pic' src='/resources/images/lang-ru.png'/>
                                <select onchange='Translate.openRedactor(this)'><option>Текст</option><option value='html'>Редактор</option></select>
                                <textarea onchange='TranslateActions.set(this)' data-id='" . $item['id'] . "' data-name='ru' cols='40' rows='3'>" . $item['ru'] . "</textarea></td>";
                    $html .= "<td><img class='lang_pic' src='/resources/images/lang-en.png'/>
                                <select onchange='Translate.openRedactor(this)'><option>Текст</option><option value='html'>Редактор</option></select>
                                <textarea onchange='TranslateActions.set(this)' data-id='" . $item['id'] . "' data-name='en' cols='40' rows='3'>" . $item['en'] . "</textarea></td>";
                    $html .= "<td><img class='lang_pic' src='/resources/images/lang-gr.png'/>
                                <select onchange='Translate.openRedactor(this)'><option>Текст</option><option value='html'>Редактор</option></select>
                                <textarea onchange='TranslateActions.set(this)' data-id='" . $item['id'] . "' data-name='el' cols='40' rows='3'>" . $item['el'] . "</textarea></td>";
                    $html .= "<td><img class='lang_pic' src='/resources/images/lang-zh.png'/>
                                <select onchange='Translate.openRedactor(this)'><option>Текст</option><option value='html'>Редактор</option></select>
                                <textarea onchange='TranslateActions.set(this)' data-id='" . $item['id'] . "' data-name='zh' cols='40' rows='3'>" . $item['zh'] . "</textarea></td>";
                    $html .= "<td style='vertical-align:middle'><button data-id='" . $item['id'] . "' onclick='TranslateActions.removeKey(this)' class='btn'>Удалить</button></td>";
                    $html .= "</tr>";
                }
            }

            $html .= "</table>";
            die(die(json_encode(array(
                'header' => $_POST['category'],
                'content' => $html
            ))));
        }
        $res = DB::select('id', 'key', 'category')
            ->from('lang_static_parts')
            ->group_by('category')
            ->execute();
        $this->template->content->groups = $res;
    }

    public function action_langupdate()
    {
        DB::update('lang_static_parts')
            ->set(array(
                $_POST['lang'] => $_POST['value']
            ))
            ->where('id', '=', $_POST['id'])
            ->execute();
        $this->action_langsave();
        die("");
    }

    public function action_langsave()
    {
        $langs = array(
            'ru' => array(),
            'en' => array(),
            'el' => array(),
            'zh' => array()
        );
        $items = DB::select('*')
            ->from('lang_static_parts')
            ->execute();
        if ($items) {
            foreach ($items as $item) {
                if ($item['ru'] != '') {
                    $langs['ru'][$item['key']] = $item['ru'];
                }
                if ($item['en'] != '') {
                    $langs['en'][$item['key']] = $item['en'];
                }
                if ($item['el'] != '') {
                    $langs['el'][$item['key']] = $item['el'];
                }
                if ($item['zh'] != '') {
                    $langs['zh'][$item['key']] = $item['zh'];
                }
            }
        }
        file_put_contents("application/i18n/data/ru.json", json_encode($langs['ru']));
        file_put_contents("application/i18n/data/en.json", json_encode($langs['en']));
        file_put_contents("application/i18n/data/el.json", json_encode($langs['el']));
        file_put_contents("application/i18n/data/zh.json", json_encode($langs['zh']));
        die("{}");
    }

    public function action_sortoptions()
    {
        $id = $this->request->query('cid');
        $category = ORM::factory('advert_category', $id);
        $category->build_js();
    }

    public function action_savesort()
    {
        file_put_contents("resources/js/sortsearch.json", json_encode($_POST['indexes']));
    }

    public function action_imageupload()
    {
        $_FILES['file']['type'] = strtolower($_FILES['file']['type']);
        if ($_FILES['file']['type'] == 'image/png' || $_FILES['file']['type'] == 'image/jpg' || $_FILES['file']['type'] == 'image/gif' || $_FILES['file']['type'] == 'image/jpeg' || $_FILES['file']['type'] == 'image/pjpeg') {
            // setting file's mysterious name
            $filename = md5(date('YmdHis')) . '.jpg';
            $file = $this->imgdir . $filename;

            // copying
            copy($_FILES['file']['tmp_name'], $file);

            // displaying file
            $array = array(
                'filelink' => '/' . $this->imgdir . $filename
            );
            $f = file_get_contents($this->imgdir . "images.json");
            $f_arr = json_decode($f);
            $add_f = array("thumb" => "/" . $file, "image" => "/" . $file, "title" => "/" . $file, "folder" => date("d.m.Y-H"));

            $f_arr[sizeof($f_arr)] = $add_f;
            file_put_contents($this->imgdir . "images.json", json_encode($f_arr));
            print stripslashes(json_encode($array));
        }
    }

    public function action_getimages()
    {
        die(file_get_contents($this->imgdir . "images.json"));
    }

    public function action_statistic()
    {
        $this->template->content->messages = ORM::factory('message')
            ->get_full();
    }

    public function action_setpacks()
    {
        $data = $this->request->post();
        if ($data['action'] == 'save') {
            file_put_contents('resources/data/packages.json', json_encode($data['data']));
        }
    }

    public function action_delivery()
    {

    }

}