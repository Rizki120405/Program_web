<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $this->view('auth/login');
    }

    public function login()
    {
        $userModel = new User();
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            // Login berhasil
            \App\Core\Auth::login($user);
            header('Location: /dashboard');
            exit();
        } else {
            // Login gagal
            $_SESSION['error'] = 'Email atau password salah';
            header('Location: /login');
            exit();
        }
    }

    public function logout()
    {
        \App\Core\Auth::logout();
        header('Location: /login');
        exit();
    }
}