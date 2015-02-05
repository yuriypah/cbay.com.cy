<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_System_Controller extends Kohana_Controller {

	public $respath = 'resources/';
	public $mobile_version = FALSE;
	public $uri = '';
	public $ctx;
	public $session;

	public function before()
	{
		parent::before();

		$this->ctx = Context::instance();
		$this->ctx->config = Kohana::$config->load( 'global' );
		$this->ctx->uri = $this->get_uri();
		
		$this->session = Session::instance();
	}

	public function go_home()
	{
		$this->go( Route::url( 'default' ) );
	}

	public function go_back()
	{
		if ( Valid::url( $this->request->referrer() ) )
		{
			$this->go( $this->request->referrer() );
		}
	}

	public function go( $url = NULL, $code = 302 )
	{
		$route = array(
			'controller' => $this->request->controller()
		);

		if ( is_array( $url ) )
		{
			$route = array_merge( $route, $url );
		}

		if ( $url === NULL OR is_array( $url ) )
		{
			$url = Route::url( 'default', $route );
		}

		$this->request->redirect( $url, $code );
	}

	public function get_uri()
	{
		if ( empty( $this->uri ) )
		{
			$uri = $this->request->controller() . '/' . $this->request->action();
			$dir = $this->request->directory();

			if ( !empty( $dir ) )
				$uri = $dir . '/' . $uri;

			$this->uri = $uri;
			unset( $uri, $dir );
		}

		return $this->uri;
	}

	private function _detect_mobile()
	{
		if(Kohana::$profiling === TRUE)
		{
			$benchmark = Profiler::start('Kohana', 'detect mobile');
		}

		$agent = strtolower( Request::$user_agent );
		$mobile_browser = 0;

		if ( preg_match( '/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', $agent ) )
		{
			$mobile_browser++;
		}

		if ( (isset( $_SERVER['HTTP_ACCEPT'] )) AND (strpos( strtolower( $_SERVER['HTTP_ACCEPT'] ), 'application/vnd.wap.xhtml+xml' ) !== false) )
		{
			$mobile_browser++;
		}

		if ( isset( $_SERVER['HTTP_X_WAP_PROFILE'] ) )
		{
			$mobile_browser++;
		}

		if ( isset( $_SERVER['HTTP_PROFILE'] ) )
		{
			$mobile_browser++;
		}

		$mobile_ua = substr( $agent, 0, 4 );
		$mobile_agents = array(
			'w3c ', 'acs-', 'alav', 'alca', 'amoi', 'audi', 'avan', 'benq', 'bird', 'blac',
			'blaz', 'brew', 'cell', 'cldc', 'cmd-', 'dang', 'doco', 'eric', 'hipt', 'inno',
			'ipaq', 'java', 'jigs', 'kddi', 'keji', 'leno', 'lg-c', 'lg-d', 'lg-g', 'lge-',
			'maui', 'maxo', 'midp', 'mits', 'mmef', 'mobi', 'mot-', 'moto', 'mwbp', 'nec-',
			'newt', 'noki', 'oper', 'palm', 'pana', 'pant', 'phil', 'play', 'port', 'prox',
			'qwap', 'sage', 'sams', 'sany', 'sch-', 'sec-', 'send', 'seri', 'sgh-', 'shar',
			'sie-', 'siem', 'smal', 'smar', 'sony', 'sph-', 'symb', 't-mo', 'teli', 'tim-',
			'tosh', 'tsm-', 'upg1', 'upsi', 'vk-v', 'voda', 'wap-', 'wapa', 'wapi', 'wapp',
			'wapr', 'webc', 'winw', 'xda', 'xda-'
		);

		if ( in_array( $mobile_ua, $mobile_agents ) )
		{
			$mobile_browser++;
		}

		if ( isset( $_SERVER['ALL_HTTP'] ) AND strpos( strtolower( $_SERVER['ALL_HTTP'] ), 'operamini' ) !== FALSE )
		{
			$mobile_browser++;
		}

		// Pre-final check to reset everything if the user is on Windows
		if ( strpos( $agent, 'windows' ) !== FALSE )
		{
			$mobile_browser = 0;
		}

		// But WP7 is also Windows, with a slightly different characteristic
		if ( strpos( $agent, 'windows phone' ) !== FALSE )
		{
			$mobile_browser++;
		}
		
		if(isset($benchmark))
		{
			Profiler::stop($benchmark);
		}

		if ( $mobile_browser > 0 )
		{
			return TRUE;
		}
		
		return FALSE;
	}

}