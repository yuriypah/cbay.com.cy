<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class URL extends Kohana_URL {

	public static function math( $uri, $current = NULL )
	{
		$uri = trim( $uri, '/' );

		if ( $current === NULL AND Request::current() )
		{
			$current = Request::current()->uri();
		}

		$current = trim( $current, '/' );

		if ( $current == $uri )
		{
			return TRUE;
		}

		if ( strpos( $current, $uri ) === 0 )
		{
			return TRUE;
		}

		return FALSE;
	}
}