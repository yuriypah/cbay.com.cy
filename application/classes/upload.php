<?php defined('SYSPATH') or die('No direct script access.');

class Upload extends Kohana_Upload {
	
	public static function file( $file, array $types = array('jpg', 'gif', 'png') )
	{
		$validation = Validation::factory( array('file' => $file ) )
			->rules( 'file', array(
				array('Upload::valid'),
				array('Upload::type', array(':value', $types)),
				array('Upload::size', array(':value', 100000000))
			) );

		if ( !$validation->check() )
		{
			return array(FALSE, $validation->errors());
		}

		$ext = strtolower( pathinfo( $file['name'], PATHINFO_EXTENSION ) );
		$filename = uniqid() . '.' . $ext;
		
		$path = DOCROOT . 'resources' . DIRECTORY_SEPARATOR .'temp' . DIRECTORY_SEPARATOR;
		
		if( ! is_dir( $path ))
		{
			mkdir($path, 0777);
			chmod($path, 0777);
		}

		$uploadedfile = Upload::save( $file, $filename, $path, 0777 );
		
		if(in_array( $ext, array('jpg', 'gif', 'png') ))
		{
			// TODO: перенести настройки в максимального размера в конфиг
			Image::factory( $uploadedfile )
				->resize( 1024, 1024 )
				->save( NULL, 85 );
		}

		return array(TRUE, $filename);
	}
	
//	public static function ( $file, array $types = array('jpg', 'gif', 'png') )
//	{
//		if ( empty( $file['name'] ) )
//		{
//			foreach ( $fields as $path => $params )
//			{
//				unset($path);
//				$model->{$params['field']} = NULL;
//			}
//
//			return $model->update();
//		}
//
//		$extra = Validation::factory( array('image' => $file) )
//			->rules( 'image', array(
//				array('Upload::valid'),
//				array('Upload::type', array(':value', $types)),
//				array('Upload::size', array(':value', 1000000))
//			) );
//
//		if ( !$extra->check() )
//		{
//			throw new ORM_Validation_Exception( $model->validation(), $extra );
//		}
//
//		$ext = strtolower( pathinfo( $file['name'], PATHINFO_EXTENSION ) );
//		$filename = uniqid() . '.' . $ext;
//
//		$uploadedfile = Upload::save( $file, $filename, DOCROOT . 'resources/demp/', 0777 );
//
//		foreach ( $fields as $path => $params )
//		{
//			$local_params = array(
//				'width' => NULL,
//				'height' => NULL,
//				'master' => NULL,
//				'quality' => 95,
//				'resize' => TRUE
//			);
//
//			$params = Arr::merge( $local_params, $params );
//
//			$file = $path . $filename;
//
//			Image::factory( $uploadedfile )
//				->resize( $params['width'], $params['height'], $params['master'] )
//				->crop( $params['width'], $params['height'] )
//				->save();
//
//			if ( $model->{$params['field']} !== NULL )
//			{
//				unset($model->{$params['field']});
//			}
//			
//			$model->{$params['field']} = $file;
//		}
//
//		unlink( $uploadedfile );
//
//		return $model->update();
//	}
}
