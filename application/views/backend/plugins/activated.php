<tr id="<?php echo $id; ?>" class="<?php echo Text::alternate('alt', ''); ?> activated">
	<th class="plugin-name">
		<?php if($plugin->settings): ?>
		<?php echo HTML::anchor(Url::site('/backend/plugins/settings/'.$plugin->id), $plugin->title).' '.HTML::icon('th-list'); ?>
		<?php else: ?>
		<?php echo $plugin->title; ?>
		<?php endif; ?>

		<?php if (isset($plugin->author)): ?>
			<span class="from"><?php echo $plugin->author; ?></span>
		<?php endif; ?>
	</th>
	<td class="plugin-description"><?php echo $plugin->description; ?></td>
	<td class="plugin-version"><?php echo $plugin->version; ?></td>
	<td class="plugin-status">
		<?php echo Form::checkbox("enabled_{$id}", $id, TRUE, array('class' => 'change-status')); ?>
	</td>
</tr>