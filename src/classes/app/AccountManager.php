<?php
namespace Application\app;

use Application\lib\DatabaseManager;
use Application\lib\Mailer;

require_once __DIR__.'/../lib/DatabaseManager.php';
require_once __DIR__.'/../lib/Mailer.php';

class AccountManager {
    public static function sign_up($user_id, $user_name, $email, $password, $gender, $birthday) {
//        require_once __DIR__.'/../lib/DatabaseManager.php';
        $db = new DatabaseManager();
        $sql = "INSERT INTO account_user (user_id, user_name, email, password, gender, birthday) VALUES (:user_id, :user_name, :email, :password, :gender, :birthday)";
        $id = $db->insert($sql, [
            'user_id' => $user_id,
            'user_name' => $user_name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'gender' => $gender,
            'birthday' => $birthday
        ]);
        return $id;
    }

    public static function sign_in($user_id, $password) {
//        require_once __DIR__.'/../lib/DatabaseManager.php';
        $db = new DatabaseManager();
        $sql = "SELECT id, password FROM account_user WHERE user_id = :user_id OR email = :email";
        $data = $db->fetch($sql, [
            'user_id' => $user_id,
            'email' => $user_id
        ]);
        var_dump($data);
        if (!empty($data)) {
            if (password_verify($password, $data['password'])) {
                return $data['id'];
            }
        }
        return false;
    }

    public static function already_user_id($user_id) {
//        require_once __DIR__.'/../lib/DatabaseManager.php';
        $db = new DatabaseManager();
        $sql = "SELECT count(*) FROM account_user WHERE user_id = :user_id";
        $data = $db->fetchColumn($sql, [
            'user_id' => $user_id
        ]);
        return $data == 0 ? true : false;
    }

    public static function already_email($email) {
//        require_once __DIR__.'/../lib/DatabaseManager.php';
        $db = new DatabaseManager();
        $sql = "SELECT count(*) FROM account_user WHERE email = :email";
        $data = $db->fetchColumn($sql, [
            'email' => $email
        ]);
        return $data == 0 ? true : false;
    }

    public static function already_user_id_or_email($user_id) {
        $db = new DatabaseManager();
        $sql = "SELECT id FROM account_user WHERE user_id = :user_id OR email = :email";
        $id = $db->fetchColumn($sql, [
            'user_id' => $user_id,
            'email' => $user_id
        ]);
        return $id ? $id : false;
    }

    public static function password_reset($user_id) {
        $db = new DatabaseManager();
        $sql = "SELECT email FROM account_user WHERE id = :id";
        $email = $db->fetchColumn($sql, [
            'id' => $user_id
        ]);
        $password = random(8);
        $sql = "UPDATE account_user SET password = :password WHERE id = :id";
        $db->execute($sql, [
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'id' => $user_id
        ]);

        $subject = 'パスワード再発行';
        $body = <<<EOF
パスワードをリセットしました
仮パスワードを使用してログインを行いパスワードを再設定してください

仮パスワード：$password
EOF;

        return new Mailer($email, $subject, $body);
    }
}