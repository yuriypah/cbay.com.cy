<div id="advert-categories-map">
	<?php $i = 0; ?>
	<?php foreach ( $data as $row ): ?>
	<?php 
		$i++;
		$children = $row->children();
		$link = URL::query(array('c' => $row->id));
	?>
	<dl>
		<dt>
			<?php echo HTML::anchor('/adverts/' . $link, $row->title); ?>
		</dt>
		<?php if(!empty($children)): ?>
		<?php foreach ( $children as $category ): ?>
		<?php 
			$link = URL::query(array('c' => $category->id));
		?>
		<dd>
			<?php echo HTML::anchor('/adverts/' . $link, $category->title); ?>
		</dd>
		<?php endforeach; ?>
		<?php endif; ?>
	</dl>
	<?php if(($i % 4) == 0): ?>
	<div class="clear"></div>
	<?php endif; ?>
	<?php endforeach; ?>
</div>