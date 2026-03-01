<?php

namespace App\Core;

use App\Models\User;

class Auth {
    private const SESSION_KEY = 'auth_user_id';
    private const REMEMBER_KEY = 'remember_token';

    public static function login(string $email, string $password, bool $remember = false): bool {
        $user = User::findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            return false;
        }

        self::setSession($user['id']);

        if ($remember) {
            self::setRememberToken($user['id']);
        }

        return true;
    }

    public static function setSession(int $userId): void {
        $_SESSION[self::SESSION_KEY] = $userId;
        $_SESSION['_session_created'] = time();
        $_SESSION['_user_ip'] = $this->getUserIP();
        $_SESSION['_user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? '';
    }

    public static function isAuthenticated(): bool {
        if (!isset($_SESSION[self::SESSION_KEY])) {
            return false;
        }

        $user = User::find($_SESSION[self::SESSION_KEY]);
        return $user !== null;
    }

    public static function getUser(): ?array {
        if (!self::isAuthenticated()) {
            return null;
        }

        return User::find($_SESSION[self::SESSION_KEY]);
    }

    public static function getId(): ?int {
        return $_SESSION[self::SESSION_KEY] ?? null;
    }

    public static function logout(): void {
        session_destroy();
        setcookie(self::REMEMBER_KEY, '', time() - 3600, '/');
    }

    public static function requireAuth(): void {
        if (!self::isAuthenticated()) {
            header('Location: /admin/login');
            exit;
        }
    }

    private static function setRememberToken(int $userId): void {
        $token = bin2hex(random_bytes(32));
        $hashedToken = hash('sha256', $token);
        $expiry = time() + (7 * 24 * 60 * 60); // 7 days

        User::updateRememberToken($userId, $hashedToken, $expiry);
        setcookie(self::REMEMBER_KEY, $token, $expiry, '/', '', true, true);
    }

    private static function getUserIP(): string {
        if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            return $_SERVER['HTTP_CF_CONNECTING_IP'];
        }
        return $_SERVER['REMOTE_ADDR'] ?? '';
    }
}
