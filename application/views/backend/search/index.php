<div class="page-header">
	<h1><?php echo $ctx->page->title; ?></h1>
</div>

<div class="well page-actions">
	<?php echo HTML::anchor(URL::site('backend/search/indexer'), __('Reindex pages'), array('class' => 'btn')); ?>
	<?php echo __('Total adverts in index: :total', array(':total' => $total_adverts)); ?>
</div>

<?php if($total_adverts > 0): ?>
<table class="table table-striped">
	<colgroup>
		<col>
		<col width="120px">
		<col width="120px">
	</colgroup>
	<thead>
		<tr>
			<th>Title</th>
			<th>Created</th>
			<th>Updated</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($adverts as $item): ?>
		<tr>
			<th><?php echo $item->title; ?></th>
			<td><?php echo Date::format($item->created_on); ?></td>
			<td><?php echo Date::format($item->updated_on); ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<?php endif; ?>