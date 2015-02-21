<div class="row" id="selected-activity" style="margin-bottom: 5px;">
    <div class="pull-left">
        <div class="checkall">
            <input type="checkbox" id="chkAll" onclick="advEdit.selectAll(this)" name="checked" value="97">
            <label for="chkAll"><?php echo __('advert_page.label.select_all'); ?></label>
        </div>
    </div>
    <div class="pull-right button_actions"><?= __('advert_page.label.selected'); ?>:&nbsp;
        <input disabled="disabled" type="button" onclick="advEdit.action('publish')"
               value="<?php echo __('advert.title.activate'); ?>"
               class="advert_activate btn">&nbsp;
        <input disabled="disabled" type="button" onclick="advEdit.action('unpublish')"
               value="<?php echo __('advert.title.deactivate'); ?>"
               class="advert_deactivate btn">&nbsp;
        <input disabled="disabled" type="button" onclick="advEdit.action('delete')"
               value="<?php echo __('advert.title.delete'); ?>"
               class="advert_delete btn">
    </div>
</div>
<?php foreach ($adverts as $advert): ?>
    <div
        class="item <?php echo $advert->finished() ? 'finished' : ''; ?> <?php if ($advert->is_deactivated()): ?>deactivated<?php endif; ?>"
        data-id="<?php echo $advert->id; ?>">
        <div class="image">
            <table>
                <tr>
                    <td style="vertical-align: middle">
                        <input type="checkbox" class="advert-checkbox" name="checked" value="<?= $advert->id ?>">
                    </td>
                    <td style="padding-left: 3px">
                        <?php if ($advert->image_exists('135_90')) {
                            $image = HTML::image($advert->image('135_90'), array('class' => 'advert-edit-image', 'width' => '60px', 'title' => $advert->title(), 'alt' => $advert->title()));
                            echo HTML::anchor('advert/' . $advert->id, $image);
                        } else
                            echo HTML::anchor('advert/' . $advert->id, NULL, array('class' => 'advert-edit-image no-image', 'title' => $advert->title()));
                        ?>
                    </td>
                </tr>
            </table>

        </div>
        <div class="content content-edit-advert">
            <?php echo HTML::anchor('advert/' . $advert->id, $advert->title(), array('class' => '', 'style' => 'font-size:14px;'.(!$advert->is_deactivated() && !$advert->is_blocked()? "" : "color:gray"))); ?>
            <?php if ($advert->is_deactivated()): ?>
                &nbsp;&nbsp;<span class="label" style="padding:3px 7px 3px 4px"> <?php echo __('advert.status.deactivated'); ?></span>
            <?php endif; ?>

            <?
            $premium = HTML::image('resources/images/prestig.png', array('data-tooltip' => __('package.description.premium'), 'class' => 'edit-buybutton'));
            $vip = HTML::image('resources/images/vip.png', array('data-tooltip' => __('package.description.vip'), 'class' => 'edit-buybutton'));
            $selected = HTML::image('resources/images/color.png', array('data-tooltip' => __('package.description.selected'), 'class' => 'edit-buybutton'));
            $top = HTML::image('resources/images/up.png', array('data-tooltip' => __('package.description.top'), 'class' => 'edit-buybutton'));
            $options = $advert->get_package_options();
            ?>

            <div class="pull-right" style="margin-right:3px">
                <!-- buttons -->
                <?php echo HTML::anchor('/advert/edit/' . $advert->id, "<i class='icon-pencil'></i> " . __('button.edit') . "&nbsp;", array(
                    'class' => 'btn  inline-block'
                )); ?>&nbsp;


                    <?php echo HTML::anchor('/adverts/delete/' . $advert->id, "<i class='icon-trash'></i> ".__('advert.title.delete')."&nbsp;", array(
                        'class' => 'advert_delete btn'
                    )); ?>&nbsp;


                <!-- packs -->
                <div class="options">
                    <div class="edit-buybox">
                        <? if (!empty($options)): ?>
                            <? $package_ids = array();
                            foreach ($advert->get_package_options() as $option) {
                                if ($option->time_left() > 0)
                                    $package_ids[] = $option->id();
                            }
                            if (!in_array(5, $package_ids)) {
                                echo HTML::anchor('packages/pay?advert=' . $advert->id . '&package=pack5', $premium);
                            } else {
                                echo "<span style='opacity:0.4'>" . $premium . "</span>";
                            }
                            if (!in_array(2, $package_ids)) {
                                echo HTML::anchor('packages/pay?advert=' . $advert->id . '&package=pack2', $vip);
                            } else {
                                echo  "<span style='opacity:0.4'>" . $vip . "</span>";
                            }
                            if (!in_array(3, $package_ids)) {
                                echo  HTML::anchor('packages/pay?advert=' . $advert->id . '&package=pack3', $selected);
                            } else {
                                echo  "<span style='opacity:0.4'>" . $selected . "</span>";
                            }
                            if (!in_array(4, $package_ids)) {
                                echo HTML::anchor('packages/pay?advert=' . $advert->id . '&package=pack3', $top);
                            } else {
                                echo  "<span style='opacity:0.4'>" . $top . "</span>";
                            }
                            ?>

                        <? endif; ?>
                    </div>
                </div>
                <!-- end packs -->
            </div>
            <div class="options">
				<span class="price">
					<?php echo $advert->amount(); ?>
				</span>
            </div>
            <div class="options">
                <b>Категория:</b> <span style="color:gray"><?php echo $advert->category(false) ?></span>
            </div>
            <div class="options">
                <?php if (!empty($options)): ?>
                    <?php foreach ($advert->get_package_options() as $option): ?>
                        <div class="option" data-id="<?php echo $option->id(); ?>">
                            <div class="row-fluid">
                                <b><?php echo $option->name(); ?>:</b>
                                <? $time_left = ($option->time_left() < 0) ? -1 : $option->time_left(); ?>
                                <?php
                                if ($time_left > 0) {
                                    echo "<span style='color:green'>" . HTML::declination($time_left, array(
                                            __('package.title.time_left.one', array(':days' => $time_left)),
                                            __('package.title.time_left.few', array(':days' => $time_left)),
                                            __('package.title.time_left.many', array(':days' => $time_left)))) . "</span>
                                                     &nbsp;&nbsp;<a href='/packages'>" . __('advert_page.label.sell_faster') . "</a>";
                                } else {
                                    echo "<span style='color:red'>" . __('package.title.time_left.zero') . "</span>";
                                }
                                ?>
                            </div>
                            <?php if ($option->time_left() <= 0): ?>
                                <? if ($option->id() == 1) : ?>
                                    <?php /*echo HTML::anchor('#', __('package.title.prolong'), array(
                                        'class' => 'advert_prolong btn btn-mini'
                                    ));*/
                                    ?>

                                <? else: ?>
                                    <?php/* echo HTML::anchor('packages/pay?advert=' . $advert->id . '&package=pack' . $option->id(), __('package.title.prolong'), array(
                                        'class' => 'package-prolong btn btn-mini'
                                    ));*/
                                    ?>
                                <? endif; ?>
                            <?php endif; ?>
                        </div>

                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="option">
                        <?php /*echo HTML::anchor('#', __('package.title.activate'), array(
                            'class' => 'advert_prolong btn btn-mini'
                        )); */
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script>
    $("input[type=checkbox]").change(function () {
        setTimeout(function () {
            if ($("input[type=checkbox]:checked").length > 0) {
                $(".button_actions input").attr('disabled', false)
            } else {
                $(".button_actions input").attr('disabled', true)
            }
        }, 200)

    })
</script>