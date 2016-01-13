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
            <?php
            $category_string = $advert->category(FALSE);
            if ($advert->category_id == 9) {
                $arr = array_merge(
                    Model_Advert_Option::get_options_for_view($advert->id),
                    Model_Advert_Option_String::get_strings($advert->id));
                if ($arr) {
                    $i = 0;
                    $category_string .= ' (';
                    foreach ($arr as $opts) {
                        if ($i == 4) {
                            break;
                        }
                        if ($opts['value'] != '')
                            $category_string .= $opts['label'] . ": " . $opts['value'] . ", ";
                        $i++;
                    }
                    $category_string = rtrim($category_string, ', ');
                    $category_string .= ')';

                }

                $am = $arr[1]['value'] . " " . $arr[2]['value'] . ", " . $arr[0]['value'] . ", " . $arr[4]['label'] . ":" . $arr[4]['value'] . ", " . $arr[7]['label'] . ":" . $arr[7]['value'] . ", " . $arr[6]['label'] . ":" . $arr[6]['value'] . ", " . $arr[8]['label'] . ":" . $arr[8]['value'];

            }
            echo "<div class='category'>";
            if ($advert->category_id == 9) {
                echo $am;
            } else {
                echo ' ';
            }

            echo "</div>";
            /* if (mb_strlen($category_string) > 90) {
                 echo "<div class='category' data-tooltip='".$category_string."'>";
                 echo "<span style=''>" . $am  . "...</span>";
                 echo "</div>";
             } else {
                 echo "<div class='category'>";
                 echo $am;
                 echo "</div>";
             }*/
            ?>

            <div class="city">
                <?php echo __('advert_page.label.city') . ': ' . $advert->city(); ?>
                <?php
                if ($advert->user->profile->type == 2) {
                    echo " | <span style='color:gray'>" . __("profile_page.settings.label.type.company") . ":</span> <a href='/adverts?user=" . $advert->user_id . "'>" . $advert->user->profile->name . "</a>";
                } else {
                    echo " | <span style='color:gray'>" . __("profile_page.settings.label.type.private") . ":</span> <a href='/adverts?user=" . $advert->user_id . "' href='#'>" . $advert->user->profile->name . "</a>";

                }
                ?>
            </div>
            <?php if (isset($checkbox)): ?>
                <button
                    class="del-from-bookmark btn btn-mini btn-danger"><?php echo __('advert_page.label.remove_bookmarks'); ?></button>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>