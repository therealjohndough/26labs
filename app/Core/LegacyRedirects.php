<?php

namespace App\Core;

class LegacyRedirects {
    public static function handle(): void {
        $redirectFile = APP_ROOT . '/config/redirects.php';

        if (!file_exists($redirectFile)) {
            return;
        }

        $redirects = require $redirectFile;

        if (!is_array($redirects) || $redirects === []) {
            return;
        }

        $requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
        $normalizedPath = self::normalizePath($requestPath);

        if (!isset($redirects[$normalizedPath])) {
            return;
        }

        $destination = trim((string) $redirects[$normalizedPath]);

        if ($destination === '') {
            return;
        }

        $targetUrl = self::toAbsoluteUrl($destination);

        if ($targetUrl === '') {
            return;
        }

        $queryString = $_SERVER['QUERY_STRING'] ?? '';
        if ($queryString !== '' && !str_contains($targetUrl, '?')) {
            $targetUrl .= '?' . $queryString;
        }

        if (self::normalizePath(parse_url($targetUrl, PHP_URL_PATH) ?: '/') === $normalizedPath) {
            return;
        }

        header('Location: ' . $targetUrl, true, 301);
        exit;
    }

    private static function normalizePath(string $path): string {
        $path = '/' . ltrim($path, '/');

        if ($path !== '/') {
            $path = rtrim($path, '/');
        }

        return $path;
    }

    private static function toAbsoluteUrl(string $destination): string {
        if (preg_match('#^https?://#i', $destination)) {
            return $destination;
        }

        $baseUrl = rtrim((string) Config::get('APP_URL', ''), '/');

        if ($baseUrl === '') {
            return '';
        }

        return $baseUrl . '/' . ltrim($destination, '/');
    }
}
