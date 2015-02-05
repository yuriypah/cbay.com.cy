<div class="page-header">
	<h1><?php echo $ctx->page->title; ?></h1>
</div>

<div class="row-fluid">
	<div class="span6" id="login-form">
		<?php echo Form::open( Route::url( 'user', array( 'action' => 'login' ) ), array( 'method' => 'post', 'class' => 'form-horizontal' ) ); ?>
			<?php echo Form::hidden( 'seturity_token', Security::token() ); ?>
			<?php echo Form::hidden( 'remember', TRUE ); ?>
			<?php echo Form::hidden( 'next', Input::get( 'next', '/' ) ); ?>

		
			<div class="control-group">
				<label class="control-label" for="login-username-input"><?php echo __( 'login_page.label.username' ); ?>:</label>
				<div class="controls">
					<?php
					echo Form::input( 'username', NULL, array(
						'maxlength' => 75,
						'id' => 'login-username-input', 'class' => 'input-large'
					) );
					?>
				</div>
			</div>
		
			<div class="control-group">
				<label class="control-label" for="login-password-input"><?php echo __( 'login_page.label.password' ); ?>:</label>
				<div class="controls">
					<?php echo Form::password( 'password', NULL, array(
						'maxlength' => 100,
						'id' => 'login-password-input', 'class' => 'input-medium'
					) ); ?>
					<?php echo HTML::anchor('/forgot/', __('login_page.label.forgot_password'), array('class' => 'btn btn-danger btn-mini')); ?>
				</div>
			</div>
		
			<div class="control-group">
				<div class="controls">
					<label class="checkbox">
						<?php echo Form::checkbox('remember'); ?>
						<?php echo __( 'login_page.label.remember' ); ?>
					</label>
				</div>
			</div>
		
			<?php Observer::notify( 'admin_login_form' ); ?>
		
			

			<div class="control-group">
				<div class="controls">
					<button name="action" value="next" class="btn btn-large btn-success"><?php echo __( 'login_page.label.login' ); ?> <i class="icon-chevron-right"></i></button>
				</div>
			</div>
		<?php echo Form::close(); ?>
	</div>
	<div class="span6" id="login-benefits">
		<div class="inner">
			<h4>Ещё не зарегистрированы?</h4>
			<p>Для того, чтобы разместить объявление на сайте, не нужно быть зарегистрированным пользователем.</p>

			<br>
			<h4 class="benefits">Но только зарегистрированные пользователи могут:</h4>
			<ul>
				<li>Подавать более одного объявления</li>
				<li>Управлять своими объявлениями в Личном кабинете</li>
			</ul>

			<br>
			
			<h4><?php echo HTML::anchor('/register/', __('login_page.label.register')); ?></h4>
		</div>

	</div>

	<div class="clear"></div>
</div>