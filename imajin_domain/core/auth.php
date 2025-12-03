<?php
require_once 'functions.php';
require_once 'validation.php';

// Login function
function login_user($username, $password) {
    global $pdo;
    
    // Sanitize inputs
    $username = sanitize_input($username);
    
    // Prepare statement to prevent SQL injection
    $stmt = $pdo->prepare("SELECT id, username, password, email FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $username]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['last_activity'] = time();
        
        return true;
    }
    
    return false;
}

// Register function
function register_user($username, $email, $password) {
    global $pdo;
    
    // Sanitize inputs
    $username = sanitize_input($username);
    $email = sanitize_input($email);
    
    // Validate inputs
    if (!validate_username($username)) {
        return false;
    }
    
    if (!validate_email($email)) {
        return false;
    }
    
    if (strlen($password) < 6) {
        return false;
    }
    
    // Check if username or email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);
    
    if ($stmt->rowCount() > 0) {
        return false;
    }
    
    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert new user
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    
    return $stmt->execute([$username, $email, $hashed_password]);
}

// Logout function
function logout_user() {
    session_unset();
    session_destroy();
    redirect('index.php');
}

// Check if user is logged in
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// Require login for protected pages
function require_login() {
    if (!is_logged_in()) {
        redirect('login.php');
    }
}

// Check if current user has admin privileges
function is_admin() {
    if (!is_logged_in()) {
        return false;
    }
    
    global $pdo;
    $stmt = $pdo->prepare("SELECT is_admin FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    
    return $user && $user['is_admin'] == 1;
}

// Require admin privileges
function require_admin() {
    if (!is_admin()) {
        redirect('error/403.php');
    }
}