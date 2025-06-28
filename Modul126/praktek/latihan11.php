<?php
$nama = ["Ahmad", "Budi", "Chika", "Dhini", "Erwin"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    for ($i = 0; $i < count($nama); $i++) { //count digunakan untuk membatasi looping berhenti setelah semua nilai array terinput
        echo "<li>$nama[$i]";
    } ?>
</body>

</html>