<div class="form-title"><?php echo __('profile_page.settings.title.personal_information'); ?></div>

<div class="control-group">
	<label class="control-label"><?php echo __('profile_page.settings.label.username'); ?></label>
	<div class="controls">
		<?php echo $user->username; ?>
	</div>
</div>

<div class="control-group">
	<label class="control-label"><?php echo __('profile_page.settings.label.email'); ?></label>
	<div class="controls">
		<div class="row">
			<div class="span2">
				<?php echo $user->email; ?>
			</div>
			
			<?php if($user->id == (string) Auth::instance()->get_user()): ?>
			<div class="span3">
				<?php echo HTML::anchor('profile/changeemail', __('profile_page.settings.label.change_email'), array('class' => 'btn btn-mini')); ?>
			</div>
			<?php endif; ?>
		</div>
		<div class="clear"></div>
	</div>
</div>

<div class="control-group">
	<label class="control-label"><?php echo __('profile_page.settings.label.registered'); ?></label>
	<div class="controls">
		<?php echo Date::format($user->profile->created, 'd F Y'); ?>
	</div>
</div>

<div class="control-group">
	<label class="control-label"><?php echo __('profile_page.settings.label.profile_type'); ?></label>
	<div class="controls">
		<?php echo __($user->profile->type()); ?>
	</div>
</div>