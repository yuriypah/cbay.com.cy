<div class="form-horizontal">
	
	<?php 
		echo View::factory('profile/settings/personal', array(
			'user' => $user
		));
		
		echo View::factory('profile/settings/data', array(
			'count_adverts' => $count_adverts, 'user' => $user
		));
		echo View::factory('profile/settings/contacts', array(
			'user' => $user
		));

		echo View::factory('profile/settings/password', array(
			'user' => $user
		));
		echo View::factory('profile/settings/messages', array(
			'user' => $user
		));
		echo View::factory('profile/settings/delete', array(
			'user' => $user
		));
	?>

</div>