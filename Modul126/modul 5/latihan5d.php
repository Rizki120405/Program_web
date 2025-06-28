<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $angka = isset($_POST['angka']) ? (int)$_POST['angka'] : 0;
    
    if($angka <= 0) {
        echo "Angka harus lebih besar dari 0.";
    } else {
        for($i = $angka; $i >= 1; $i--) {
            for($j = 1; $j <= $i; $j++) {
                echo $j . " ";
            }
            echo "<br>";
        }
    }
} else {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Latihan5d</title>
</head>
<body>
    <form method="post">
        <label>Masukan angka: </label>
        <input type="number" name="angka" required>
        <button type="submit">Tampilkan!</button>
    </form>
</body>
</html>
<?php } ?>