<?php foreach ($adverts as $advert): ?>
<? if($advert->vip()) :?>
<div class="item <?php echo $advert->selected() ? 'selected' : ''; echo $advert->premium() ? 'selected' : '';  ?>" data-id="<?php echo $advert->id; ?>">
    <div class="image">
		<?php 
		if( $advert->image_exists('235_175') )
		{
			$image = HTML::image( $advert->image('235_175'), array('title' => $advert->title(), 'alt' => $advert->title()) );
			echo HTML::anchor('advert/'.$advert->id, $image);
		}
		else
			echo HTML::anchor('advert/'.$advert->id, NULL, array('class' => 'no-image', 'title' => $advert->title()));
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
<? endif; ?>
<?php endforeach; ?>