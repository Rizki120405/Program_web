<?php
$x = 19;
echo "x = $x </br>";

//menggunakan statmen IF-ELSE 
if ($x % 2 == 0) {
    echo "$x adalah bilangan genap";
} else {
    echo "$x adalah bilangan ganjil";
}
echo "</br></br>";

//menggunakan statement IF-ELSEIF-ELSE
$tahun = "2018";
if ($tahun == "2015") {
    echo "Sekarang tahun 2015";
} elseif ($tahun == "2016") {
    echo "Sekarang tahun 2016";
} elseif ($tahun == "2017") {
    echo "Sekarang tahun 2017";
} else {
    echo "sekarang tahun 2018";
}
?>