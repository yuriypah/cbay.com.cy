<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

return array(
	'*' => array(
		'*' => array(
			'*' => array(
				'header_block' => array(
					'name' => 'Layout_Header'
				),
				'footer_block' => array(
					'name' => 'Layout_Footer'
				),

				'header_menu' => array(
					'name' => 'Layout_HeaderMenu'
				),
			)
		),
		'advert' => array(
			'*' => array(
				'right_menu_top' => array(
					'name' => 'Advert_Place_Info'
				)
			),
		),
		'help' => array(
			'*' => array(
				'left_menu_top' => array(
					'name' => 'Help_Menu'
				)
			),
		),
		'adverts' => array(
			'*' => array(
				'header_sub_menu' => array(
					'name' => 'Advert_Search'
				)
			),
			'index' => array(
				'wrapper_bottom' => array(
					'name' => 'Advert_Categories'
				),
//				'wrapper_top' => array(
//					'name' => 'Advert_Counter'
//				)
			),
			'unpublish' => array(
				'header_sub_menu' => TRUE
			),
			'publish' => array(
				'header_sub_menu' => TRUE
			),
		),
		'profile' => array(
			'*' => array(
				'header_sub_menu' => array(
					'name' => 'Layout_SubMenu'
				)
			)
		),
		'messages' => array(
			'*' => array(
				'header_sub_menu' => array(
					'name' => 'Layout_SubMenu'
				)
			)
		),
		'wallet' => array(
			'*' => array(
				'header_sub_menu' => array(
					'name' => 'Layout_SubMenu'
				)
			)
		),
	),
	'backend' => array(
		'*' => array(
			'*' => array(
				'header_sub_menu' => array(
					'name' => 'Layout_SubMenu'
				)
			),
			
		),
		'categories' => array(
			'*' => array(
				'left_menu_top' => array(
					'name' => 'Backend_Category_Menu'
				)
			),
			
		),
		'adverts' => array(
			'*' => array(
				'header_sub_menu' => array(
					'name' => 'Layout_SubMenu'
				)
			)
		),
	),
);