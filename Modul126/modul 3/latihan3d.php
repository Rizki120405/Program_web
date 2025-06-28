<?php
function faktorial($n) {
    if($n <= 1) {
        return 1;
    } else {
        return $n * faktorial($n - 1);
    }
}

echo "<h3>Hasil Perhitungan Faktorial</h3>";
echo "Faktorial 5 = " . faktorial(5) . "<br>";
echo "Faktorial 7 = " . faktorial(7) . "<br>";
echo "Faktorial 10 = " . faktorial(10);
?>