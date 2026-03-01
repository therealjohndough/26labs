<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Core\CSRF;
use App\Core\Validator;
use App\Models\User;

class AuthController {
    public function showLogin(): void {
        if (Auth::isAuthenticated()) {
            header('Location: /admin/dashboard');
            exit;
        }

        $this->render('admin/login', [
            'title' => 'Admin Login',
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function login(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        $csrf = $_POST[CSRF::getFieldName()] ?? '';
        if (!CSRF::verify($csrf)) {
            http_response_code(403);
            die('CSRF token invalid');
        }

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (Auth::login($email, $password)) {
            header('Location: /admin/dashboard');
            exit;
        }

        $this->render('admin/login', [
            'title' => 'Admin Login',
            'error' => 'Invalid email or password',
            'csrf_token' => CSRF::getToken(),
            'csrf_field' => CSRF::getFieldName(),
        ]);
    }

    public function logout(): void {
        Auth::logout();
        header('Location: /admin/login');
        exit;
    }

    private function render(string $view, array $data = []): void {
        extract($data);
        require __DIR__ . '/../../views/' . $view . '.php';
    }
}
