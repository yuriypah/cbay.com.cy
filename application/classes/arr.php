<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Arr extends Kohana_Arr {

	protected static $_russian_letters = array(
		'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н',
		'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь',
		'Э', 'Ю', 'Я'
	);

	public static function letters( $type = array('all', '09', 'A-Z', 'А-Я') )
	{
		$array = array();
		
		if ( in_array( 'all', $type ) )
		{
			$array['all'] = 'Все';
		}

		if ( in_array( 'A-Z', $type ) )
		{
			foreach ( range( 'A', 'Z' ) as $char )
			{
				$array['eng'][$char] = $char;
			}
		}

		if ( in_array( 'А-Я', $type ) )
		{
			foreach ( self::$_russian_letters as $char )
			{
				$array['rus'][$char] = $char;
			}
		}
		elseif ( in_array( 'АЯ', $type ) )
		{
			$array['rus'] = 'А-Я';
		}

		if ( in_array( '0-9', $type ) )
		{
			foreach ( range( 1, 9 ) as $char )
			{
				$array['num'][$char] = $char;
			}
		} else if ( in_array( '09', $type ) )
		{
			foreach ( range( 1, 9 ) as $char )
			{
				$array['num'] = '0-9';
			}
		}

		return $array;
	}
}