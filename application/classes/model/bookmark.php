<?php defined('SYSPATH') or die('No direct script access.');

class Model_Bookmark extends ORM {
	
	protected $_created_column = array(
		'column' => 'created',
		'format' => 'Y-m-d H:i:s'
	);
	
	protected $_sorting = array('created' => 'desc');
	
	public function rules()
	{
		return array(
			'user_id' => array(
				array('not_empty'),
			),
			'related_id' => array(
				array('not_empty'),
			),
			'related_table' => array(
				array('not_empty'),
			),
		);
	}
	
	public function filters()
	{
		return array(
			'user_id' => array(
				array('intval'),
			),
			'related_id' => array(
				array('intval'),
			)
		);
	}
	
	public function is_bookmark($object, $user_id)
	{
		if(!$object->loaded())
		{
			return NULL;
		}

		return DB::select()
			->from($this->table_name())
			->where('user_id', '=', (int) $user_id)
			->where('related_table', '=', $object->table_name())
			->where('related_id', '=', $object->pk())
			->limit(1)
			->execute($this->_db)
			->get('related_id');
	}
	
	public function get_by_array_ids(array $ids, $object, $user_id)
	{
		if(count( $ids == 0 ))
		{
			return NULL;
		}

		return DB::select()
			->from($this->table_name())
			->where('user_id', '=', (int) $user_id)
			->where('related_table', '=', $object->table_name())
			->where('related_id', 'in', $ids)
			->as_object()
			->execute($this->_db);
	}

	public function add_object(ORM $object, $user_id)
	{		
		// Если запись в закладках, удаляем ее
		if($this->is_bookmark( $object, $user_id ))
		{
			return $this->delete_object($object, $user_id);
		}

		try 
		{
			$this->user_id = (int) $user_id;
			$this->related_table = $object->table_name();
			$this->related_id = $object->pk();
			$this->create();
			
			return array(TRUE, __('Object :object: :id added to bookmark', array(
				':object' => $object->object_name(),
				':id' => $object->pk()
			)));
		} 
		catch (ORM_Validation_Exception $e)
		{
			return array(NULL, $e->errors('validation'));
		}
		
		return array(NULL, NULL);
	}
	
	public function delete_object(ORM $object, $user_id = NULL)
	{		
		$query = DB::delete($this->table_name())
			->where('related_table', '=', $object->table_name())
			->where('related_id', '=', $object->pk());
		
		if($user_id !== NULL)
		{
			$query->where('user_id', '=', (int) $user_id);
		}
		
		$query->execute($this->_db);
		
		return array(FALSE, __('Object :object: :id delete from bookmark', array(
			':object' => $object->object_name(),
			':id' => $object->pk()
		)));
	}
}