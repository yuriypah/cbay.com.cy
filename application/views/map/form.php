<?php
	$filed = ($field === NULL) ? 'city_id' : $field.'[city_id]';
?>

<div id="geo_form">
	<div class="control-group" id="form_city_block">
		<?php echo Form::label('form_city', __('map.label.city'), array('class' => 'control-label')); ?>
		<div class="controls">
			<?php echo Form::select($filed, Model_Map::$cities, $city_id, array('id' => 'form_city', 'title' => __('advert.tooltip.city'))); ?>
		</div>
	</div>
</div>