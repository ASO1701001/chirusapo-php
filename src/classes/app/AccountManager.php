<?php
namespace Application\app;

use Application\lib\DatabaseManager;
use Application\lib\Mailer;

require_once __DIR__.'/../lib/DatabaseManager.php';
require_once __DIR__.'/../lib/Mailer.php';

class AccountManager {
    public static function sign_up($user_id, $user_name, $email, $password, $gender, $birthday) {
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
        $db = new DatabaseManager();
        $sql = "SELECT id, password FROM account_user WHERE user_id = :user_id OR email = :email";
        $data = $db->fetch($sql, [
            'user_id' => $user_id,
            'email' => $user_id
        ]);
        if (!empty($data)) {
            if (password_verify($password, $data['password'])) {
                return $data['id'];
            }
        }
        return false;
    }

    public static function already_user_id($user_id) {
        $db = new DatabaseManager();
        $sql = "SELECT count(*) FROM account_user WHERE user_id = :user_id";
        $data = $db->fetchColumn($sql, [
            'user_id' => $user_id
        ]);
        return $data == 0 ? true : false;
    }

    public static function already_email($email) {
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

    public static function user_info($user_id) {
        $db = new DatabaseManager();
        $sql = "SELECT user_id, user_name, email, icon_file_name FROM account_user WHERE id = :user_id";
        $data = $db->fetch($sql, [
            'user_id' => $user_id
        ]);
        return [
            'user_id' => $data['user_id'],
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'user_icon' => !empty($data['icon_file_name']) ? 'https://storage.googleapis.com/chirusapo/user-icon/'.$data['icon_file_name'] : null
        ];
    }
}