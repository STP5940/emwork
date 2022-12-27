<?php

// To help the built-in PHP dev server, check if the request was actually for
// something which should probably be served as a static file
if (PHP_SAPI === 'cli-server' && $_SERVER['SCRIPT_FILENAME'] !== __FILE__) {
    return false;
}

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

// dd for larapack debug
require __DIR__ . '/../web/vendor/larapack/dd/src/helper.php';

require __DIR__ . '/../web/vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../web/app/settings.php';
$app = new \Slim\App($settings);

// global function
require __DIR__ . '/../web/app/globalfunc.php';

// Set up dependencies
require __DIR__ . '/../web/app/dependencies.php';

// Register middleware
require __DIR__ . '/../web/app/middleware.php';

// Register routes
require __DIR__ . '/../web/app/routes.php';

// Run!
$app->run();
