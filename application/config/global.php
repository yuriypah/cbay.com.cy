<?php defined( 'SYSPATH' ) or die( 'No direct access allowed.' );

return array(
	'advert' => array(
		'moderation' => FALSE
	),
	
	'email' => array(
		'support' => 'admin@cybaybeta.ru'
	),

	'default_locale' => 'ru',
	'default_view_type' => 'list-img', // 'list-img', 'tiles', 'list'
	'view' => array(
		'title' => 'Kipr',
		'description' => '',
		'keywords' => '',
	),
	'default_package' => 'pack1',
	'allowed_html_tags' => array(
		'b' => array(), 'strong' => array(),
		'i' => array(), 'em' => array(),
		'ol' => array(), 'ul' => array(), 'li' => array(),
		'p' => array('align' => 1),
		'br' => array(), 'hr' => array(),
		'h3' => array(), 'h4' => array(),
	),

	'api' => array(
		'yandex_map' => ''
	)
);