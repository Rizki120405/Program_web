<?php

namespace App\Controllers;

use App\Core\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Cek apakah pengguna sudah login
        \App\Core\Auth::check();
        
        $data = [
            'title' => 'Dashboard',
            'user' => \App\Core\Auth::user()
        ];
        
        $this->view('dashboard/index', $data);
    }
}