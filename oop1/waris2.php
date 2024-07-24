<?php
include("waris1.php");

//pewarian tanpa perubahan
class OrangSunda extends Orang {}

//pewarisan dengan meng-override function ucap salam dan perubahan method
class OrangInggris extends Orang {
    protected $asal = "England"; // penambahan properti baru
    function UcapSalam() {
        echo "hello, my name is ".$this->nama."<br>";
    }
    function UcapNegara() { //penambahan method
        echo "I'm from ".$this->asal."<br>";
    }
}

class OrangJawa extends Orang {
    protected $suku = "Jawa";
    function UcapSalam() {
        echo "nggih, jenengku ".$this->nama."<br>";
    }
    function UcapSuku() { //penambahan method
        echo "I'm from ".$this->suku."<br>";
    }
}

$kabayan = new OrangSunda("Kabayan");
$kabayan->UcapSalam();
$william = new OrangInggris("Prince William");
$william->UcapNegara();
$william->UcapSalam();
$william = new OrangJawa("Muhammad Raihan Syahfitrah");
$william->UcapSuku();
$william->UcapSalam();
?>