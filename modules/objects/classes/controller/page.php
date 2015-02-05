<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_Page extends Controller_Template {

	public $blocks = array();
	
	public function action_test()
	{
		$this->blocks['left_menu_top'] = array(
			'name' => 'Sidebar_CategoryFilter',
		);

		$this->blocks['left_menu_bottom'] = array(
			'name' => 'Sidebar_PropertyFilter',
			'param' => 'test_param'
		);
	}

	public function after()
	{
		if ( class_exists( 'Object' ) )
		{
			Object::add_blocks( $this->blocks );
		}

		parent::after();
	}

}