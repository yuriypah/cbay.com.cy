<?php foreach ($adverts as $advert):?>
    <div class="item<?php echo $advert->selected() ? ' selected' : '';
    echo $advert->premium() ? ' selected' : ''; ?>" data-id="<?php echo $advert->id; ?>">
        <div class="list-img-pack">
            <? if ($advert->premium()) { ?>
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
      
        <div class="date">
            <?php echo $advert->published_on(); ?>
        </div>
        <div class="image">
            <?php

            if ($advert->image_exists('full')) {
                echo "<div class='type_list_preview_images' style='display:none'>" . View::factory('adverts/view/images_preview', array(
                        'advert' => $advert
                    )) . "</div>";
                echo HTML::anchor('advert/' . $advert->id, HTML::image('resources/images/advert-with-image.png', array(
                    'title' => $advert->title(),
                    'class' => 'type_list_preview_image_handler',
                    'alt' => $advert->title())));
            }
            ?>
            <script>
                $(".type_list_preview_image_handler").click(function (e) {

                    e.preventDefault();
                    $.fancybox.showLoading();
                    var self = this;
                    setTimeout(function() {
                        $(self).parents('.item').find('.fancybox_gallery:first').click();
                    },300);


                });
                $(".fancybox_gallery").fancybox();
            </script>
        </div>
        <div class="content">
            <?php echo HTML::anchor('advert/' . $advert->id, $advert->title(), array('class' => 'title'));

            ?>


            <div class="other">
                <div class="category"><?php echo $advert->category(FALSE); ?></div>
                <div class="city"><?php echo __('advert_page.label.city') . ': ' . $advert->city(); ?></div>

            </div>

            <div
                class="price"><?php echo $advert->amount() > 0 ? $advert->amount() : "<span class='gray'>" . $advert->amount() . "</span>"; ?></div>
        </div>
    </div>
<?php endforeach; ?>