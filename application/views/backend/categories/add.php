<?php echo Form::open('/form-category-save', array('class' => 'form-horizontal ajax', 'id' => 'form_category_add')); ?>
	<?php echo Form::hidden('category[id]', $category->pk()); ?>
	<?php echo Form::hidden('token', Security::token()); ?>

	<?php echo View::factory('lang/head', array(
		'parts' => $parts
	)); ?>

	<div class="form-title"><?php echo __('Category options'); ?></div>

	<div class="control-group">
		<?php echo Form::label('form_advert_category_group_id', __('Group'), array(
			'class' => 'control-label'
		)); ?>
		<div class="controls">
			<?php echo Form::select( 'category[parent_id]', $groups,  $category->parent_id, array(
				'class' => 'input-title', 'id' => 'form_advert_category_group_id')
			); ?>
		</div>
	</div>

	<div class="control-group">
		<?php echo Form::label('form_advert_category_ration', __('Ratio'), array(
			'class' => 'control-label'
		)); ?>
		<div class="controls">
			<?php echo Form::input( 'category[ratio]', 1, array(
				'class' => 'input-title', 'id' => 'form_advert_category_ratio')
			); ?>
		</div>
	</div>

	<div class="form-actions">
		<?php echo Form::button('submit', 'Сохранить', array('icon' => HTML::icon('ok', TRUE))); ?>
	</div>

<?php echo Form::close(); ?>