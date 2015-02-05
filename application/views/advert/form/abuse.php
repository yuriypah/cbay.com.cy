<script type="text/javascript">
$(function() {

	$("form").validate({
		errorElement: 'span',
		errorClass: "help-inline",
		rules: {
			'description': "required",
			'category':  "required"
		},
		highlight: function( element, errorClass, validClass ) {
			$(element).parent().parent().addClass('error').removeClass(validClass);
		},
		unhighlight: function( element, errorClass, validClass ) {
			$(element).parent().parent().removeClass('error').addClass(validClass);
		}
	});

});
</script>

<hr />

<?php echo Form::open('form-message-send', array(
	'class' => 'ajax form-horizontal', 'data-trigger' => 'advert-form-send'
)); ?>

	<?php echo Form::hidden('advert_id', (int) Input::post('advert_id')); ?>
	<?php echo Form::hidden('token', Security::token(FALSE)); ?>
	<?php echo Form::hidden('action', 'abuse'); ?>

	<div class="control-group">
		<label class="control-label" for="form-name">
			<?php echo __('advert.form.abuse_category'); ?>
		</label>
		<div class="controls">
			<?php 
				echo Form::select('category', Model_Message::abuse(), NULL, array(
					'class' => 'span7'
				));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="comment"><?php echo __('advert.form.comment'); ?></label>
		<div class="controls">
			<?php 
				echo Form::textarea('description', NULL, array(
					'id' => 'comment', 'class' => 'span7'
				));
			?>
			<p class="help-block"><?php echo __('advert.form.comment_help'); ?></p>
		</div>
	</div>

	<div class="form-actions">
		<button name="action" value="abuse" class="btn btn-large"><?php echo __('advert.form.send') . ' ' . HTML::icon('chevron-right'); ?></button>
	</div>
<?php echo Form::close(); ?>