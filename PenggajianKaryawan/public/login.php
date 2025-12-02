<?php
require_once '../app/helpers/auth.php';

// If already logged in, redirect to dashboard
if (isLoggedIn()) {
    if (isAdmin()) {
        header('Location: index.php?page=dashboard');
    } else {
        header('Location: index.php?page=dashboard');
    }
    exit();
}

// Include the login view
include '../resources/views/auth/login.php';