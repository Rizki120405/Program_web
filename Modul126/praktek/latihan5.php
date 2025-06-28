<?php
$budaya_baru = "";
if (isset($_POST["budaya"])) {
    $budaya_baru = htmlspecialchars($_POST["budaya"]);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Budaya (NIM 126)</title>
</head>
<body>
    <form method="post">
        <input type="text" name="budaya" placeholder="Masukkan budaya baru">
        <button type="submit">Tambahkan</button>
    </form>
    <?php if (!empty($budaya_baru)): ?>
        <p>Budaya <?= $budaya_baru ?> berhasil ditambahkan!</p>
    <?php endif; ?>
</body>
</html>