<table class="table table-striped">
	<colgroup>
		<col />
		<col width="100px" />
		<col width="150px" />
	</colgroup>
	<thead>
		<tr>
			<th><?php echo __( 'Name' ); ?></th>
			<th><?php echo __( 'Email' ); ?></th>
			<th><?php echo __( 'Last login' ); ?></th>
            <th><?php echo __( 'Status' ); ?></th>
            <th><?php echo __( 'Action' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $users as $user ): ?>
			<tr data-id="<?php echo $user->id; ?>">
				<td>
					<?php echo HTML::anchor('backend/users/view/' . $user->id, $user->profile->name); ?>
					<?php echo HTML::label($user->username); ?>
				</td>
				<td><?php echo $user->email; ?></td>
				<td><?php echo Date::fuzzy_span( $user->last_login ); ?></td>
                <td><?= ($user->status == 0) ? __('backend.users.blocked') : __('backend.users.active'); ?></td>
                <td><?= ($user->status == 0) ? HTML::anchor('backend/users/unblockuser/'.$user->id, __('backend.users.unblock'), array('class' => 'advert_deactivate btn btn-mini btn-success')) : HTML::anchor('backend/users/blockuser/'.$user->id, __('backend.users.block'), array('class' => 'advert_deactivate btn btn-mini btn-danger')); ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>