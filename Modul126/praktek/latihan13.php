<?php
$budaya = [
    "BD12601" => "Tari Kecak - Bali",
    "BD12602" => "Wayang Kulit - Jawa Tengah",
    "BD12603" => "Batik - Jawa",
    "BD12604" => "Angklung - Jawa Barat",
    "BD12605" => "Rendang - Sumatera Barat"
];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Budaya Indonesia (NIM 126)</title>
</head>
<body>
    <h2>Daftar Budaya Indonesia</h2>
    <ul>
    <?php foreach ($budaya as $kode => $detail): ?>
        <li><strong><?= $kode ?></strong>: <?= $detail ?></li>
    <?php endforeach; ?>
    </ul>
</body>
</html>