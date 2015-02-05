<?
/**
 * The directory in which other frameworks resources are located.
 */

$frameworks = '/frameworks';
$fw = 'kohana-3.2-master-1';

/**
 * The directory in which your application specific resources are located.
 * The application directory must contain the bootstrap.php file.
 *
 * @see  http://kohanaframework.org/guide/about.install#application
 */
$application = 'application';

/**
 * The directory in which system modules are located.
 *
 * @see  http://kohanaframework.org/guide/about.install#modules
 */
$modules = $frameworks.DIRECTORY_SEPARATOR.$fw.DIRECTORY_SEPARATOR.'modules';

/**
 * The directory in which your local modules are located.
 *
 */
$local_modules = 'modules';

/**
 * The directory in which your plugins are located.
 *
 */
$plugins = 'plugins';

/**
 * The directory in which the Kohana resources are located. The system
 * directory must contain the classes/kohana.php file.
 *
 * @see  http://kohanaframework.org/guide/about.install#system
 */
$system = $frameworks.DIRECTORY_SEPARATOR.$fw.DIRECTORY_SEPARATOR.'system';

/**
 * The default extension of resource files. If you change this, all resources
 * must be renamed to use the new extension.
 *
 * @see  http://kohanaframework.org/guide/about.install#ext
 */
define('EXT', '.php');

/**
 * Set the PHP error reporting level. If you set this in php.ini, you remove this.
 * @see  http://php.net/error_reporting
 *
 * When developing your application, it is highly recommended to enable notices
 * and strict warnings. Enable them by using: E_ALL | E_STRICT
 *
 * In a production environment, it is safe to ignore notices and strict warnings.
 * Disable them by using: E_ALL ^ E_NOTICE
 *
 * When using a legacy application with PHP >= 5.3, it is recommended to disable
 * deprecated notices. Disable with: E_ALL & ~E_DEPRECATED
 */
//error_reporting(E_ALL | E_STRICT);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT); 
/**
 * End of standard configuration! Changing any of the code below should only be
 * attempted by those with a working knowledge of Kohana internals.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 */

// Set the full path to the docroot
define('DOCROOT', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);

// Make the frameworks relative to the docroot, for symlink'd index.php
if ( ! is_dir($frameworks) AND is_dir(DOCROOT.$frameworks))
	$frameworks = DOCROOT.$frameworks;

// Make the application relative to the docroot, for symlink'd index.php
if ( ! is_dir($application) AND is_dir(DOCROOT.$application))
	$application = DOCROOT.$application;

// Make the modules relative to the docroot, for symlink'd index.php
if ( ! is_dir($local_modules) AND is_dir(DOCROOT.$local_modules))
	$local_modules = DOCROOT.$local_modules;

if ( ! is_dir($modules) AND is_dir(DOCROOT.$modules))
	$modules = DOCROOT.$modules;

// Make the plugins relative to the docroot
if ( ! is_dir($plugins) AND is_dir(DOCROOT.$plugins))
	$plugins = DOCROOT.$plugins;

// Make the system relative to the docroot, for symlink'd index.php
if ( ! is_dir($system) AND is_dir(DOCROOT.$system))
	$system = DOCROOT.$system;

// Define the absolute paths for configured directories
define('FRWPATH', realpath($frameworks).DIRECTORY_SEPARATOR);
define('APPPATH', realpath($application).DIRECTORY_SEPARATOR);
define('MODPATH', realpath($modules).DIRECTORY_SEPARATOR);
define('LMPATH', realpath($local_modules).DIRECTORY_SEPARATOR);
define('PLUGPATH', realpath($plugins).DIRECTORY_SEPARATOR);
define('SYSPATH', realpath($system).DIRECTORY_SEPARATOR);

// Clean up the configuration vars
unset($application, $modules, $system);

if (file_exists('install'.EXT))
{
	// Load the installation check
	return include 'install'.EXT;
}

/**
 * Define the start time of the application, used for profiling.
 */
if ( ! defined('KOHANA_START_TIME'))
{
	define('KOHANA_START_TIME', microtime(TRUE));
}

/**
 * Define the memory usage at the start of the application, used for profiling.
 */
if ( ! defined('KOHANA_START_MEMORY'))
{
	define('KOHANA_START_MEMORY', memory_get_usage());
}

// Bootstrap the application
require APPPATH.'bootstrap'.EXT;

if ( ! defined('SUPPRESS_REQUEST'))
{
	/**
	 * Execute the main request. A source of the URI can be passed, eg: $_SERVER['PATH_INFO'].
	 * If no source is specified, the URI will be automatically detected.
	 */
	echo Request::factory()
		->execute()
		->send_headers()
		->body();
}
