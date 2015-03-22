<div class="hero-unit">
	<h1><?php echo __('messages.advert.publish.title'); ?></h1>
	<hr />
	<? foreach($data as $advert) :?>
	<p><?php echo __('messages.advert.publish.info', array(
		':title' => HTML::anchor( Route::url('advert_view', array('id' => $advert->id)), $advert->part()->title))); ?></p>
	<? endforeach; ?>
</div>