<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Model_Advert_Category_Option extends ORM {
	
	public $_values = array();
	
	protected $_has_many = array(
		'categories' => array( 
			'model' => 'advert_category', 
			'foreign_key' => 'option_id',
			'through' => 'advert_categories_options'
		),
		'values' => array(
			'model' => 'advert_category_option_value',
			'foreign_key' => 'option_id'
		)
	);

	public static function get_all()
	{
		$locale = I18n::lang();
		$object = new Model_Advert_Category_Option;
		return DB::select(array($object->table_name() . '.id', 'option_id'))
			->select(array($object->table_name() . '.parent_id', 'option_parent_id'))
			->from($object->table_name())
			->order_by('option_id', 'asc')
			->order_by('id', 'asc')
			->select(array('lo.title', 'title'),array('lo.description', 'description'))
			->join(array('lang_parts', 'lo'), 'left')
				->on('lo.related_table', '=', DB::expr("'".$object->table_name()."'"))
				->on('lo.related_id', '=', $object->table_name() . '.id')
				->on('lo.locale', '=', DB::expr("'$locale'"))
			->select(array('advert_category_option_values.id', 'id'), array('advert_category_option_values.option_id', 'parent_id'))
			->join('advert_category_option_values', 'right')
				->on('advert_category_option_values.option_id', '=', $object->table_name() . '.id')
			->select(array('lv.title', 'value_title'))
			->join(array('lang_parts', 'lv'), 'left')
				->on('lv.related_table', '=', DB::expr("'advert_category_option_values'"))
				->on('lv.related_id', '=', 'advert_category_option_values.id')
				->on('lv.locale', '=', DB::expr("'$locale'"));
	}

	public function categories()
	{
		return $this
			->categories
			->find_all()
			->as_array(NULL, 'id');
	}
	
	public function parents()
	{
		$options = self::get_all();
		if($this->loaded())
		{
			$options->where($this->table_name() . '.id', '!=', $this->id);
		}
		
		$options = $options->as_object()
			->execute();

		$array = array('---------');

		foreach ($options as $option)
		{
			$array[$option->title . " / " . $option->description][$option->id] = $option->value_title;
		}
		
		return $array;
	}
}