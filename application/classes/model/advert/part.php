<?php defined('SYSPATH') or die('No direct script access.');

class Model_Advert_Part extends ORM
{

//	public function filters()
//	{
//		return array(
//			'description' => array(
//				array('Kses::filter', array(':value', Context::instance()->config['allowed_html_tags']))
//			)
//		);
//	}
    public function get_item($id)
    {
        return DB::query(Database::SELECT, "SELECT * FROM `advert_parts` WHERE `advert_id`='" . $id . "' ORDER BY `locale` ASC")
            ->execute()
            ->as_array();
    }

    public function save_changes($data, $id)
    {
        DB::update('advert_parts')
            ->set($data['ru'])
            ->where('advert_id', '=', $id)
            ->where('locale', '=', 'ru')
            ->execute();

        DB::update('advert_parts')
            ->set($data['en'])
            ->where('advert_id', '=', $id)
            ->where('locale', '=', 'en')
            ->execute();

        DB::update('advert_parts')
            ->set($data['gr'])
            ->where('advert_id', '=', $id)
            ->where('locale', '=', 'gr')
            ->execute();

    }

    public function add_item(ORM $advert, $data, $lang = NULL)
    {
        $locales = array('ru', 'en', 'gr');

        if (!is_array($data)) {
            throw new Kohana_Exception('Data variable mast be an array');
        }

        if (!$advert->loaded()) {
            throw new Kohana_Exception('Advert not loaded');
        }

        $data['advert_id'] = $advert->pk();

        if ($lang !== NULL) {
            $data['locale'] = $lang;
        }

        if (!isset($data['locale']) OR !array_key_exists($data['locale'], Model_Lang_Part::$languages)) {
            $data['locale'] = I18n::lang();
        }

        $data['created_on'] = date("Y-m-d H:i:s");

        $translates = array();
        for ($i = 0; $i < count($locales); $i++) {
            if ($data['locale'] != $locales[$i]) {
                if ($locales[$i] == 'gr')
                    $lg = 'el';
                else
                    $lg = $locales[$i];

                $translates[$locales[$i]]['advert_id'] = $data['advert_id'];
                $tmpres = Googletranslate::translate($data['title'], $lg, $data['locale']);
                $translates[$locales[$i]]['title'] = $tmpres[0]['translatedText'];
                $tmpres = Googletranslate::translate($data['description'], $lg, $data['locale']);
                $translates[$locales[$i]]['description'] = $tmpres[0]['translatedText'];
                $tmpres = Googletranslate::translate($data['keywords'], $lg, $data['locale']);
                $translates[$locales[$i]]['keywords'] = str_replace(' ', '', $tmpres[0]['translatedText']);
                $translates[$locales[$i]]['locale'] = $locales[$i];
                $translates[$locales[$i]]['created_on'] = $data['created_on'];
            }
        }

        foreach ($translates as $key => $val) {
            DB::insert($this->table_name(), array('advert_id', 'title', 'description', 'keywords', 'locale', 'created_on'))
                ->values($val)
                ->execute();
        }
        return $this
            ->values($data, array('advert_id', 'title', 'description', 'locale', 'keywords', 'created_on'))
            ->create();
    }

    public function update_item(ORM $advert, $data, $lang = NULL)
    {
        $locales = array('ru', 'en', 'gr');
        if (!is_array($data)) {
            throw new Kohana_Exception('Data variable mast be an array');
        }

        if (!$advert->loaded()) {
            throw new Kohana_Exception('Advert not loaded');
        }

        if ($lang !== NULL) {
            $data['locale'] = $lang;
        }

        if (!isset($data['locale']) OR !array_key_exists($data['locale'], Model_Lang_Part::$languages)) {
            $data['locale'] = I18n::lang();
        }

        $set_pairs = array();
        foreach ($data as $key => $value) {
            if (in_array($key, array('title', 'description', 'keywords'))) {
                $set_pairs[$key] = $data[$key];
            }
        }
        $translates = array();
        for ($i = 0; $i < count($locales); $i++) {
            if ($data['locale'] != $locales[$i]) {
                if ($locales[$i] == 'gr')
                    $lg = 'el';
                else
                    $lg = $locales[$i];

                $tmpres = Googletranslate::translate($set_pairs['title'], $lg, $data['locale']);
                $translates[$locales[$i]]['title'] = $tmpres[0]['translatedText'];
                $tmpres = Googletranslate::translate($set_pairs['description'], $lg, $data['locale']);
                $translates[$locales[$i]]['description'] = $tmpres[0]['translatedText'];
                $tmpres = Googletranslate::translate($set_pairs['keywords'], $lg, $data['locale']);
                $translates[$locales[$i]]['keywords'] = str_replace(' ', '', $tmpres[0]['translatedText']);
            }
        }
        foreach ($translates as $key => $translate) {
            DB::update($this->table_name())
                ->set($translate)
                ->where('advert_id', '=', $advert->pk())
                ->where('locale', '=', $key)
                ->execute();
        }
        return DB::update($this->table_name())
            ->set($set_pairs)
            ->where('advert_id', '=', $advert->pk())
            ->where('locale', '=', $data['locale'])
            ->execute();
    }
}