<div class="page-header">
	<h1><?php echo $ctx->page->title; ?></h1>
</div>
<div id="advert-categories-map">
	<?php $i = 0; ?>
	<?php foreach ( $categories as $row ): ?>
	<?php 
		$i++;
		$children = $row->children();
		$link = URL::query(array('c' => $row->id));
	?>
	<dl>
		<dt><a href="/adverts/<?php echo $link; ?>"><?php echo $row->title; ?></a></dt>
		<?php if(!empty($children)): ?>
		<?php foreach ( $children as $category ): ?>
		<?php 
			$link = URL::query(array('c' => $category->id));
		?>
		<dd><a href="/adverts/<?php echo $link; ?>"><?php echo $category->title; ?></a></dd>
		<?php endforeach; ?>
		<?php endif; ?>
	</dl>
	<?php if(($i % 4) == 0): ?>
	<div class="clear"></div>
	<?php endif; ?>
	<?php endforeach; ?>
</div>