<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $title; ?></title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	
<?php  
	foreach($styles as $style) echo "\t".Html::style($resources_path.$style).PHP_EOL;
	foreach($scripts as $script) echo "\t".Html::script($resources_path.$script).PHP_EOL;
?>
</head>
<!-- 
Created by ButscH & Dimon December 2011
butschster@gmail.com
-->
<body id="body_<?php echo URL::title(str_replace('/', ' ', $ctx->uri), '_'); ?>">
	<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<?php echo HTML::anchor(URL::base(), 'CBAY', array(
						'class' => 'brand'
					)); ?>

					<div class="nav-collapse">
						<ul class="nav ">
							<li>				
								<?php echo HTML::anchor(URL::site('register'), HTML::icon('user') . ' ' .__('User register')); ?>
							</li>
						</ul>
						
						<ul class="nav pull-right">
							<li>				
								<?php echo HTML::anchor(URL::base(), HTML::icon('chevron-left') . ' ' .__('Back to Homepage')); ?>
							</li>
						</ul>
					</div><!--/.nav-collapse -->	
				</div> <!-- /container -->
			</div> <!-- /navbar-inner -->
		</div> <!-- /navbar -->
		<div class="form-container well">
			<?php echo $messages; ?>

			<div class="content clearfix">
				<?php echo $content; ?>
			</div>
		</div>
</body>
</html>