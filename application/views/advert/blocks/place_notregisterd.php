<div class="control-group <?php echo Arr::path($messages_array, 'errors.type') ? 'error' : ''; ?>">
	<div class="controls">
		<label class="radio inline">
			<?php 
				echo Form::radio('type', Model_User_Profile::TYPE_PRIVATE, Arr::get($data, 'type', TRUE) == Model_User_Profile::TYPE_PRIVATE);
				echo __('place.label.private');
			?>
		</label>
		<label class="radio inline">
			<?php 
				echo Form::radio('type', Model_User_Profile::TYPE_COMPANY, Arr::get($data, 'type') == Model_User_Profile::TYPE_COMPANY);
				echo __('place.label.company');
			?>
		</label>
		
		<?php echo Form::error('errors.type', $messages_array); ?>
	</div>
</div>

<div class="control-group <?php echo Arr::path($messages_array, 'errors.name') ? 'error' : ''; ?>">
	<label class="control-label" for="name"><?php echo __('place.label.name'); ?></label>
	<div class="controls">
		<?php 
			echo Form::input('name', Arr::get($data, 'name'), array(
				'id' => 'name', 'class' => 'input-large',
				'title' => __('advert.tooltip.name')
			));
		?>
		
		<?php echo Form::error('errors.name', $messages_array); ?>
	</div>
</div>

<div class="control-group <?php echo Arr::path($messages_array, 'errors.email') ? 'error' : ''; ?>">
	<label class="control-label" for="email"><?php echo __('place.label.email'); ?></label>
	<div class="controls">
		<?php 
			echo Form::input('email', Arr::get($data, 'email'), array(
				'id' => 'email', 'class' => 'input-large',
				'title' => __('advert.tooltip.email')
			));
		?>
		
		<?php echo Form::error('errors.email', $messages_array); ?>
	</div>
</div>

<div class="control-group">
	<div class="controls">
		<label class="checkbox">
		<?php 
			echo Form::checkbox('allow_mails', 1, Arr::get($data, 'allow_mails') == Model_Advert::MAILS_NOT_ALLOW, array(
				'title' => __('advert.tooltip.allow_mails')
			)) . ' ';
			echo __('place.label.allow_mails');
		?>
		</label>
	</div>
</div>

<div class="control-group">
	<label class="control-label" for="phone"><?php echo __('place.label.phone'); ?></label>
	<div class="controls">
		<?php 
			echo Form::input('phone', Arr::get($data, 'phone'), array(
				'id' => 'phone', 'class' => 'input-large', 'title' => __('advert.tooltip.phone')
			));
		?>
		
		<?php echo Form::error('errors.phone', $messages_array); ?>
	</div>
</div>
   <!-- <div class="control-group">
		<label class="control-label" for="phone"><?php echo __('place.label.skype'); ?></label>
		<div class="controls">
			<?php
				echo Form::input('skype', Arr::get($data, 'skype'),array(
					'id' => 'skype', 'class' => 'input-large', 'title' => __('advert.tooltip.skype')
				));
			?>

			<?php echo Form::error('errors.skype', $messages_array); ?>
		</div>
    </div>-->