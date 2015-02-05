<?php echo Form::open('/form-profile-password_change', array('method' => 'post', 'id' => 'form_profle_edit_contacts')); ?>
<?php echo Form::hidden('token', Security::token()); ?>

<div class="form-title"><?php echo __('profile_page.settings.title.password_change'); ?></div>

<?php echo HTML::message(__('profile_page.settings.text.password_info')); ?>

<div class="control-group <?php echo Arr::path($messages_array, 'errors.current_password') ? 'error' : ''; ?>">
	<label class="control-label" for="profile_password_current"><?php echo __('profile_page.settings.label.current_password'); ?></label>
	<div class="controls">
		<?php echo Form::password('current_password', NULL, array('id' => 'profile_password_current')); ?>
		
		<?php echo Form::error('errors.current_password', $messages_array); ?>
	</div>
</div>

<div class="control-group <?php echo Arr::path($messages_array, 'errors.password') ? 'error' : ''; ?>">
	<label class="control-label" for="profile_password"><?php echo __('profile_page.settings.label.new_password'); ?></label>
	<div class="controls">
		<?php echo Form::password('password', NULL, array('id' => 'profile_password')); ?>

		<?php echo Form::error('errors.password', $messages_array); ?>
	</div>
</div>

<div class="control-group <?php echo Arr::path($messages_array, 'errors.password_confirm') ? 'error' : ''; ?>">
	<label class="control-label" for="profile_password_confirm"><?php echo __('profile_page.settings.label.confirm_password'); ?></label>
	<div class="controls">
		<?php echo Form::password('password_confirm', NULL, array('id' => 'profile_password_confirm')); ?>

		<?php echo Form::error('errors.password_confirm', $messages_array); ?>
	</div>
</div>

<div class="form-actions">
	<button type="submit" class="btn"><?php echo __('profile_page.settings.label.change_password') . ' ' . HTML::icon('chevron-right'); ?></button>
</div>
<?php echo Form::close(); ?>