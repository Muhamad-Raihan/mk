<?php
include ("mobil.php");

$kijang = new mobil();
$kijang -> merk =  "Toyota";
$kijang -> nama =  "Kijang LGX";
$kijang -> bbm =  "Solar";
$kijang -> tipe =  "SUV";
$kijang -> Bergerak();
$kijang -> BahanBakar();
$kijang -> Jenis();
echo "<br>";
echo "<br>";

$kijang = new mobil();
$kijang -> merk =  "Toyota";
$kijang -> nama =  "Supra Turbo";
$kijang -> bbm =  "Bensin";
$kijang -> tipe =  "Sedan";
$kijang -> Bergerak();
$kijang -> BahanBakar();
$kijang -> Jenis();
echo "<br>";
?>