<?php defined('SYSPATH') or die('No direct script access.');

class Model_Package {
	
	public static $packages = array();
	public static $options = array();

	protected $_options = array();
	protected $_discount = 0;
	protected $_amount = 0;
	
	public static function init()
	{
		$options_array = Kohana::$config->load('packages');
		foreach ($options_array as $name => $options)
		{
			self::$packages[$name] = new Model_Package($options);
		}
	}

	public function __construct(array $options = array(), $discount = 0)
	{
		foreach ( $options as $option )
		{
			$this->add_option($option);
		}
		
		$this->set_discount($discount);
	}

	public function add_option(Model_Package_Option_Abstract $option)
	{
		if(Model_Package_Option::exists_option( $option->id() ))
		{
			throw new Exception(__('Option with ID: :id exists', array(':id' => $option->id() )));
		}

		$this->_options[$option->id()] = $option;
		
		Model_Package_Option::add($option);

		return $this->calculate_amount();
	}
	
	public function set_discount($amount)
	{
		if($amount > 1)
		{
			$amount = $amount / 100;
		}

		$this->_discount = (float) $amount;
	}

	public function discount() 
	{
		return $this->_discount;
	}


	public function calculate_amount()
	{
		$amount = 0;
		foreach ($this->_options as $opt)
		{	
			$amount += $opt->amount();
		}

		$this->_amount = $amount - ( $amount * ( $this->discount() / 100 ) );
		
		return $this;
	}
	
	public function amount()
	{
		return $this->_amount;
	}

	public function get_options()
	{
		return $this->_options;
	}
}