<div class="row">
    <div class="col-12">
        <h2>Selamat Datang, <?php echo htmlspecialchars($user['nama']); ?>!</h2>
        <p>Di Aplikasi Penggajian Karyawan</p>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Karyawan</h5>
                <p class="card-text">Data Karyawan</p>
                <a href="/karyawan" class="btn btn-light">Lihat</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Absensi</h5>
                <p class="card-text">Data Absensi</p>
                <a href="/absensi" class="btn btn-light">Lihat</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Penggajian</h5>
                <p class="card-text">Data Penggajian</p>
                <a href="/penggajian" class="btn btn-light">Lihat</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Laporan</h5>
                <p class="card-text">Laporan Gaji</p>
                <a href="#" class="btn btn-light">Lihat</a>
            </div>
        </div>
    </div>
</div>