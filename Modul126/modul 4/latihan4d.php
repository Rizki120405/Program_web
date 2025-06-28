<?php
$negara = [
    ["Negara" => "Indonesia", "Ibukota" => "D.K.I. Jakarta", "Kode Telepon" => "+62"],
    ["Negara" => "Singapura", "Ibukota" => "Singapura", "Kode Telepon" => "+65"],
    ["Negara" => "Malaysia", "Ibukota" => "Kuala Lumpur", "Kode Telepon" => "+60"],
    ["Negara" => "Brunei", "Ibukota" => "Bandar Seri Begawan", "Kode Telepon" => "+673"],
    ["Negara" => "Thailand", "Ibukota" => "Bangkok", "Kode Telepon" => "+66"],
    ["Negara" => "Laos", "Ibukota" => "Vientiane", "Kode Telepon" => "+856"],
    ["Negara" => "Filipina", "Ibukota" => "Manila", "Kode Telepon" => "+63"],
    ["Negara" => "Myanmar", "Ibukota" => "Naypyidaw", "Kode Telepon" => "+95"]
];

echo "<h3>Daftar Negara ASEAN</h3>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Negara</th><th>Ibukota</th><th>Kode Telepon</th></tr>";
foreach($negara as $n) {
    echo "<tr>";
    echo "<td>".$n['Negara']."</td>";
    echo "<td>".$n['Ibukota']."</td>";
    echo "<td>".$n['Kode Telepon']."</td>";
    echo "</tr>";
}
echo "</table>";
?>