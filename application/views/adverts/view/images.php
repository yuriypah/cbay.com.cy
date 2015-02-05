<?php $other_images = $advert->images->find_all(); ?>
<div id="advert-images">
	<div class="image-big">
		<?php 
		$title = $advert->part()->title . ' - <strong>' . $advert->amount() . '</strong>';
//                echo HTML::image( $advert->image('510_410') );
		?>
            <div class="big-img-conteiner" style="background: url('/<?= $advert->image('510_410') ?>') 50% 0;"></div>
	</div>

	<div class="images-small">
		<?php if(count($other_images) > 0): ?>
		<div class="image-small current">
			<?php 
				$_image = HTML::image( $advert->image('102_80') );
				echo HTML::anchor( $advert->image('full'), $_image, array(
					'class' => 'fancybox image-anchor', 'data-preview' => $advert->image,
					'data-tooltip' => $title, 'rel' => 'gallery',
				)); 
				?>
			<?php echo HTML::image( $advert->image('102_80') ); ?>
			<div class="overlay"></div>
		</div>
		<?php foreach ($other_images as $image): ?>
			<?php if($image->exists()): ?>
			<div class="image-small">
				<?php 
				$_image = HTML::image( $image->image('102_80') );
				echo HTML::anchor( $image->image('full') , $_image, array(
					'class' => 'fancybox image-anchor', 
					'rel' => 'gallery',
					'data-tooltip' => $title,
					'data-preview' => $image->image
				)); 
				?>
			</div>
			<?php endif; ?>
		<?php endforeach; ?>
		<?php endif; ?>
		<div class="clear"></div>
	</div>
	
</div>