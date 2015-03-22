<div class="hero-unit">
	<h1><?php echo __('profile_page.changeemail.title'); ?></h1>
	<hr />
	<?php echo __('profile_page.changeemail.text.info'); ?>

	<br />
	
	<?php echo HTML::message(__('profile_page.changeemail.text.refer')); ?>

	<?php echo Form::open(NULL, array('method' => 'post', 'id' => 'form_profle_delete', 'class' => 'form-inline')); ?>
	<?php echo Form::hidden('token', Security::token()); ?>

	<h3 class="h3-small"><?php echo __('profile_page.changeemail.label.email'); ?></h3>
	<hr />
	<?php 
	echo Form::input('email', Arr::get($data, 'email'), array(
		'id' => 'profile_email', 'class' => 'input-xlarge'
	));
	echo " ".Form::button('delete', __('profile_page.changeemail.label.change'), array(
		'value' => 'confirm',
		'class' => 'btn'
	)); 

	echo Form::error('errors.email', $messages_array);
	
	echo Form::close(); 
	?>
</div>