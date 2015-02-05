<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Date extends Kohana_Date {
	
	// TODO: перевести названия месяцев
	protected static $_replace_monts = array(
		"января"		=> "Январь",
		"февраля"		=> "Февраль",
		"марта"			=> "Март",
		"апреля"		=> "Апрель",
		"мая"			=> "Май",
		"июня"			=> "Июнь",
		"июля"			=> "Июль",
		"августа"		=> "Август",
		"сентября"		=> "Сентябрь",
		"октября"		=> "Октябрь",
		"ноября"		=> "Ноябрь",
		"декабря"		=> "Декабрь",
	);
	
	protected static $_replace = array (
		"January"		=> "января",
		"February"		=> "февраля",
		"March"			=> "марта",
		"April"			=> "апреля",
		"May"			=> "мая",
		"June"			=> "июня",
		"July"			=> "июля",
		"August"		=> "августа",
		"September"		=> "сентября",
		"October"		=> "октября",
		"November"		=> "ноября",
		"December"		=> "декабря",	

		"Sunday"		=> "воскресенье",
		"Monday"		=> "понедельник",
		"Tuesday"		=> "вторник",
		"Wednesday"		=> "среда",
		"Thursday"		=> "четверг",
		"Friday"		=> "пятница",
		"Saturday"		=> "суббота",

		"Sun"			=> "воскресенье",
		"Mon"			=> "понедельник",
		"Tue"			=> "вторник",
		"Wed"			=> "среда",
		"Thu"			=> "четверг",
		"Fri"			=> "пятница",
		"Sat"			=> "суббота",

		"th"			=> "",
		"st"			=> "",
		"nd"			=> "",
		"rd"			=> ""
	);
	
	public static function format($date = NULL, $format = 'd F Y', $decl = FALSE)
	{
		if(  is_string( $date ))
		{
			$date = strtotime($date);
		}
		
		$date = date($format, $date);
		$date = strtr($date, self::$_replace);
		
		if($decl)
		{
			$date = strtr($date, self::$_replace_monts);
		}

		return $date;
	}

	public static function range( $date_from, $date_to = NULL )
	{
		$range = array();

		$date_from = strtotime( $date_from );

		if ( $date_to === NULL )
		{
			$date_to = time();
		}
		else
		{
			$date_to = strtotime( $date_to );
		}

		if ( $date_to >= $date_from )
		{
			array_push( $range, $date_from ); // first entry

			while ( $date_from < $date_to ) 
			{
				$date_from += 86400; // add 24 hours
				array_push( $range, $date_from );
			}
		}
		return $range;
	}

}