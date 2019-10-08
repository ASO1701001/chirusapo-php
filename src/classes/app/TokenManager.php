<?php
namespace Application\app;

use Application\lib\DatabaseManager;

require_once __DIR__.'/../lib/DatabaseManager.php';
require_once 'functions.php';

class TokenManager {
    /**
     * @param $token
     * @return bool
     */
    public static function verify_token($token) {
//        require_once __DIR__.'/../lib/DatabaseManager.php';
        $db = new DatabaseManager();
        $sql = "SELECT count(*) FROM account_user_token WHERE token = :token AND timestamp > :timestamp";
        $count = $db->fetchColumn($sql, [
            'token' => $token,
            'timestamp' => time()
        ]);
        return $count == 0 ? false : true;
    }

    /**
     * @param $token
     * @return bool|int
     */
    public static function get_user_id($token) {
//        require_once __DIR__.'/../lib/DatabaseManager.php';
        if (!self::verify_token($token)) {
            return false;
        }
        $db = new DatabaseManager();
        $sql = "SELECT user_id FROM account_user_token WHERE token = :token";
        $user_id = $db->fetchColumn($sql, [
            'token' => $token
        ]);
        return $user_id;
    }

    /**
     * @param $user_id
     * @return string
     */
    public static function add_token($user_id) {
//        require_once __DIR__.'/../lib/DatabaseManager.php';
        do {
            $token = random(30);
        } while (self::count_token($token) > 0);
        $db = new DatabaseManager();
        $sql = "INSERT INTO account_user_token (user_id, token, expiration_date) VALUES (:user_id, :token, :expiration_date)";
        $db->insert($sql, [
            'user_id' => $user_id,
            'token' => $token,
            'expiration_date' => date('Y-m-d H:i:s', strtotime('+1 month'))
        ]);
        return $token;
    }

    /**
     * @param $token
     * @return int
     */
    public static function count_token($token) {
//        require_once __DIR__.'/../lib/DatabaseManager.php';
        $db = new DatabaseManager();
        $sql = "SELECT count(*) FROM account_user_token WHERE token = :token";
        $count = $db->fetchColumn($sql, [
            'token' => $token
        ]);
        return $count;
    }
}