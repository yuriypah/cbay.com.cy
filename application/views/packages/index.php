<div id="pay-title"><?= __('menu.label.packages_pay'); ?></div>
<p class="alert alert-"><i class="icon-info-sign icon"></i><?= __('suggest.text.info') ?></p>
<div id="suggest-packages">
    <div id="suggest-adverts" class="">
        <? foreach ($adverts as $advert) : ?>
            <?
            $pack = '';
            $pack .= $advert->premium() ? ' pack-premium' : '';
            $pack .= $advert->vip() ? ' pack-vip' : '';
            $pack .= $advert->selected() ? ' pack-selected' : '';
            $pack .= $advert->top() ? ' pack-top' : '';
            ?>
            <div class="suggest-advert-box<?= $pack ?>" val="<?= $advert->id ?>">
                <div class="list-img-pack">
                    <?php if ($advert->premium()) { ?>
                        <?= HTML::image('resources/images/prestig.png', array('data-tooltip' => __('package.option.title.premium'))); ?>
                    <? } ?>
                    <? if ($advert->vip()) { ?>
                        <?= HTML::image('resources/images/vip.png', array('data-tooltip' => __('package.option.title.vip'))); ?>
                    <? } ?>
                    <? if ($advert->selected()) { ?>
                        <?= HTML::image('resources/images/color.png', array('title' => __('package.option.title.selected'))); ?>
                    <? } ?>
                    <? if ($advert->top()) { ?>
                        <?= HTML::image('resources/images/up.png', array('title' => __('package.option.title.top'))); ?>
                    <? } ?>
                </div>
                <div class="image">
                    <?php if ($advert->image_exists('135_90')) {
                        echo HTML::image($advert->image('135_90'));
                    } else
                        echo '<div class="no-image"></div>';
                    ?>
                </div>
                <div class="advert-title"><?= $advert->title() ?></div>
            </div>
        <? endforeach; ?>
        <div style="clear:both"></div>
    </div>
</div>
<div>
    <div class="alert alert-info package-block pack-premium">

        <input type="checkbox" name="addpackege" value="pack5" class=" package-select">

        <div class="pull-left">
            <img src="/resources/images/prestig.png" class="sale_img"/>
        </div>
        <div class="pull-right package-textbox">
            <? echo __('package.description.premium'); ?>
        </div>
    </div>
    <div class="alert alert-info package-block pack-vip">
        <input type="checkbox" name="addpackege" value="pack2" class="package-select">

        <div class="pull-left">
            <img src="/resources/images/vip.png" class="sale_img"/>
        </div>
        <div class="pull-right package-textbox">
            <? echo __('package.description.vip'); ?>
        </div>
    </div>
    <div class="alert alert-info package-block pack-selected">
        <input type="checkbox" name="addpackege" value="pack3" class=" package-select">

        <div class="pull-left">
            <img src="/resources/images/color.png" class="sale_img"/>
        </div>
        <div class="pull-right package-textbox">
            <? echo __('package.description.selected'); ?>
        </div>
    </div>
    <div class="alert alert-info package-block pack-top">
        <input type="checkbox" name="addpackege" value="pack4" class="package-select">

        <div class="pull-left">
            <img src="/resources/images/up.png" class="sale_img"/>
        </div>
        <div class="pull-right package-textbox">
            <? echo __('package.description.top'); ?>
        </div>
    </div>
</div>

<div id="suggest-action">
    <button name="action" class="btn btn-success" onclick="buySuggest()">
        <?= __('suggest.button.tobuy') ?>
        <i class="icon-chevron-right icon"></i>
    </button>
    <script>
        $(function () {
            suggest = {
                'nopack': '<?= __('suggest.error.nopack') ?>',
                'noadvert': '<?= __('suggest.error.noadvert') ?>'
            };
        });
        $(".suggest-advert-box").click(function () {
            if (!$(this).hasClass('pack-premium')) {
                $(".package-block.pack-premium").show()
            } else {
                $(".package-block.pack-premium").hide()
            }
            if (!$(this).hasClass('pack-vip')) {
                $(".package-block.pack-vip").show()
            } else {
                $(".package-block.pack-vip").hide()
            }
            if (!$(this).hasClass('pack-selected')) {
                $(".package-block.pack-selected").show()
            } else {
                $(".package-block.pack-selected").hide()
            }
            $('.package-block').removeClass('selected-package');
            $('input[name=addpackege]').attr('checked', false);
        });

    </script>
</div>
