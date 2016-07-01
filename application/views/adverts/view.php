<script type="text/javascript">
    var advert_id = <?php echo $advert->id; ?>;
    var media_uri = '<?php echo URL::site(RESURL . MEDIA); ?>';
    <? if($message) :?>
    $(function () {
        var link = '/ajax-form-';
        var self = $("#message-click");
        if (self.hasClass('mail-to-user'))
            link += 'message';
        else if (self.hasClass('mail-to-friend'))
            link += 'sendfriend';
        else if (self.hasClass('report'))
            link += 'abuse';
        else
            return false;
        $('.option').removeClass('clicked');
        $.post(link, {advert_id: advert_id}, function (response) {
            self.addClass('clicked');

            $('#options-form-container')
                .empty()
                .html(response)
                .show();
            $('#form-name').val('<?= $message->name ?>');
            $('#form-email').val('<?= $message->email ?>');
            $('#comment').val('<?= $message->description ?>');
        });

        return false;
    });
    <? endif; ?>
</script>
<div class="page-header with-image" id="advert-header">
    <div id="view-pack-image" style="display:inline-block">
        <div class="pull-left"><h1><?php echo $advert->part()->title; ?></h1></div>
        <div class="list-img-pack pull-left"><a href="/packages">
                <? if ($advert->premium()) { ?>
                    <?= HTML::image('resources/images/prestig.png', array('data-tooltip' => __('package.option.title.premium'))); ?>
                <? } ?>
                <? if ($advert->vip()) { ?>
                    <?= HTML::image('resources/images/vip.png', array('data-tooltip' => __('package.option.title.vip'))); ?>
                <? } ?>
                <? if ($advert->selected()) { ?>
                    <?= HTML::image('resources/images/color.png', array('data-tooltip' => __('package.option.title.selected'))); ?>
                <? } ?>
                <? if ($advert->top()) { ?>
                    <?= HTML::image('resources/images/up.png', array('data-tooltip' => __('package.option.title.top'))); ?>
                <? } ?>
            </a></div>
    </div>
    <div id="advert-published">
        <strong><?php echo __('advert_page.label.published'); ?></strong>:
        <span><?php echo $advert->published_on(); ?></span>
    </div>
    <? /*if ($shows['this_user']) :*/ ?>
    <div id="advert-packages">&nbsp;
        <!-- <?php echo HTML::anchor('packages', __('advert_page.label.sell_faster'), array('class' => 'packages-font')); ?>
        <div class="list-img-pack view more_serv">

            <? if (!$advert->premium()) { ?>
                <?php echo HTML::anchor('packages/pay?advert=' . $advert->id . '&package=pack5', HTML::image('resources/images/prestig.png', array('data-tooltip' => __('package.option.title.premium')))); ?>
            <? } ?>
            <? if (!$advert->vip()) { ?>
                <?php echo HTML::anchor('packages/pay?advert=' . $advert->id . '&package=pack2', HTML::image('resources/images/vip.png', array('data-tooltip' => __('package.option.title.vip')))); ?>
            <? } ?>
            <? if (!$advert->selected()) { ?>
                <?php echo HTML::anchor('packages/pay?advert=' . $advert->id . '&package=pack3', HTML::image('resources/images/color.png', array('data-tooltip' => __('package.option.title.selected')))); ?>
            <? } ?>
            <? if (!$advert->top()) { ?>
                <?php echo HTML::anchor('packages/pay?advert=' . $advert->id . '&package=pack4', HTML::image('resources/images/up.png', array('data-tooltip' => __('package.option.title.top')))); ?>
            <? } ?>
        </div>-->
        <div class="pull-right">


            <a href="/advert/edit/<?php echo $advert->id ?>"><i class="icon icon-pencil advert-actions"></i></a>&nbsp;
            <i onclick="window.print();" class="icon icon-print advert-actions"></i>&nbsp;
        </div>
    </div>
    <? /*endif;*/ ?>
</div>


<div class="row with-image" id="advert">

    <div id="advert-content">

        <div id="advert-user-info">
            <table class="advert-user-table">

                <tr>
                    <th><?php echo __('advert_page.label.price'); ?>:</th>
                    <td colspan="2">
                        <div id="advert-price">
                            <?php echo $advert->amount(); ?>
                        </div>
                    </td>
                    <!--<? if (isset($options_for_view)) {
                        foreach ($options_for_view as $option) {
                            if ($option['key'] == 170) {
                                ?>
                                <td>в</td>
                                <td><strong><?= $option['value'] ?></strong></td><?
                                break;
                            }
                        }
                    }
                    ?>-->
                </tr>
                <tr>
                    <th><?php echo __('advert_page.label.seller'); ?>:</th>
                    <td colspan="2"><?php echo $advert->user->profile->name; ?>
                        <?php if ($advert->allow_mails() && $advert->user->profile->id != $ctx->auth->get_user()->profile_id): ?>
                        <?php echo "&nbsp;" . HTML::anchor('#advert-options', __('advert_page.label.send_email'), array(
                                'id' => 'send_email_to_seller',
                                'class' => 'dashed'
                            )); ?>
                    </td>
                    <?php else: ?>

                    <?php
                    endif;
                    ?>
                </tr>
                <?php if (!empty($advert->phone)): ?>
                    <tr>
                        <th><?php echo __('advert_page.label.phone'); ?>:</th>
                        <td colspan="2"
                            id="phone_container"><a id="phone_id" href="#"
                                                    class="dashed"><?= __('advert_page.label.phone_link') ?></a>
                            <script>
                                $("#phone_id").click(function (e) {
                                    e.preventDefault();
                                    $.fancybox.showLoading();
                                    $(this).replaceWith("<img style='vertical-align: top' src='/adverts/phone/?id=<?php echo base64_encode($advert->phone)?>'/>")
                                    setTimeout(function () {
                                        $.fancybox.hideLoading();
                                    }, 200);
                                });
                            </script>
                        </td>

                    </tr>
                <?php endif; ?>
                <?php if (!empty($advert->skype)): ?>
                    <!--<tr>
                        <th><?php echo __('advert_page.label.skype'); ?>:</th>
                        <td><?php echo $advert->skype; ?></td>
                    </tr>-->
                <?php endif; ?>
                <!-- !!! -->
                <tr>
                    <th><?php echo __('advert_page.label.city'); ?>:</th>
                    <td><?php echo $advert->city(); ?></td>
                    <td colspan="2"></td>
                </tr>

            </table>
        </div>

        <div id="advert-category">
            <strong><?php echo __('advert_page.label.category'); ?></strong> <?php echo HTML::anchor('adverts' . URL::query(array('c' => $advert->category_id), FALSE), $advert->category(FALSE)); ?>
        </div>

        <?php
        if ($options_for_view) {
            echo View::factory('adverts/view/category_options', array(
                'advert' => $advert,
                'options_for_view' => $options_for_view
            ));
        }
        ?>
        <?php if ($advert->part()->description): ?>
            <div id="advert-description">
                <h3 class="head"><?php echo __('advert_page.label.description'); ?></h3>
                <?php echo $advert->part()->description; ?>
                <br/><hr/>
                <div class="originText">
                    <?php echo $advert->part($advert->user->profile->default_locale)->description; ?>
                </div>

                <button class="btn btn-default btn-sm originTextHolder">Original Text</button>
                <script>
                    $(".originTextHolder").click(function() {
                        $(".originText").slideToggle();
                    })
                </script>
            </div>
        <?php endif; ?>
        <h4 id="advert-number"><?php echo __('advert_page.label.number', array(':num' => $advert->id)); ?></h4>
    </div>



    <?php if ($advert->image_exists('510_410')): ?>
        <div class="span6" id="advert-sidebar">
            <?php echo View::factory('adverts/view/images', array(
                'advert' => $advert
            )); ?>
            <div id="advert-statistic">
                <!--<div class="span4">
                    <span><h3 class="head"><?php echo __('advert_page.label.start_date') ?> –
                            <strong><?php echo $advert->published_on(); ?></strong></h3></span><span><h3
                            class="head"><?php echo __('advert_page.label.finish_date') ?>
                            &nbsp;<strong><?php echo $advert->finished_on(); ?></strong></h3></span>
                </div>-->
                <? if ($shows['this_user']): ?>
                    <!--<div class="span2">
                        <span><h3 class="head"><?php echo __('advert_page.label.shows') ?>:
                                <strong><?= $shows['all'] ?></strong></h3></span><span><h3
                                class="head"><?php echo __('advert_page.label.shows_today') ?>:
                                <strong><?= $shows['today'] ?></strong></h3></span>
                    </div>-->
                <? endif; ?>
            </div>
        </div>
    <? else: ?>
        <div class="span6" id="advert-sidebar">
            <div id="advert-images">
                <div class="image-big">
                    <div class="big-img-conteiner"
                         style="background: #2E8BAE url('/resources/images/photo-icon.jpg') 50% 50% no-repeat; background-size: auto !important;"></div>
                </div>
            </div>
            <div id="advert-statistic">
                <div class="span4">
                    <span><h3 class="head"><?php echo __('advert_page.label.start_date') ?> –
                            <strong><?php echo $advert->published_on(); ?></strong></h3></span><span><h3
                            class="head"><?php echo __('advert_page.label.finish_date') ?>
                            &nbsp;<strong><?php echo $advert->finished_on(); ?></strong></h3></span>
                </div>
                <? if ($shows['this_user']): ?>
                    <div class="span2">
                        <span><h3 class="head"><?php echo __('advert_page.label.shows') ?>:
                                <strong><?= $shows['all'] ?></strong></h3></span><span><h3
                                class="head"><?php echo __('advert_page.label.shows_today') ?>:
                                <strong><?= $shows['today'] ?></strong></h3></span>
                    </div>
                <? endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php echo View::factory('adverts/view/options', array(
    'advert' => $advert
)); ?>

