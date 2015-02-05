<script>
$(function() {
	$('#categories-menu > ul').treeview({
		collapsed:	true,
		persist:	"location"
	});
})
</script>
<div id="categories-menu" class="content-styled">
	<ul class="unstyled">
		<li class="root"><?php echo HTML::anchor('/backend/categories', 'Root')?>

			<ul class="unstyled">
			<?php foreach ($data['categories'] as $id => $category): ?>
			<?php echo recurse_menu($id, $category, 0); ?>
			<?php endforeach; ?>
			</ul>
		</li>
	</ul>
</div>
<?php
	function recurse_menu($id, $data, $ds_id)
	{
		$result = '';
		$selected = ($id == $ds_id) ? 'selected' : '';

		if(  is_array( $data ))
		{
			$result .= '<li class="'.$selected.'">';
			$result .= HTML::anchor('/backend/categories' . URL::query(array(
				'cid' => $id
			), FALSE), key($data));


			$result .= '<ul class="unstyled" >';
			foreach ( $data[key($data)] as $id => $name )
			{
				$result .= recurse_menu($id, $name, $ds_id);
			}
			$result .= '</ul>';

			$result .= '</li>';
		}
		else
		{
			$result .= '<li class="'.$selected.'">';
			$result .= HTML::anchor('/backend/categories' . URL::query(array(
				'cid' => $id
			), FALSE), $data);
			$result .= '</li>';
		}

		return $result;
	}

?>