<?php defined('SYSPATH') or die('No direct script access.');

class Valid extends Kohana_Valid {
	
	/**
	 * Checks if a phone number is valid.
	 *
	 * @param   string   phone number to check
	 * @return  boolean
	 */
	public static function phone($number, $lengths = NULL)
	{
		// Remove all non-digit characters from the number
		$number = preg_replace('/\D+/', '', $number);
		
		if($lengths === NULL)
		{
			$lengths = array(7,10,11);			
		}
		else if ( ! is_array($lengths) )
		{
			return Valid::min_length($number, (int) $lengths);
		}

		// Check if the number is within range
		return in_array(strlen($number), $lengths);
	}
}
