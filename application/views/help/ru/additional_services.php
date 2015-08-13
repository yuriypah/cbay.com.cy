<?php
$packs = HTML::getPacks();
echo __('help.additional_services', array(
    ':pack_up_price' => $packs->pack_up->price,
    ':pack_up_days' => $packs->pack_up->days,
    ':pack_pickout_price' => $packs->pack_pickout->price,
    ':pack_pickout_days' => $packs->pack_pickout->days,
    ':pack_prestige_price' => $packs->pack_prestige->price,
    ':pack_prestige_days' => $packs->pack_prestige->days,
    ':pack_vip_price' => $packs->pack_vip->price,
    ':pack_vip_days' => $packs->pack_vip->days
));
?>


