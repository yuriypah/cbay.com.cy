<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

// Autoloading for Less
require Kohana::find_file( 'vendor/less', 'lessc.inc' );

// Компилируем less файл в css
if(Model_Setting::get( 'less_enable', 'off') == 'on')
{
	try
	{
		$files = array('common', 'backend', 'login');
		
		foreach ( $files as $file_name )
		{
			$less_file = DOCROOT.'resources'.DIRECTORY_SEPARATOR.'less'.DIRECTORY_SEPARATOR.$file_name.'.less';
			$css_file = DOCROOT.'resources'.DIRECTORY_SEPARATOR.'css'.DIRECTORY_SEPARATOR.$file_name.'.css';
			
			if(!file_exists($less_file))
				continue;

			if(!file_exists($css_file))
			{
				$handle = fopen($css_file, 'w');
				fwrite($handle, '');
				fclose($handle);
			}

			$params = array(
				'newlineChar' => '',
				'indentChar' => '',
			);

			if(Kohana::$profiling === TRUE)
			{
				$benchmark = Profiler::start('Compile less files', 'resources/less/'.$file_name.'.less');
			}

			lessc::ccompile( $less_file , $css_file, $params);

			if(isset($benchmark))
			{
				Profiler::stop($benchmark);
			}
		}
	}
	catch ( Exception $e ) 
	{
		throw new Exception($e);
	}
}