<?php
//qw($advert->category(),$advert->category_id,'ae');
?>
<table id="advert-options-list">
	<colgroup>
		<col>
		<col width="15px">
		<col>
	</colgroup>
	<tbody>
        <?php
            foreach($options_for_view as $option){
                ?>
		<tr>
			<th><?php echo $option['label']; ?></th>
			<td></td>
			<td><?php echo $option['value']; ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>