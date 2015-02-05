<?php /*<?php if(!empty($messages)): ?>
<?php foreach ( $messages as $type => $texts ): ?>
<div class="alert alert-block">
	<ul>
		<?php foreach ( $texts as $field => $text ): ?>
		<li><?php echo $text; ?></li>
		<?php endforeach; ?>
	</ul>
</div>
<?php endforeach; ?>
<?php endif; ?>
*/
?>
<script>
$(function() {
<?php foreach ( $messages as $type => $mess ): ?>
	<?php if($type === Messages::SUCCESS): ?>
	<?php foreach ( $mess as $message ): ?>
		$.jGrowl("<?php echo str_replace('"', '\"', $message); ?>");
	<?php endforeach; ?>
        <? elseif($type === Messages::ERRORS): ?>
	<?php foreach ( $mess as $name => $message ): ?>
		$.jGrowl("<?php echo str_replace('"', '\"', $message); ?>",{ sticky: true, theme:'red_theme'});
                $("#<?=$name?>").css('border', '1px solid rgb(231, 66, 66)')
	<?php endforeach; ?>
	<?php endif; ?>
<?php endforeach; ?>
})
</script>