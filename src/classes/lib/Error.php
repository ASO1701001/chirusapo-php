<?php
namespace Application\lib;

class Error {
    // etc.
    public static $REQUIRED_PARAM = 'REQUIRED_PARAM';
    public static $ALLOW_EXTENSION = 'ALLOW_EXTENSION';
    public static $UPLOAD_FAILED = 'UPLOAD_FAILED';
    public static $MAIL_SEND = 'MAIL_SEND';
    // Account
    public static $VALIDATION_USER_ID = 'VALIDATION_USER_ID';
    public static $VALIDATION_USER_NAME = 'VALIDATION_USER_NAME';
    public static $VALIDATION_EMAIL = 'VALIDATION_EMAIL';
    public static $VALIDATION_PASSWORD = 'VALIDATION_PASSWORD';
    public static $VALIDATION_BIRTHDAY = 'VALIDATION_BIRTHDAY';
    public static $VALIDATION_GENDER = 'VALIDATION_GENDER';
    public static $ALREADY_USER_ID = 'ALREADY_USER_ID';
    public static $ALREADY_EMAIL = 'ALREADY_EMAIL';
    public static $UNKNOWN_USER = 'UNKNOWN_USER';
    public static $VALIDATION_LINE_ID = 'VALIDATION_LINE_ID';
    public static $VALIDATION_INTRODUCTION = 'VALIDATION_INTRODUCTION';
    // Token
    public static $UNKNOWN_TOKEN = 'UNKNOWN_TOKEN';
    // Group
    public static $UNKNOWN_GROUP = 'UNKNOWN_GROUP';
    public static $ALREADY_CREATE_GROUP = 'ALREADY_CREATE_GROUP';
    public static $ALREADY_BELONG_GROUP = 'ALREADY_BELONG_GROUP';
    public static $UNREADY_BELONG_GROUP = 'UNREADY_BELONG_GROUP';
    public static $VALIDATION_GROUP_ID = 'VALIDATION_GROUP_ID';
    public static $VALIDATION_GROUP_NAME = 'VALIDATION_GROUP_NAME';
    public static $VALIDATION_PIN_CODE = 'VALIDATION_PIN_CODE';
    public static $VERIFY_PIN_CODE = 'VERIFY_PIN_CODE';
    // Timeline
    public static $NOT_FIND_POST_CONTENT = 'NOT_FIND_POST_CONTENT';
    public static $DUPLICATE_MEDIA_FILE = 'DUPLICATE_MEDIA_FILE';
    public static $VALIDATION_TIMELINE_POST_CONTENT = 'VALIDATION_TIMELINE_POST_CONTENT';
    public static $GENERATE_THUMBNAIL = 'GENERATE_THUMBNAIL';
}