<?php
session_start();

// Cek login
if(!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

// Data perusahaan (dalam aplikasi nyata seharusnya menggunakan database)
$perusahaan = [
    // Data perusahaan sama seperti di admin.php
];

// Tangani aksi CRUD
$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? null;

// Proses form jika ada data POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'nama' => $_POST['nama'] ?? '',
        'pendiri' => $_POST['pendiri'] ?? '',
        'tahun' => $_POST['tahun'] ?? '',
        'produk' => $_POST['produk'] ?? '',
        'logo' => $_POST['logo'] ?? ''
    ];
    
    // Validasi sederhana
    $errors = [];
    if(empty($data['nama'])) $errors[] = 'Nama perusahaan harus diisi';
    if(empty($data['pendiri'])) $errors[] = 'Nama pendiri harus diisi';
    if(!is_numeric($data['tahun'])) $errors[] = 'Tahun harus angka';
    
    if(empty($errors)) {
        if($action == 'tambah') {
            $perusahaan[] = $data;
            // Simpan ke database (dalam contoh ini hanya ke session)
            $_SESSION['message'] = 'Data perusahaan berhasil ditambahkan';
            header('Location: admin.php');
            exit;
        } elseif($action == 'edit' && isset($id)) {
            $perusahaan[$id] = $data;
            $_SESSION['message'] = 'Data perusahaan berhasil diupdate';
            header('Location: admin.php');
            exit;
        }
    }
}

// Hapus data
if($action == 'hapus' && isset($id)) {
    unset($perusahaan[$id]);
    $_SESSION['message'] = 'Data perusahaan berhasil dihapus';
    header('Location: admin.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo ucfirst($action); ?> Perusahaan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h1><?php echo ucfirst($action); ?> Data Perusahaan</h1>
        
        <?php if(!empty($errors)): ?>
            <div class="error-message">
                <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form method="post" class="company-form">
            <div class="form-group">
                <label for="nama">Nama Perusahaan</label>
                <input type="text" id="nama" name="nama" value="<?php echo $action == 'edit' ? htmlspecialchars($perusahaan[$id]['nama']) : ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="pendiri">Pendiri</label>
                <input type="text" id="pendiri" name="pendiri" value="<?php echo $action == 'edit' ? htmlspecialchars($perusahaan[$id]['pendiri']) : ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="tahun">Tahun Berdiri</label>
                <input type="number" id="tahun" name="tahun" value="<?php echo $action == 'edit' ? htmlspecialchars($perusahaan[$id]['tahun']) : ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="produk">Produk Utama</label>
                <input type="text" id="produk" name="produk" value="<?php echo $action == 'edit' ? htmlspecialchars($perusahaan[$id]['produk']) : ''; ?>" required>
            </div>
            
            <div class="form-group">
                <label for="logo">URL Logo</label>
                <input type="url" id="logo" name="logo" value="<?php echo $action == 'edit' ? htmlspecialchars($perusahaan[$id]['logo']) : ''; ?>" required>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="button save">Simpan</button>
                <a href="admin.php" class="button cancel">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>