<div class="auth-form" id="form_register">
	<div class="form-title"><?php echo __('place.title.register'); ?></div>

	<div class="control-group">
		<label class="control-label" for="login-password-input"><?php echo __('place.label.password'); ?>:</label>
		<div class="controls">
			<?php echo Form::password('password', NULL, array(
				'maxlength' => 100,
				'id' => 'login-password-input', 'class' => 'login-field',
				'title' => __('advert.tooltip.password', array(':num' => Model_User::PASSWORD_LENGTH))
			)); ?>

			<?php echo Form::error('errors.password', $messages_array); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="login-password-confirm-input"><?php echo __('place.label.confirm_password'); ?>:</label>
		<div class="controls">
			<?php echo Form::password('password_confirm', NULL, array(
				'maxlength' => 100,
				'id' => 'login-password-confirm-input', 'class' => 'login-field'
			)); ?>

			<?php echo Form::error('errors.password_confirm', $messages_array); ?>
		</div>
	</div>

	<div class="control-group">
		<div class="controls">
			<label class="checkbox">
				<?php 
					echo Form::checkbox('agree');
					echo __('register_page.rules.agree');
				?>

				<?php echo Form::error('errors.agree', $messages_array); ?>
			</label>

			<label class="checkbox">
				<?php 
					echo Form::checkbox('subscribe');
					echo __('register_page.rules.subscribe');
				?>
			</label>
		</div>
	</div>
</div>