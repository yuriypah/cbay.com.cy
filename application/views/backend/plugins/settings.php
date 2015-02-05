<div class="page-header">
	<h1><?php echo $ctx->page->title; ?></h1>
</div>

<div id="settings" class="box2">
	<?php echo Form::open(NULL, array('class' => 'form-horizontal')); ?>
	
	<?php echo View::factory($plugin->id.'/settings', array(
		'plugin' => $plugin
	)); ?>

	<div class="form-actions">
		<?php echo Form::button('submit', 'Сохранить', array('icon' => HTML::icon('ok'))); ?>
	</div>
	<?php echo Form::close(); ?>
</div>