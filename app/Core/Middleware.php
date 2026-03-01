<?php

namespace App\Core;

abstract class Middleware {
    abstract public function handle(): bool;
}

class AuthMiddleware extends Middleware {
    public function handle(): bool {
        if (!Auth::isAuthenticated()) {
            header('Location: /admin/login');
            return false;
        }
        return true;
    }
}

class GuestMiddleware extends Middleware {
    public function handle(): bool {
        if (Auth::isAuthenticated()) {
            header('Location: /admin/dashboard');
            return false;
        }
        return true;
    }
}
