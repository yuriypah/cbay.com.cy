<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_Form_Category extends Controller_System_Form {

	public function action_save()
	{
		$category_post = Input::post( 'category' );
		$packages = Input::post( 'packages', array() );

		$category = ORM::factory( 'advert_category', (int) $category_post['id'] );

		$new = TRUE;
		if ( $category->loaded() )
		{
			$new = FALSE;
		}

		try
		{
			if(isset($category_post['parent_id']))
			{
				$parent = ORM::factory('advert_category', (int) $category_post['parent_id']);
				if(!$parent->loaded())
				{
					unset($category_post['parent_id']);
				}
			}

			Database::instance()->begin();
			$category
				->values( $category_post )
				->save();

			foreach (Input::post('lang_part', array()) as $locale => $data)
			{
				ORM::factory('lang_part')->add_item($category, $data, $locale);
			}

			if ( $new === TRUE )
			{
				Observer::notify( 'category_add', $category );
				$this->json['redirect'] = '/backend/categories/edit/' . $category->id;
			}
			else
			{				
				Observer::notify( 'category_update', $category );
			}

			$this->json['data'] = $category->as_array();
			$this->json['status'] = TRUE;
			
			Database::instance()->commit();
		}
		catch ( ORM_Validation_Exception $e )
		{
			$this->json['validation'] = $e->errors( 'validation' );
			Database::instance()->rollback();
		}
	}

}
