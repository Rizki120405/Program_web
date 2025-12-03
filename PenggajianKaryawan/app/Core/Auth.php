<?php

namespace App\Core;

class Auth
{
    public static function user()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        return isset($_SESSION['user']) ? $_SESSION['user'] : null;
    }

    public static function check()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit();
        }
    }

    public static function login($user)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $_SESSION['user'] = $user;
    }

    public static function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        unset($_SESSION['user']);
        session_destroy();
    }

    public static function id()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        return isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;
    }
}