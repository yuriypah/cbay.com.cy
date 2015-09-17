<?php defined('SYSPATH') or die('No direct script access.');

class Model_Advert_Category extends ORM
{

    protected $_primary_key_value = 'related_id';
    protected $_reload_on_wakeup = FALSE;

    protected $_belongs_to = array(
        'advert' => array('model' => 'advert', 'foreign_key' => 'category_id'),
    );

    protected $_has_many = array(
        'options' => array(
            'model' => 'advert_category_option',
            'foreign_key' => 'category_id',
            'through' => 'advert_categories_options'
        )
    );

    public static $categories = array();

    public function rules()
    {
        return array(
            'ratio' => array(
                array('numeric')
            )
        );
    }

    public function labels()
    {
        return array(
            'title' => 'Название'
        );
    }

    public static function init()
    {
        $lang = I18n::lang();
        self::$categories = Model_Tree::factory(self::get_all())
            //->cached(NULL, 'advert_category')
            ->execute();
    }

    public static function build_js()
    {
        $data = self::build_tree();

        $json = json_encode($data, JSON_HEX_APOS);

        $file = RESPATH . 'js' . DIRECTORY_SEPARATOR . 'tree.js';

        if (!file_exists($file)) {
            $f = fopen($file, 'w');
            $result = fwrite($f, $json);
            fclose($f);
        } else {
            $data = file_get_contents($file);
            if (md5($data) != md5($json)) {
                $f = fopen($file, 'w');
                $result = fwrite($f, $json);
                fclose($f);
            }
        }
    }

    public static function build_tree()
    {
        if (Kohana::$caching === TRUE) {
            if ($data = Kohana::cache('categories::options::values')) {
                return $data;
            }
        }

        $categories = (array)self::get_all();

        $categories_options = DB::select()
            ->from('advert_categories_options')
            ->order_by('parent_index', 'ASC')
            ->execute()
            ->as_array();


        $options = ORM::factory('advert_category_option')
            ->with_locale()
            ->find_all()
            ->as_array('id');
        $values = ORM::factory('advert_category_option_value')
            ->with_locale()
            ->order_by('index', 'ASC')
            ->find_all()
            ->as_array('id');
        $data = array();
        foreach ($categories_options as $row) {
            if (isset($categories[$row['category_id']])) {
                $data['categories'][$row['category_id']]['id'] = $categories[$row['category_id']]->id;
                $data['categories'][$row['category_id']]['title'] = $categories[$row['category_id']]->title;
                $data['categories'][$row['category_id']]['parent_id'] = $categories[$row['category_id']]->parent_id;
                $data['categories'][$row['category_id']]['options'][] = $row['option_id'];

            }
        }

        foreach ($values as $row) {
            if (isset($options[$row->option_id])) {
                $options[$row->option_id]->_values[] = $row->as_array();
            }
        }

        foreach ($options as $option) {
            $data['options'][$option->id] = array(
                'id' => $option->id,
                'title' => $option->title,
                'type' => $option->type_id,
                'description' => $option->description,
                'values' => $option->_values,
                'parent_id' => $option->parent_id,
                'ranged' => $option->ranged,
                'ranged_min' => $option->ranged_min,
                'ranged_max' => $option->ranged_max

            );
        }

        if (Kohana::$caching === TRUE) {
            Kohana::cache('categories::options::values', $data, 72000);
        }

        return $data;
    }

//	protected function build_tree(&$elements, $parentId = 0)
//	{
//		$branch = array();
//
//		foreach ($elements as $element) 
//		{
//			if ($element['parent_id'] == $parentId) 
//			{
//				$children = buildTree($elements, $element['id']);
//				if ($children) {
//					$element['children'] = $children;
//				}
//				$branch[$element['id']] = $element;
//				unset($elements[$element['id']]);
//			}
//		}
//		return $branch;
//	}


    public static function get_all()
    {
        $locale = I18n::lang();

        return DB::select('*')
            ->from('advert_categories')
            ->order_by('parent_id', 'asc')
            ->order_by('id', 'asc')
            ->join('lang_parts', 'left')
            ->on('lang_parts.related_table', '=', DB::expr("'advert_categories'"))
            ->on('lang_parts.related_id', '=', 'advert_categories.id')
            ->on('lang_parts.locale', '=', DB::expr("'$locale'"))
            ->as_object()
            ->execute()
            ->as_array('id');

    }

    public function recalculate()
    {
        DB::update($this->table_name())
            ->set(array(
                'count_adverts' => 0
            ))
            ->execute($this->_db);

        $categories = DB::select('id', 'parent_id')
            ->from($this->table_name())
            ->where('parent_id', '!=', 0)
            ->execute($this->_db)
            ->as_array('parent_id', 'id');

        $count_adverts = DB::select(array('COUNT("*")', 'total'))
            ->from('adverts')
            ->where('adverts.category_id', '=', DB::expr('`' . $this->table_name() . '`.`id`'))
            ->group_by('adverts.category_id');

        DB::update($this->table_name())
            ->where('parent_id', '!=', 0)
            ->set(array(
                'count_adverts' => $count_adverts
            ))
            ->execute($this->_db);

        foreach ($categories as $parent_id => $id) {
            $this->calculate($parent_id, $id);
        }
    }

    public function count_advert($category_id)
    {
        $category = DB::select('id', 'parent_id')
            ->from($this->table_name())
            ->where('id', '=', $category_id)
            ->as_object()
            ->execute($this->_db)
            ->current();

        if ($category) {
            DB::update($this->table_name())
                ->where('id', '=', $category->id)
                ->set(array(
                    'count_adverts' => DB::expr('count_adverts + 1')
                ))
                ->execute($this->_db);

            $this->calculate($category->parent_id, $category->id);
        }
    }

    public function calculate($parent_id, $category_id)
    {
        $count_parents = DB::select(array('SUM("count_adverts")', 'total'))
            ->from($this->table_name())
            ->where('parent_id', '=', $parent_id)
            ->group_by('parent_id')
            ->execute($this->_db)
            ->get('total', 0);

        DB::update($this->table_name())
            ->where('id', '=', $parent_id)
            ->set(array(
                'count_adverts' => $count_parents
            ))
            ->execute($this->_db);
    }

    public function groups($locale = NULL)
    {
        if ($locale === NULL) {
            $locale = I18n::lang();
        }

        $array = DB::select('id', 'lang_parts.title')
            ->from($this->table_name())
            ->where('parent_id', '=', 0)
            ->join('lang_parts', 'left')
            ->on('lang_parts.related_table', '=', DB::expr("'" . $this->table_name() . "'"))
            ->on('lang_parts.related_id', '=', $this->table_name() . '.id')
            ->on('lang_parts.locale', '=', DB::expr("'$locale'"))
//			->cached()
            ->execute($this->_db)
            ->as_array('id', 'title');

        $array[0] = '----------------------';
        return $array;
    }

    public function tree()
    {
        return self::$categories;
    }

    public function form_select($pair = NULL, $null_line = FALSE, $locale = NULL)
    {
        if ($locale === NULL) {
            $locale = I18n::lang();
        }

        $data = DB::select()
            ->from('advert_categories')
            ->where('advert_categories.level', '<=', 1)
            ->join('lang_parts', 'left')
            ->on('lang_parts.related_table', '=', DB::expr("'" . $this->table_name() . "'"))
            ->on('lang_parts.related_id', '=', $this->table_name() . '.id')
            ->on('lang_parts.locale', '=', DB::expr("'$locale'"))
            ->execute($this->_db);

        $select = array();
        foreach ($categories as $category) {
            $select[$category->parent_id][$category->id] = $category;
        }

        return $select;
    }

    public function get($category_id)
    {
        $query = DB::select()
            ->from($this->name)
            ->join('lang_part', 'left')
            ->on($this->name . '.id', '=', 'lang_part.related_id')
            ->where('advert_category', '=', $this->name)
            ->where('id', '=', $category_id)
            ->cached(3600, FALSE, 'get_categoriy_by_id_' . $category_id);

        return $query->execute($this->_db);
    }
}
