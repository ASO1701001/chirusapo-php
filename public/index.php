<?php
use Application\Controllers\ChildController;
use Application\Controllers\IndexController;
use Application\Controllers\AccountController;
use Application\controllers\MasterController;
use Application\controllers\TimelineController;
use Application\controllers\TimelineCommentController;
use Application\controllers\TokenController;
use Application\controllers\GroupController;
use Slim\App;
use Slim\Container;
use Slim\Http\Response;

// autoload
require_once __DIR__.'/../vendor/autoload.php';
// controller
require_once __DIR__.'/../src/classes/controllers/IndexController.php';
require_once __DIR__.'/../src/classes/controllers/MasterController.php';
require_once __DIR__.'/../src/classes/controllers/AccountController.php';
require_once __DIR__.'/../src/classes/controllers/TokenController.php';
require_once __DIR__.'/../src/classes/controllers/GroupController.php';
require_once __DIR__.'/../src/classes/controllers/TimelineController.php';
require_once __DIR__.'/../src/classes/controllers/TimelineCommentController.php';
require_once __DIR__.'/../src/classes/controllers/ChildController.php';
// manager
//require_once __DIR__.'/../src/classes/app/FunctionApp.php';
require_once __DIR__.'/../src/classes/app/MasterManager.php';
require_once __DIR__.'/../src/classes/app/AccountManager.php';
require_once __DIR__.'/../src/classes/app/TokenManager.php';
require_once __DIR__.'/../src/classes/app/GroupManager.php';
require_once __DIR__.'/../src/classes/app/TimelineManager.php';
require_once __DIR__.'/../src/classes/app/ChildManager.php';
// lib
require_once __DIR__.'/../src/classes/lib/DatabaseManager.php';
require_once __DIR__.'/../src/classes/lib/Error.php';
require_once __DIR__.'/../src/classes/lib/Validation.php';
require_once __DIR__.'/../src/classes/lib/Mailer.php';
require_once __DIR__.'/../src/classes/lib/GoogleCloudStorage.php';
require_once __DIR__.'/../src/classes/lib/FFMpegManager.php';
// etc.
require_once __DIR__.'/../src/classes/app/functions.php';


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
$app->post('/account/signout', AccountController::class.':sign_out');
$app->post('/account/resign', AccountController::class.':resign');
$app->post('/account/password-reset', AccountController::class.':password_reset');
$app->post('/account/password-change', AccountController::class.':password_change');
$app->post('/account/edit', AccountController::class.':account_edit');

$app->post('/token/verify-token', TokenController::class.':verify_token');

$app->post('/group/create', GroupController::class.':group_create');
$app->post('/group/join', GroupController::class.':group_join');
$app->get('/group/belong-group', GroupController::class.':belong_group');
$app->get('/group/belong-member', GroupController::class.':belong_member');
$app->post('/group/withdrawal', GroupController::class.':group_withdrawal');

// TODO：グループ退会（強制）
// TODO：グループ削除

$app->get('/timeline/get', TimelineController::class.':get_timeline');
$app->post('/timeline/post', TimelineController::class.':post_timeline');
$app->post('/timeline/delete', TimelineController::class.':delete_timeline');
$app->post('/timeline/comment/post', TimelineCommentController::class.':post_comment');
$app->get('/timeline/comment/get', TimelineCommentController::class.':get_comment');
$app->post('/timeline/comment/delete', TimelineCommentController::class.':delete_comment');

$app->get('/child/list', ChildController::class.':list_child');
$app->post('/child/add', ChildController::class.':add_child');
$app->post('/child/edit', ChildController::class.':edit_child');
$app->post('/child/delete', ChildController::class.':delete_child');
// TODO：子ども成長記録登録
// TODO：子ども成長日記投稿
// $app->post('/child/diary/post', ChildDiaryController::class.':post_diary');
// TODO：子ども成長日記表示
// $app->get('/child/diary/get', ChildDiaryController::class.':get_diary');
// TODO：子ども成長日記削除
// $app->post('/child/diary/delete', ChildDiaryController::class.':delete_diary');
// TODO：子ども友だち追加
// $app->post('/child/friend/add', ChildFriendController::class.':add_friend');
// TODO：子ども友だち表示
// $app->get('/child/friend/get', ChildFriendController::class.':get_friend');
// TODO：子ども友だち編集
// $app->post('/child/friend/edit', ChildFriendController::class.':edit_friend');
// TODO：子ども友だち削除
// $app->post('/child/friend/delete', ChildFriendController::class.':delete_friend');
// TODO：子ども友だち関連付け

// TODO：アルバムアップロード
// TODO：アルバム表示

// TODO：アカウントLINEログイン

// TODO：カレンダー表示
// TODO：カレンダー追加
// TODO：カレンダー削除

try {
    $app->run();
} catch (Throwable $e) {
    echo $e;
}
