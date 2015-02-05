<div id="breadcrumbs">
	<span>
		<?php echo HTML::anchor('adverts/'.URL::query(array('l' => $data['city_id'])), __('map.label.adverts_in_city', array(':city' => $data['city']))); ?>
	</span>
	<span class="separator">&nbsp;</span>
	<?php $i = 1; $total = count($data['path']); ?>

	<?php foreach ($data['path'] as $id => $title): ?>
	<?php echo HTML::anchor('adverts/'.URL::query(array('c' => $id)), $title); ?>
	
	<?php if($i < $total): ?>
	<span class="separator">&nbsp;</span>
	<?php endif; ?>
	<?php $i++; ?>
	<?php endforeach; ?>
	
	<?php if($data['prev_id'] OR $data['next_id']): ?>
	<div class="navigator">
		<div>
			<?php if($data['prev_id']): ?>
			<?php echo HTML::anchor('advert/'.$data['prev_id'], __('advert.label.previous')); ?>
			<?php endif; ?>
			<?php if($data['prev_id'] AND $data['next_id']): ?>
			<span> | </span>
			<?php endif; ?>
			<?php if($data['next_id']): ?>
			<?php echo HTML::anchor('advert/'.$data['next_id'], __('advert.label.next')); ?>
			<?php endif; ?>
		</div>
	</div>
	<?php endif; ?>

	<div class="clear"></div>
</div>