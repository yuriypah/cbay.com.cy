<?php defined('SYSPATH') or die('No direct access allowed.');
$lang = '';
switch (substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2)) {
    case 'ru':
        $lang = 'ru';
        break;
    case 'gr':
    case 'el':
        $lang = 'gr';
    case 'zh':
        $lang = 'zh';
    default:
        $lang = 'en';
        break;
}
return array(
    'advert' => array(
        'moderation' => true
    ),

    'email' => array(
        'support' => 'admin@cybaybeta.ru'
    ),

    'default_locale' => $lang,
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