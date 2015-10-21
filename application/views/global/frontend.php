<?php echo HTML::doctype('html5'); ?>
<html xmlns="https://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo  $ctx->page->title; ?></title>
		<meta name="robots" content="index, follow" />
		<meta name="keywords" content="<?php echo $ctx->page->meta_keywords ?>" />
		<meta name="description" content="<?php echo $ctx->page->meta_description ?>" />
        <link href='https://fonts.googleapis.com/css?family=Russo+One&subset=latin,cyrillic' rel='stylesheet' type='text/css'/>
		<link rel="icon" href="/fav_new.png" type="image/x-icon" />

		<script type="text/javascript">
			var resources_path = "/<?php echo $resources_path; ?>";
			var directory = "<?php echo Request::current()->directory(); ?>";
			var controller = "<?php echo Request::current()->controller(); ?>";
			var action = "<?php echo Request::current()->action(); ?>";
		</script>
<?php
	foreach($styles as $style)  { echo "\t".Html::style($resources_path.$style)."\n"; }
	foreach($scripts as $script) { echo "\t".Html::script($resources_path.$script)."\n"; }
?>

	<?php echo $messages; ?>
	<?php Observer::notify('page_layout_head'); ?>
        <link rel="stylesheet" type="text/css" href="/plugins/jquery-ui/jquery-ui.min.css"/>
        <link rel="stylesheet" type="text/css" href="/plugins/jquery-ui/jquery-ui.theme.min.css"/>
        <script type="text/javascript" src="/plugins/jquery-ui/jquery-ui.js"></script>
	</head>
	<body id="body_<?php echo URL::title(str_replace('/', ' ', $ctx->uri), '_'); ?>">


		<div id="tooltip"></div>
		<div id="header" class="wrapper">
			<?php Block::run('header_block'); ?>
		</div>
		
		<?php Block::run('header_menu'); ?>
		
		<div class="wrapper">

			<?php Block::run('wrapper_top'); ?>
			
			<div id="container">
				<div id="container-content" class="<?php if($left_sidebar === TRUE): ?>leftSidebar<?php endif; ?> <?php if($right_sidebar === TRUE): ?>rightSidebar<?php endif; ?>">
					
					<?php Block::run('content_top'); ?>

					<?php echo $content; ?>
					<?php if(isset($pagination)): ?>
					<?php  echo $pagination; ?>
					<?php endif; ?>
					
					<?php Block::run('content_bottom'); ?>
				</div>
			</div>

			<?php if($left_sidebar === TRUE): ?>
			<div class="sidebar" id="sideLeft">
				<?php Block::run('left_menu_top'); ?>
				<?php Block::run('left_menu_middle'); ?>
				<?php Block::run('left_menu_bottom'); ?>
			</div><!-- .sidebar#sideLeft -->
			<?php endif; ?>
			<?php if($right_sidebar === TRUE): ?>
			<div class="sidebar" id="sideRight">
				<?php Block::run('right_menu_top'); ?>
				<?php Block::run('right_menu_middle'); ?>
				<?php Block::run('right_menu_bottom'); ?>
			</div><!-- .sidebar#sideRight -->
			<?php endif; ?>

			<div class="clear"></div>
			
			<?php Block::run('wrapper_bottom'); ?>
			<div id="footer">
				<?php Block::run('footer_block'); ?>
			</div>
		</div>
		
		<?php Observer::notify('page_layout_bottom'); ?>
        <?php // ProfilerToolbar::render(true); ?>
	</body>
</html>