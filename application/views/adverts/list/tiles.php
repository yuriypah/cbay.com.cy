<?php  foreach ($adverts as $advert): ?>
<div class="item<?php echo $advert->selected() ? ' selected' : ''; echo $advert->premium() ? ' selected' : '';  ?>" data-id="<?php echo $advert->id; ?>">
        <div class="list-img-pack">
            <? if($advert->premium()) {?>
                <?= HTML::image('resources/images/prestig.png', array('data-tooltip' => __('package.option.title.premium'))); ?>
            <? } ?>
            <? if($advert->vip()) {?>
                <?= HTML::image('resources/images/vip.png', array('data-tooltip' => __('package.option.title.vip'))); ?>
            <? } ?>
            <? if($advert->selected()) {?>
                <?= HTML::image('resources/images/color.png', array('title' => __('package.option.title.selected'))); ?>
            <? } ?>
            <? if($advert->top()) {?>
                <?= HTML::image('resources/images/up.png', array('title' => __('package.option.title.top'))); ?>
            <? } ?>
        </div>
        <div class="image" style='position:relative'>
		<?php

		if( $advert->image_exists('235_175') )
		{
			$image = HTML::image( $advert->image('235_175'), array('title' => $advert->title(), 'alt' => $advert->title()) );
			echo HTML::anchor('advert/'.$advert->id, $image);
		}
		else
			echo HTML::anchor('advert/'.$advert->id, NULL, array('class' => 'no-image', 'title' => $advert->title()));
		?>
        <?
        $count_other = $advert->images->count_all();
        if($advert->image_exists('235_175')) {
            $count_other++;
        }
        if($count_other > 0) {
            echo "<div style='
background: url(/resources/images/photo-icons-sprite.png) no-repeat 0 0;
width: 20px;
height: 18px;
position: absolute;
bottom: -2px;
right: -1px;
z-index: 100;
font-weight: 700;
line-height: 21px;
font-size: 9px;
color: white;
text-align: center;
'>".$count_other."</div>";

        }
        ?>
	</div>
	<div class="content">
		<?php echo HTML::anchor('advert/'.$advert->id, $advert->title(), array('class' => 'title')); ?>
		<div class="clear"></div>

		<div class="price"><?php echo $advert->amount(); ?></div>
		<div class="city"><?php echo __('advert_page.label.city') . ': '. $advert->city(); ?>

        </div>
        <div class="clear"></div>
        <div class="tiles-seller">
            <?php
            if($advert->user->profile->type == 2) {
                echo "<span style='color:gray'>".__("profile_page.settings.label.type.company").":</span> <a href='#'>".$advert->user->profile->name."</a>";
            }
            ?>
        </div>


	</div>
</div>

<?php endforeach; ?>