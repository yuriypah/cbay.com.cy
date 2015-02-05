<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

/**
 * Base class for t systems communication
 */
class Controller_Payment extends Controller_System_Security {

	protected $_payment_result;

	public function before()
	{
		if ( $this->request->method() != Request::POST )
		{
			die( 'No direct script access.' );
		}
	}

	public function result_action()
	{
		$this->_payment_result = Input::post();
	}

}