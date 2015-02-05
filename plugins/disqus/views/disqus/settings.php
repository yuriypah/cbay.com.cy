<div class="control-group well">
	<?php echo Form::label('setting_disqus_id', 'ID профиля:', array('class' => 'control-label')); ?>
	<div class="controls">
		<?php echo Form::input('setting[disqus_id]', $plugin->get('disqus_id'), array(
			'id' => 'setting_disqus_id', 'class' => ''
		)); ?>
	</div>
</div>

<div class="control-group well">
	<?php echo Form::label('setting_counter_status', 'Показывать счетчик комментариев:', array('class' => 'control-label')); ?>
	<div class="controls">
		<label class="radio"><?php echo Form::radio( 'setting[counter_status]', 'on', $plugin->get('counter_status') == 'on' ); ?> Да</label>
		<label class="radio"><?php echo Form::radio( 'setting[counter_status]', 'off', $plugin->get('counter_status') == 'off' ); ?> Нет</label>
	</div>
</div>