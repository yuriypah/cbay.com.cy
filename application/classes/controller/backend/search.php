<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_Backend_Search extends Controller_System_Backend {

	public function action_index()
	{
		$total_adverts = DB::select(array('COUNT("*")', 'total'))
			->from('advert_index')
			->execute()
			->get('total', 0);
		
		$adverts = DB::select('*')
			->from('advert_index')
			->join( 'adverts' , 'left')
				->on('advert_index.advert_id', '=', 'adverts.id')
			->as_object()
			->execute();
			
		$this->template->content->total_adverts = $total_adverts;
		$this->template->content->adverts = $adverts;
	}
	
	public function action_indexer()
	{
		$adverts = ORM::factory('advert')->find_all_by_filter();

		$indexer = Model_Search_Indexer::instance();

		foreach ( $adverts[0] as $advert )
		{
			$title = $content = array();
			foreach ($advert->parts->find_all() as $part)
			{
				$content[] = $part->description;
				$title[] = $part->title;
			}

			$indexer->add($advert->id, $title, $content, $title);
		}
		
		$this->go_back();
	}
}