<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

class Controller_System_Page extends Controller_System_Template {

	public $template = 'global/frontend';

	public $auto_render = FALSE;
	public $navigation = FALSE;
	public $page = NULL;
	public $left_sidebar = FALSE;
	public $right_sidebar = FALSE;
	public $blocks = array();

	public $enviroment = 'sitemap';

	public $scripts = array(
		'libs/jquery-1.8.2.min.js',
		'libs/jgrowl/jquery.jgrowl_minimized.js',
		'libs/jquery.templates.min.js',
        'js/tree.js',
        'js/translate.js'
	);

	public $styles = array(
		'libs/jgrowl/jquery.jgrowl.css',
		'css/common.css',
        'css/custom.css',
	);

	public function before()
	{
		$this->navigation = Navigation::instance( $this->enviroment );
		Observer::notify( 'init_navigation' );

		// Ищем текущую страницу в карте сайта по текущему URL
		$this->page = $this->navigation
			->pages()
			->findOneByUri( Request::current()->uri() );

		// Если найдена, то рендерим шаблон для нее
		if ( $this->page !== NULL )
		{
			$this->auto_render = TRUE;

			// Указываем, нужна ли авторизация и для каких ролей доступен
			// контроллер
			$this->auth_required = $this->page->getRoles();
		}
		parent::before();

		if ( ($this->page === NULL AND $this->request->is_ajax() === TRUE ) )
		{
			return;
		}

		if ( $this->page !== NULL )
		{
			if ( !$this->page->title )
			{
				$this->page->title = $this->page->label;
			}

			if ( !isset( $this->page->meta_keywords ) )
			{
				$this->page->meta_keywords = $this->ctx->config['view']['keywords'];
			}

			if ( !isset( $this->page->meta_description ) )
			{
				$this->page->meta_description = $this->ctx->config['view']['description'];
			}

			Observer::notify( 'page_found', $this->page );
		}

		if ( $this->auto_render === TRUE AND $this->page->auto_render !== FALSE)
		{
			$this->template->content = View::factory(
				$this->page->template !== NULL
					? $this->page->template
					: $this->get_uri()
			);
		}

		$this->ctx->page = $this->page;
	}

	public function after()
	{
		if ( $this->auto_render === TRUE )
		{
			// Выводим навигацию в шаблон
			$this->template->set_global('navigation', $this->navigation->menu());
//			$this->template->navigation = View::factory( 'global/navigation', array(
//				'navigation' => $this->navigation->menu()
//			) );

			$this->template->scripts = array_merge($this->template->scripts, array(
				'js/core.js',
				'js/ui.js',
				'js/common.js'
			));

			$this->template->left_sidebar = $this->left_sidebar;
			$this->template->right_sidebar = $this->right_sidebar;

			if ( class_exists( 'Object' ) )
			{
				Object::add_blocks( $this->blocks );
			}
		}

		parent::after();
	}

}