<?php
// Routes

use Slim\Http\Request;
use Slim\Http\Response;

$container = $app->getContainer();

$app->get('/', App\Action\HomeAction::class)
    ->setName('homepage');


$app->group('/api', function () use ($app, $container) {
    $app->post('/checklogin', \App\LoginController::class . ':checklogin');

    $app->post('/customer/store', \App\Users\CustomerController::class . ':store');
    $app->post('/customer/destroy', \App\Users\CustomerController::class . ':destroy');
    $app->post('/customer/update', \App\Users\CustomerController::class . ':update');

    // ทดสอบร่างการ
    $app->post('/testbody/update', \App\Users\TestbodyController::class . ':update');
    $app->post('/testpractical/update', \App\Users\TestpracticalController::class . ':update');
    $app->post('/testtheory/update', \App\Users\TesttheoryController::class . ':update');

    $app->post('/logout', \App\LoginController::class . ':logout')->setName('logout');
});

//******************************* ERROR PAGE *******************************//

$app->get('/403', function (Request $request, Response $response, array $args) use ($container) {
    return view('Error.403');
});

$app->get('/404', function (Request $request, Response $response, array $args) use ($container) {
    return view('Error.404');
});

$app->get('/500', function (Request $request, Response $response, array $args) use ($container) {
    return view('Error.500');
});

setroute($container->router->getRoutes(), 'getroute');
