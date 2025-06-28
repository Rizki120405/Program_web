<?php
function hitung_pangkat($bilangan, $pangkat) {
    return pow($bilangan, $pangkat);
}

echo "<h3>Hasil Perhitungan Pangkat</h3>";
echo "2 pangkat 3 = " . hitung_pangkat(2, 3) . "<br>";
echo "5 pangkat 4 = " . hitung_pangkat(5, 4) . "<br>";
echo "10 pangkat 2 = " . hitung_pangkat(10, 2);
?>