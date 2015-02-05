<div class="hero-unit">

	<h1><?php echo __('profile_page.delete.title'); ?></h1>

	<hr />
	<div class="alert alert-block">
		<h4 class="alert-heading"><?php echo __('profile_page.delete.label.warning'); ?></h4>
		<p><?php echo __('profile_page.delete.text'); ?></p>
	</div>


	<?php echo Form::open(NULL, array('method' => 'post', 'class' => 'form-horizontal', 'id' => 'form_profle_delete')); ?>
	<?php echo Form::hidden('token', Security::token()); ?>

	<button type="submit" name="delete" value="confirm" class="btn btn-large">
		<?php echo __('profile_page.delete.label.confirm') . ' ' . HTML::icon('trash'); ?>
	</button>

	<?php echo Form::close(); ?>
</div>