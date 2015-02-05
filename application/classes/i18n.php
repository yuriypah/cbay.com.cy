<?php defined( 'SYSPATH' ) OR die( 'No direct access allowed.' );

class I18n extends I18n_Core {
    public static $localVars = [];
	public static function set_current_lang($lang = NULL)
	{
		if($lang === NULL)
		{
			if(Auth::instance()->logged_in())
			{
				$lang = Auth::instance()->get_user()->profile->default_locale;
			}
			else
			{
				$lang = Input::get('lang');
			}
		}

		if($lang !== NULL AND in_array($lang, array_keys(Model_Lang_Part::$languages)))
		{
			Cookie::set('lang', $lang);
                        I18n::lang(strip_tags($lang));
		}
                else
                    I18n::lang( Cookie::get('lang', Kohana::$config->load('global')->default_locale));
	}
}