<?php

class CSRFToken {

    protected static $tokenName = 'csrf_token';
    protected static $token;

    public function __construct() {}

    public static function genererToken() {
        self::$token = bin2hex(random_bytes(32));
        $_SESSION[self::$tokenName] = self::$token;
        return self::$token;
    }

    public static function verifierToken($token) {
        return isset($_SESSION[self::$tokenName]) && hash_equals($_SESSION[self::$tokenName], $token);
    }

    public static function getTokenName() {
        return self::$tokenName;
    }

    public static function getToken() {
        return self::$token;
    }
}
?>
