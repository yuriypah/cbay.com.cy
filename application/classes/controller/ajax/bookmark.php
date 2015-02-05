<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_Ajax_Bookmark extends Controller_Ajax_JSON {

	public function action_set()
	{
		$object_id = (int) Input::post( 'object_id' );
		$object_name = Input::post( 'object_name' );

		$bookmark = new Model_Bookmark_Cookie;
		$favourite = $bookmark->add_object($object_name, $object_id);
		
		$this->json['bookmark_status'] = $favourite[0];
		$this->json['status'] = TRUE;
		$this->json['message'] = $favourite[1];
	}
	
	public function action_delete()
	{
		$ids = (array) Input::post( 'ids', array() );
		$object_name = Input::post( 'object_name' );
		
		$bookmark = new Model_Bookmark_Cookie;
		
		foreach ($ids as $id)
		{
			$bookmark->add_object($object_name, $id);
		}
		
		$this->json['status'] = TRUE;
	}

}