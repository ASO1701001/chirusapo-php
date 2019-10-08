<?php
namespace Classes\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;

class IndexController
    // extends Controller
{
    public function index(Request $request, Response $response) {
        $result = [
            'status' => 200,
            'message' => null,
            'data' => [
                'message' => 'Hello! Slim Framework.'
            ]
        ];

        return $response->withJson($result);
    }
}