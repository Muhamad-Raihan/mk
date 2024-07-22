<?php
include ("orang.php");

$raihan = new orang(); //instansiasi
$raihan -> nama = "Muhammad Raihan Syahfitrah";
$raihan -> UcapSalam();
echo "<br>";

$nara = new orang();
$nara -> nama = "Naura";
$nara -> UcapSalam();
?>