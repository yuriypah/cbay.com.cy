<tr id="<?php echo $id; ?>" class="<?php echo Text::alternate('alt', ''); ?> deactivated">
	<th class="plugin-name">
		<?php echo $plugin->title; ?>
		<?php if (isset($plugin->author)): ?>
			<span class="from"><?php echo $plugin->author; ?></span>
		<?php endif; ?>
	</th>
	<td class="plugin-description"><?php echo $plugin->description; ?></td>
	<td class="plugin-version"><?php echo $plugin->version; ?></td>
	<td class="plugin-status">
		<?php echo Form::checkbox("plugin_{$id}", $id, FALSE, array('class' => 'change-status')); ?>
	</td>
</tr>