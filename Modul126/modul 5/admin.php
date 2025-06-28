<?php
session_start();

// Redirect ke login jika belum login
if(!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

// Data perusahaan teknologi
$perusahaan = [
    [
        "nama" => "Apple Inc.",
        "pendiri" => "Steve Jobs, Steve Wozniak, Ronald Wayne",
        "tahun" => 1976,
        "produk" => "iPhone, iPad, Mac",
        "logo" => "https://upload.wikimedia.org/wikipedia/commons/f/fa/Apple_logo_black.svg"
    ],
    // Data perusahaan lainnya...
    [
        "nama" => "Netflix, Inc.",
        "pendiri" => "Reed Hastings, Marc Randolph",
        "tahun" => 1997,
        "produk" => "Streaming service",
        "logo" => "https://upload.wikimedia.org/wikipedia/commons/0/08/Netflix_2015_logo.svg"
    ]
];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Data Perusahaan Teknologi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="admin-container">
        <header class="admin-header">
            <h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
            <a href="logout.php" class="logout-button">Logout</a>
        </header>
        
        <main class="admin-content">
            <h2>Daftar Perusahaan Teknologi</h2>
            
            <div class="action-buttons">
                <a href="perusahaan.php?action=tambah" class="button">Tambah Perusahaan</a>
            </div>
            
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Logo</th>
                            <th>Nama Perusahaan</th>
                            <th>Pendiri</th>
                            <th>Tahun</th>
                            <th>Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($perusahaan as $index => $p): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><img src="<?php echo htmlspecialchars($p['logo']); ?>" alt="Logo" class="company-logo"></td>
                            <td><?php echo htmlspecialchars($p['nama']); ?></td>
                            <td><?php echo htmlspecialchars($p['pendiri']); ?></td>
                            <td><?php echo htmlspecialchars($p['tahun']); ?></td>
                            <td><?php echo htmlspecialchars($p['produk']); ?></td>
                            <td class="action-cell">
                                <a href="perusahaan.php?action=edit&id=<?php echo $index; ?>" class="button edit">Edit</a>
                                <a href="perusahaan.php?action=hapus&id=<?php echo $index; ?>" class="button delete">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>