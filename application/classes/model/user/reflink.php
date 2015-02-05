<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Model_User_Reflink extends ORM {

	protected $_primary_key = 'code';

	const FORGOT_PASSWORD = 0;
	const CHANGE_EMAIL = 1;
	const REGISTER = 2;

	public static $types = array(
		self::FORGOT_PASSWORD => 'Forgot password',
		self::CHANGE_EMAIL => 'Change email',
		self::REGISTER => 'Register new user'
	);
	protected $_belongs_to = array(
		'user' => array(),
	);

	/**
	 * Confirm referial operation
	 * Model must be loaded
	 *
	 * @return  Model_User
	 * @throws ORM_Validation_Exception
	 */
	public function confirm()
	{
		if ( !$this->loaded() )
		{
			throw new Kohana_Exception( 'Reflink model not loaded or not found' );
		}

		$status = TRUE;

		switch ( $this->type )
		{
			case self::FORGOT_PASSWORD:
				$status = Text::random();
				$this->user->update_user( array(
					'password' => $status, 'password_confirm' => $status
				));

				break;

			case self::CHANGE_EMAIL:
				$status = $this->user->change_email( $this->data );
				break;

			case self::REGISTERED:
				$role = ORM::factory( 'role', array('name' => 'login') );

				$status = $this->user->add( 'roles', $role );
				break;

			default:

				break;
		}

		return $status;
	}

	/**
	 * Generate new reflink code
	 *
	 * @param   Model_User  $user
	 * @param   integer		$type	reflink type
	 * @param   string		$data	string stored to reflink in database
	 * @return  string
	 */
	public function generate( Model_User $user, $type, $data = NULL )
	{
		if ( !$user->loaded() )
		{
			throw new Kohana_Exception( ' User not loaded ' );
		}

		$reflink = $this
			->where( 'user_id', '=', $user->id )
			->where( 'type', '=', (int) $type )
			->where( 'created', '>', DB::expr( 'CURDATE() - INTERVAL 1 HOUR' ) )
			->find();

		if ( !$reflink->loaded() )
		{
			$reflink = ORM::factory( 'user_reflink' );
			$reflink->user_id = (int) $user->id;
			$reflink->code = uniqid( TRUE ) . sha1( microtime() );
			$reflink->type = (int) $type;
			$reflink->data = $data;
			$reflink->create();
		}
		else
		{
			$reflink->data = $data;
			$reflink->update();
		}

		return $reflink->code;
	}

	/**
	 * Delete reflinks from database
	 * Model must be loaded
	 *
	 * @return  integer
	 */
	public function delete()
	{
		if ( !$this->loaded() )
		{
			throw new Kohana_Exception( 'Reflink not loaded or not found' );
		}

		return DB::delete( $this->table_name() )
			->where( 'user_id', '=', $this->user_id )
			->where( 'type', '=', $this->type )
			->execute( $this->_db );
	}

	/**
	 * Delete old reflinks from database
	 *
	 * @return  integer
	 */
	public function clear_old()
	{
		return DB::delete( $this->table_name() )
			->where( 'created', '<', DB::expr( 'CURDATE() - INTERVAL 1 DAY' ) )
			->execute( $this->_db );
	}

}