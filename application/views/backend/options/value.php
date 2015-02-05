<tr data-id="<?php echo $value->id; ?>">

	<td>
		<?php
		
		echo Form::input ( "values[{$value->id}]", $value->locale ()->title, array (
				'class' => 'span12' 
		) );
		?>
	</td>
		<td>
<?php
if ($value->locale ()->title != '') {
	echo "<input type='button' data-id='".$value->id."' class='btn btn-default option_lang' value='Языковые настройки'/>";
}
?>
</td>
	<td>
		<?php echo HTML::anchor('#', HTML::icon('remove'), array('class' => 'btn btn-mini btn-confirm delete-value')); ?>
	</td>
	
</tr>