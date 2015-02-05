<ul id="categories-counter">
	<?php if($data !== NULL): ?>
	<?php foreach ($data as $category): ?>
	<li>
		<?php echo HTML::anchor('/adverts/'.URL::query(array(
			'c' => $category->id
		)), $category->title); ?>
	</li>
	<?php endforeach; ?>
	<?php endif; ?>
</ul>