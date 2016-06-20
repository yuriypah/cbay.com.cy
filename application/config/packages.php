<?php defined('SYSPATH') or die('No direct script access.');
$packs = HTML::getPacks();
return array(
    'pack1' => array(
        new Model_Package_Option_Show(1, 60)
    ),
    'pack5' => array(
        new Model_Package_Option_Premium(5, $packs->pack_prestige->days, $packs->pack_prestige->price)
    ),
    'pack2' => array(
        new Model_Package_Option_Vip(2, $packs->pack_vip->days, $packs->pack_vip->price)
    ),
    'pack3' => array(
        new Model_Package_Option_Select(3, $packs->pack_pickout->days, $packs->pack_pickout->price)
    ),
    'pack4' => array(
        new Model_Package_Option_Top(4, $packs->pack_up->days, $packs->pack_up->price)
    )
);