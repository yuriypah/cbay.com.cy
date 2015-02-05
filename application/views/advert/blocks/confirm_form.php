<fieldset id="change_auth_form">
	<legend><?php echo __('Would you like to register?'); ?></legend>
	
	<div class="control-group">
		<div class="controls">
			<label class="radio">
				<?php 
					echo Form::radio('user_action', 'noregister', Arr::get($data, 'user_action', 'noregister') == 'noregister');
					echo HTML::label(__('Not now'), 'warning');
				?>
			</label>
			<label class="radio">
				<?php 
					echo Form::radio('user_action', 'register', Arr::get($data, 'user_action') == 'register');
					echo HTML::label(__('I want to register'));
				?>
			</label>
			
			<label class="radio">
				<?php 
					echo Form::radio('user_action', 'registered', Arr::get($data, 'user_action') == 'registered');
					echo HTML::label(__('Already registered'), 'success');
				?>
			</label>
		</div>
	</div>
	
</fieldset>

<?php echo View::factory('advert/noregister_form', array('data' => $data)); ?>
<?php echo View::factory('advert/register_form', array('data' => $data)); ?>
<?php echo View::factory('advert/auth_form', array('data' => $data)); ?>