<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Model_Advert_Image extends ORM {
	
	public function image($folder = '102_80')
	{
		return RESURL . MEDIA.'/' . $folder . '/' . $this->image;
	}
	
	public function exists($folder = '102_80')
	{
		return file_exists(RESPATH . MEDIA . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $this->image);
	}

	public function add_related_images(Model_Advert $object, $images)
	{
		$params = $object->images();
		
		DB::delete($this->table_name())
			->where('advert_id', '=', $object->pk())
			->execute($this->_db);
		
		$insert = DB::insert($this->table_name())
			->columns(array('advert_id', 'image'));
		
		$i = 0;
		foreach( $images as $image )
		{
			$filename = $this->add_images($image, NULL, $params);
			
			if($filename !== NULL)
			{
				$insert->values(array(
					'advert_id' => $object->pk(), 
					'image' => $filename
				));
				
				$i++;
			}
		}
		
		if($i > 0) $insert->execute($this->_db);
	}
	
	public function delete_all($advert)
	{
		if( ! ($advert instanceof Model_Advert) )
		{
			throw new Kohana_Exception('Needs Advert object');
		}
		
		$images = $advert->images->find_all();
		
		foreach($images as $image)
		{
			$image->delete();
		}
	}
	
	public function delete()
	{
		if( ! $this->loaded() ) return;

		$paths = ORM::factory( 'advert' )->images();
		
		foreach ($paths as $path => $data)
		{
			$file = DOCROOT . $path . $this->image;
			if( file_exists( $file ) AND !is_dir( $file ))
			{
				unlink($file);
			}
		}
		
		DB::delete($this->table_name())
			->where('image', '=', $this->image)
			->execute($this->_db);
	}
}