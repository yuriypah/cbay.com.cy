<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_Form_Options extends Controller_System_Form {

	public function action_save()
	{
		$data = $this->request->post('option');

		$id = Arr::get($data, 'id');
		
		$option = ORM::factory( 'advert_category_option', (int) $id );
		
		$new = TRUE;
		if ( $option->loaded() )
		{
			$new = FALSE;
		}
		
		try
		{
			return $this->_save($option, $data, $new);
		}
		catch ( ORM_Validation_Exception $e )
		{
			$this->json['validation'] = $e->errors( 'validation' );
			Database::instance()->rollback();
		}
	}
	
	protected function _save($option, $data, $new)
	{
		$categories = Arr::get($data, 'category_id', array());
		
		if(isset($data['parent_id']) && $data['parent_id'] == 0)
		{
			$data['parent_id'] = NULL;
		}
        if(!$data['ranged'])
        {
            $data['ranged'] = 0;
        }

		Database::instance()->begin();
		$option
			->values( $data )
			->save();
		
		$option->update_related_ids('categories', $categories);

		foreach (Input::post('lang_part', array()) as $locale => $content)
		{
			ORM::factory('lang_part')->add_item($option, $content, $locale);
		}
		
		$values = $this->request->post('values');
		if(!$new AND is_array($values))
		{
			foreach ($values as $id => $title) 
			{
				$value = ORM::factory('advert_category_option_value', $id);
				if($value->loaded())
				{
					ORM::factory('lang_part')->add_item($value, array('title' => $title));
				}
			}
		}
		elseif(is_array($values))
		{
			foreach ($values as $i => $title) 
			{
				$value = ORM::factory('advert_category_option_value');
				$value->option_id = $option->id;
				$value->create();
				ORM::factory('lang_part')->add_item($value, array('title' => $title));
			}
		}

		if ( $new === TRUE )
		{
			Observer::notify( 'option_add', $option );
			$this->json['redirect'] = '/backend/options/edit/' . $option->id;
		}
		else
		{				
			Observer::notify( 'option_update', $option );
		}

		$this->json['data'] = $option->as_array();
		$this->json['status'] = TRUE;

		Database::instance()->commit();
	}
}