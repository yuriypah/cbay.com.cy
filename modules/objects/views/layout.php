<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	.....
</head>
<body>
	<?php Block::run('header_block'); ?>
	<div class="container">
		<section id="middle">
			<?php Block::run('breadcrumbs'); ?>

			<div id="container">
				<div id="content">			
					<?php echo $content; ?>
				</div><!-- #content--> 
			</div><!-- #container--> 

			<?php if($left_sidebar === TRUE): ?>
			<div class="sidebar" id="sideLeft">
				<?php Block::run('left_menu_top'); ?>
				<?php Block::run('left_menu_middle'); ?>
				<?php Block::run('left_menu_bottom'); ?>>	
			</div><!-- .sidebar#sideLeft -->
			<?php endif; ?>
			<?php if($right_sidebar === TRUE): ?>
			<div class="sidebar" id="sideRight">
				<?php Block::run('right_menu_top'); ?>
				<?php Block::run('right_menu_middle'); ?>
				<?php Block::run('right_menu_bottom'); ?>
			</div><!-- .sidebar#sideRight -->
			<?php endif; ?>
		</section>

		<footer>
			....
		</footer>
	</div>
</body>
</html>