<div class="page-header">
	<h1><?php echo $ctx->page->title; ?></h1>
</div>

<div id="plugins">
	<table class="table table-striped">
		<colgroup>
			<col width="200px" />
			<col />
			<col width="100px" />
			<col width="80px" />
		</colgroup>
		<thead>
			<tr>
				<th>Плагин</th>
				<th>Описание</th>
				<th>Версия</th>
				<th>Статус</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($plugins as $id => $plugin): ?>
				<?php $status = isset($loaded_plugins[$id]) ? 'activated' : 'deactivated'; ?>
				<?php
				echo View::factory( '/backend/plugins/' . $status, array(
					'id' => $id,
					'plugin' => $plugin
				));
				?>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>