<div class="hero-unit">
	<h1><?php echo __('messages.advert.unpublish.title'); ?></h1>
	<hr />
	
	<p class="lead"><?php echo __('messages.advert.unpublish.info'); ?></p>
	<hr />
	
	<p><?php echo __('messages.advert.unpublish.reason_text'); ?></p>
	
	<?php echo Form::open(NULL, array(
		'class' => 'form-inline'
	)); ?>
		<?php echo Form::hidden('advert_id', $id); ?>

		<ul class="unstyled">
			<li>
				<?php echo Form::radio('reason', Model_Advert::STATUS_SOLD_SITE, TRUE, array(
					'id' => 'reason_site'
				)); ?>
				<?php echo Form::label('reason_site', __(Model_Advert::$status[Model_Advert::STATUS_SOLD_SITE])); ?>
			</li>
			<li>
				<?php echo Form::radio('reason', Model_Advert::STATUS_SOLD_OTHER, FALSE, array(
					'id' => 'reason_other'
				)); ?>
				<?php echo Form::label('reason_other', __(Model_Advert::$status[Model_Advert::STATUS_SOLD_OTHER])); ?>
			</li>
			<li>
				<?php echo Form::radio('reason', Model_Advert::STATUS_OFF, FALSE, array(
					'id' => 'reason_off'
				)); ?>
				<?php echo Form::label('reason_off', __(Model_Advert::$status[Model_Advert::STATUS_OFF])); ?>
			</li>
		</ul>
		
		<?php echo Form::submit('unpublish', 'Снять объявление с продажи', array(
			'class' => 'btn btn-warning'
		)); ?>
		
		<?php echo HTML::anchor(Route::url( 'profile'), 'Отмена', array(
			'class' => 'btn'
		)); ?>
	<?php echo Form::close(); ?>
</div>
