<div class="auth-form" id="form_noregister">
	<div class="form-title"><?php echo __('place.title.enter_password'); ?></div>

	<div class="control-group">
		<label class="control-label" for="login-password-input"><?php echo __('login_page.label.password'); ?>:</label>
		<div class="controls">
			<?php echo Form::password('password', NULL, array(
				'maxlength' => 100,
				'id' => 'login-password-input', 'class' => 'login-field',
				'title' => __('advert.tooltip.password', array(':num' => Model_User::PASSWORD_LENGTH))
			)); ?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="login-password-confirm-input"><?php echo __('login_page.label.confirm_password'); ?>:</label>
		<div class="controls">
			<?php echo Form::password('password_confirm', NULL, array(
				'maxlength' => 100,
				'id' => 'login-password-confirm-input', 'class' => 'login-field'
			)); ?>
		</div>
	</div>

	<div class="control-group">
		<div class="controls">
			<label class="checkbox">
				<?php 
					echo Form::checkbox('agree');
					echo __('register_page.rules.agree', FALSE, array(
						'title' => __('advert.tooltip.agree')
					));
				?>
			</label>
		</div>
	</div>
</div>