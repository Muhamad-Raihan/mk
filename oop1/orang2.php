<?php
class Orang {
    private $nama;
    function __construct($nama)
    {
        $this -> nama = $nama;
        echo "Constructor : $this->nama dilahirkan<br>";
    }
    function UcapSalam(){
        echo "Halo, nama saya adalah ". $this->nama. "<br><br>";
    }
    function __destruct()
    {
        echo "Destructor : $this->nama telah pergi <br>";
    }
}
?>