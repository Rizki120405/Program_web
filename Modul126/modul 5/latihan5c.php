<?php
$nama = isset($_GET['nama']) ? htmlspecialchars($_GET['nama']) : '';
$email = isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '';

echo "<h2>Profil Mahasiswa</h2>";
echo "<p><strong>Nama:</strong> $nama</p>";
echo "<p><strong>Email:</strong> $email</p>";
echo "<p><strong>Jurusan:</strong> Teknik Informatika, Universitas Pasundan Bandung</p>";
echo "<a href='latihan5b.php'>Kembali</a>";
?>