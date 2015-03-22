<?php foreach ($adverts as $advert): ?>
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
                <?= HTML::image('resources/images/color.png', array('data-tooltip' => __('package.option.title.selected'))); ?>
            <? } ?>
            <? if ($advert->top()) { ?>
                <?= HTML::image('resources/images/up.png', array('data-tooltip' => __('package.option.title.top'))); ?>
            <? } ?>
        </div>
        <?php if (isset($checkbox)): ?>
            <div class="chbox">
                <input type="checkbox" value="<?php echo $advert->id; ?>" name="bookmark[<?php echo $advert->id; ?>]">
            </div>
        <?php endif; ?>
        <div class="date">
            <?php echo $advert->published_on(); ?>
        </div>
        <div class="image" style='position:relative'>
            <?php
            if ($advert->image_exists('135_90')) {
                $image = HTML::image($advert->image('135_90'), array('width' => '60px', 'title' => $advert->title(), 'alt' => $advert->title()));
                echo HTML::anchor('advert/' . $advert->id, $image);
            } else
                echo HTML::anchor('advert/' . $advert->id, NULL, array('class' => 'no-image', 'title' => $advert->title()));
            ?>

            <?

            $count_other = $advert->images->count_all();
            if ($advert->image_exists('135_90')) {
                $count_other++;
            }
            if ($count_other > 0) {
                echo "<div style='
background: url(/resources/images/photo-icons-sprite.png) no-repeat 0 0;
width: 20px;
height: 18px;
position: absolute;
bottom: 3px;
right: 0px;
z-index: 100;
font-weight: 700;
line-height: 21px;
font-size: 9px;
color: white;
text-align: center;
'>" . $count_other . "</div>";

            }
            ?>
        </div>
        <div class="content">
            <?php echo HTML::anchor('advert/' . $advert->id, $advert->title(), array('class' => 'title')); ?>
            <div class="price"><?php echo $advert->amount(); ?></div>

            <div class="category"><?php
                echo $advert->category(FALSE);
                if ($advert->category_id == 12 || $advert->category_id == 9) {

                    $arr = array_merge(
                        Model_Advert_Option::get_options_for_view($advert->id),
                        Model_Advert_Option_String::get_strings($advert->id));
                    if ($arr) {
                        $i = 0;
                        $str = ' (';
                        foreach ($arr as $opts) {
                            if($i == 4) {
                                break;
                            }
                            if($opts['value'] != '')
                            $str .= $opts['label'] . ": " . $opts['value'] . ", ";
                            $i++;
                        }
                        $str = rtrim($str,', ');
                        $str .= ')';
                        echo $str;
                    }

                }
                ?></div>
            <div class="city"><?php echo __('advert_page.label.city') . ': ' . $advert->city(); ?></div>

            <?php if (isset($checkbox)): ?>
                <button
                    class="del-from-bookmark btn btn-mini btn-danger"><?php echo __('advert_page.label.remove_bookmarks'); ?></button>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>