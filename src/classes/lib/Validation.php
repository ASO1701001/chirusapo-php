<?php
namespace Application\lib;

class Validation {
    public static $USER_ID = 'user_id';
    public static $USER_NAME = 'user_name';
    public static $EMAIL = 'email';
    public static $PASSWORD = 'password';
    public static $BIRTHDAY = 'birthday';
    public static $GENDER = 'gender';
    public static $USER_ID_OR_EMAIL = 'user_id_or_email';
    public static $GROUP_ID = 'group_id';
    public static $GROUP_NAME = 'group_name';
    public static $PIN_CODE = 'pin_code';
    /*
    public static $BODY_HEIGHT = 'body_height';
    public static $BODY_WEIGHT = 'body_weight';
    */

    public static function fire($value, string $rule) {
        $regex = '';
        switch ($rule) {
            case self::$USER_ID:
                $regex = '/^[a-zA-Z0-9-_]{4,30}$/';
                break;
            case self::$USER_NAME:
                $regex = '/^.{2,30}$/';
                break;
            case self::$EMAIL:
                $regex = '/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/';
                break;
            case self::$PASSWORD:
                $regex = '/^[a-zA-Z0-9-_]{5,30}$/';
                break;
            case self::$BIRTHDAY:
                $regex = '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/';
                break;
            case self::$GENDER:
                $regex = '/^[0-2]$/';
                break;
            case self::$USER_ID_OR_EMAIL:
                $regex = '/^[a-zA-Z0-9-_.@+]{4,}$/';
                break;
            case self::$GROUP_ID:
                $regex = '/^[a-zA-Z0-9-_]{5,30}$/';
                break;
            case self::$GROUP_NAME:
                $regex = '/^.{1,30}$/';
                break;
            case self::$PIN_CODE:
                $regex = '/^[0-9]{4}$/';
                break;
            /*
            case self::$BODY_HEIGHT:
                $regex = '/^13[0-9]|1[4-9][0-9]|2[0-4][0-9]|250$/';
                break;
            case self::$BODY_WEIGHT:
                $regex = '/^[1-9][0-9]|1[0-4][0-9]|150$/';
                break;
            */
        }

        return (preg_match($regex, $value)) ? true : false;
    }
}