<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_Ajax_Plugin extends Controller_Ajax_JSON {

	public $auth_required = array('admin');

	public function action_status()
	{
		$status = (int) Input::post( 'status' );
		$plugin_id = Input::post( 'id' );

		Model_Plugin::find_all();

		$plugin = Model_Plugin::get_registered( $plugin_id );
		$view = $status == 1 ? 'activated' : 'deactivated';

		if ( $status )
		{
			Model_Plugin::activate( $plugin_id );
		}
		else
		{
			Model_Plugin::deactivate( $plugin_id );
		}

		$this->json['status'] = TRUE;
		$this->json['operation'] = $view;
		$this->json['plugin_id'] = $plugin_id;

		$this->json['javascripts'] = $plugin->javascripts();
		$this->json['styles'] = $plugin->styles();

		$this->json['html'] = (string) View::factory( 'backend/plugins/' . $view, array(
			'id' => $plugin_id,
			'plugin' => $plugin
		) );
	}
}