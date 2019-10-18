<?php
namespace Application\app;

use Application\lib\DatabaseManager;

require_once __DIR__.'/../lib/DatabaseManager.php';

class GroupManager {
    /** 自分が所属しているグループを返す
     * @param $user_id
     * @return array
     */
    public static function belong_my_group($user_id) {
        $db = new DatabaseManager();
        $sql = "SELECT gm.group_id, gm.group_name
                FROM group_user gu
                LEFT JOIN group_master gm
                ON gm.id = gu.group_id
                WHERE gm.delete_flg = false
                AND gu.user_id = :user_id";
        $belong_group = $db->fetchAll($sql, [
            'user_id' => $user_id
        ]);
        $result = [];
        foreach ($belong_group as $group) {
            $result[] = [
                'group_id' => $group['group_id'],
                'group_name' => $group['group_name']
            ];
        }
        return $result;
    }

    /** グループに所属しているユーザーを返す
     * @param $group_id
     * @return array
     */
    public static function belong_member($group_id) {
        $db = new DatabaseManager();
        $sql = "SELECT au.user_id, au.user_name, au.icon_file_name
                FROM group_user gu
                LEFT JOIN account_user au ON gu.user_id = au.id
                WHERE gu.group_id = :group_id";
        $data = $db->fetchAll($sql, [
            'group_id' => $group_id
        ]);
        foreach ($data as $key => $value) {
            $data[$key] = [
                'user_id' => $value['user_id'],
                'user_name' => $value['user_name'],
                'user_icon' => !empty($value['icon_file_name']) ? 'https://storage.googleapis.com/chirusapo/user-icon/'.$value['icon_file_name'] : null
            ];
        }
        return $data;
    }

    /** グループに参加する
     * @param $group_id
     * @param $user_id
     * @return string
     */
    public static function join_group($group_id, $user_id) {
        $db = new DatabaseManager();
        $sql = "INSERT INTO group_user (group_id, user_id) VALUES (:group_id, :user_id)";
        $id = $db->insert($sql, [
            'group_id' => $group_id,
            'user_id' => $user_id
        ]);
        return $id;
    }

    /** グループを作成する
     * @param $group_id
     * @param $group_name
     * @return string
     */
    public static function create_group($group_id, $group_name) {
        $db = new DatabaseManager();
        $sql = "INSERT INTO group_master (group_id, group_name) VALUES (:group_id, :group_name)";
        $id = $db->insert($sql, [
            'group_id' => $group_id,
            'group_name' => $group_name
        ]);
        return $id;
    }

    /** グループを削除する
     * @param $group_id
     */
    public static function delete_group($group_id) {
        $db = new DatabaseManager();
        $sql = "UPDATE group_master SET delete_flg = true WHERE id = :group_id";
        $db->execute($sql, [
            'group_id' => $group_id
        ]);
    }

    /** グループから脱退する
     * @param $group_id
     * @param $user_id
     */
    public static function withdrawal_group($group_id, $user_id) {
        $db = new DatabaseManager();
        $sql = "DELETE FROM group_user WHERE group_id = :group_id AND user_id = :user_id";
        $db->execute($sql, [
            'group_id' => $group_id,
            'user_id' => $user_id
        ]);
    }

    /** 既にグループIDが登録されているか返す
     * @param $group_id
     * @return int
     */
    public static function already_group_id($group_id) {
        $db = new DatabaseManager();
        $sql = "SELECT count(*) FROM group_master WHERE group_id = :group_id";
        $count = $db->fetchColumn($sql, [
            'group_id' => $group_id
        ]);
        return $count == 0 ? false : true;
    }

    /** 既にグループに所属しているか返す
     * @param $user_id
     * @param $group_id
     * @return bool
     */
    public static function already_belong_group($group_id, $user_id) {
        $db = new DatabaseManager();
        $sql = "SELECT count(*) FROM group_user WHERE group_id = :group_id AND user_id = :user_id";
        $count = $db->fetchColumn($sql, [
            'group_id' => $group_id,
            'user_id' => $user_id
        ]);
        return $count == 0 ? false : true;
    }

    /** グループIDを返す
     * @param $group_id
     * @return int
     */
    public static function get_group_id($group_id) {
        $db = new DatabaseManager();
        $sql = "SELECT id FROM group_master WHERE group_id = :group_id";
        $id = $db->fetchColumn($sql, [
            'group_id' => $group_id
        ]);
        return $id;
    }

    /** PINコードを検証する
     * @param $group_id
     * @param $pin_code
     * @return bool
     */
    public static function pin_code_verify($group_id, $pin_code) {
        $db = new DatabaseManager();
        $sql = "SELECT count(*) FROM group_master WHERE id = :group_id AND pin_code = :pin_code";
        $count = $db->fetchColumn($sql, [
            'group_id' => $group_id,
            'pin_code' => $pin_code
        ]);
        return $count == 0 ? false : true;
    }
}