<?php
$budaya_items = [
    "Tari Kecak" => "Tari tradisional Bali...",
    "Wayang Kulit" => "Seni pertunjukan Jawa...",
];

$selected = isset($_GET["budaya"]) ? $_GET["budaya"] : "";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Detail Budaya (NIM 126)</title>
</head>
<body>
    <?php if (array_key_exists($selected, $budaya_items)): ?>
        <h1><?= $selected ?></h1>
        <p><?= $budaya_items[$selected] ?></p>
    <?php else: ?>
        <p>Budaya tidak ditemukan</p>
    <?php endif; ?>
    <a href="latihan6.php">Kembali</a>
</body>
</html>