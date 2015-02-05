<div class="control-group well">
	<?php echo Form::label('setting_project_id', 'ID проекта:', array('class' => 'control-label')); ?>
	<div class="controls">
		<?php echo Form::input('setting[project_id]', $plugin->get('project_id', 00000), array(
			'id' => 'setting_project_id', 'class' => '', 'maxlength' => 10, 'size' => 10
		)); ?>
	</div>
</div>

<div class="control-group well">
	<?php echo Form::label('setting_project_host', 'Адрес проекта (*.reformal.ru):', array('class' => 'control-label')); ?>
	<div class="controls">
		<?php echo Form::input('setting[project_host]', $plugin->get('project_host', '.reformal.ru'), array(
			'id' => 'setting_project_host', 'class' => '', 'maxlength' => 100, 'size' => 100
		)); ?>
	</div>
</div>

<div class="control-group well">
	<?php echo Form::label('setting_tab_alignment', 'Позиция ярлыка:', array('class' => 'control-label')); ?>
	<div class="controls">
		<?php echo Form::select('setting[tab_alignment]', array(
				'left' => 'Слева',
				'right' => 'Справа'
			), $plugin->get('tab_alignment', 'right'), array('id' => 'setting_tab_alignment')); ?>
	</div>
</div>

<div class="control-group well">
	<?php echo Form::label('setting_tab_bg_color', 'Цвет ярлыка:', array('class' => 'control-label')); ?>
	<div class="controls">
		<?php echo Form::input('setting[tab_bg_color]', $plugin->get('tab_bg_color', '#F08200'), array(
			'id' => 'setting_tab_bg_color', 'class' => '', 'maxlength' => 7, 'size' => 7
		)); ?>
	</div>
</div>