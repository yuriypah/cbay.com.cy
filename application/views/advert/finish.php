<div class="hero-unit">
	<h1><?php echo $ctx->page->title; ?></h1>
	<hr />
	
	<p><?php echo __('place.text.advert_added_info', array(
		':advert' => HTML::anchor('advert/' . $advert->id, $advert->part()->title)
	)); ?>
	</p>
	<hr />
	
	<p><?php echo __('place.text.advert_added_manage', array(
		':url' => HTML::anchor('profile', __('menu.label.profile.index'))
	)); ?></p>
</div>
