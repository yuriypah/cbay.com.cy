<div class="hero-unit">
	<h1><?php echo $ctx->page->title; ?></h1>
	<p><?php echo __('error.text'); ?></p>
	
	
	<br /><br />
	<ul>
		<li><?php echo HTML::anchor('/', __('error.label.goto_index_page')); ?></li>
		<li><?php echo HTML::anchor('/adverts', __('error.label.goto_adverts')); ?></li>
	</ul>
	
	<?php if(isset($message) AND !empty($message)): ?>
	<hr />
	<h3><?php echo __('error.label.reason'); ?></h3>
	<p><i><?php echo $message; ?></i></p>
	<?php endif; ?>
</div>



