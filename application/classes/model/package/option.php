<?php defined('SYSPATH') or die('No direct script access.');

class Model_Package_Option {
	
	const TYPE_SHOW		= 1;
	const TYPE_VIP		= 2;
	const TYPE_SELECTED	= 3;
	const TYPE_TOP		= 4;
	const TYPE_PREMIUM	= 5;
	
	public static $types = array(
		self::TYPE_SHOW		=> 'Show',
		self::TYPE_VIP		=> 'VIP',
		self::TYPE_SELECTED	=> 'Pick Up',
		self::TYPE_TOP		=> 'Top',
		self::TYPE_PREMIUM	=> 'Premium',
	);
	
	public $_object_name = 'package_option';
	public $_primary_key = 'option_id';


	protected static $_options = array();

	public static function add(Model_Package_Option_Abstract $option)
	{
		self::$_options[$option->id()] = $option;
	}
	
	public static function get_all()
	{
		return self::$_options;
	}
	
	public static function exists_option($id)
	{
		return isset(self::$_options[$id]);
	}

	public static function get($id)
	{
		return self::exists_option($id) ? self::$_options[$id] : NULL;
	}
}