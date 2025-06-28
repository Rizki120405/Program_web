<?php
function varStatic()
{
    static $x = 1; //Mendeklarasikan variabel statis
    echo $x;
    $x++;
    echo "</br>";
}
varStatic();//memanggil function varStatic
varStatic();
varStatic();
varStatic();

?>