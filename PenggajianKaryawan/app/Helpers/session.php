<?php

function session_start_if_not()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
}

function session_set($key, $value)
{
    session_start_if_not();
    $_SESSION[$key] = $value;
}

function session_get($key)
{
    session_start_if_not();
    return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
}

function session_has($key)
{
    session_start_if_not();
    return isset($_SESSION[$key]);
}

function session_flash($key, $value = null)
{
    session_start_if_not();
    
    if ($value !== null) {
        $_SESSION[$key] = $value;
        $_SESSION[$key . '_flash'] = true;
    } else {
        if (isset($_SESSION[$key]) && isset($_SESSION[$key . '_flash'])) {
            $value = $_SESSION[$key];
            unset($_SESSION[$key], $_SESSION[$key . '_flash']);
            return $value;
        }
        return null;
    }
}

function session_destroy()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    $_SESSION = array();
    
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    
    session_destroy();
}