<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_Form_Values extends Controller_System_Form {

	public function action_add()
	{
		$option_id = (int) $this->request->param('id');
		
		$option = ORM::factory('advert_category_option', $option_id);
		$value = ORM::factory('advert_category_option_value');

		if($option->loaded())
		{
			$value->option_id = $option->id;
			$value->create();
		}

		echo View::factory('backend/options/value', array(
			'value' => $value
		));
	}
	
	public function action_delete()
	{
		$id = (int) $this->request->param('id');
		$value = ORM::factory('advert_category_option_value', $id);
		if($value->loaded())
		{
			$value->delete();
			$this->json['status'] = TRUE;
		}
	}
	
}