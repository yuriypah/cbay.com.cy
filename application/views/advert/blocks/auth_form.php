<div class="auth-form" id="form_registered">

	<div class="form-title"><?php echo __('place.title.logged_in'); ?></div>
	<div class="control-group">
		<label class="control-label" for="login-username-input"><?php echo __('login_page.label.username'); ?>:</label>
		<div class="controls">
			<?php echo Form::input('email', Arr::get($data, 'email'), array(
				'maxlength' => 75,
				'id' => 'login-username-input', 'class' => 'login-field',
				'title' => __('advert.tooltip.login')
			)); ?>
			
			<?php echo Form::error('errors.email', $messages_array); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="login-password-input"><?php echo __('login_page.label.password'); ?>:</label>
		<div class="controls">
			<?php echo Form::password('password', NULL, array(
				'maxlength' => 100,
				'id' => 'login-password-input', 'class' => 'login-field',
				'title' => __('advert.tooltip.password')
			)); ?>
			
			<?php echo Form::error('errors.password', $messages_array); ?>
		</div>
	</div>
</div>