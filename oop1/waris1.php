<?php
class Orang {
    protected $nama;
    function __construct($nama)
    {
        $this->nama = $nama;
    }
    function UcapSalam(){
        echo "Halo, nama saya ".$this->nama."<br>";
    }
}
?>