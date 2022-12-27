<?php
// DIC configuration

$container = $app->getContainer();

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------

// Twig
$container['view'] = function ($c) {
    $settings = $c->get('settings');
    $view = new Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);

    // Add extensions
    $view->addExtension(new Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
    $view->addExtension(new Twig\Extension\DebugExtension());

    return $view;
};

// Flash messages
$container['flash'] = function ($c) {
    return new Slim\Flash\Messages;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings');
    $logger = new Monolog\Logger($settings['logger']['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['logger']['path'], Monolog\Logger::DEBUG));
    return $logger;
};

// Using Eloquent ORM
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();
//pass the connection to global container (created in previous article)
$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};

// Setting csrf token
$container['csrf'] = function ($c) {
    $guard = new \Slim\Csrf\Guard();
    $guard->setFailureCallable(function ($request, $response, $next) {
        $request = $request->withAttribute("csrf_status", false);
        $getpath = $request->getUri();

        switch (substr($getpath->getPath() , 0, 5)) {
            case '/api/':
                break;
            default:
                die('Appbase slime Check csrf Fail!<br/><a href="login">Goto login</a><br/>');
        }
        return $next($request, $response);
    });
    return $guard;
};

// Register globally to app
$container['session'] = function ($c) {
    $SessionHelper = new \SlimSession\Helper;
    $Session = new \Slim\Middleware\Session([
        'name' => 'appbaseslim_session',
        'autorefresh' => true,
        'lifetime' => '24 minutes',
        'autorefresh'  => true,
    ]);
    return $SessionHelper;
};

// Page not found
$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        $response = new \Slim\Http\Response(404);
        return $response->withRedirect('/404', 301);
        // return $response->write("Page not found");
    };
};


// Page not found
$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        $response = new \Slim\Http\Response(404);
        return $response->withRedirect('/404', 301);
        // return $response->write("Page not found");
    };
};

// Error 405
$container['notAllowedHandler'] = function ($c) {
    return function ($request, $response, $methods) use ($c) {
        return $response->withStatus(405)
            ->withHeader('Allow', implode(', ', $methods))
            ->withHeader('Content-type', 'text/html')
            ->write('Method must be one of: ' . implode(', ', $methods) . '<br/><a href="/login">Goto login</a><br/>');
    };
};

// -----------------------------------------------------------------------------
// Service controller
// -----------------------------------------------------------------------------

$container[App\Action\HomeAction::class] = function ($c) {
    return new App\Action\HomeAction($c->get('view'), $c->get('logger'));
};
