<div class="edit-buybox">
    <?php
    if ($advert->premium()) {
        echo "<span style='opacity:0.4'>" .
            HTML::image('resources/images/prestig.png', array('data-tooltip' => __('package.description.premium.finished', array(':date' => date("d.m.Y", strtotime($advert->premium)))), 'class' => 'edit-buybutton'))
            . "</span>";
    } else {
        echo HTML::anchor('packages/pay?advert=' . $advert->id . '&package=pack5',
            HTML::image('resources/images/prestig.png', array('data-tooltip' => __('package.description.premium'), 'class' => 'edit-buybutton')));
    }
    if ($advert->vip()) {
        echo "<span style='opacity:0.4'>" .
            HTML::image('resources/images/vip.png', array('data-tooltip' => __('package.description.vip.finished', array(':date' => date("d.m.Y", strtotime($advert->vip)))), 'class' => 'edit-buybutton'))
            . "</span>";
    } else {
        echo HTML::anchor('packages/pay?advert=' . $advert->id . '&package=pack2',
            HTML::image('resources/images/vip.png', array('data-tooltip' => __('package.description.vip'), 'class' => 'edit-buybutton')));
    }
    if ($advert->selected()) {
        echo "<span style='opacity:0.4'>" .
            HTML::image('resources/images/color.png', array('data-tooltip' => __('package.description.selected.finished', array(':date' => date("d.m.Y", strtotime($advert->selected)))), 'class' => 'edit-buybutton')) .
            "</span>";
    } else {
        echo HTML::anchor('packages/pay?advert=' . $advert->id . '&package=pack3',
            HTML::image('resources/images/color.png', array('data-tooltip' => __('package.description.selected'), 'class' => 'edit-buybutton')));
    }
    if ($advert->top()) {
        echo "<span style='opacity:0.4'>" .
            HTML::image('resources/images/up.png', array('data-tooltip' => __('package.description.top.finished', array(':date' => date("d.m.Y", strtotime($advert->top)))), 'class' => 'edit-buybutton buy-pack4'))
            . "</span>";
    } else {
        echo HTML::anchor('packages/pay?advert=' . $advert->id . '&package=pack3',
            HTML::image('resources/images/up.png', array('data-tooltip' => __('package.description.top'), 'class' => 'edit-buybutton')));
    }
    ?>
</div>