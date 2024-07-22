<?php
include ("hewan.php");

$kucing = new hewan();
$kucing -> nama =  "Kucing";
$kucing -> suara =  "meong-meong";
$kucing -> gerak =  "Berjalan, Berlari dan Melompat";
$kucing -> Bergerak();
$kucing -> Bersuara();
echo "<br>";
echo "<br>";

$burung = new hewan();
$burung -> nama =  "Burung";
$burung -> suara =  "cuit-cuit";
$burung -> gerak =  "Terbang";
$burung -> Bergerak();
$burung -> Bersuara();
echo "<br>";
echo "<br>";

$katak = new hewan();
$katak -> nama =  "Katak";
$katak -> suara =  "kwebek-kwebek";
$katak -> gerak =  "Melompat";
$katak -> Bergerak();
$katak -> Bersuara();
echo "<br>";
echo "<br>";

?>