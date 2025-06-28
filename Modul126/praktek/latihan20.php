<?php
$GLOBALS['varGlobal'] = 18;
function testVar()
{
    $varLokal = 2;
    echo "<p> test variabel didalam function.</p>";
    // mengakses variabel Global didalam function
    echo "Variabel global :" . $GLOBALS['varGlobal'];
    echo "</br>";
    echo "Variabel lokal : $varLokal";
    echo "</br>";
}
testVar();

echo "<p> test variabel diluar function.</p>";
echo "Varibel global : $varGlobal ";
echo "</br>";
// mengakses di luar function
echo "Variabel lokal : $varLokal ";// variabel lokal yang terletak di dalam function tidak bisa di akses eksternal
echo "</br>";
?>