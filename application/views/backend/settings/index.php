<div class="page-header">
	<h1><?php echo $ctx->page->title; ?></h1>
</div>
<div>
    <button onclick="window.location.href = '/backend/settings/sortoptions'" class="btn btn-success">Настроить порядок выдачи опций в поиске</button>
</div>

<Br/>
<?php echo Form::open(NULL, array('class' => 'form-horizontal')); ?>

<div class="control-group well">
	<?php echo Form::label('setting_site_title', 'Заголовок сайта:', array('class' => 'control-label')); ?>
	<div class="controls">
		<?php echo Form::input('setting[site_title]', Model_Setting::get('site_title'), array('class' => 'input-xxlarge', 'id' => 'setting_site_title')); ?>
		<p class="help-block">Этот текст будет отображаться в панеле управления и может использоваться в темах.</p>
	</div>
</div>

<div class="control-group well">
	<?php echo Form::label('setting_date_format', 'Формат даты:', array('class' => 'control-label')); ?>
	<div class="controls">
		<?php
		echo Form::select('setting[date_format]', array(
			'Y-m-d' => '2011-12-14',
			'd.m.Y' => '14.12.2011',
			"Y/m/d" => "2011/12/14",
			"m/d/Y" => "12/14/2011",
			"d/m/Y" => "14/12/2011"
				), Model_Setting::get('date_format'), array('id' => 'setting_date_format'));
		?>
	</div>
</div>

<div class="control-group well">
	<?php echo Form::label('setting_display_errors', 'Вывод ошибок:', array('class' => 'control-label')); ?>
	<div class="controls">
		<?php echo Form::select('setting[display_errors]', array(
				'on' => 'Включен',
				'off' => 'Выключен',
			), Model_Setting::get('display_errors'), array('id' => 'setting_display_errors')); ?>
	</div>
</div>

<div class="form-actions">
	<?php echo Form::button('submit', 'Сохранить', array('icon' => HTML::icon('ok'))); ?>
</div>
<?php echo Form::close(); ?>