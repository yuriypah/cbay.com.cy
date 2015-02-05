<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_Form_Message extends Controller_System_Form {
	
	public $auth_required = FALSE;
	
	public function action_send()
	{
		$advert_id = (int) Input::post('advert_id');
		
		$advert = ORM::factory('advert', $advert_id);
		
		if(!$advert->loaded())
		{
			throw new HTTP_Exception_404("Advert not found");
		}

		switch ($this->request->post('action'))
		{
			case 'abuse':
				return $this->_abuse($advert);
			case 'message':
				return $this->_message($advert);
			case 'sendfriend':
				return $this->_sendfriend($advert);
		}
	}
	
	protected function _abuse($advert)
	{
		$title = Model_Message::abuse((int) Input::post('category'));
		$text = (string) View::factory('messages/site/abuse', array(
			'text' => Kses::filter(Input::post('description'), $this->ctx->config['allowed_html_tags']),
			'advert' => $advert
		));
		
		$users = ORM::factory('user')
			->get_role_ids('support');

		$this->json['status'] = ORM::factory('message')
			->send($title, $text, Auth::instance()->get_user(), $users, FALSE);
		
		$this->json['message'] = __('message.send.abuse');
	}
	
	protected function _sendfriend($advert)
	{
		
	}
	
	protected function _message($advert)
	{
		if(!$advert->allow_mails())
		{
			throw new HTTP_Exception_404("User mails not allowed");
		}
		
		if(!Valid::email( Input::post('email') ))
		{
			throw new HTTP_Exception_404("Email not valid");
		}

		$title = __('message.title.message', array(':title' => $advert->part()->title));
		
		$text = (string) View::factory('messages/site/message', array(
			'text' => Kses::filter(Input::post('description'), $this->ctx->config['allowed_html_tags']),
			'name' => Input::post('name'),
			'email' => Input::post('email'),
			'advert' => $advert,
		));

		$this->json['status'] = ORM::factory('message')
			->send($title, $text, Auth::instance()->get_user(), $advert->user_id, FALSE);
		
		$this->json['message'] = __('message.send.message');
	}
}