<?php
require_once '../../../app/helpers/auth.php';
requireLogin();

if (!isKaryawan()) {
    header('Location: ../public/login.php');
    exit();
}

$title = 'Dashboard Karyawan';
ob_start();
?>

<div class="row">
    <div class="col-md-12">
        <h2>Selamat Datang, <?php echo getUsername(); ?>!</h2>
        <p>Dashboard Karyawan Sistem Penggajian</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-user"></i> Profil Saya</h5>
                <p class="card-text">Lihat dan edit profil karyawan</p>
                <a href="?page=profile" class="btn btn-light btn-sm">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-calendar-check"></i> Absensi Saya</h5>
                <p class="card-text">Lihat riwayat absensi</p>
                <a href="?page=absensi" class="btn btn-light btn-sm">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-money-bill-wave"></i> Slip Gaji</h5>
                <p class="card-text">Lihat slip gaji saya</p>
                <a href="?page=penggajian" class="btn btn-light btn-sm">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-chart-bar"></i> Statistik</h5>
                <p class="card-text">Statistik kinerja saya</p>
                <a href="?page=statistik" class="btn btn-light btn-sm">Lihat</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Riwayat Gaji Terakhir</h5>
            </div>
            <div class="card-body">
                <p>Menampilkan informasi gaji terakhir Anda</p>
                <!-- Data akan ditampilkan dari database -->
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Statistik Absensi</h5>
            </div>
            <div class="card-body">
                <p>Menampilkan statistik absensi Anda</p>
                <!-- Data akan ditampilkan dari database -->
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include '../layouts/main.php';
?>