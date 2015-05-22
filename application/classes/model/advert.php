<?php defined('SYSPATH') or die('No direct script access.');

class Model_Advert extends ORM
{

    const MAILS_ALLOW = 1;
    const MAILS_NOT_ALLOW = 0;

    const STATUS_MODERATION = 0; // На модерации
    const STATUS_PUBLISHED = 1; // Опубликовано
    const STATUS_BLOCKED_REPOST = 2; // Повтор
    const STATUS_BLOCKED_RULES = 3; // Нарушение правил

    const STATUS_SOLD_SITE = 4; // Продано через сайт
    const STATUS_SOLD_OTHER = 5; // Продано где-то ещё
    const STATUS_OFF = 6; // Продано где-то ещё

    public static $status = array(
        self::STATUS_MODERATION => 'advert.status.moderation',
        self::STATUS_PUBLISHED => 'advert.status.published',
        self::STATUS_BLOCKED_REPOST => 'advert.status.blocked.repost',
        self::STATUS_BLOCKED_RULES => 'advert.status.blocked.rules',
        self::STATUS_SOLD_SITE => 'advert.status.sold.site',
        self::STATUS_SOLD_OTHER => 'advert.status.sold.other',
        self::STATUS_OFF => 'advert.status.off',
    );

    protected $_created_column = array(
        'column' => 'published',
        'format' => 'Y-m-d H:i:s'
    );

    protected $_updated_column = array(
        'column' => 'updated',
        'format' => 'Y-m-d H:i:s'
    );

    protected $_sorting = array(
        'published' => 'desc'
    );

    protected $_has_many = array(
        'images' => array(
            'model' => 'advert_image',
            'foreign_key' => 'advert_id'
        ),
        'parts' => array(
            'model' => 'advert_part',
            'foreign_key' => 'advert_id'
        ),
        'options' => array(
            'model' => 'advert_option',
            'foreign_key' => 'advert_id'
        ),
        'option_values' => array(
            'model' => 'advert_option_string',
            'foreign_key' => 'advert_id'
        ),
    );

    protected $_belongs_to = array(
        'user' => array('model' => 'user'),
        'map' => array('model' => 'map', 'foreign_key' => 'id'),
    );

    public function viewd_statuses()
    {
        return array(
            self::STATUS_PUBLISHED
        );
    }

    // Validation rules
    public function rules()
    {
        return array(
            'phone' => array(
                array('not_empty'),
                array('phone', array(':value', Model_User_Profile::PHONE_LENGTH))
            ),
        );
    }

    public function filters()
    {
        return array(
            'amount' => array(
                array('floatval'),
            ),
            'allow_mails' => array(
                array('intval'),
            ),
            'phone' => array(
                array('Model_User_Profile::format_phone')
            )
        );
    }

    protected $_part = NULL;

    public function images()
    {
        return array(
            'resources/' . MEDIA . '/full/' => array(
                'quality' => 85,
            ),
            'resources/' . MEDIA . '/510_410/' => array(
                'width' => 510,
                'height' => 410,
                'quality' => 85,
                'master' => Image::AUTO,
            ),
            'resources/' . MEDIA . '/135_90/' => array(
                'width' => 135,
                'height' => 90,
                'quality' => 85,
                'master' => Image::INVERSE
            ),
            'resources/' . MEDIA . '/235_175/' => array(
                'width' => 235,
                'height' => 175,
                'quality' => 85,
                'master' => Image::INVERSE
            ),
            'resources/' . MEDIA . '/102_80/' => array(
                'width' => 102,
                'height' => 80,
                'quality' => 85,
                'master' => Image::INVERSE
            ),
            'resources/' . MEDIA . '/96_78/' => array(
                'width' => 96,
                'height' => 78,
                'quality' => 85,
                'master' => Image::INVERSE
            ),
        );
    }

    public function phone()
    {
        $phone = $this->phone;

        $file = URL::title($phone, '') . '.png';
        if (!file_exists(TMPPATH . $file)) {
            $im = @imagecreate(140, 14) or die ("Cannot Initialize new GD image stream");
            $text_color = imagecolorallocate($im, 0, 0, 0);
            $font = imageloadfont(RESPATH . 'fonts/Lucida_16_bold.gdf');
            imagestring($im, $font, 0, 0, $phone, $text_color);
            imagepng($im, TMPPATH . $file);
            imagedestroy($im);
        }
        return $file;
    }

    public function status()
    {
        return Arr::get(self::$status, $this->status);
    }

    public function is_deactivated()
    {
        return in_array($this->status, array(
            self::STATUS_OFF, self::STATUS_SOLD_SITE, self::STATUS_SOLD_OTHER
        ));
    }

    public function is_blocked()
    {
        return in_array($this->status, array(
            self::STATUS_BLOCKED_REPOST, self::STATUS_BLOCKED_RULES
        ));
    }

    public function selected()
    {
        return strtotime($this->selected) >= time();
    }

    public function top()
    {
        return strtotime($this->top) >= time();
    }

    public function finished()
    {
        return strtotime($this->finished) < time();
    }

    public function published()
    {
        return strtotime($this->published) >= time();
    }

    public function premium()
    {
        return strtotime($this->premium) >= time();
    }

    public function vip()
    {
        return strtotime($this->vip) >= time();
    }

    public function published_on()
    {
        if (strtotime(date('d.m.Y', strtotime($this->published))) == (strtotime(date('d.m.Y')) - 86400)) {
            return __('advert_page.label.yesterday') . ' ' . Date::format($this->published, 'H:i');
        }
        if (strtotime(date('d.m.Y', strtotime($this->published))) == (strtotime(date('d.m.Y')))) {
            return __('advert_page.label.today') . ' ' . Date::format($this->published, 'H:i');
        }

        return Date::format($this->published);
    }

    public function updated_on()
    {
        if (strtotime(date('d.m.Y', strtotime($this->updated))) == (strtotime(date('d.m.Y')))) {
            return __('advert_page.label.today') . ' ' . Date::format($this->updated, 'H:i');
        }
        if (strtotime(date('d.m.Y', strtotime($this->updated))) == (strtotime(date('d.m.Y')) - 86400)) {
            return __('advert_page.label.today') . ' ' . Date::format($this->updated, 'H:i');
        }

        return Date::format($this->updated);
    }

    public function finished_on()
    {
        if (strtotime(date('d.m.Y', strtotime($this->finished))) == (strtotime(date('d.m.Y')))) {
            return __('advert_page.label.today') . ' ' . Date::format($this->finished, 'H:i');
        }
        return Date::format($this->finished);
    }

    public function allow_mails()
    {
        return $this->allow_mails == self::MAILS_ALLOW;
    }

    public function image_exists($folder = '102_80')
    {
        return (!empty($this->image) AND file_exists(RESPATH . MEDIA . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $this->image));
    }

    public function image($folder = '102_80')
    {
        return RESURL . MEDIA . '/' . $folder . '/' . $this->image;
    }

    public function city()
    {
        $city = NULL;

        if (isset(Model_Map::$cities[$this->city_id])) {
            $city = Model_Map::$cities[$this->city_id]->title;
        } elseif (isset($this->city)) {
            $city = $this->city;
        } else {
            $city = $this->map->title;
        }

        if (empty($city)) {
            $city = 'unknown';
        }

        $city = URL::title($city, '_');
        return __('map.city.' . $city);
    }

    public function category($path = TRUE)
    {
        $category = Model_Advert_Category::$categories
            ->find_by_id($this->category_id);
        if ($category !== NULL) {
            if ($path === TRUE) {
                $category = $category->current()->get_keys_path('title');
                $category = array_reverse($category);
                $category = implode('&nbsp;&rarr;&nbsp;', $category);
            } elseif ($path === NULL) {
                $category = $category->current();
            } else {
                $category = $category->current()->title;
            }
        }

        return $category;
    }


//	public function count_all()
//	{
//		$count = DB::select(array('COUNT("*")', 'total'))
//			->from($this->table_name())
//			->where('finished', '>=', DB::expr('NOW()'));
//
//		// Фильтруем только опубликованные объявления
//		if(Kohana::$environment === Kohana::PRODUCTION)
//		{
//			$count->where('status', '=', self::STATUS_PUBLISHED);
//		}
//		
//		$count = $this->filter_by_location($count);
//		
//		return (int) $count
//			->cached()
//			->execute($this->_db)
//			->get('total');
//	}

    public function find_vip()
    {
        $city = Model_Map::$current_city;
        $adverts = ORM::factory('advert')
            ->select(array('map.title', 'city'))
            ->distinct(true)
            ->filter_by_location(NULL, $city)
            ->with_user()
            ->with_part()
            //->order_by(DB::expr('rand()'))
            ->where($this->object_name() . '.vip', '>=', DB::expr('NOW()'))
            ->where($this->object_name() . '.status', 'in', $this->viewd_statuses())
            ->where($this->object_name() . '.finished', '>=', DB::expr('NOW()'));
        return $adverts->find_all()->as_array();
    }

    public function get_one($id)
    {
        $adverts = ORM::factory('advert')
            ->with_part()
            ->where('id', '=', $id);
        return $adverts->find();
    }


    function sort()
    {
        return $this->order_by($this->object_name() . '.premium', 'desc')
            ->order_by($this->object_name() . '.top', 'desc');
    }

//        public function(){
//            DB::update($this->object_name())
//                    ->
//        }

    public function find_all_by_filter($pagination = TRUE)
    {
        $city = Model_Map::$current_city;     // City ID
        $category = (int)Input::get('c');        // Category ID
        $keyword = Input::get('q');                // Search keyword
        $only_title = (int)Input::get('t');        // Only title
        $with_photo = (int)Input::get('i');        // Only with photo
        $order = Input::get('o');

        $sort_by = Input::get('s', 'date');

        $ad_groups = Input::get('f', 'all');


        $options = Input::get('option');

        $adverts = ORM::factory('advert')
            ->select(array('map.title', 'city', 'adverts.status'))
            ->distinct(true)
            ->filter_by_location(NULL, $city)
            ->with_user()
            ->with_part()
            ->sort();

        /*		if(!empty($options))
                {
                    $options  = explode(',', $options);
                    $options = array_map('intval', $options);

                    $adverts->with_options($options);
                }*/

        switch ($ad_groups) {
            case 'private':
                $adverts->where('user_profiles.type', '=', Model_User_Profile::TYPE_PRIVATE);
                break;
            case 'company':
                $adverts->where('user_profiles.type', '=', Model_User_Profile::TYPE_COMPANY);
                break;
        }

        switch ($sort_by) {
            case 'date':
                if (!in_array($order, array('asc', 'desc'))) {
                    $order = 'desc';
                }
                $adverts
                    ->order_by($this->object_name() . '.published', $order);
//					->order_by($this->object_name().'.premiumq', $order)
//					->order_by($this->object_name().'.selected', $order);
                break;

            case 'price':
                if (!in_array($order, array('asc', 'desc'))) {
                    $order = 'asc';
                }

                $adverts
                    ->order_by($this->object_name() . '.amount', $order);
                break;
        }

        //Поиск по строке
        if ($keyword !== NULL && !empty($keyword)) {
            $adverts2 = ORM::factory('advert')->where(DB::expr('now()'), '<=', DB::expr('TIMESTAMP(finished)'))->with_part()->find_all()->as_array();
            $findedIds = array();
            foreach ($adverts2 as $key) {
                if (preg_match("/" . $keyword . "/ui", $key->title) || preg_match("/" . $keyword . "/ui", $key->description)) {
                    if (!$flag) {
                        $adverts->where_open();
                        $flag = true;
                    }
                    $findedIds[] = $key->id;
                }
            }
            if ($findedIds) {
                $adverts->where('advert.id', 'in', $findedIds);

            }
            if ($flag) {
                $adverts->where_close();
            } else {
                $adverts->where('advert.id', '=', 0);
            }
        }
        $adverts->where($this->object_name() . '.status', 'in', $this->viewd_statuses());

        // Фильтруем объявления у которых дата создания меньше даты окончания показов
        $adverts->where($this->object_name() . '.finished', '>=', DB::expr('NOW()'));

        if ($category != 0) {
            $categories = DB::select('id')
                ->from('advert_categories')
                ->where('parent_id', '=', $category)
                ->execute($this->_db)
                ->as_array(NULL, 'id');
            $categories[] = $category;
            if (!empty($categories)) {
                $adverts->where($this->object_name() . '.category_id', 'in', $categories);
            } else {
                $adverts->where($this->object_name() . '.category_id', '=', $category);
            }
        }

        if ($with_photo == 1) {
            $adverts->where($this->object_name() . ".image", '!=', '');
        }

        if ($options) {
            $void_option = false;
            foreach ($options as $opt) {
                if ($opt == '')
                    $void_option = true;
                else {
                    $void_option = false;
                    break;
                }
            }
            if (!$void_option) {
                foreach ($options as $index => $opt) {
                    if ($opt != "") {
                        $arr = array();
                        $query = DB::select('advert_id')
                            ->from('advert_options')
                            ->where('option_id', '=', $index)
                            ->and_where('value_id', '=', $opt)
                            ->execute()
                            ->as_array();
                        foreach ($query as $item) {
                            $arr[] = $item['advert_id'];
                        }
                        $query = DB::select('advert_id')
                            ->from('advert_option_strings')
                            ->where('option_id', '=', $index)
                            ->and_where('option_value', 'LIKE', '%' . $opt . '%')
                            ->execute()
                            ->as_array();
                        foreach ($query as $item) {
                            $arr[] = $item['advert_id'];
                        }
                        if ($arr)
                            $adverts->and_where('advert.id', 'IN', $arr);
                        else
                            $adverts->and_where('advert.id', '=', NULL);
                    }
                }
            }
        }
        if ($pagination) {
            $count = clone($adverts);
            $pagination = Pagination::factory(array(
                'total_items' => $count->count_all(),
                'items_per_page' => 5,
                'uri_segment' => 'page'
            ));

            $adverts->limit($pagination->items_per_page)
                ->offset($pagination->offset);

            return array($adverts->find_all(), $pagination);
        }

        return array($adverts->find_all(), NULL);
    }

    public function with_author()
    {
        return $this->select(array('user_profiles.name', 'user'), array('users.status', 'user_status'))
            ->join('users', 'left')
            ->on('users.id', '=', $this->object_name() . '.user_id')
            ->join('user_profiles', 'left')
            ->on('user_profiles.id', '=', 'users.profile_id');
    }

    public function with_part($locale = NULL)
    {
        if ($locale === NULL) {
            $locale = I18n::lang();
        }

        $part = ORM::factory('advert_part');

        return $this
            ->select($part->table_name() . '.title', $part->table_name() . '.description')
            ->join($part->table_name(), 'left')
            ->on($part->table_name() . '.advert_id', '=', $this->object_name() . '.id')
            ->where($part->table_name() . '.locale', '=', $locale);
    }


    /*    public function with_options($options)
        {
            if(!is_array( $options ))
            {
                $options = array($options);
            }

            return $this->join('advert_options')
                ->on('advert_options.advert_id', '=', $this->object_name().'.id')
                ->where('advert_options.value_id', 'in', $options);
        }*/


    /*	public function with_options($options)
        {
            if(!is_array( $options ))
            {
                $options = array($options);
            }

            return $this->join('adverts_options')
                ->on('adverts_options.advert_id', '=', $this->object_name().'.id')
                ->where('adverts_options.value_id', 'in', $options);
        }*/

    public function part($locale = NULL)
    {
        if ($locale === NULL) {
            $locale = I18n::lang();
        }

        if ($this->_part instanceof Model_Advert_Part) {
            return $this->_part;
        }

        return $this->_part = ORM::factory('advert_part')
            ->where('advert_id', '=', $this->pk())
            ->where('locale', '=', $locale)
            ->find();
    }

    public function get_ids_by_category_id($category_id)
    {
        return $this->get_ids_by('category_id', $category_id);
    }

    public function get_ids_by_options(array $options)
    {

    }

    public function remove_package($package, $advert)
    {
        DB::delete('advert_package_options')
         ->where('advert_id', '=', $advert)
        ->and_where('option_id', '=', $package)->execute();

    }

    public function add_package($package)
    {
        if (!($package instanceof Model_Package)) {
            if (!isset(Model_Package::$packages[$package])) {
                // throw new Exception(__('Package with name: :name not found', array(':name' => $package)));
            }

            $package = Model_Package::$packages[$package];
        }

        $options = $package->get_options();

        $insert = DB::insert('advert_package_options')
            ->columns(array('created', 'advert_id', 'option_id', 'finished'));

        foreach ($options as $option) {
            if ($option instanceof Model_Package_Option_Abstract) {
                $this->{$option->column} = date('Y-m-d H:i:s', time() + $option->duration());
                $insert->values(array(
                    'created' => date('Y-m-d H:i:s'),
                    'advert_id' => $this->id,
                    'option_id' => $option->id(),
                    'finished' => $this->{$option->column}
                ));

//				$moneyflow = ORM::factory('moneyflow');
//				$moneyflow->set_recipient($option);
//				$moneyflow->start(  Auth::instance()->get_user() );
//				$moneyflow->finish();
            }
        }

        try {
            Database::instance()->begin();
            $this->update();
            $insert->execute($this->_db);

            Database::instance()->commit();
        } catch (Exception $exc) {
            Database::instance()->rollback();
            Messages::errors($exc->getMessage());
        }

        return $this;
    }

    public function get_options()
    {
        if (!$this->loaded()) {
            return array();
        }
        $result = array();
        $options = DB::select()
            ->from('advert_options')
            ->where('advert_id', '=', $this->id)
            ->as_object()
            ->execute();
        foreach ($options as $opt) {
            $result[$opt->option_id] = $opt->value_id;
        }
        $string_options = DB::select()
            ->from('advert_option_strings')
            ->where('advert_id', '=', $this->id)
            ->as_object()
            ->execute();
        foreach ($string_options as $opt) {
            $result[$opt->option_id] = $opt->option_value;
        }
        return $result;
    }


    public function add_option($id)
    {
        $option = Model_Package_Option::get($id);
        if (!$option) {
            return FALSE;
        }

        $insert = DB::insert('advert_package_options')
            ->columns(array('created', 'advert_id', 'option_id', 'finished'));

        if ($option instanceof Model_Package_Option_Abstract) {
            $this->{$option->column} = date('Y-m-d H:i:s', time() + $option->duration());

            $insert->values(array(
                'created' => date('Y-m-d H:i:s'),
                'advert_id' => $this->id,
                'option_id' => $option->id(),
                'finished' => $this->{$option->column}
            ));

            $moneyflow = ORM::factory('moneyflow');
            $moneyflow->set_recipient($option);
            $moneyflow->start(Auth::instance()->get_user());
            $moneyflow->finish();
        }

        try {
            Database::instance()->begin();
            $this->update();
            $insert->execute($this->_db);

            Database::instance()->commit();
        } catch (Exception $exc) {
            Database::instance()->rollback();
            Messages::errors($exc->getMessage());
        }

        return $this;
    }

    public function get_package_options() // не используется
    {
        $array = array();

        if (!$this->loaded()) {
            return array();
        }

        $options = DB::select()
            ->from('advert_package_options')
            ->where('advert_id', '=', $this->id)
            ->as_object()
            ->execute($this->_db);

        foreach ($options as $option) {
            if (Model_Package_Option::exists_option($option->option_id)) {
                $array[$option->option_id] = Model_Package_Option::get($option->option_id);
                $array[$option->option_id]
                    ->set('created', $option->created)
                    ->set('finished', $option->finished);
            }
        }

        return $array;
    }

    public function delete()
    {
        if (!$this->_loaded)
            throw new Kohana_Exception('Cannot delete :model model because it is not loaded.', array(':model' => $this->_object_name));

        if ($this->user_id != Auth::instance()->get_user()) {
            throw new Kohana_Exception('Cannot delete advert.');
        }

        // Use primary key value
        $id = $this->pk();

        ORM::factory('bookmark')->delete_object($this);
        ORM::factory('advert_image')->delete_all($this);

        // Delete the object
        DB::delete($this->_table_name)
            ->where($this->_primary_key, '=', $id)
            ->execute($this->_db);

        return $this->clear();
    }

    public function set_status($status)
    {
        if (!$this->_loaded) {
            throw new Kohana_Exception('Cannot change advert status because it is not loaded.');
        }

        if ($this->user_id != Auth::instance()->get_user()) {
            throw new Kohana_Exception('Cannot change advert status.');
        }

        // Use primary key value
        $id = $this->pk();

        return DB::update($this->table_name())
            ->set(array(
                'status' => (int)$status,
            ))
            ->where($this->_primary_key, '=', $id)
            ->execute();
    }

    public function find_image($filename)
    {
        $image = DB::select('image')
            ->from($this->table_name())
            ->where('image', '=', $filename)
            ->limit(1)
            ->execute()
            ->get('image');

        if ($image !== NULL) {
            return TRUE;
        }

        return DB::select('image')
            ->from($this->images->table_name())
            ->where('image', '=', $filename)
            ->limit(1)
            ->execute()
            ->get('image', FALSE);
    }

    public function delete_image($filename)
    {
        ORM::factory('advert_image', array('image' => $filename))
            ->delete();

        foreach ($this->images() as $path => $data) {
            $file = DOCROOT . $path . $filename;
            if (file_exists($file) AND !is_dir($file)) {
                unlink($file);
            }
        }

        DB::update($this->table_name())
            ->set(array('image' => ''))
            ->where('image', '=', $filename)
            ->execute();
    }

    public function change_main_image($image, $id)
    {
        $old = DB::select('image')
            ->from($this->table_name())
            ->where('id', '=', $id)
            ->execute();

        if ($old[0]['image'] != $image) {
            var_dump('ok');
            DB::update($this->table_name())
                ->set(array('image' => $image))
                ->where('id', '=', $id)
                ->execute();

            DB::update('advert_images')
                ->set(array('image' => $old[0]['image']))
                ->where('image', '=', $image)
                ->execute();
        }
    }
}