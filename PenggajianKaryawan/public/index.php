<?php
require_once '../app/helpers/auth.php';

// Check if user is logged in
if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

// Determine which page to load based on the 'page' parameter
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Include the appropriate controller and run the required action
switch ($page) {
    case 'dashboard':
        if (isAdmin()) {
            include '../resources/views/dashboard/admin.php';
        } else {
            include '../resources/views/dashboard/karyawan.php';
        }
        break;
        
    case 'karyawan':
        require_once '../app/controllers/KaryawanController.php';
        $controller = new KaryawanController();
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';
        
        if ($action === 'create' && $_POST) {
            $controller->create();
        } elseif ($action === 'create') {
            $controller->create();
        } elseif ($action === 'edit' && isset($_GET['id'])) {
            if ($_POST) {
                $controller->edit($_GET['id']);
            } else {
                $controller->edit($_GET['id']);
            }
        } elseif ($action === 'delete' && isset($_GET['id'])) {
            $controller->delete($_GET['id']);
        } else {
            $controller->index();
        }
        break;
        
    case 'absensi':
        require_once '../app/controllers/AbsensiController.php';
        $controller = new AbsensiController();
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';
        
        if ($action === 'create' && $_POST) {
            $controller->create();
        } elseif ($action === 'create') {
            $controller->create();
        } elseif ($action === 'edit' && isset($_GET['id'])) {
            if ($_POST) {
                $controller->edit($_GET['id']);
            } else {
                $controller->edit($_GET['id']);
            }
        } elseif ($action === 'delete' && isset($_GET['id'])) {
            $controller->delete($_GET['id']);
        } else {
            $controller->index();
        }
        break;
        
    case 'penggajian':
        require_once '../app/controllers/PenggajianController.php';
        $controller = new PenggajianController();
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';
        
        if ($action === 'create' && $_POST) {
            $controller->create();
        } elseif ($action === 'create') {
            $controller->create();
        } elseif ($action === 'edit' && isset($_GET['id'])) {
            if ($_POST) {
                $controller->edit($_GET['id']);
            } else {
                $controller->edit($_GET['id']);
            }
        } elseif ($action === 'delete' && isset($_GET['id'])) {
            $controller->delete($_GET['id']);
        } elseif ($action === 'slip' && isset($_GET['id'])) {
            $controller->generateSlipGaji($_GET['id']);
        } else {
            $controller->index();
        }
        break;
        
    default:
        if (isAdmin()) {
            include '../resources/views/dashboard/admin.php';
        } else {
            include '../resources/views/dashboard/karyawan.php';
        }
        break;
}