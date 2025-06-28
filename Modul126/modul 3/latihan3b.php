<?php
echo "<h3>Perbedaan isset() dan empty()</h3>";
echo "<p><strong>isset()</strong> digunakan untuk mengecek apakah suatu variabel sudah didefinisikan dan tidak NULL.</p>";
echo "<p><strong>empty()</strong> digunakan untuk mengecek apakah variabel kosong (0, '', NULL, false, array kosong).</p>";

echo "<h4>Contoh:</h4>";
$x = "";
echo "\$x = \"\"<br>";
echo "isset(\$x): " . (isset($x) ? 'TRUE' : 'FALSE') . "<br>";
echo "empty(\$x): " . (empty($x) ? 'TRUE' : 'FALSE') . "<br><br>";

$y = null;
echo "\$y = null<br>";
echo "isset(\$y): " . (isset($y) ? 'TRUE' : 'FALSE') . "<br>";
echo "empty(\$y): " . (empty($y) ? 'TRUE' : 'FALSE') . "<br><br>";

$z = array();
echo "\$z = array()<br>";
echo "isset(\$z): " . (isset($z) ? 'TRUE' : 'FALSE') . "<br>";
echo "empty(\$z): " . (empty($z) ? 'TRUE' : 'FALSE') . "<br>";
?>