<?php
$hari = ["Senin", "Selasa", "Rabu"];
echo "array awal :";
print_r($hari);
echo "<hr>";

echo "array setelah di pop :";
$hasil = array_pop($hari);//menghapus atau mengambil elemen terakhir dari array
print_r($hari);
echo "<br>elemen yang di pop : $hasil <hr>";


echo "array setelah di push :";
$hasil = array_push($hasil, "kamis", "jumat");//menambahkan beberapa elemen pada akhir array
print_r($hasil);
echo "<hr>";

echo "array setelah di shift : ";
$hasil = array_shift($hari); // menghapus atau mengambil elemen pertama dari array
print_r($hari);
echo "<br>elemen yang di shift : $hasil <hr>";

echo "array setelah di unshift : ";
$hasil = array_unshift($hari, "elemen", "ditambahkan"); //menambahkan beberapa elemen pada akhir array
print_r($hari);
?>