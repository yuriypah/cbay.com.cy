<?php defined('SYSPATH') OR die('No direct access allowed.');

class Kses {

	public static function filter($string, $allowed_html = array(), $allowed_protocols = array('http', 'https', 'ftp', 'mailto'))
	{
		return kses($string, $allowed_html, $allowed_protocols);
	}
}