<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_Ajax_category extends Controller_Ajax_JSON {

	//public $auth_required = array('admin');

	public function action_get_list()
	{
		$lang = Input::post( 'lang' );

		$categories = ORM::factory( 'category' )
				->where( 'language', '=', $lang )
				->order_by( 'category_id', "DESC" )
				->order_by( 'title', 'DESC' )
				->cached()
				->find_all();
		$out = array(array('id' => 0, 'name' => 'Первый уровень'));
		foreach ( $categories as $category )
		{
			$out[$category->id] = array(
				'id' => $category->id,
				'name' => $category->title,
			);
		}
		$this->json = $out;
	}

}