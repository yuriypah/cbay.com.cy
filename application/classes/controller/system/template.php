<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_System_Template extends Controller_System_Security {

	public $template = 'global/layout';
	public $auto_render = TRUE;
	public $json = NULL;
	
	public $styles = array();
	public $scripts = array();

	public function before()
	{
		parent::before();

		if ( $this->auto_render === TRUE )
		{
			if ( $this->request->is_ajax() === TRUE OR Input::get('ajax') )
			{
				// Load the template
				$this->template = View::factory( 'global/ajax' );
			}
			else
			{
				$this->template = View::factory( $this->template );
			}

			// Initialize empty values
			$this->template->title = '';
			$this->template->content = '';

			$this->template->styles = array();
			$this->template->scripts = array();
		}
	}

	public function after()
	{
		parent::after();

		if ( $this->auto_render === TRUE )
		{
			$this->template->styles = array_merge( $this->styles, $this->template->styles );
			$this->template->scripts = array_merge( $this->scripts, $this->template->scripts );

			unset( $styles, $scripts );

			$this->template->set_global( 'ctx', $this->ctx );

			$messages = Messages::get();
			$this->template->messages = View::factory('global/messages', array(
				'messages' => $messages
			));

			$this->template->set_global( 'messages_array', $messages );
			$this->template->bind_global( 'request', $this->request );

			$this->template->set_global( 'resources_path', $this->respath );

			Observer::notify( 'template_before_render', $this->template );

			$this->response->body( $this->template->render() );
		}
		elseif ( $this->request->is_ajax() === TRUE )
		{
			if ( $this->json !== NULL )
			{
				if ( is_array( $this->json ) AND !isset( $this->json['status'] ) )
				{
					$this->json['status'] = TRUE;
				}

				$this->template = json_encode( $this->json );
			}

			$this->response->body( $this->template );
		}
	}

}