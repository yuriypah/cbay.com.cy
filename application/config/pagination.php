<?php defined('SYSPATH') or die('No direct script access.');

return array(

	// Application defaults
	'default' => array(
		'current_page'      => array('source' => 'query_string', 'key' => 'p'),
		'total_items'       => 0,
		'items_per_page'    => 15,
		'view'              => 'pagination/basic',
		'auto_hide'         => TRUE,
		'first_page_in_url' => FALSE,
	),
);
