<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

$app->add(function ($request, $response, $next) {

	$requests = 100; // maximum number of requests default 100
	$inmins = 1;    // in how many time (minutes) default 60
	
	$ApirateLimit = new App\ApirateLimit($requests, $inmins);
	$mustbethrottled = $ApirateLimit();
	
	if ($mustbethrottled == false) {
        $responsen = $next($request, $response);
	} else {

        return $response->withStatus(429)
        ->withHeader('Content-Type', 'application/json')
        ->withHeader('RateLimit-Limit', $requests)
        ->write(json_encode(['JWTAuth' => [
            'status' => false,
            'message' => 'RateLimit-Limit Request: 429',
        ]], true));

        $responsen = $response ->withStatus(429)
                               ->withHeader('RateLimit-Limit', $requests);
	}

    return $responsen;
});

$app->add($app->getContainer()->get('csrf'));