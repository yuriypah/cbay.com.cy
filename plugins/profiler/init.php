<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

$plugin = Model_Plugin_Item::factory( array(
	'id' => 'profiler',
	'title' => 'Profiler',
	'description' => 'Включает профилирование на сайте',
	'version' => '1.0.0',
) )->register();

Kohana::$profiling = FALSE;

if ( $plugin->enabled() )
{
	Kohana::$profiling = TRUE;
	Observer::observe( 'page_layout_bottom', 'enable_profiler' );
}

function enable_profiler()
{
	echo View::factory( 'profiler/footer' );
}