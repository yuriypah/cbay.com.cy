<script type="text/javascript">
$(function() {

	$("form").validate({
		errorElement: 'span',
		errorClass: "help-inline",
		rules: {
			'email': {
				required: true,
				email: true
			},
			'friend_email': {
				required: true,
				email: true
			},
			'friend_name':  "required"
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
	<?php echo Form::hidden('action', 'sendfriend'); ?>

	<div class="control-group">
		<label class="control-label" for="form-email"><?php echo __('advert.form.your_email'); ?></label>
		<div class="controls">
			<?php 
				echo Form::input('email', NULL,  array(
					'id' => 'form-email'
				));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="form-friend-name"><?php echo __('advert.form.friend_name'); ?></label>
		<div class="controls">
			<?php 
				echo Form::input('friend_name', NULL,  array(
					'id' => 'form-friend-name'
				));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="form-friend-email"><?php echo __('advert.form.friend_email'); ?></label>
		<div class="controls">
			<?php 
				echo Form::input('friend_email', NULL,  array(
					'id' => 'form-friend-email'
				));
			?>
		</div>
	</div>

	<div class="form-actions">
		<button name="action" value="sendfriend" class="btn btn-large"><?php echo __('advert.form.send') . ' ' . HTML::icon('chevron-right'); ?></button>
	</div>
<?php echo Form::close(); ?>