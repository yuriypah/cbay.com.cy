<div id="pay-page">
    <div id="pay-advert" class="pull-left">
        <div id="adverts-list" class="type-tiles">
            <div class="item<?php echo $advert->selected() ? ' selected' : '';
            echo $advert->premium() ? ' selected' : ''; ?>" data-id="<?php echo $advert->id; ?>">
                <div class="list-img-pack">
                    <? if ($advert->premium()) { ?>
                        <?= HTML::image('resources/images/prestig.png'); ?>
                    <? } ?>
                    <? if ($advert->vip()) { ?>
                        <?= HTML::image('resources/images/vip.png'); ?>
                    <? } ?>
                    <? if ($advert->selected()) { ?>
                        <?= HTML::image('resources/images/color.png'); ?>
                    <? } ?>
                    <? if ($advert->top()) { ?>
                        <?= HTML::image('resources/images/up.png'); ?>
                    <? } ?>
                </div>
                <div class="image">
                    <?php
                    if ($advert->image_exists('235_175')) {
                        $image = HTML::image($advert->image('235_175'));
                        echo HTML::anchor('advert/' . $advert->id, $image);
                    } else
                        echo HTML::anchor('advert/' . $advert->id, NULL, array('class' => 'no-image'));
                    ?>
                </div>
                <div class="content">
                    <?php echo HTML::anchor('advert/' . $advert->id, $advert->title(), array('class' => 'title')); ?>
                    <div class="clear"></div>

                    <div class="price"><?php echo $advert->amount(); ?></div>
                    <div class="city"><?php echo __('advert_page.label.city') . ': ' . $advert->city(); ?></div>

                    <div class="clear"></div>
                </div>
            </div>
        </div>
    </div>
    <div id="pay-content">
        <div id="pay-title"><?= __('package.pay.title') ?></div>
        <div id="pay-info">
            <div class="pay-info-line">
                <div class="pull-left pay-info-title">
                    <?= __('package.pay.package') ?>:
                </div>
                <div class="pull-left pay-info-value pay-page">
                    <?php
                    echo View::factory('/packages/view/packs', array('pack' => Input::get('package')));

                    ?>
                </div>
                <div class="pay-info-line">
                    <div class="pull-left pay-info-title"><?= __('package.pay.cost') ?>:</div>
                    <div class="pull-left pay-info-value"><?= $package->amount() ?>&nbsp;€</div>
                </div>

                <div class="pay-info-title"><?= __('package.pay.payment') ?>:</div>

                <div id="payment">
                    <?php
                    $isAvailable = $amount >= $package->amount(); // средств достаточно для оплаты пакета
                    if (!$isAvailable) {
                        ?>
                        <p class="alert alert-"><i
                                class="icon-info-sign icon"></i> <?php echo __('wallet.pay.notice.balance'); ?></p>
                    <? } ?>
                    <div class="pull-left">

                        <form action="/packages/walletpay" method="POST">
                            <input type="hidden" name="advert" value="<?= $advert->id; ?>">
                            <input type="hidden" name="package" value="pack<?= $package->id(); ?>">
                            <input <?php echo !$isAvailable ? " disabled='disabled' " : '' ?> type="submit"
                                                                                              value="<?= __('wallet.pay'); ?>: <?= $package->amount() ?>&nbsp;€"
                                                                                              class="advert_activate btn btn-success">
                        </form>
                    </div>
                    &nbsp;&nbsp; <a target="_blank" href="/wallet">
                        <button
                            class="advert_activate btn btn-success"><?= __('wallet.topayment', array(':amount' => $amount . " " . __('currency.euro'))); ?></button>
                    </a>
                </div>
            </div>
        </div>
    </div>