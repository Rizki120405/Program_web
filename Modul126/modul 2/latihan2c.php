<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modul 2 - Latihan 1</title>
    <style>
        .ganjil {
            background-color: #883;
            color: #fff;
        }
        .genap {
            background-color: #999;
        }
    </style>
</head>
<body>
    <table border="1" cellpadding="3" cellspacing="0">
        <tr>
            <th>Kolom 1</th>
            <th>Kolom 2</th>
            <th>Kolom 3</th>
            <th>Kolom 4</th>
            <th>Kolom 5</th>
        </tr>
        <?php
        $baris = 15;
        $kolom = 5;
        
        for($i = 1; $i <= $baris; $i++) {
            $class = ($i % 2 == 0) ? 'genap' : 'ganjil';
            echo "<tr class='$class'>";
            for($j = 1; $j <= $kolom; $j++) {
                echo "<td>Baris $i Kolom $j</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>