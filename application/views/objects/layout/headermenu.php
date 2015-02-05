<div id="header-panel">
	<ul class="wrapper" id="header-menu">
		<?php
			$count = count($navigation);
			$i = 0;
		?>
		<?php foreach ( $navigation as $page ): ?>
		<?php
			if ( $page['secured'] === FALSE )
				continue;

			$li_class = array();

			if ( $page['active'] )
			{
				$li_class[] = 'current';
			}

			if ( $page['class'] )
			{
				$li_class[] = 'header_menu_' . $page['class'];
			}
		?>

		<li class="<?php echo implode( ' ', $li_class ); ?>">
			<?php echo HTML::anchor( $page['href'], $page['label']); ?>
		</li>
		
		<?php if(++$i !== $count): ?>
		<li class="separator"></li>
		<?php endif; ?>		
		<?php endforeach; ?>
	</ul>

	<div class="clear"></div>
	
	<?php Block::run('header_sub_menu'); ?>
</div>

