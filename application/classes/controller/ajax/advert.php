<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_Ajax_Advert extends Controller_Ajax_JSON {

	public function action_phone()
	{
		$phone = $this->request->post( 'phone' );
		
		if(!$phone)
		{
			return;
		}
		
		$phone = Encrypt::instance()->decode( $phone );
		
		$this->session->set('phone', $phone);
		$this->json['status'] = TRUE;
	}
	
	public function action_activate()
	{
		$id = Input::post('id');

		$advert = ORM::factory('advert', $id);
		if(!$advert->loaded())
		{
			$this->json['message'] = __('Advert not found');
			return;
		}

		$package_id = $this->ctx->config->default_package;
		$package = Model_Package::$packages[$package_id];
		
		if($package->amount() == 0)
		{
			$advert->add_package($package);
			$this->json['message'] = __('Advert activated');
			$this->json['location'] = Route::url( 'profile');
			return;
		}
		else
		{
			$this->json['location'] = Route::url('default', array(
				'controller' => 'packages', 'action' => 'pay'
			)) . URL::query( array(
				'advert_id' => $advert->id,
				'package_id' => $package_id
			));
		}
	}
	
	public function action_deactivate()
	{
		$ids = Input::post('ids', array());
		
		
	}
}