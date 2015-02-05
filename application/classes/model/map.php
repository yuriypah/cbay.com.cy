<?php defined('SYSPATH') or die('No direct script access.');

class Model_Map extends ORM {
	
	protected $_table_name = 'map';
	
	protected $_reload_on_wakeup = FALSE;

	public static $cities = array();
	public static $cities_data = array();
	public static $current_city = NULL;

	
	public function key()
	{
		return URL::title($this->title, '_');
	}
	
	public function name()
	{
		$key = $this->key();
		return __( 'map.city.' . $key );
	}
	
	public function icon()
	{
		return HTML::image('resources/images/land/' . $this->key() . '.png');
	}
	
	public function __toString()
	{
		return $this->name();
	}

	public static function init()
	{
		$map = DB::select()
			->from('map')
			->as_object('Model_Map')
			->cached()
			->execute();
		
		foreach ( $map as $item )
		{
			self::$cities[$item->id] = $item;
		}
	}
	
	public static function set_current_position($id = NULL)
	{
		self::$current_city = Cookie::get('current_city');
		
		$id = Arr::get($_GET, 'l');
		
		if($id === NULL)
		{
			return;
		}

		if(self::check_by_id( $id ))
		{
			self::$current_city = $id;
			Cookie::set('current_city', self::$current_city);
		}
		else
		{
			self::$current_city = NULL;
			Cookie::delete('current_city');
		}
	}
	
	public static function get_current_position()
	{
		return Arr::get(self::$cities, self::$current_city);
	}
	

	public static function check_by_id($id)
	{	
		return isset(self::$cities[$id]);
	}
}