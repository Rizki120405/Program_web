<!DOCTYPE html>
<html>
<head>
    <title>Latihan1c</title>
    <style>
        .kotak {
            width: 30px;
            height: 30px;
            background-color: #BADA55;
            text-align: center;
            line-height: 30px;
            margin: 3px;
            float: left;
            transition: 1s;
        }
        .kotak:hover {
            transform: rotate(360deg);
            border-radius: 50%;
        }
        .clear {
            clear: both;
        }
    </style>
</head>
<body>
    <?php
    $huruf = ['A', 'B', 'C'];
    for($i = 1; $i <= 3; $i++) {
        for($j = 0; $j < $i; $j++) {
            echo '<div class="kotak">'.$huruf[$j].'</div>';
        }
        echo '<div class="clear"></div>';
    }
    ?>
</body>
</html>