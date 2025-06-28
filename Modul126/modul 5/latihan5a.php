<?php
$angka = isset($_GET['angka']) ? (int)$_GET['angka'] : 0;

if($angka <= 0) {
    echo "Parameter 'angka' tidak valid atau tidak ditemukan.";
} else {
    for($i = $angka; $i >= 1; $i--) {
        for($j = 1; $j <= $i; $j++) {
            echo $j;
        }
        echo "<br>";
    }
}
?>