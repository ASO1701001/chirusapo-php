<?php
use Application\app\AccountManager;
use Application\app\TokenManager;
use Application\lib\Error;
use Application\lib\Validation;
use Classes\Controllers\IndexController;
use Classes\Controllers\AccountController;
use Slim\App;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/classes/lib/Validation.php';
require_once __DIR__.'/../src/classes/lib/Error.php';
require_once __DIR__.'/../src/classes/app/functions.php';
require_once __DIR__.'/../src/classes/app/AccountManager.php';
require_once __DIR__.'/../src/classes/app/TokenManager.php';

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
//$app->post('/account/signin', AccountController::class.':sign_in');
$app->post('/account/signin', function (Request $request, Response $response) {
    $param = array_escape($request->getParsedBody());

    $user_id = isset($param['user_id']) ? $param['user_id'] : null;
    $password = isset($param['password']) ? $param['password'] : null;

    $error = [];

    if (is_null($user_id) || is_null($password)) {
        $result = [
            'status' => 400,
            'message' => [
                Error::$REQUIRED_PARAM
            ],
            'data' => null
        ];
    } else {
        $valid_user_id = Validation::fire($user_id, Validation::$USER_ID_OR_EMAIL);
        $valid_password = Validation::fire($password, Validation::$PASSWORD);

        if (!$valid_user_id || !$valid_password) {
            if (!$valid_user_id) $error[] = Error::$VALIDATION_USER_ID;
            if (!$valid_password) $error[] = Error::$VALIDATION_PASSWORD;

            $result = [
                'status' => 400,
                'message' => $error,
                'data' => null
            ];
        } else {
            $id = AccountManager::sign_in($user_id, $password);

            if (!$id) {
                $result = [
                    'status' => 400,
                    'message' => [
                        Error::$UNKNOWN_USER
                    ],
                    'data' => null
                ];
            } else {
                $token = TokenManager::add_token($id);

                $result = [
                    'status' => 200,
                    'message' => null,
                    'data' => [
                        'token' => $token
                    ]
                ];
            }
        }
    }

    return $response->withJson($result);
});
$app->post('/account/password-reset', AccountController::class.':password_reset');

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
