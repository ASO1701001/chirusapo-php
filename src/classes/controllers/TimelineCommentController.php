<?php
namespace Application\controllers;

use Application\app\GroupManager;
use Application\app\TimelineManager;
use Application\app\TokenManager;
use Application\lib\Error;
use Slim\Http\Request;
use Slim\Http\Response;

require_once __DIR__.'/../app/GroupManager.php';
require_once __DIR__.'/../app/TimelineManager.php';
require_once __DIR__.'/../app/TokenManager.php';
require_once __DIR__.'/../lib/Error.php';

class TimelineCommentController {
    public static function get_comment(Request $request, Response $response) {
        $param = array_escape($request->getQueryParams());

        $token = isset($param['token']) ? $param['token'] : null;
        $timeline_id = isset($param['timeline_id']) ? $param['timeline_id'] : null;

        $error = [];

        if (is_null($token) || is_null($timeline_id)) {
            $result = [
                'status' => 400,
                'message' => [
                    Error::$REQUIRED_PARAM
                ],
                'data' => null
            ];
        } else {
            $user_id = TokenManager::get_user_id($token);
            $group_id = TimelineManager::get_timeline_group_id($timeline_id);

            if (!$user_id || !$group_id) {
                if (!$user_id) $error[] = Error::$UNKNOWN_TOKEN;
                if (!$group_id) $error[] = Error::$UNKNOWN_POST;

                $result = [
                    'status' => 400,
                    'message' => $error,
                    'data' => null
                ];
            } else {
                $belong_group = GroupManager::already_belong_group($group_id, $user_id);

                if (!$belong_group) {
                    $result = [
                        'status' => 400,
                        'message' => [
                            Error::$UNREADY_BELONG_GROUP
                        ],
                        'data' => null
                    ];
                } else {
                    $timeline_data = TimelineManager::get_post($timeline_id);
                    $comment_data = TimelineManager::get_comment($timeline_id);

                    $result = [
                        'status' => 200,
                        'message' => null,
                        'data' => [
                            'timeline' => $timeline_data,
                            'comment' => $comment_data
                        ]
                    ];
                }
            }
        }

        return $response->withJson($result);
    }
}