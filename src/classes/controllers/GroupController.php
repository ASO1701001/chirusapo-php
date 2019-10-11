<?php
namespace Classes\controllers;

use Application\app\GroupManager;
use Application\app\TokenManager;
use Application\lib\Error;
use Slim\Http\Request;
use Slim\Http\Response;

require_once __DIR__.'/../lib/Error.php';
require_once __DIR__.'/../app/GroupManager.php';
require_once __DIR__.'/../app/TokenManager.php';

class GroupController {
    public static function group_join(Request $request, Response $response) {
        $param = array_escape($request->getParsedBody());

        $token = isset($param['token']) ? $param['token'] : null;
        $group_id = isset($param['group_id']) ? $param['group_id'] : null;
        $pin_code = isset($param['pin_code']) ? $param['pin_code'] : null;

        $error = [];

        if (is_null($token) || is_null($group_id) || is_null($pin_code)) {
            $result = [
                'status' => 400,
                'message' => [
                    Error::$REQUIRED_PARAM
                ],
                'data' => null
            ];
        } else {
            $user_id = TokenManager::get_user_id($token);
            $already_group = GroupManager::already_group_id($group_id);

            if (!$user_id || !$already_group) {
                if (!$user_id) $error[] = Error::$UNKNOWN_TOKEN;
                if (!$already_group) $error[] = Error::$UNKNOWN_GROUP;

                $result = [
                    'status' => 400,
                    'message' => $error,
                    'data' => null
                ];
            } else {
                $inner_group_id = GroupManager::get_group_id($group_id);
                $already_belong = GroupManager::already_belong_group($inner_group_id, $user_id);
                $verify_pin_code = GroupManager::pin_code_verify($inner_group_id, $pin_code);

                if (!$already_belong && $verify_pin_code) {
                    GroupManager::join_group($inner_group_id, $user_id);

                    $result = [
                        'status' => 200,
                        'message' => null,
                        'data' => null
                    ];
                } else {
                    if ($already_belong) $error[] = Error::$ALREADY_BELONG_GROUP;
                    if (!$verify_pin_code) $error[] = Error::$VERIFY_PIN_CODE;

                    $result = [
                        'status' => 400,
                        'message' => $error,
                        'data' => null
                    ];
                }
            }
        }

        return $response->withJson($result);
    }

    public static function group_create(Request $request, Response $response) {
        $param = array_escape($request->getParsedBody());

        $token = isset($param['token']) ? $param['token'] : null;
        $group_id = isset($param['group_id']) ? $param['group_id'] : null;
        $group_name = isset($param['group_name']) ? $param['group_name'] : null;

        $error = [];

        if (is_null($token) || is_null($group_id) || is_null($group_name)) {
            $result = [
                'status' => 400,
                'message' => [
                    Error::$REQUIRED_PARAM
                ],
                'data' => null
            ];
        } else {
            $user_id = TokenManager::get_user_id($token);
            $already_group = GroupManager::already_group_id($group_id);

            if (!$user_id || $already_group) {
                if (!$user_id) $error[] = Error::$UNKNOWN_TOKEN;
                if ($already_group) $error[] = Error::$ALREADY_CREATE_GROUP;

                $result = [
                    'status' => 400,
                    'message' => $error,
                    'data' => null
                ];
            } else {
                $inner_group_id = GroupManager::create_group($group_id, $group_name);
                GroupManager::join_group($inner_group_id, $user_id);

                $result = [
                    'status' => 200,
                    'message' => null,
                    'data' => null
                ];
            }
        }

        return $response->withJson($result);
    }
}