<?php
namespace Application\app;

use Application\lib\DatabaseManager;

require_once __DIR__.'/../lib/DatabaseManager.php';

class GroupManager {
    public static function belong_group($user_id) {
        $db = new DatabaseManager();
        $sql = "SELECT gm.group_id, gm.group_name
                FROM group_user gu
                LEFT JOIN group_master gm
                ON gm.group_id = gu.group_id
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
}