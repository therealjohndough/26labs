<?php

namespace App\Core;

class GuestMiddleware extends Middleware {
    public function handle(): bool {
        if (Auth::isAuthenticated()) {
            header('Location: /admin/dashboard');
            return false;
        }
        return true;
    }
}
