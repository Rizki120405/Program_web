<?php
require_once '../config/database.php';
require_once '../models/User.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function login() {
        if ($_POST) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            $user = $this->userModel->authenticate($username, $password);
            
            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                
                if ($user['role'] == 'admin') {
                    header('Location: ../resources/views/dashboard/admin.php');
                } else {
                    header('Location: ../resources/views/dashboard/karyawan.php');
                }
                exit();
            } else {
                $error = "Username atau password salah!";
            }
        }
        
        include '../resources/views/auth/login.php';
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: ../../public/login.php');
        exit();
    }
}