<?php

namespace App\Core;

class AuthMiddleware extends Middleware {
    public function handle(): bool {
        if (!Auth::isAuthenticated()) {
            header('Location: /admin/login');
            return false;
        }
        return true;
    }
}
