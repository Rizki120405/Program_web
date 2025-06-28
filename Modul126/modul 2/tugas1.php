<?php
function isPrime($num) {
    if($num < 2) return false;
    for($i = 2; $i <= sqrt($num); $i++) {
        if($num % $i == 0) return false;
    }
    return true;
}

for($i = 1; $i <= 20; $i++) {
    $output = "Angka $i adalah bilangan ";
    $type = [];
    
    if($i % 2 == 0) {
        $type[] = "genap";
    } else {
        $type[] = "ganjil";
    }
    
    if(isPrime($i)) {
        $type[] = "prima";
    }
    
    if(count($type) > 1) {
        $output .= implode(" sekaligus bilangan ", $type);
    } else {
        $output .= $type[0];
    }
    
    echo $output . "<br>";
}
?>