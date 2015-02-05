<?php defined('SYSPATH') or die('No direct script access.');

class Object {
	
	/**
	 *
	 * @var array 
	 */
	protected static $_blocks = array();

	/**
	 * 
	 * @param string $block
	 * @return Object
	 */
	public static function create($block)
	{
		return new Object($block);
	}
	
	/**
	 * 
	 * @param array $blocks
	 */
	public static function add_blocks(array $blocks)
	{		
		foreach ($blocks as $block_name => $data)
		{
			self::add_block($block_name, $data);
		}
	}
	
	/**
	 * 
	 * @param string $block_name
	 * @param array $data
	 */
	public static function add_block($block_name, $data)
	{
		self::$_blocks[$block_name] = $data;
	}
	
	/**
	 * 
	 * @return array
	 */
	public static function blocks()
	{
		return self::$_blocks;
	}

	/**
	 * 
	 * @param string $b
	 * @return string|null
	 */
	public static function find_block($b)
	{
		// Строим путь до текущей страницы
		$request = Request::current();
		$d = $request->directory();
		$c = $request->controller();
		$a = $request->action();
		$x = '*';
		
		if(empty($d))
		{
			$d = $x;
		}
		
		$paths = array(
			array($d, $c, $a, $b),
			array($d, $c, $x, $b),
			array($d, $x, $a, $b),
			array($x, $c, $a, $b),
			array($x, $x, $a, $b),
			array($x, $c, $x, $b),
			array($d, $x, $x, $b),
			array($x, $x, $x, $b),
		);
		
		// Загружаем список блоков для текущей страницы
		$config = Kohana::$config->load('objects')->as_array();
		
		foreach ($paths as $path)
		{
			$path = implode('.', $path);
			if($data = Arr::path($config, $path))
			{
				return array($path, $data);
			}
		}
		
		return NULL;
	}

	/**
	 *
	 * @var Model_Object 
	 */
	protected $_object = NULL;
	
	/**
	 *
	 * @var string 
	 */
	protected $_container = 'object/container';
	
	/**
	 *
	 * @var string 
	 */
	protected $_path;
	
	/**
	 *
	 * @var string 
	 */
	protected $_block;

	/**
	 *
	 * @var bool 
	 */
	protected $_loaded = FALSE;

	/**
	 * 
	 * @param string $block
	 */
	public function __construct($block) 
	{
		list($path, $data) = self::find_block($block);

		if($data !== NULL)
		{
			self::add_block($block, $data);
		}

		if(isset(self::$_blocks[$block]) AND self::$_blocks[$block] !== TRUE)
		{
			$class = 'Objects_'.self::$_blocks[$block]['name'];
			
			$this->_object = self::$_blocks[$block] = new $class(self::$_blocks[$block]);
			$this->_path = $path;
			$this->_block = $block;
			$this->_loaded = TRUE;

			unset($class);
		}
		
		unset($path, $block);
	}
	
	/**
	 * 
	 * @return bool
	 */
	public function loaded()
	{
		return $this->_loaded;
	}

	/**
	 * 
	 * @return string
	 */
	public function __toString()
	{
		return $this->render();
	}

	public function render() 
	{
		if(!$this->loaded())
		{
			return NULL;
		}
		
		echo View::factory($this->_container)
			->set('block', $this->_object->render());
	}
}
