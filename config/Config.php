<?php

namespace App\Core;

class Config {
    private static array $config = [];

    public static function load(string $envFile = '.env'): void {
        if (!file_exists($envFile)) {
            die("Configuration file not found: $envFile");
        }

        $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($lines as $line) {
            if (strpos($line, '#') === 0) {
                continue;
            }
            
            if (strpos($line, '=') !== false) {
                [$key, $value] = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value);
                
                // Remove quotes if present
                if ((str_starts_with($value, '"') && str_ends_with($value, '"')) ||
                    (str_starts_with($value, "'") && str_ends_with($value, "'"))) {
                    $value = substr($value, 1, -1);
                }
                
                self::$config[$key] = $value;
            }
        }
    }

    public static function get(string $key, mixed $default = null): mixed {
        return self::$config[$key] ?? $default;
    }

    public static function set(string $key, mixed $value): void {
        self::$config[$key] = $value;
    }

    public static function has(string $key): bool {
        return isset(self::$config[$key]);
    }
}
