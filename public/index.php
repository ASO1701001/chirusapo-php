<?php

use Classes\Controllers\IndexController;
use Classes\Controllers\AccountController;
use Classes\controllers\TokenController;
use Classes\controllers\GroupController;
use Slim\App;
use Slim\Container;
use Slim\Http\Response;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/classes/controllers/IndexController.php';
require_once __DIR__.'/../src/classes/controllers/AccountController.php';
require_once __DIR__.'/../src/classes/controllers/TokenController.php';
require_once __DIR__.'/../src/classes/controllers/GroupController.php';

/*
 * GET
 * $getParams = $request->getQueryParams();
 * POST
 * $postParams = $request->getParsedBody();
*/

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];

$c = new Container($configuration);

$app = new App($c);

unset($app->getContainer()['notFoundHandler']);
$app->getContainer()['notFoundHandler'] = function ($c) {
    return function () use ($c) {
        $response = new Response(404);
        $result = [
            'status' => 400,
            'message' => [
                'Slim Framework Error! 404 Not Found Handler.'
            ],
            'data' => null
        ];

        return $response->withJson($result);
    };
};

$c['notAllowedHandler'] = function ($c) {
    return function () use ($c) {
        $response = new Response(405);
        $result = [
            'status' => 400,
            'message' => [
                'Slim Framework Error! 405 Not Allowed Handler.'
            ],
            'data' => null
        ];

        return $response->withJson($result);
    };
};

$app->get('/', IndexController::class.':index');

$app->post('/account/signup', AccountController::class.':sign_up');
$app->post('/account/signin', AccountController::class.':sign_in');
$app->post('/account/password-reset', AccountController::class.':password_reset');

$app->post('/token/verify-token', TokenController::class.':verify_token');

/*
$app->post('/group/join', GroupController::class.':group_join');
$app->post('/group/create', GroupController::class.':group_create');
*/

/*
$app->post('/account/signout', AccountController::class.':signout');
$app->post('/account/resign', AccountController::class.':resign');
$app->post('/account/edit', AccountController::class.':edit');
$app->post('/account/password-change', AccountController::class.':password_change');
*/

// $app->post('/token/verify-token',);

try {
    $app->run();
} catch (Throwable $e) {
    echo $e;
}
