<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_Bookmarks extends Controller_System_Page {

	public function action_index()
	{
		$adverts = ORM::factory( 'advert' )
			->with_bookmarks()
			->select(array('map.title', 'city'))
			->with_city()
			->with_part()
			->find_all();

		$this->template->content->total_bookmarks = count($adverts);
		$this->template->content->adverts = $adverts;
	}
}