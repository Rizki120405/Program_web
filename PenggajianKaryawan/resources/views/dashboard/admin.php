<?php
require_once '../../../app/helpers/auth.php';
requireLogin();

if (!isAdmin()) {
    header('Location: ../public/login.php');
    exit();
}

$title = 'Dashboard Admin';
ob_start();
?>

<div class="row">
    <div class="col-md-12">
        <h2>Selamat Datang, <?php echo getUsername(); ?>!</h2>
        <p>Dashboard Administrator Sistem Penggajian Karyawan</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-users"></i> Karyawan</h5>
                <p class="card-text">Manajemen data karyawan</p>
                <a href="?page=karyawan" class="btn btn-light btn-sm">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-calendar-check"></i> Absensi</h5>
                <p class="card-text">Manajemen absensi karyawan</p>
                <a href="?page=absensi" class="btn btn-light btn-sm">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-money-bill-wave"></i> Penggajian</h5>
                <p class="card-text">Manajemen penggajian karyawan</p>
                <a href="?page=penggajian" class="btn btn-light btn-sm">Lihat</a>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-user-cog"></i> Pengguna</h5>
                <p class="card-text">Manajemen pengguna sistem</p>
                <a href="?page=users" class="btn btn-light btn-sm">Lihat</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Statistik Karyawan</h5>
            </div>
            <div class="card-body">
                <canvas id="karyawanChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Statistik Gaji</h5>
            </div>
            <div class="card-body">
                <canvas id="gajiChart"></canvas>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include '../layouts/main.php';
?>