<?php echo Form::open('profile/delete', array('method' => 'post', 'id' => 'form_profle_delete')); ?>
	<?php echo Form::hidden('token', Security::token()); ?>
	<div class="form-title"><?php echo __('profile_page.settings.title.delete_profile'); ?></div>

	<?php echo HTML::message(__('profile_page.settings.text.delete_info'), 'error'); ?>
	<button type="submit" name="delete" value="process" class="btn btn-danger"><?php echo __('profile_page.settings.label.delete') . ' ' . HTML::icon('trash icon-white'); ?></button>
<?php echo Form::close(); ?>