<?php

/*
    |--------------------------------------------------------------------------
    | Load file config evn
    |--------------------------------------------------------------------------
    */
$dotenv = \Dotenv\Dotenv::create(__DIR__ . '/..');
$dotenv->load();


define('DB_DRIVER', getenv('DB_DRIVER', ''));
define('DB_HOST', getenv('DB_HOST', 'localhost'));
define('DB_PORT', getenv('DB_PORT'));
define('DB_DATABASE', getenv('DB_DATABASE', 'forge'));
define('DB_USERNAME', getenv('DB_USERNAME', 'forge'));
define('DB_PASSWORD', getenv('DB_PASSWORD'));
define('MY_IP', getenv('MY_IP'));

define('NAME_WEBSITEUPPER', strtoupper(getenv('NAME_WEBSITE')));
define('URL_WEBSITEUPPER', strtoupper(getenv('URL_WEBSITE')));
define('URL_WEBSITELOWER', getenv('URL_WEBSITE'));
define('LANGUAGE', getenv('LANGUAGE'));

define('CONFIG_IMEZONE', getenv('CONFIG_IMEZONE', 'Asia/Bangkok'));

define('KEY_CAPTCHA_PUBLIC', getenv('KEY_CAPTCHA_PUBLIC', ''));
define('KEY_CAPTCHA_PRIVATE', getenv('KEY_CAPTCHA_PRIVATE', ''));

define('KEY_LINENOTIFY_DEPOSIT', getenv('KEY_LINENOTIFY_DEPOSIT', ''));
define('KEY_LINENOTIFY_WITHDRAW', getenv('KEY_LINENOTIFY_WITHDRAW', ''));
define('KEY_LINENOTIFY_BANK', getenv('KEY_LINENOTIFY_BANK', ''));

define('KEY_CLIENTID', getenv('KEY_CLIENTID', ''));
define('KEY_CLIENTSECRET', getenv('KEY_CLIENTSECRET', ''));
define('KEY_REDIRECTURI', getenv('KEY_REDIRECTURI', ''));

define('DISPLAY_ERROR', filter_var(getenv('DISPLAY_ERROR', True), FILTER_VALIDATE_BOOLEAN));

date_default_timezone_set(CONFIG_IMEZONE);

// echo date_default_timezone_get().' : '.date("Y-m-d H:i:s")


return [
    'settings' => [
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => DISPLAY_ERROR,

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../resources/views/',
            'cache' => __DIR__ . '/../resources/cache/bladeone',
        ],


        // View settings
        'view' => [
            'template_path' => __DIR__ . '/templates',
            'twig' => [
                'cache' => __DIR__ . '/../resources/cache/twig',
                'debug' => true,
                'auto_reload' => true,
            ],
        ],

        // monolog settings
        'logger' => [
            'name' => 'app',
            'path' => __DIR__ . '/../log/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // jwt settings
        'jwt' => [
            'secret' => 'A++$#%fsad$6546V&^%&^dfg*&(*gffdg646)*(*&^Ddfgfd%$^#^4654%fdgDfdHfdgg$&%^^&&*sdfSKsd*())',
        ],


        // Google Recaptcha
        'google_recaptcha' => [
            'public' => KEY_CAPTCHA_PUBLIC,
            'secret' => KEY_CAPTCHA_PRIVATE,
        ],

        // line notify
        'line_notify' => [
            'depositkey' => KEY_LINENOTIFY_DEPOSIT,
            'withdrawkey' => KEY_LINENOTIFY_WITHDRAW,
            'bank' => KEY_LINENOTIFY_BANK
        ],

        // line notify
        'name_website' => [
            'title' => NAME_WEBSITEUPPER,
            'urlupper'   => URL_WEBSITEUPPER,
            'urllower'   => URL_WEBSITELOWER
        ],

        // Google login
        'google_login' => [
            'ClientId'     => KEY_CLIENTID,
            'ClientSecret' => KEY_CLIENTSECRET,
            'RedirectUri'  => KEY_REDIRECTURI,
        ],

        // Database connection setting
        'db' => [
            'driver'    => DB_DRIVER,
            'host'      => DB_HOST,
            'port'      => DB_PORT,
            'database'  => DB_DATABASE,
            'username'  => DB_USERNAME,
            'password'  => DB_PASSWORD,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
    ],
];
