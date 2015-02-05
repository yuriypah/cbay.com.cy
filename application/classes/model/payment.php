<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

abstract class Model_Payment {

	protected $_service_url;

	abstract public function check();

	abstract public function complete();

	abstract public function _make_query_string();

	abstract public function _make_query_body();

	public function send_request( $type = 'post' )
	{
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $this->_service_url . $this->_make_query_string() );

		curl_setopt( $ch, CURLOPT_HEADER, FALSE );
		curl_setopt( $ch, CURLOPT_NOBODY, FALSE );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
		if ( $type == "post" )
		{
			curl_setopt( $ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0 );
			curl_setopt( $ch, CURLOPT_POST, 1 );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $this->_make_query_body() );
		}

		$response = curl_exec( $ch );

		$http_code = curl_getinfo( $ch, CURLINFO_HTTP_CODE );

		if ( $http_code != 200 )
			return false;

		curl_close( $ch );

		return $response;
	}

}