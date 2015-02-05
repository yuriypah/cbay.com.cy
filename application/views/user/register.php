<!-- Страница регистрации -->


<div class="page-header">
	<h1><?php echo $ctx->page->title; ?></h1>
</div>

<?php echo HTML::message( __('register_page.text.info') ); ?>

<?php echo Form::open( Route::url( 'user', array('action' => 'register') ), array('method' => 'post', 'class' => 'form-horizontal') ); ?>
	<?php echo Form::hidden( 'seturity_token', Security::token() ); ?>
	
	<div class="control-group">
		<div class="controls">
			<label class="radio inline">
				<?php 
					echo Form::radio('type', Model_User_Profile::TYPE_PRIVATE, TRUE);
					echo __('register_page.label.private');
				?>
			</label>
			<label class="radio inline">
				<?php 
					echo Form::radio('type', Model_User_Profile::TYPE_COMPANY);
					echo __('register_page.label.company');
				?>
			</label>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="name"><?php echo __('register_page.label.name'); ?></label>
		<div class="controls">
			<?php 
				echo Form::input('name', NULL, array(
					'id' => 'name', 'class' => 'input-xlarge',
                                        'title' => __('register_page.tooltip.name')
				));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="email"><?php echo __('register_page.label.email'); ?></label>
		<div class="controls">
			<?php 
				echo Form::input('email', NULL, array(
					'id' => 'email', 'class' => 'input-large',
                                        'title' => __('register_page.tooltip.email')
				));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="phone"><?php echo __('register_page.label.phone'); ?></label>
		<div class="controls">
			<?php 
				echo Form::input('phone', NULL, array(
					'id' => 'phone', 'class' => 'input-large',
                                        'title' => __('register_page.tooltip.phone')
				));
			?>
		</div>
	</div>
	<!--<div class="control-group">
		<label class="control-label" for="skype"><?php echo __('register_page.label.skype'); ?></label>
		<div class="controls">
			<?php 
				echo Form::input('skype', NULL, array(
					'id' => 'phone', 'class' => 'input-large',
                                        'title' => __('register_page.tooltip.skype')
				));
			?>
		</div>
	</div>-->
	<?php if(Model_Lang_Part::count() > 1): ?>
	<div class="control-group">
		<label class="control-label" for="language"><?php echo __('register_page.label.language'); ?></label>
		<div class="controls">
			<?php echo Form::locales(NULL, 'default_locale'); ?>
		</div>
	</div>
	<?php else: ?>
	<?php echo Form::locales(NULL, 'default_locale'); ?>
	<?php endif; ?>

	<div class="control-group">
		<label class="control-label" for="password"><?php echo __('register_page.label.password'); ?></label>
		<div class="controls">
			<?php 
				echo Form::password('password', NULL, array(
					'id' => 'password', 'class' => 'input-large',
                                        'title' => __('register_page.tooltip.password', array(':num' => 8))
				));
			?>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label" for="password_confirm"><?php echo __('register_page.label.confirm_password'); ?></label>
		<div class="controls">
			<?php 
				echo Form::password('password_confirm', NULL, array(
					'id' => 'password_confirm', 'class' => 'input-large',
                                        'title' => __('register_page.tooltip.password_repeat')
				));
			?>
		</div>
	</div>

    <div class="control-group">

        <div class="controls">
        <div class="license">
            <?php echo $license; ?>
        </div>
            </div>
    </div>


	<div class="control-group">
		<div class="controls">
			<label class="checkbox">
				<?php 
					echo Form::checkbox('rule_agree');
					echo __('register_page.rules.agree');
				?>
			</label>

			<label class="checkbox">
				<?php 
					echo Form::checkbox('rule_subscribe');
					echo __('register_page.rules.subscribe');
				?>
			</label>
		</div>
	</div>
	
	<div class="form-actions">
		<button type="submit" disabled="disabled" class="btn btn-large btn-success"><?php echo __('register_page.label.register') . ' ' . HTML::icon('chevron-right'); ?></button>
	</div>

<?php echo Form::close(); ?>
<script>
    $(document).ready(function() {
       $("input[name=rule_agree]").click(function() {
            $(".form-actions [type=submit]").attr('disabled', !this.checked);
       });
    });
</script>