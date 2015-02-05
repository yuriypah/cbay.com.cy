<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_Ajax_Map extends Controller_Ajax_JSON {
	
	public function action_get_countries()
	{
		$id = Input::post('id');
		$data = Geo::get_countries();
		
		$this->json['status'] = TRUE;
		$this->json['html'] = View::factory('map/select', array(
			'selected_id' => $id,
			'data' => $data,
			'title' => __('Select country')
		))->render();
	}
	
	public function action_get_regions()
	{
		$id = Input::post('id');
		$parent_id = Input::post('parent_id');
		$data = Geo::get_regions(/*$parent_id*/);
		
		$this->json['status'] = TRUE;
		$this->json['html'] = View::factory('map/select', array(
			'selected_id' => $id,
			'data' => $data,
			'title' => __('Select region')
		))->render();
	}
	
	public function action_get_cities()
	{
		$id = Input::post('id');
		$parent_id = Input::post('parent_id');
		$data = Geo::get_cities($parent_id);
		
		$this->json['status'] = TRUE;
		$this->json['html'] = View::factory('map/select', array(
			'selected_id' => $id,
			'data' => $data,
			'title' => __('Select city')
		))->render();
	}
}