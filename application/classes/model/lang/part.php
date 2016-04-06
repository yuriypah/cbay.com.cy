<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Model_Lang_Part extends ORM {

	const LANG_TITLE_RU = 'Русский';
	const LANG_TITLE_EN = 'English';
	const LANG_TITLE_GR = 'Greek';
    const LANG_TITLE_ZH = '中国';

	const LANG_CODE_RU = 'ru';
	const LANG_CODE_EN = 'en';
	const LANG_CODE_GR = 'gr';
    const LANG_CODE_ZH = 'zh';
	protected $_primary_key = 'related_id';

	public static $languages = array(
		self::LANG_CODE_EN => self::LANG_TITLE_EN,
		self::LANG_CODE_RU => self::LANG_TITLE_RU,
		self::LANG_CODE_GR => self::LANG_TITLE_GR,
        /*self::LANG_CODE_ZH => self::LANG_TITLE_ZH,*/
	);
	
	public static function count()
	{
		return count(self::$languages);
	}
        
        public function get_category_options($id){
            
            $res = DB::select('option_id')
                    ->from('advert_categories_options')
                    ->where('category_id', '=', $id)
                    ->limit(3)
                    ->execute();
            $items = array();
            foreach($res as $item){
                $items[] = $item['option_id'];
            }

            $cat_names = DB::select($this->table_name().'.title')
                    ->from('advert_category_option_values')
                    ->join($this->table_name(), 'LEFT')
                    ->on('advert_category_option_values.id', '=', $this->table_name().'.related_id')
                    ->where('advert_category_option_values.option_id', 'IN', $items)
                    ->and_where($this->table_name().'.related_table', '=', 'advert_category_option_values')
                    ->execute();
            return $cat_names;
        }


        public function get_cat_name($related_table, $id, $lang = NULL){
            if(!$lang)
                $lang = I18n::lang();
            $result = DB::select('title')
                    ->from($this->table_name())
                    ->where('related_table', '=', $related_table)
                    ->and_where('related_id', '=', $id)
                    ->execute($this->_db);
            if($result->count() > 0){
                return $result;
            } else {
                return false;
            }
        }

	public function get_item_list( ORM $related_object )
	{
		if(!$related_object->loaded())
		{
			return array();
		}

		$query = DB::select()
			->from( $this->table_name() )
			->where( 'related_table', '=', $related_object->table_name() )
			->where( 'related_id', '=', $related_object->pk() );

		return $query
			->as_object()
			->execute($this->_db)
			->as_array('locale');
	}
	
	public function delete_item(ORM $related_object, $lang = NULL)
	{
		$query = DB::delete($this->_table_name);

		// Если модель загружена, то удаляем только для текущей записи
		// TODO: хорошенько подумать чтобы удалять таким образом!
		if($related_object->loaded())
		{
			$query->where('related_id', '=', $related_object->pk());
		}

		if($lang !== NULL AND array_key_exists( $lang, Model_Lang_Part::$languages ))
		{
			$query->where('locale', '=', $lang);
		}
		
		$query
			->where('related_table', '=', $related_object->table_name())
			->execute($this->_db);
		
		return $this;
	}

	public function add_item(ORM $related_object, $data, $lang = NULL)
	{
		if(!is_array($data))
		{
			throw new Kohana_Exception('Data variable mast be an array');
		}
		
		if(!$related_object->loaded())
		{
			throw new Kohana_Exception('Related object :table_name not loaded', array(
				':table_name' => $related_object->table_name()
			));
		}

		$data['related_table'] = $related_object->table_name();
		$data['related_id']    = $related_object->pk();

		if($lang !== NULL)
		{
			$data['locale'] = $lang;
		}
		
		// Если не указана локаль или она отсутсвует в списке разрешенных, указываем локаль по умолчанию
		if(!isset($data['locale']) OR !array_key_exists( $data['locale'], Model_Lang_Part::$languages ))
		{
			$data['locale'] = I18n::lang();
		}
		
		// Проверяем, есть ли текущая запись в БД
		$this
			->where('related_table', '=', $data['related_table'])
			->where('related_id', '=', $data['related_id'])
			->where('locale', '=', $data['locale'])
			->find();
		
		// Если есть обноляем запись
		if($this->loaded())
		{
			return DB::update($this->_table_name)
				->set($data)
				->where('related_table', '=', $this->related_table)
				->where('related_id', '=', $this->related_id)
				->where('locale', '=', $this->locale)
				->execute($this->_db);
		}
		
		// Если нет, создаем новую
		return $this
			->reset()
			->values($data, array('related_table', 'related_id', 'title', 'description', 'locale'))
			->create();
	}
	
	public function clear_lost()
	{
		$rows = $this->find_all();
		
		$tables = array();
		foreach ($rows as $row)
		{
			$tables[$row->related_table][$row->related_id] = $row->related_id;
		}
		
		$lost = array();
		
		foreach ($tables as $related_table => $related_ids)
		{
			foreach ( $related_ids as $id )
			{
				$row = DB::select('id')
				->from($related_table)
				->where('id', '=', $id)
				->execute()
				->get('id');
			
				if($row === NULL)
				{
					$lost[$related_table][$id] = $id;
				}
			}
		}
		
		foreach ( $lost as  $table => $ids )
		{
			DB::delete($this->table_name())
				->where('related_id', 'in', $ids)
				->where('related_table', '=', $table)
				->execute();
		}
	}

}