<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Context {

	protected static $_instance = NULL;

	public static function instance( $params = array() )
	{
		if ( self::$_instance === NULL )
		{
			self::$_instance = new Context( $params );
			return self::$_instance;
		}

		return self::$_instance;
	}

	protected $_params = array();

	public function __construct( $params = array() )
	{
		$this->auth = Auth::instance();
		$this->user = $this->auth->get_user();

		$this->_params = array_merge( $this->_params, $params );
	}

	public function __set( $name, $value )
	{
		$this->_params[$name] = $value;
	}

	public function __get( $name )
	{
		if ( isset( $this->_params[$name] ) )
		{
			return $this->_params[$name];
		}

		throw new Kohana_Exception( 'Parameter :param not found', array(':param' => $name) );
	}

	public function __isset( $name )
	{
		return isset( $this->_params[$name] );
	}

}