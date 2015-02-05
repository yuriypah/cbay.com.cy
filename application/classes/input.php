<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

/**
 * Input class.
 *
 * @package    Input
 * 
 * @author     ButscH
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt    LGPL
 */
class Input {

	/**
	 * Fetch an item from the $_POST array.
	 *
	 * @param   string   key to find
	 * @param   mixed    default value
	 * @param   boolean  XSS clean the value
	 * @return  mixed
	 */
	public static function post( $key = '', $default = NULL )
	{
		return self::search_array( $_POST, $key, $default );
	}

	/**
	 * Fetch an item from the $_GET array.
	 *
	 * @param   string   key to find
	 * @param   mixed    default value
	 * @param   boolean  XSS clean the value
	 * @return  mixed
	 */
	public static function get( $key = '', $default = NULL )
	{
		return self::search_array( $_GET, $key, $default );
	}

	/**
	 * Fetch an item from the $_FILE array.
	 *
	 * @param   string   key to find
	 * @param   mixed    default value
	 * @param   boolean  XSS clean the value
	 * @return  mixed
	 */
	public static function file( $key = '', $default = NULL )
	{
		return self::search_array( $_FILES, $key, $default );
	}

	/**
	 * Fetch an item from the $_SERVER array.
	 *
	 * @param   string   key to find
	 * @param   mixed    default value
	 * @param   boolean  XSS clean the value
	 * @return  mixed
	 */
	public static function server( $key = '', $default = NULL )
	{
		return self::search_array( $_SERVER, $key, $default );
	}

	/**
	 * Fetch an item from a global array.
	 *
	 * @param   array    array to search
	 * @param   string   key to find
	 * @param   mixed    default value
	 * @param   boolean  XSS clean the value
	 * @return  mixed
	 */
	public static function search_array( $array = array(), $key = '', $default = NULL )
	{
		if ( empty( $key ) )
		{
			return $array;
		}

		if ( substr_count( $key, '.' ) > 0 )
		{
			$value = Arr::path( $array, $key, $default );
		}
		else
		{
			$value = Arr::get( $array, $key, $default );
		}

		return $value;
	}

}