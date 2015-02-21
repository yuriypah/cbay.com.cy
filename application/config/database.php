<?php

defined('SYSPATH') or die('No direct access allowed.');

return array
    (
    'default' => array
        (
        'type' => 'mysql',
        'connection' => array(
            'hostname' => 'localhost',
            'database' => 'cbay',
            'username' => 'root',
            'password' => '1q2w3e4r',
            'persistent' => FALSE,
        ),
        'table_prefix' => '',
        'charset' => 'utf8',
        'caching' => false,
        'profiling' => TRUE,
    ),
    'production' => array
        (
        'type' => 'mysql',
        'connection' => array(
            'hostname' => 'localhost',
            'database' => 'cbay',
            'username' => 'root',
            'password' => '1q2w3e4r',
            'persistent' => FALSE,
        ),
        'table_prefix' => '',
        'charset' => 'utf8',
        'caching' => false,
        'profiling' => TRUE,
    ),
);