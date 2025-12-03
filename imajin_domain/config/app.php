<?php
// Global configuration
session_start();

// Timezone
date_default_timezone_set('UTC');

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Application constants
define('APP_NAME', 'Imajin Domain');
define('BASE_URL', 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']));
define('UPLOAD_PATH', __DIR__ . '/../assets/uploads/portraits/');

// Include other config files
require_once 'database.php';
require_once 'session.php';