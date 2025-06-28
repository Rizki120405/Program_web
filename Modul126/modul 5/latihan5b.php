<?php
$mahasiswa = [
    ["nama" => "Fahmi Ramadhan", "email" => "fahmi@mail.unpas.ac.id"],
    ["nama" => "Tanti Yuliawati", "email" => "tanti@mail.unpas.ac.id"],
    ["nama" => "Muhammad Faisal", "email" => "faisal@mail.unpas.ac.id"]
];

echo "<h2>Daftar Mahasiswa</h2>";
foreach($mahasiswa as $m) {
    $url = "latihan5c.php?nama=".urlencode($m['nama'])."&email=".urlencode($m['email']);
    echo "<p><a href='$url'>".$m['nama']."</a></p>";
    echo "<p>".$m['email']."</p>";
    echo "<hr>";
}
?>