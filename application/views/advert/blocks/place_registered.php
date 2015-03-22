
<?php echo Form::hidden('type', $ctx->user->profile->type); ?>
	
	<div class="control-group <?php echo Arr::path($messages_array, 'errors.name') ? 'error' : ''; ?>">
		<label class="control-label" for="name"><?php echo __('place.label.name'); ?></label>
		<div class="controls">
			<div class="row">
				<div class="span2">
					<?php 
						echo Form::hidden('name', $ctx->user->profile->name);
						echo $ctx->user->profile->name;
					?>
				</div>
				<div class="span3">
					<?php echo HTML::anchor('profile/settings#profile_name', __('place.label.change_name'), array(
						'class' => 'btn btn-mini'
					));?>
				</div>
			</div>
		</div>
	</div>

	<div class="control-group <?php echo Arr::path($messages_array, 'errors.email') ? 'error' : ''; ?>">
		<label class="control-label" for="email"><?php echo __('place.label.email'); ?></label>
		<div class="controls">
			<div class="row">
				<div class="span2">
					<?php 
						echo Form::hidden('email', $ctx->user->email);
						echo $ctx->user->email;
					?>
				</div>
				<div class="span3">
					<?php echo HTML::anchor('profile/changeemail', __('place.label.change_email'), array(
						'class' => 'btn btn-mini'
					));?>
				</div>
			</div>
		</div>
	</div>
	
	<!--<div class="control-group">
		<div class="controls">
			<label class="checkbox">
			<?php 
				echo Form::checkbox('allow_mails', 'no', Arr::get($data, 'allow_mails') == Model_Advert::MAILS_NOT_ALLOW, array(
					'title' => __('advert.tooltip.allow_mails')
				)) . ' ';
				echo __('place.label.allow_mails');
			?>
			</label>
		</div>
	</div>-->

	<div class="control-group">
		<label class="control-label" for="phone"><?php echo __('place.label.phone'); ?></label>
		<div class="controls">
			<?php 
				echo Form::input('phone', $ctx->user->profile->phone, array(
					'id' => 'phone', 'class' => 'input-large', 'title' => __('advert.tooltip.phone')
				));
			?>
			
			<?php echo Form::error('errors.phone', $messages_array); ?>
		</div>
	</div>
    <!--<div class="control-group">
		<label class="control-label" for="phone"><?php echo __('place.label.skype'); ?></label>
		<div class="controls">
			<?php
				echo Form::input('skype', $ctx->user->profile->skype,array(
					'id' => 'skype', 'class' => 'input-large', 'title' => __('advert.tooltip.skype')
				));
			?>

			<?php echo Form::error('errors.skype', $messages_array); ?>
		</div>
    </div>-->