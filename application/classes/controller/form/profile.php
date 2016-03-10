<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_Form_Profile extends Controller_System_Form {
	
	public $auth_required = array('login');
	
	public function action_contacts()
	{
		$data = Input::post( 'profile' );
		$profile = $this->ctx->user->profile;
		try
		{
			Database::instance()->begin();
			$profile
				->values( $data )
				->save();

			Observer::notify( 'user_profile_update' , $profile );

			$this->json['data'] = $profile->as_array();

			$this->json['status'] = TRUE;
			
			Database::instance()->commit();
		}
		catch ( ORM_Validation_Exception $e )
		{
			$this->json['validation'] = $e->errors( 'validation' );
			Database::instance()->rollback();
		}
	}
	
	public function action_messages()
	{
		$data = Input::post( 'message' );
		$profile = $this->ctx->user->profile;
		
		if(!isset($data['notice']))
		{
			$data['notice'] = 0;
		}
		else
		{
			$data['notice'] = 1;
		}
		
		if(!isset($data['remiders']))
		{
			$data['remiders'] = 0;
		}
		else
		{
			$data['remiders'] = 1;
		}

		try
		{
			Database::instance()->begin();
			$profile
				->values( $data )
				->save();

			Observer::notify( 'user_profile_update' , $profile );

			$this->json['data'] = $profile->as_array();
			$this->json['status'] = TRUE;
			
			Database::instance()->commit();
		}
		catch ( ORM_Validation_Exception $e )
		{
			$this->json['validation'] = $e->errors( 'validation' );
			Database::instance()->rollback();
		}
	}
	
	public function action_password_change()
	{
		$data = $_POST;
		
		$data['user_password'] = $this->ctx->user->password;
		$data['current_password'] = Auth::instance()->hash($data['current_password']);
		
		$valid = Validation::factory( $data )
			->rule('current_password', 'matches', array(':data', ':field', 'user_password'))
			->rule('password', 'not_empty')
			->rule('password', 'min_length', array(':value', 6))
			->rule('password_confirm', 'matches', array(':data', ':field', 'password'))
			->labels( array(
				'user_password' => __('Your password'),
				'current_password' => __('Current password'),
				'password' => __('New password'),
				'password_confirm' => __('Confirm password')
			) );
		
		if(!$valid->check())
		{
			Messages::errors($valid->errors( 'validation' ));
			$this->go_back();
		}
		else
		{
			$this->ctx->user->password = $data['password'];
			$this->ctx->user->save();
			Messages::success(__('messages.profile.password_changed'));
			$this->go_back();
		}
	}
	
	public function action_roles()
	{
		$user_id = (int) $this->request->post('user_id');
		$perms = $this->request->post('user_permission');
		
		$user = ORM::factory( 'user',  $user_id);
		
		if(!$user->loaded())
		{
			throw new HTTP_Exception_404('User not found');
		}
		
		$user->update_related_ids('roles', $perms);
		$this->json['status'] = TRUE;
		
	}
}