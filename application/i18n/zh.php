<?php defined( 'SYSPATH' ) or die( 'No direct access allowed.' );
return ( array ) json_decode ( file_get_contents ( "application/i18n/data/zh.json" ), true );
?>