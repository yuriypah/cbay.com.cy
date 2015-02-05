<?php echo Form::open('/form-profile-messages', array('method' => 'post', 'class' => 'ajax', 'id' => 'form_profle_edit_messages')); ?>
<?php echo Form::hidden('token', Security::token()); ?>

<div class="form-title"><?php echo __('profile_page.settings.title.messages'); ?></div>

<?php echo HTML::message(__('profile_page.settings.text.messages_info')); ?>

<div class="control-group">
	<label class="checkbox inline">
		<?php echo Form::checkbox('message[notice]', 1, $user->profile->notice == 1, array('id' => 'message_notice')); ?>
		<?php echo __('profile_page.settings.label.notice'); ?>
	</label>

	<label class="checkbox inline">
		<?php echo Form::checkbox('message[remiders]', 1, $user->profile->remiders == 1, array('id' => 'message_remiders')); ?>
		<?php echo __('profile_page.settings.label.remiders'); ?>
	</label>
</div>
<div class="form-actions">
	<button type="submit" class="btn"><?php echo __('profile_page.settings.label.save') . ' ' . HTML::icon('chevron-right'); ?></button>
</div>


<?php echo Form::close(); ?>