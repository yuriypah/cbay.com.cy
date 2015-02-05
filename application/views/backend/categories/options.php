<table class="table table-striped">
<?php foreach ($options as $option): ?>
	<tr>
		<td><?php echo HTML::anchor('backend/options/edit/' . $option->id, $option->title . ' / ' . $option->description ); ?></td>
	</tr>
<?php endforeach; ?>
</table>
