<div class="form-title">&nbsp;</div>

<div class="control-group">
	<label class="control-label"><?php echo __('profile_page.settings.label.adverts'); ?></label>
	<div class="controls">
		<div class="row">
			<div class="span2">
				<?php echo $count_adverts; ?>
			</div>
			<?php if($user->id == (string) Auth::instance()->get_user()): ?>
			<div class="span3">
				<?php echo HTML::anchor('advert/place', __('profile_page.settings.label.place_advert'), array('class' => 'btn btn-mini')); ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>