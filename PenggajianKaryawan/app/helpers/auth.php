<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: ../public/login.php');
        exit();
    }
}

function getUserRole() {
    return isset($_SESSION['role']) ? $_SESSION['role'] : null;
}

function isAdmin() {
    return getUserRole() === 'admin';
}

function isKaryawan() {
    return getUserRole() === 'karyawan';
}

function getUserId() {
    return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
}

function getUsername() {
    return isset($_SESSION['username']) ? $_SESSION['username'] : null;
}