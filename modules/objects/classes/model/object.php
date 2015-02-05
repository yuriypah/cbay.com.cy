<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Model_Object {
	
	/**
	 *
	 * @var string 
	 */
	protected $title = '';

	/**
	 *
	 * @var string 
	 */
	protected $_name;
	
	/**
	 *
	 * @var array 
	 */
	protected $_data = array();
	
	/**
	 *
	 * @var array 
	 */
	protected $_params = array();
	
	/**
	 *
	 * @var string 
	 */
	protected $_template = 'object/default';

	public function __construct( $params = array() )
	{
		$this->_params = $params;
		$this->_name = $params['name'];
		$this->_id = Text::random( 'alpha' );
		
		$this->_init();
		$this->_execute();
	}

	protected function _init()
	{
		if ( isset( $this->_params['tpl'] ) )
		{
			$this->_template = $this->_params['tpl'];
		}
		else
		{
			$this->_template = 'objects/' . strtolower( str_replace( '_', '/', $this->_name ) );
		}

		if ( isset( $this->_params['title'] ) )
		{
			$this->_title = $this->_params['title'];
		}
	}
	
	/**
	 * 
	 * @param string $name
	 * @return mixed
	 */
	public function __get( $name )
	{
		return $this->get( $name );
	}

	/**
	 * 
	 * @param string $name
	 * @param mixed $value
	 * @return Model_Object
	 */
	public function __set( $name, $value )
	{
		return $this->set( $name, $value );
	}

	/**
	 * 
	 * @return string
	 */
	public function __toString()
	{
		return $this->name;
	}

	/**
	 * 
	 * @return string
	 */
	public function render()
	{
		return View::factory( $this->_template)
			->bind('data', $this->_data)
			->bind('params', $this->_params)
			->set('title', $this->_title)
			->render();
	}
	
	/**
	 * 
	 * @param string $name
	 * @param mixed $default
	 * @return mixed
	 */
	public function get( $name, $default = NULL )
	{
		return Arr::path( $this->_params, $name, $default );
	}

	/**
	 * 
	 * @param string $name
	 * @param mixed $value
	 * @return \Model_Object
	 */
	public function set( $name, $value )
	{
		$this->_params[$name] = $value;
		
		return $this;
	}

	/**
	 * 
	 * @return string
	 */
	public function id()
	{
		return $this->_id;
	}
	
	/**
	 * 
	 * @return string
	 */
	public function title()
	{
		return $this->title;
	}

	protected function _execute()
	{
		return $this->_data;
	}

}