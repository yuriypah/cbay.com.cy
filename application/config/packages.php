<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

return array(
	'pack1' => array(
		new Model_Package_Option_Show(1, 30)
	),
        'pack5' => array(
            new Model_Package_Option_Premium(5, 7, 3.99)
        ),
        'pack2' => array(
            new Model_Package_Option_Vip(2, 7, 2.99)
        ),
        'pack3' => array(
            new Model_Package_Option_Select(3, 7, 1.99)
        ),
        'pack4' => array(
            new Model_Package_Option_Top(4, 1, 0.99)
        )
);