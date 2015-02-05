<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Auth_ORM extends Kohana_Auth_ORM {

	public function logged_in( $role = NULL, $all_required = TRUE )
	{
		// Get the user from the session
		$user = $this->get_user();

		if ( !$user )
			return FALSE;

		if ( $user instanceof Model_User AND $user->loaded() )
		{
			if ( $role === NULL )
			{
				return TRUE;
			}

			return $user->has_role( $role, $all_required );
		}

		return FALSE;
	}

}