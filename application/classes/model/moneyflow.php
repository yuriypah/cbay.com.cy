<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Model_Moneyflow extends ORM {

	const TYPE_CARRYING_IN = 1;
	const TYPE_PAYMENT = 2;
	
	const STATUS_START = 1;
	const STATUS_CANCELED = 2;
	const STATUS_FINISHED = 9;

	public static $types = array(
		self::TYPE_CARRYING_IN => 'Carrying money to account',
		self::TYPE_PAYMENT => 'Payment',
	);

	public static $statuses = array(
		self::STATUS_START => 'Flow started',
		self::STATUS_CANCELED => 'Flow canceled',
		self::STATUS_FINISHED => 'Flow finished',
	);

	protected $_created_column = array(
		'column' => 'created',
		'format' => 'Y-m-d H:i:s'
	);
	
	protected $_updated_column = array(
		'column' => 'processed',
		'format' => 'Y-m-d H:i:s'
	);

	protected $_belongs_to = array(
		'user' => array('model' => 'user'),
		'option' => array('model' => 'package_option'),
	);
	
	public function filters()
	{
		return array(
			'amount' => array(
				array('floatval'),
			)
		);
	}

	protected $_user_id;
	protected $_recipient;
	
	public function recipient()
	{
		return $this->_recipient;
	}

	public function set_recipient( Model_Package_Option_Abstract $recipient )
	{
		$this->_recipient = $recipient;

		return $this;
	}

	public function start( $user, $amount = NULL )
	{
		if ( $user instanceof Model_User )
		{
			if ( !$user->loaded() )
			{
				throw new Kohana_Exception( 'User mast be loaded' );
			}

			$user = $user->pk();
		}
		
		if(!$this->_recipient)
		{
			throw new Kohana_Exception( 'Recipient not set' );
		}

		$this->_user_id = (int) $user;
		
		if($amount === NULL)
		{
			$amount = $this->_recipient->amount();
		}

		$values = array(
			'user_id'	=> $this->_user_id,
			'option_id' => $this->_recipient->id(),
			'amount'	=> (int) $amount,
			'status'	=> Model_Moneyflow::STATUS_START,
			'type'		=> $this->_recipient->payment_type()
		);

		$this->values( $values )->create();

		return $this;
	}
	
	public function finish( )
	{
		if( ! $this->loaded() )
		{
			throw new Kohana_Exception( 'Flow not init' );
		}
		
		if ( ! $this->user->loaded() )
		{
			throw new Kohana_Exception( 'User with user ID :user_id not found', array(':user_id' => $this->user->id));
		}
		
//		if( $this->amount > 0 AND $this->user->amount < $this->amount)
//		{
//			throw new Kohana_Exception ( 'Not enough money (in the account: :amount), need :need_amount', array(':need_amount' => $this->amount(), ':amount' => $this->user->amount()) );
//		}

		$multiplyer = ($this->type == Model_Moneyflow::TYPE_PAYMENT) ? -1 : 1;
		$this->user->amount += $multiplyer * $this->amount;
		$this->user->save();

		$this->values( array(
			'status' => Model_Moneyflow::STATUS_FINISHED
		) )->save();

		return $this;
	}

	public function cancel( $reason = NULL )
	{
		$this->values(  array(
			'status' => self::STATUS_CANCELED,
			'description' => $reason
		) )->update();
		
		return $this;
	}
}