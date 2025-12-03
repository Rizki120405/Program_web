<?php

function base_url($path = '')
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $basePath = dirname($_SERVER['SCRIPT_NAME']);
    
    if ($basePath === '/') {
        $basePath = '';
    }
    
    return $protocol . '://' . $host . $basePath . '/' . ltrim($path, '/');
}

function redirect($path)
{
    header('Location: ' . base_url($path));
    exit();
}

function url($path = '')
{
    return base_url($path);
}