<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_System_Form extends Controller_Ajax_JSON {
	
	public $auth_required = array('admin');

	public function before()
	{
		parent::before();

		if($this->request->method() === Request::POST)
		{
			$token = Input::post('token');
			if(empty($token) OR !Security::check($token))
			{
				throw new Exception('Security token not check');
			}
		}
	}
	
	public function after()
	{
		if(Input::post('lang_part', array()))
		{
			$this->json['parts'] = Input::post('lang_part', array());
		}
		
		$this->json['lang'] = I18n::$lang;

		if($this->json['status'] === TRUE AND empty($this->json['message']))
		{
			$this->json['message'] = __('Data has ben saved');
		}
		
		parent::after();
	}
}