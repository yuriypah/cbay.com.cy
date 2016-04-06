<div class="hero-unit">
	<h1><?php echo $ctx->page->title; ?></h1>
	<hr />

	<?php echo HTML::message(__('forgot_page.text.info')); ?>

	<?php echo Form::open(Route::url('user', array('action' => 'forgot')), array('method' => 'post', 'class' => 'form-inline')); ?>
	<?php echo Form::hidden('seturity_token', Security::token()); ?>

		<h5><?php echo __('forgot_page.label.username'); ?>:</h5>
		<?php
		echo Form::input('username', NULL, array(
			'maxlength' => 75,
			'id' => 'login-username-input', 'class' => 'login-field',
		));
		?>

		<?php
		Observer::notify('admin_login_forgot_form'); 
		
		echo Form::button('forgot', __('forgot_page.label.send'), array(
			'class' => 'btn btn-success'
		)); 

		echo '<br />';
		echo Form::error('errors.username', $messages_array);
		?>
<?php echo Form::close(); ?>
</div>