<?php

require_once '../vendor/autoload.php';

// Mulai session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Include helper functions
require_once '../app/Helpers/url.php';
require_once '../app/Helpers/csrf.php';
require_once '../app/Helpers/session.php';

use App\Core\Router;

$router = new Router();

// Route untuk autentikasi
$router->get('/login', 'App\Controllers\AuthController@showLoginForm');
$router->post('/login', 'App\Controllers\AuthController@login');
$router->get('/logout', 'App\Controllers\AuthController@logout');

// Route untuk dashboard
$router->get('/', 'App\Controllers\DashboardController@index');
$router->get('/dashboard', 'App\Controllers\DashboardController@index');

// Route untuk karyawan
$router->get('/karyawan', 'App\Controllers\KaryawanController@index');
$router->get('/karyawan/create', 'App\Controllers\KaryawanController@create');
$router->post('/karyawan', 'App\Controllers\KaryawanController@store');
$router->get('/karyawan/{id}/edit', 'App\Controllers\KaryawanController@edit');
$router->post('/karyawan/{id}', 'App\Controllers\KaryawanController@update');
$router->delete('/karyawan/{id}', 'App\Controllers\KaryawanController@delete');

// Route untuk absensi
$router->get('/absensi', 'App\Controllers\AbsensiController@index');
$router->get('/absensi/create', 'App\Controllers\AbsensiController@create');
$router->post('/absensi', 'App\Controllers\AbsensiController@store');
$router->get('/absensi/{id}/edit', 'App\Controllers\AbsensiController@edit');
$router->post('/absensi/{id}', 'App\Controllers\AbsensiController@update');
$router->delete('/absensi/{id}', 'App\Controllers\AbsensiController@delete');

// Route untuk penggajian
$router->get('/penggajian', 'App\Controllers\PenggajianController@index');
$router->get('/penggajian/create', 'App\Controllers\PenggajianController@create');
$router->post('/penggajian', 'App\Controllers\PenggajianController@store');
$router->get('/penggajian/{id}/edit', 'App\Controllers\PenggajianController@edit');
$router->post('/penggajian/{id}', 'App\Controllers\PenggajianController@update');
$router->delete('/penggajian/{id}', 'App\Controllers\PenggajianController@delete');
$router->get('/penggajian/{id}/slip', 'App\Controllers\PenggajianController@generateSlipGaji');

// Resolve request
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$router->resolve($uri, $method);