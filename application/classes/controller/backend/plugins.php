<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_Backend_Plugins extends Controller_System_Backend {

	public function action_index()
	{
		$this->template->content->plugins = Model_Plugin::find_all();
		$this->template->content->loaded_plugins = Model_Plugin::get_loaded();
	}

	public function action_settings()
	{
		$plugin_id = $this->request->param( 'id' );

		if ( !Model_Plugin::is_enabled( $plugin_id ) )
		{
			throw new Exception( 'Плагин не активирован' );
		}

		$plugin = Model_Plugin::get_registered( $plugin_id );

		if ( $this->request->method() == Request::POST )
		{
			return $this->_save( $plugin );
		}

		$this->template->content->plugin = $plugin;
	}

	private function _save( $plugin )
	{
		$data = input::post( 'setting' );
		Model_Plugin::set_all_settings( $data, $plugin->id );

		$this->go_back();
	}

}