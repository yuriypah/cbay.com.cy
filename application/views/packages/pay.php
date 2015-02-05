<div id="pay-page">
    <div id="pay-advert" class="pull-left">
        <div id="adverts-list" class="type-tiles">
            <div class="item<?php echo $advert->selected() ? ' selected' : ''; echo $advert->premium() ? ' selected' : '';  ?>" data-id="<?php echo $advert->id; ?>">
                <div class="list-img-pack">
                    <? if($advert->premium()) {?>
                        <?= HTML::image('resources/images/prestig.png'); ?>
                    <? } ?>
                    <? if($advert->vip()) {?>
                        <?= HTML::image('resources/images/vip.png'); ?>
                    <? } ?>
                    <? if($advert->selected()) {?>
                        <?= HTML::image('resources/images/color.png'); ?>
                    <? } ?>
                    <? if($advert->top()) {?>
                        <?= HTML::image('resources/images/up.png'); ?>
                    <? } ?>
                </div>
                    <div class="image">
                            <?php 
                            if( $advert->image_exists('235_175') )
                            {
                                    $image = HTML::image( $advert->image('235_175') );
                                    echo HTML::anchor('advert/'.$advert->id, $image);
                            }
                            else
                                    echo HTML::anchor('advert/'.$advert->id, NULL, array('class' => 'no-image'));
                            ?>
                    </div>
                    <div class="content">
                            <?php echo HTML::anchor('advert/'.$advert->id, $advert->title(), array('class' => 'title')); ?>
                            <div class="clear"></div>

                            <div class="price"><?php echo $advert->amount(); ?></div>
                            <div class="city"><?php echo __('advert_page.label.city') . ': '. $advert->city(); ?></div>

                            <div class="clear"></div>
                    </div>
            </div>
        </div>
    </div>
    <div id="pay-content">
        <div id="pay-title"><?= __('package.pay.title') ?></div>
        <div id="pay-info">
            <div class="pay-info-line"><div class="pull-left pay-info-title"><?= __('package.pay.package') ?>:</div><div class="pull-left pay-info-value"><?= $package->column ?></div></div>
            <div class="pay-info-line"><div class="pull-left pay-info-title"><?= __('package.pay.description') ?>:</div><div class="pull-left pay-info-value"><?= __('package.description.'.$package->column) ?></div></div>
            <div class="pay-info-line"><div class="pull-left pay-info-title"><?= __('package.pay.cost') ?>:</div><div class="pull-left pay-info-value"><?= $package->amount() ?>&nbsp;€</div></div>
            
            <div class="pay-info-value"><?= __('package.pay.payment') ?>:</div>
            <div id="payment">
                <div class="pull-left">
                    <div id="payment-wallet" class="payment">
                        <?= HTML::image('resources/images/money-wallet-icon.png', array('class' => 'wallet-image')); ?>
                        <span class="wallet-text"><?= __('wallet.label'); ?></span>
                    </div>
                    <form action="/packages/walletpay" method="POST">
                        <input type="hidden" name="advert" value="<?= $advert->id; ?>">
                        <input type="hidden" name="package" value="pack<?= $package->id(); ?>">
                        <div id="wallet-button">
                            <input type="submit" value="<?= __('wallet.pay'); ?>" class="advert_activate btn btn-mini btn-success">
                        </div>
                    </form>
                </div>
                <div class="pull-left">
                    <div id="payment-paypal" class="payment"></div>
                    <div id="paypalbutton">
                        <?= View::factory( 'packages/paypal'.$package->column, array(
                                'advert' => $advert->id
                            ) );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>