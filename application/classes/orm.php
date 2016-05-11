<?php defined('SYSPATH') or die('No direct script access.');

class ORM extends Kohana_ORM
{

    public function int2ip($i)
    {
        $d[0] = (int)($i / 256 / 256 / 256);
        $d[1] = (int)(($i - $d[0] * 256 * 256 * 256) / 256 / 256);
        $d[2] = (int)(($i - $d[0] * 256 * 256 * 256 - $d[1] * 256 * 256) / 256);
        $d[3] = $i - $d[0] * 256 * 256 * 256 - $d[1] * 256 * 256 - $d[2] * 256;
        return "$d[0].$d[1].$d[2].$d[3]";
    }

    public function ip2int($ip)
    {
        $a = explode(".", $ip);
        return $a[0] * 256 * 256 * 256 + $a[1] * 256 * 256 + $a[2] * 256 + $a[3];
    }

    public function ip()
    {
        return isset($this->ip) ? $this->int2ip($this->ip) : NULL;
    }

    public function title($locale = NULL)
    {
        return isset($this->title) ? $this->title : $this->locale($locale)->title;
    }

    public function description($locale = NULL)
    {
        return isset($this->description) ? $this->description : $this->locale($locale)->description;
    }

    public function amount()
    {
        // return (int) number_format($this->amount, 0, ',', ' ') . ' ' . __('currency.euro')';'
        return (int)$this->amount > 0 ? number_format($this->amount, 0, ',', ' ') . ' ' . __('currency.euro') : __('currency.no_set');
    }

    public function label($field, array $attributes = NULL, $render = TRUE)
    {
        $name = $field;
        $labels = $this->labels();

        if (!array_key_exists($field, $this->_object) AND !array_key_exists($field, $labels)) {
            throw new Exception('Field not found');
        }

        if (isset($labels[$field])) {
            $name = $labels[$field] . ':';
        }

        if ($render === FALSE) {
            return $name;
        }

        $field_id = 'form_' . $this->object_name() . '_' . $field;

        $attributes['class'] = 'control-label';

        return Form::label($field_id, $name, $attributes);
    }

    public function list_columns()
    {
        if (Cache::instance()->get('table_columns_' . $this->_object_name)) {
            //return Cache::instance()->get( 'table_columns_' . $this->_object_name );
        }

        //Cache::instance()->set( 'table_columns_' . $this->_object_name, $this->_db->list_columns( $this->table_name() ) );

        // Proxy to database
        return $this->_db->list_columns($this->table_name());
    }

    public function form_select($pair = NULL, $null_line = FALSE, $locale = NULL)
    {
        if ($locale === NULL) {
            $locale = I18n::lang();
        }

        $data = DB::select()
            ->from(array($this->table_name(), $this->object_name()))
            ->join('lang_parts', 'left')
            ->on('lang_parts.related_table', '=', DB::expr("'" . $this->table_name() . "'"))
            ->on('lang_parts.related_id', '=', $this->object_name() . '.' . $this->primary_key())
            ->on('lang_parts.locale', '=', DB::expr("'" . $locale . "'"));

        // Process pending database method calls
//		foreach ($this->_db_pending as $method)
//		{
//			$name = $method['name'];
//			$args = $method['args'];
//
//			call_user_func_array(array($data, $name), $args);
//		}

        if ($pair === NULL) {
            $pair = array('id', 'title');
        }

        if (count($pair) != 2) {
            throw new Exception('Необходимо указать 2 поля');
        }

        foreach ($pair as $value) {
            $data->select($value);
        }

        $array = $data->execute($this->_db)
            ->as_array($pair[0], $pair[1]);

        if ($null_line) {
            array_push($array, "---=== Не выбрано ===---");
        }

        return $array;
    }

    public function get_ids_by($column, $value)
    {
        return DB::select('id')
            ->from($this->table_name())
            ->where($column, '=', $value)
            ->execute($this->_db)
            ->as_array(NULL, 'id');
    }

    /**
     * Получение списка ID для текущей модели
     *
     * @return array
     */
    public function get_ids()
    {
        return DB::select('id')
            ->from($this->table_name())
            ->execute($this->_db)
            ->as_array(NULL, 'id');
    }

    public function get_by_ids($ids)
    {
        if (!is_array($ids)) {
            $ids = array($ids);
        }

        if (count($ids) == 0) {
            return NULL;
        }

        return $this
            ->where('id', 'in', $ids)
            ->find_all();
    }

    /**
     * Checks whether a column value is unique.
     * Excludes itself if loaded.
     *
     * @param   string   the field to check for uniqueness
     * @param   mixed    the value to check for uniqueness
     * @return  bool     whteher the value is unique
     */
    public function unique($field, $value)
    {
        $model = ORM::factory($this->object_name())
            ->where($field, '=', $value)
            ->find();

        if ($this->loaded()) {
            return (!($model->loaded() AND $model->pk() != $this->pk()));
        }

        return (!$model->loaded());
    }

    /**
     * Подгрузка к текущей модели bookmark_id
     * Если запись в закладках, то будет указан ее ID
     *
     * @return  ORM
     */
    public function with_bookmarks()
    {
        $bookmarks = Arr::get(Model_Bookmark_Cookie::$bookmarks, $this->object_name());

        if ($bookmarks === NULL OR empty($bookmarks)) {
            return $this
                ->limit(0);
        }

        return $this
            ->where($this->object_name() . '.id', 'in', $bookmarks);
    }

    public function with_user()
    {
        return $this
            ->select(array('user_profiles.name', 'author'))
            ->join('users', 'left')
            ->on('users.id', '=', $this->object_name() . '.user_id')
            ->join('user_profiles', 'left')
            ->on('users.profile_id', '=', 'user_profiles.id')
            ->where('users.status', '=', 1);
    }

    public function by_user($id)
    {
        return $this
            ->select(array('user_profiles.name', 'author'))
            ->join('users', 'left')
            ->on('users.id', '=', $this->object_name() . '.user_id')
            ->join('user_profiles', 'left')
            ->on('users.profile_id', '=', 'user_profiles.id')
            ->where('users.status', '=', 1)
            ->and_where_open()
            ->and_where('users.id', '=', $id)
            ->and_where_close();
    }

    public function in_bookmark($default = NULL)
    {
        if (!isset($this->bookmark_id)) {
            return $default;
        }

        return (bool)$this->bookmark_id;
    }

    /**
     * Подгрузка для текущей модели title и description
     *
     * @param type $locale Локаль для отображения
     * @return  ORM
     */
    public function with_locale($locale = NULL)
    {
        if ($locale === NULL) {
            $locale = I18n::lang();
        }

        return $this
            ->select(array('lang_parts.title', 'title'))
            ->select(array('lang_parts.description', 'description'))
            ->join('lang_parts', 'left')
            ->on('lang_parts.related_table', '=', DB::expr("'" . $this->table_name() . "'"))
            ->on('lang_parts.related_id', '=', $this->object_name() . '.' . $this->primary_key())
            ->on('lang_parts.locale', '=', DB::expr("'" . $locale . "'"));
    }

    public function delete()
    {
        ORM::factory('lang_part')->delete_item($this);
        return parent::delete();
    }

    /**
     * Подгрузка для текущей записи - модели с полями перевода
     *
     * @param type $locale Локаль для отображения
     * @return  ORM
     */
    protected $_locale = NULL;

    public function locale($locale = NULL)
    {
        if ($locale === NULL) {
            $locale = I18n::lang();
        }

        if ($this->_locale === NULL) {
            $this->_locale = ORM::factory('lang_part')
                ->where('locale', '=', $locale)
                ->where('related_table', '=', $this->table_name())
                ->where('related_id', '=', $this->pk())
                ->find();
        }

        return $this->_locale;
    }

    public function get_related_ids($alias)
    {
        if (!isset($this->_has_many[$alias])) {
            /*throw new Kohana_Exception('Relation :alias not exists in object :object', array(
                ':alias' => $alias,
                ':object' => $this->object_name()
            ));*/
        }

        if (!$this->loaded()) {
            return array();
        }

        $table_name = $this->_has_many[$alias]['through'];
        $filed = $this->_has_many[$alias]['foreign_key'];
        $related_field = $this->_has_many[$alias]['far_key'];

        return DB::select($related_field)
            ->from($table_name)
            ->where($filed, '=', $this->pk())
            ->execute($this->_db)
            ->as_array(NULL, $related_field);
    }

    public function update_related_ids($alias, $new_ids = array(), $current_ids = array())
    {
        if (!is_array($new_ids)) {
            return $this;
        }

        if (!$this->loaded() AND !empty($new_ids)) {
            return $this->add($alias, $new_ids);
        }

        if (empty($current_ids)) {
            $current_ids = $this->get_related_ids($alias);
        }

        $old_ids = array_diff($current_ids, $new_ids);
        $new_ids = array_diff($new_ids, $current_ids);

        if (!empty($old_ids)) {
            $this->remove($alias, $old_ids);
        }

        if (!empty($new_ids)) {
            $this->add($alias, $new_ids);
        }

        return $this;
    }

    public function add_images($file, $field = NULL, $image_rotation = NULL, $params = NULL)
    {
        if ($field !== NULL AND !$this->loaded()) {
            //throw new Kohana_Exception( 'Model must be loaded' );
        }

        if ($params === NULL) {
            $params = $this->images();
        }

        $tmp_file = DOCROOT . trim($file);

        if (!file_exists($tmp_file) OR is_dir($tmp_file)) {
            return NULL;
        }

        $ext = strtolower(pathinfo($tmp_file, PATHINFO_EXTENSION));
        $filename = uniqid() . '.' . $ext;

        if (strpos($tmp_file, 'temp') !== FALSE) {
            foreach ($params as $path => $_params) {
                $path = DOCROOT . trim($path) . DIRECTORY_SEPARATOR;

                if (!is_dir($path)) {
                    mkdir($path, 0777);
                    chmod($path, 0777);
                }

                $file = $path . $filename;

                $local_params = array(
                    'width' => NULL,
                    'height' => NULL,
                    'master' => NULL,
                    'quality' => 95,
                    'resize' => TRUE
                );

                $_params = Arr::merge($local_params, $_params);

                if (!copy($tmp_file, $file)) {
                    continue;
                }

                chmod($file, 0777);

                $image = Image::factory($file);
                $watermark_path = DOCROOT."/resources/images/logo4.png";
                $watermark = Image::factory($watermark_path);
                $image->watermark($watermark, 30, 30, 50);
                if (!empty($_params['width']) AND !empty($_params['height'])) {
                    $image->resize($_params['width'], $_params['height'], $_params['master']);
                    $image->crop($_params['width'], $_params['height']);
                }

                $image->save();
            }

            if ($field !== NULL) {
                $this->{$field} = $filename;
                $this->{'image_rotation'} = $image_rotation;
                $this->update();
            }
            unlink($tmp_file);
        } else {
            $filename = pathinfo($file, PATHINFO_BASENAME);
            if ($field !== NULL) {
                $this->{$field} = $filename;
                $this->{'image_rotation'} = $image_rotation;
                $this->update();
            }
        }
        return $filename;
    }

    public function with_city()
    {
        return $this
            ->join('map', 'left')
            ->on('map.id', '=', $this->object_name() . '.city_id');
    }


    public function filter_by_location($object = NULL, $city_id = NULL)
    {
        if ($object === NULL) {
            $object = $this;
        }

        $field = 'city_id';

        if ($object instanceof ORM) {
            $field = $object->object_name() . '.city_id';
        }

        if ($city_id === NULL OR $city_id == 0) {
            $city_id = Model_Map::$current_city;
        }

        $object
            ->join('map', 'left')
            ->on('map.id', '=', $field);


        if ($city_id) {
            return $object
                ->where($field, '=', $city_id);
        }

        return $object;
    }
}
