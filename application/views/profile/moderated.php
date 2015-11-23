<?php
echo View::factory('profile/advertsmenu',array(
    'counts' => $counts,
    'current' => 'moderated'
));
?>
<?php if(count($adverts) > 0): ?>
<div id="adverts-list" class="type-edit">
	<?php
	echo View::factory( 'adverts/list/blocked', array(
		'adverts' => $adverts
	) );
	?>
	
	<div class="clear"></div>
</div>
<?php else: ?>
<div class="hero-unit">
	<h1><?php echo __('profile_page.moderated.title'); ?></h1>
	<hr />
	<p class="lead"><?php echo __('profile_page.moderated.what_is'); ?></p>
</div>
<?php endif; ?>
