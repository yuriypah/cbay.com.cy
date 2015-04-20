<script type="text/javascript">
	var $option_id = <?php echo $option->pk(); ?>
</script>

<?php echo Form::open('/form-options-save', array('class' => 'form-horizontal ajax', 'id' => 'form_options_add')); ?>

<div class="row-fluid">
	<div class="span7">	
		<?php echo Form::hidden('option[id]', $option->pk()); ?>
		<?php echo Form::hidden('token', Security::token()); ?>
		<?php echo View::factory('lang/head', array(
			'parts' => $parts
		)); ?>
		<div class="control-group">
			<?php echo Form::label('form_advert_type_id', __('Option type'), array(
				'class' => 'control-label'
			)); ?>
			<div class="controls">
				<?php echo Form::select( 'option[type_id]', $types, $option->type_id, array(
					'class' => 'input-title span12', 'id' => 'form_advert_type_id')
				); ?>
			</div>
		</div>

		<div class="control-group">
			<?php echo Form::label('form_advert_category_id', __('Categories'), array(
				'class' => 'control-label'
			)); ?>
			<div class="controls">
				<?php echo Form::select( 'option[category_id][]', $categories, $option->categories(), array(
					'class' => 'input-title span12', 'id' => 'form_advert_category_id', 'size' => 15)
				); ?>
			</div>
		</div>
		
		<div class="form-title"><?php echo __('Parent option'); ?></div>

		<div class="control-group">
			<?php echo Form::label('form_advert_category_option_id', __('Value'), array(
				'class' => 'control-label'
			)); ?>
			<div class="controls">
				<?php echo Form::select( 'option[parent_id]', $related_options, (int)$option->parent_id, array(
					'class' => 'input-title span12', 'id' => 'form_advert_category_option_id', 'size' => 15)
				); ?>
			</div>
		</div>
	</div>
	<div class="span5">
        <fieldset>
            <legend>Параметры поля:</legend>
            Ползунок:
            <select name="option[ranged]">
                <option value="0" <? echo $option->ranged ==0 ? " selected='selected' " : "" ?>>Не отображать</option>
                <option value="1" <? echo $option->ranged == 1 ? " selected='selected' " : "" ?>>Одно значение</option>
                <option value="2" <? echo $option->ranged == 2 ? " selected='selected' " : "" ?>>Диапазон значений</option>
            </select><Br/>
            Минимальное значение:&nbsp; <input value="<?php echo $option->ranged_min ?>" type="text" style="width:60px" name="option[ranged_min]"/><Br/>
            Максимальное значение: <input value="<?php echo $option->ranged_max ?>" type="text" style="width:60px" name="option[ranged_max]"/>
        </fieldset>
		<?php echo $values; ?>
	</div>
</div>
	<div class="form-actions">
		<?php echo Form::button('submit', 'Сохранить', array('icon' => HTML::icon('ok', TRUE))); ?>
	</div>

<?php echo Form::close(); ?>