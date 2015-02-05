<?php if(count($data['adverts']) > 0): ?>
<div id="related-adverts">
	<h4><?php echo __('advert.label.related'); ?></h4>

	<ul>
		<?php foreach ($data['adverts'] as $advert): ?>
		<li>
			<?php if( $advert->image_exists('96_78') ): ?>
			<div class="image"><?php echo HTML::anchor('advert/'. $advert->id, HTML::image( $advert->image('96_78') )); ?></div>
			<?php else: ?>
			<?php echo HTML::anchor('advert/'.$advert->id, NULL, array('class' => 'no-image')); ?>
			<?php endif; ?>
			<div class="link">
				<?php echo HTML::anchor('advert/'. $advert->id, $advert->title); ?>
			</div>
			<div class="price"><?php echo $advert->amount(); ?></div>
		</li>
		<?php endforeach; ?>
	</ul>

	<div class="clear"></div>
</div>
<?php endif; ?>