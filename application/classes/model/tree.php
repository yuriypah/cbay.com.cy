<?php defined('SYSPATH') or die('No direct script access.');

class Model_Tree {

	protected $_data = array();
	protected $_tree = array();
	protected $_temp = array();
	
	// Cache lifetime
	protected $_cache_key = 'tree';
	protected $_lifetime = NULL;
	
	protected $_flatten = FALSE;
	
	protected static $_types = array(
		'parent_id'
	);

	/**
	 * @return Model_Tree 
	 */
	public static function factory($data = array())
	{
		return new self($data);
	}

	public function __construct($data) 
	{
		$this->_data = $data;
	}
	
	public function set_data($data)
	{
		$this->_data = $data;
		return $this;
	}
	
	public function cached($lifetime = NULL, $key = NULL)
	{
		if ($lifetime === NULL)
		{
			// Use the global setting
			$lifetime = Kohana::$cache_life;
		}
		
		if ($key !== NULL)
		{
			$this->_cache_key = $key;
		}

		$this->_lifetime = $lifetime;

		return $this;
	}
	
	public function flatten()
	{
		$this->_flatten = TRUE;
		$this->_cache_key .= '_flatten';

		return $this;
	}

	public function execute() 
	{
		if ($this->_lifetime !== NULL AND Kohana::$caching === TRUE)
		{
			// Set the cache key based on the database instance name and SQL
			$cache_key = 'Tree("'.$this->_cache_key.'")';

			// Read the cache first to delete a possible hit with lifetime <= 0
			if (($result = Kohana::cache($cache_key, NULL, $this->_lifetime)) !== NULL)
			{
				$this->_tree = $result;
				return $result;
			}
		}
		
		$this->_init();
	
		$result = new Model_Tree_Result($this->_tree, $this->_temp);

		if (isset($cache_key) AND $this->_lifetime > 0)
		{
			// Cache the result array
			Kohana::cache($cache_key, $result, $this->_lifetime);
		}

		return $result;
	}

	protected function _init()
	{
		if (Kohana::$profiling === TRUE)
		{
			$benchmark = Profiler::start('Tree', __FUNCTION__);
		}

		foreach ($this->_data as $row) 
		{
			$this->_add_row($row->parent_id, $row->id, $row);
		}

		$this->_tree = $this->_recurse($this->_temp, 0);

		if (isset($benchmark)) 
		{
			Profiler::stop($benchmark);
		}

		return $this;
	}
	
//	protected function _init()
//	{
//		if (Kohana::$profiling === TRUE)
//		{
//			$benchmark = Profiler::start('Tree', __FUNCTION__);
//		}
//		
//		foreach ($this->_data as $row)
//		{
//			$this->_temp[$row->parent_id][$row->id] = $row;
//		}
//
//		$this->_tree = $this->_recurse($this->_temp, $this->_temp);
//		
//		echo debug::vars($this->_tree);
//
//		if (isset($benchmark)) 
//		{
//			Profiler::stop($benchmark);
//		}
//
//		return $this;
//	}
//
//
//	protected function _recurse(&$list, $parent, $level = 1)
//	{
//		$tree = array();
//		foreach ($parent as $id => $l)
//		{
//			$object = NULL;
//			
//			echo $id;
//
//			if(isset($list[$id]))
//			{
//				$object = new Model_Tree_Item($id);
//
//				$object
//					->set_level($level)
//					->set_data($l)
//					->set_parent($parent)
//					->set_children($this->_recurse($list, $list[$id], $level++));
//			}
//
//			$tree[$id] = $object;
//		} 
//		return $tree;
//	}
	
	protected function _add_row($parent_id, $id, $data)
	{
		$parent_object = NULL;
		$level = 1;

		if(isset($this->_temp[$parent_id]))
		{
			$parent_object = new Model_Tree_Item($parent_id);
			$parent_object
				->set_level($this->_temp[$parent_id]['level'])
				->set_data($this->_temp[$parent_id]['data']);

			$level = $parent_object->level + 1;
		}		

		$this->_temp[$id] = array(
			'parent' => $parent_object,
			'parent_id' => $parent_id,
			'level' => $level,
			'data' => $data
		);
		
		return $this;
	}
	protected function _recurse($tree, $pid)
	{
		$return = array();

		foreach($tree as $id => $data)
		{
			if($data['parent_id'] == $pid) 
			{
				unset($tree[$id]);
				
				$leaf = new Model_Tree_Item($id);
				$children = $this->_recurse($tree, $id);
				
				$leaf
					->set_level($data['level'])
					->set_data($data['data'])
					->set_parent($data['parent']);

				if($this->_flatten === TRUE)
				{
					$leaf->set_children($children);
	
					if($children)
					{
						$return = Arr::merge($return, $children);
					}
				}
				else
				{
					$leaf->set_children($children);
				}
				
				$return[$id] = $leaf;
				
			}
		}

		return empty($return) ? NULL : $return;
	}
}