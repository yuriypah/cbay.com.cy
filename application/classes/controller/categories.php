<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_Categories extends Controller_System_Page {

	public function action_index()
	{
		$categories = ORM::factory( 'advert_category' )
			->tree()
			->get();

		$this->template->content->categories = $categories;
	}
}