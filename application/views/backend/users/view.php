<div class="form-horizontal">
	<?php 
		echo View::factory('profile/settings/personal', array(
			'user' => $user
		));
		echo View::factory('profile/settings/data', array(
			'count_adverts' => $count_adverts, 'user' => $user
		));
		echo View::factory('profile/settings/contacts_view', array(
			'user' => $user
		));
		
		echo View::factory('profile/settings/roles', array(
			'user' => $user, 
			'permissions' => $permissions,
			'user_permissions' => $user_permissions
		));
	?>
</div>