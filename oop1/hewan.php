<?php
class hewan{
    public $nama;
    public $suara;
    public $gerak;
    function Bergerak(){
        echo "Ini adalah $this->nama. $this->nama dapat bergerak dengan cara $this->gerak. <br>";
    }
    function Bersuara(){
        echo "$this->nama dapat mengeluarkan $this->suara.";
    }
}
?>