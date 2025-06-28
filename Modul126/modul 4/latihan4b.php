<?php
$negara = ["Indonesia", "Singapura", "Malaysia", "Brunei", "Thailand"];

echo "<h3>Daftar Negara ASEAN awal :</h3>";
echo "<ul>";
foreach($negara as $n) {
    echo "<li>$n</li>";
}
echo "</ul>";

// Menambahkan 3 negara baru
array_push($negara, "Laos", "Filipina", "Myanmar");

echo "<h3>Daftar Negara ASEAN baru :</h3>";
echo "<ul>";
foreach($negara as $n) {
    echo "<li>$n</li>";
}
echo "</ul>";
?>