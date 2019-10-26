<?php
use Application\Controllers\IndexController;
use Application\Controllers\AccountController;
use Application\controllers\MasterController;
use Application\controllers\TimelineController;
use Application\controllers\TokenController;
use Application\controllers\GroupController;
use Slim\App;
use Slim\Container;
use Slim\Http\Response;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../src/classes/controllers/IndexController.php';
require_once __DIR__.'/../src/classes/controllers/MasterController.php';
require_once __DIR__.'/../src/classes/controllers/AccountController.php';
require_once __DIR__.'/../src/classes/controllers/TokenController.php';
require_once __DIR__.'/../src/classes/controllers/GroupController.php';
require_once __DIR__.'/../src/classes/controllers/TimelineController.php';

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

$app->get('/start/master-download', MasterController::class.':master_download');

$app->post('/account/signup', AccountController::class.':sign_up');
$app->post('/account/signin', AccountController::class.':sign_in');
$app->post('/account/password-reset', AccountController::class.':password_reset');
$app->post('/account/password-change', AccountController::class.':password_change');
$app->post('/account/edit', AccountController::class.':account_edit');

// TODO：ログアウト
// TODO：退会

$app->post('/token/verify-token', TokenController::class.':verify_token');

$app->post('/group/create', GroupController::class.':group_create');
$app->post('/group/join', GroupController::class.':group_join');
$app->post('/group/belong-group', GroupController::class.':belong_group');
$app->post('/group/belong-member', GroupController::class.':belong_member');
$app->post('/group/withdrawal', GroupController::class.':group_withdrawal');

// TODO：グループ退会（強制）
// TODO：グループ削除

$app->get('/timeline/get', TimelineController::class.':get_timeline');
$app->post('/timeline/post', TimelineController::class.':post_timeline');

// TODO：タイムライン削除
// TODO：タイムラインコメント投稿
// TODO：タイムラインコメント表示
// TODO：タイムラインコメント削除

// TODO：子ども情報登録
// TODO：子ども情報表示
// TODO：子ども情報削除
// TODO：子ども成長記録登録
// TODO：子ども成長日記投稿
// TODO：子ども成長日記表示
// TODO：子ども成長日記削除
// TODO：子ども友だち追加
// TODO：子ども友だち表示

try {
    $app->run();
} catch (Throwable $e) {
    echo $e;
}
