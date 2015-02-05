<div id="sub-menu">
	<div class="wrapper">
		<ul>
		<?php foreach ( $navigation as $page ): ?>
		<?php
		if ( !$page['active'] )
			continue;

		if ( !empty( $page['children'] ) ):
			$count = count($page['children']);
			$i = 0;
		?>
		<?php foreach ( $page['children'] as $child ): ?>
			<li class="<?php echo $child['active'] ? 'current' : ''; ?>"><?php echo HTML::anchor( $child['href'], $child['label']); ?></li>
			<?php if(++$i !== $count): ?>
			<li class="separator"></li>
			<?php endif; ?>
		<?php endforeach; ?>
		<?php endif; ?>
		<?php endforeach; ?>
		</ul>
		<div class="clear"></div>
	</div>
</div>