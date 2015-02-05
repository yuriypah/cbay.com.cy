<div class="form-title"><?php echo __('profile_page.settings.title.roles'); ?></div>

<?php echo Form::open('/form-profile-roles', array('class' => 'ajax', 'id' => 'form_profle_edit_roles')); ?>
<?php echo Form::hidden('user_id', $user->id); ?>
<?php echo Form::hidden('token', Security::token(FALSE)); ?>
<div class="control-group">
	<?php foreach ($permissions as $perm): ?>
	<label class="checkbox inline" for="userEditPerms<?php echo ucwords($perm->name); ?>">
	<?php echo Form::checkbox('user_permission['.$perm->name.']', $perm->id, in_array($perm->id, $user_permissions), array(
		'id' => 'userEditPerms' . ucwords($perm->name)
	)) . ' ' .__(ucwords($perm->name)); ?>
	</label>
	<?php endforeach; ?>
</div>

<div class="form-actions">
	<button type="submit" class="btn"><?php echo __('profile_page.settings.label.save') . ' ' . HTML::icon('chevron-right'); ?></button>
</div>
<?php echo Form::close(); ?>