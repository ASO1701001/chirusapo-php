<?php
namespace Application\lib;

class Error {
    public static $REQUIRED_PARAM = 'REQUIRED_PARAM';
    public static $VALIDATION_USER_ID = 'VALIDATION_USER_ID';
    public static $VALIDATION_USER_NAME = 'VALIDATION_USER_NAME';
    public static $VALIDATION_EMAIL = 'VALIDATION_EMAIL';
    public static $VALIDATION_PASSWORD = 'VALIDATION_PASSWORD';
    public static $VALIDATION_BIRTHDAY = 'VALIDATION_BIRTHDAY';
    public static $VALIDATION_GENDER = 'VALIDATION_GENDER';
    public static $ALREADY_USER_ID = 'ALREADY_USER_ID';
    public static $ALREADY_EMAIL = 'ALREADY_EMAIL';
    public static $UNKNOWN_USER = 'UNKNOWN_USER';
    public static $MAIL_SEND = 'MAIL_SEND';
    public static $UNKNOWN_TOKEN = 'UNKNOWN_TOKEN';
    public static $UNKNOWN_GROUP = 'UNKNOWN_GROUP';
    public static $ALREADY_BELONG_GROUP = 'ALREADY_BELONG_GROUP';
}