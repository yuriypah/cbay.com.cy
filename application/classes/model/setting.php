<?php defined( 'SYSPATH' ) or die( 'No direct access allowed.' );

class Model_Setting {

	protected static $_settings = array();

	public static function init()
	{
		self::$_settings = DB::select('name', 'value')
				->from( 'settings' )
				->as_object()
				->cached( 3600, FALSE, 'settings_init' )
				->execute()
				->as_array('name', 'value');
	}

	/**
	 * Get the value of a setting
	 *
	 * @param name  string  The setting name
	 * @return string the value of the setting name
	 */
	public static function get( $name, $default = NULL )
	{
		return Arr::get( self::$_settings, $name, $default );
	}

	public static function save_from_array( array $array )
	{
		foreach ( $array as $key => $value )
		{
			if ( isset( self::$_settings[$key] ) )
			{
				DB::update( 'settings' )
					->set( array('value' => $value) )
					->where( 'name', '=', $key )
					->execute();
			}
			else
			{
				DB::insert( 'settings' )
					->columns( array('name', 'value') )
					->values( array($key, $value) )
					->execute();
			}
		}

		Kohana::cache( 'settings_init', NULL, -1 );
	}
}