<?php defined('SYSPATH') or die('No direct script access.');

class Model_Package_Option_Abstract  {
	
	protected $_id;
	protected $_type_id;
	protected $_amount = 0;
	protected $_duration = 0;
	
	public $created;
	public $finished;

	public $column = 'abstract';

	public function __construct($id, $duration, $amount = 0 )
	{
		$this->_id = (int) $id;
		
		$this->_amount = (float) $amount;
		$this->_duration = (int) $duration * Date::DAY;
		
		$this->created = $this->finished = date('Y-m-d H:i:s');
	}
	
	public function set( $name, $value )
	{
		if(in_array($name, array('created', 'finished')))
		{
			$this->{$name} = strtotime($value);
		}
		
		return $this;
	}

	public function id()
	{
		return $this->_id;
	}
	
	public function name()
	{
		return __('package.option.title.' . $this->column);
	}

	public function duration($hours = FALSE)
	{
		return $hours === FALSE ? $this->_duration : $this->_duration / Date::DAY;
	}
	
	public function time_left()
	{
		return (int) (($this->finished - time()) / Date::DAY) ;
	}
	
	public function total_time()
	{
		return (int) (($this->finished - time()) - ($this->created - time())) / Date::DAY ;
	}

	public function amount()
	{
		return $this->_amount;
	}
	
	public function payment_type()
	{
		return $this->_type_id;
	}
}