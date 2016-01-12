<?php defined('SYSPATH') or die('No direct script access.');
// -- Environment setup --------------------------------------------------------
// Load the core Kohana class
//echo phpinfo();exit; //original
//require_once '/var/www/cbay/data/www/cbay.com.cy/modules/email/vendor/swiftmailer/lib/swift_required.php';

require SYSPATH . 'classes/kohana/core' . EXT;

if (is_file(APPPATH . 'classes/kohana' . EXT)) {
    // Application extends the core
    require APPPATH . 'classes/kohana' . EXT;
} else {

    // Load empty core extension
    require SYSPATH . 'classes/kohana' . EXT;
}

/**
 * Set the default time zone.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set('Europe/Nicosia');

/**
 * Set the default locale.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, 'ru_RU.utf-8');
//exit('aabbsa');
/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://kohanaframework.org/guide/using.autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

// -- Configuration and initialization -----------------------------------------

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
if (isset($_SERVER['KOHANA_ENV'])) {
    Kohana::$environment = constant('Kohana::' . strtoupper($_SERVER['KOHANA_ENV']));
} else//if ( in_array($_SERVER['SERVER_NAME'], array( 'cybaybeta.ru', 'bpy.me', '77.247.243.104', 'cbay.com.cy' )))
{
    Kohana::$environment = Kohana::DEVELOPMENT;
}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */

Kohana::init(array(
    'base_url' => '/',
    'caching' => FALSE,
    'profile' => Kohana::$environment !== Kohana::PRODUCTION,
    'index_file' => FALSE,
    'errors' => TRUE,
));

define('RESPATH', DOCROOT . 'resources' . DIRECTORY_SEPARATOR);
define('TMPPATH', RESPATH . 'temp' . DIRECTORY_SEPARATOR);

define('RESURL', 'resources/');
define('TMPURL', RESURL . 'temp/');

define('MEDIA', 'media');

/**
 * Attach the file write to logging. Multiple writers are supported.
 */

Kohana::$log->attach(new Log_File(APPPATH . 'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

/**
 * Set default cookie salt
 */
Cookie::$salt = 'AS7hjdd4234fdsdsfAD';

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */

Kohana::modules(array(
    // Other modules
    'i18n_plural' => LMPATH . 'i18n_plural',        // I18n Plural translation
    'navigation' => LMPATH . 'navigation',        // Navigation
    'observer' => LMPATH . 'observer',            // Observer
    'email' => LMPATH . 'email',            // PHP swift mailer lybrary
    'objects' => LMPATH . 'objects',            // View blocks
    'kses' => LMPATH . 'kses',                // HTMLpurifer
    'pagination' => LMPATH . 'pagination',        // Navigation
    'captcha' => LMPATH . 'captcha',                  // CAPTCHA
    'sitemap' => LMPATH . 'sitemap',                  //sitemap

    // System modules
    'auth' => MODPATH . 'auth',            // Basic authentication
    'cache' => MODPATH . 'cache',            // Caching with multiple backends
    'database' => MODPATH . 'database',        // Database access
    'image' => MODPATH . 'image',            // Image manipulation
    'orm' => MODPATH . 'orm',                // Object Relationship Mapping
));

if (Kohana::$environment === Kohana::PRODUCTION) {
    Database::$default = 'production';
}

I18n::set_current_lang();

Model_Setting::init();
Model_Plugin::init();
Model_Map::init();
Model_Map::set_current_position();
Model_Package::init();
Model_Advert_Category::init();
Model_Bookmark_Cookie::init();

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */

//Подключение Сфинкс
require APPPATH . 'sphinxapi' . EXT;

//if ( ! Route::cache() )
//{
Route::set('help', 'help/<article>', array(
    'article' => '[A-Za-z0-9_-]+'
))
    ->defaults(array(
        'controller' => 'help',
        'action' => 'index',
    ));
Route::set('about', 'about/<article>', array(
    'article' => '[A-Za-z0-9_-]+'
))
    ->defaults(array(
        'controller' => 'about',
        'action' => 'index',
    ));

Route::set('advert_view', 'advert/<id>', array(
    'id' => '[0-9]+'
))
    ->defaults(array(
        'controller' => 'adverts',
        'action' => 'view',
    ));

// Для проаерки одноразовых ссылок
Route::set('reflink', 'reflink/<id>', array(
    'id' => '[A-Za-z0-9]+'
))
    ->defaults(array(
        'controller' => 'reflink',
        'action' => 'index'
    ));

Route::set('profile', 'profile')
    ->defaults(array(
        'controller' => 'profile',
        'action' => 'index'
    ));

Route::set('wallet', 'wallet')
    ->defaults(array(
        'controller' => 'wallet',
        'action' => 'index'
    ));

Route::set('user', '<action>(?next=<next_url>)', array(
    'action' => '(login|logout|forgot|register)',
))
    ->defaults(array(
        'controller' => 'user',
    ));

Route::set('error', 'error/<action>(/<message>)', array('action' => '[0-9]++', 'message' => '.+'))
    ->defaults(array(
        'controller' => 'error'
    ));

// Системные контроллеры
Route::set('system', '<directory>-<controller>-<action>(/<id>)', array(
    'directory' => '(ajax|action|form)',
    'controller' => '[A-Za-z\_]+',
    'action' => '[A-Za-z\_]+',
    'id' => '.+',
))->defaults(array(
    'directory' => 'action',
));

Route::set('backend', 'backend(/<controller>(/<action>(/<id>)))(?page=<pagenumber>)', array(
    'controller' => '[A-Za-z\_]+',
    'action' => '[A-Za-z\_]+',
    'id' => '.+',
    'pagenumber' => '[0-9]+',
))->defaults(array(
    'directory' => 'backend',
    'controller' => 'index',
    'action' => 'index',
));

Route::set('default', '(<controller>(/<action>(/<id>)))')
    ->defaults(array(
        'controller' => 'index',
        'action' => 'index',
    ));

//Route::cache(Kohana::$caching === TRUE);
//}
$captcha = Captcha::instance();
$captcha->render();
