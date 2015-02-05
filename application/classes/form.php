<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Form extends Kohana_Form {
	
	public static function button($name, $body, array $attributes = NULL)
	{
		// Set the input name
		$attributes['name'] = $name;
		
		if(!isset($attributes['class']))
			$attributes['class'] = 'btn btn-large';
		
		if(isset($attributes['icon']))
			$body = $attributes['icon'].' '.$body;

		return '<button'.HTML::attributes($attributes).'>'.$body.'</button>';
	}	
	
	public static function date($name, $value = NULL, array $attributes = NULL)
	{
		$attributes['type'] = 'date';

		return Form::input($name, $value, $attributes);
	}
	
	public static function error($field, array $array, $default = NULL)
	{
		$error = Arr::path($array, $field, $default);

		if($error)
		{
			return '<span class="help-inline">' . $error . '</span>';
		}
		
		return $error;
	}

	public static function locales($default = NULL, $name = 'language')
	{
		if($default === NULL)
		{
			$default = I18n::lang();
		}
		
		if(Auth::instance()->logged_in())
		{
			$default = Auth::instance()->get_user()->profile->default_locale;
		}

		$locales = Model_Lang_Part::$languages;
		
		if(count($locales) == 1)
		{
			$locales = array_keys($locales);
			return Form::hidden ( $name, $locales[0], array('id' => $name));
		}

		return Form::select($name, $locales, $default, array('id' => $name));
	}
}