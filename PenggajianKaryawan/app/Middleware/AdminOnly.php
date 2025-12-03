<?php

namespace App\Middleware;

use App\Core\Auth;

class AdminOnly
{
    public static function handle()
    {
        $user = Auth::user();
        
        if (!$user || $user['role'] !== 'admin') {
            header('HTTP/1.1 403 Forbidden');
            echo "Akses ditolak. Hanya admin yang dapat mengakses halaman ini.";
            exit();
        }
    }
}