<?php

namespace App\Middleware;

use App\Core\Auth;

class AuthOnly
{
    public static function handle()
    {
        if (!Auth::user()) {
            header('Location: /login');
            exit();
        }
    }
}