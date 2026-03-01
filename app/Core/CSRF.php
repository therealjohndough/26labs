<?php

namespace App\Core;

class CSRF {
    private const TOKEN_KEY = '_csrf_token';
    private const TOKEN_TIME_KEY = '_csrf_token_time';

    public static function generateToken(): string {
        if (!isset($_SESSION[self::TOKEN_KEY])) {
            $_SESSION[self::TOKEN_KEY] = bin2hex(random_bytes(32));
            $_SESSION[self::TOKEN_TIME_KEY] = time();
        }
        return $_SESSION[self::TOKEN_KEY];
    }

    public static function getToken(): string {
        return self::generateToken();
    }

    public static function verify(string $token): bool {
        if (!isset($_SESSION[self::TOKEN_KEY])) {
            return false;
        }

        // Check token expiry (1 hour)
        if (time() - $_SESSION[self::TOKEN_TIME_KEY] > 3600) {
            unset($_SESSION[self::TOKEN_KEY]);
            unset($_SESSION[self::TOKEN_TIME_KEY]);
            return false;
        }

        return hash_equals($_SESSION[self::TOKEN_KEY], $token);
    }

    public static function getFieldName(): string {
        return self::TOKEN_KEY;
    }
}
