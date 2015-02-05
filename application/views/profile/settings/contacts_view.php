
<div class="form-title"><?php echo __('profile_page.settings.title.contacts_information'); ?></div>

<div class="control-group">
	<label class="control-label" for="profile_name"><?php echo __('profile_page.settings.label.name'); ?></label>
	<div class="controls"><?php echo $user->profile->name; ?></div>
</div>

<div class="control-group">
	<label class="control-label" for="profile_phone"><?php echo __('profile_page.settings.label.phone'); ?></label>
	<div class="controls">
		<?php echo $user->profile->phone; ?>
	</div>
</div>

<div class="control-group">
	<label class="control-label" for="profile_language"><?php echo __('profile_page.settings.label.language'); ?></label>
	<div class="controls"><?php echo $user->profile->default_locale;?></div>
</div>