<?php
class mobil {
    public $nama;
    public $bbm;
    public $tipe;
    public $merk;
    function Bergerak(){
        echo "ini mobil $this->nama yang bermerk $this->merk dan bergerak dengan 4 roda.<br>";
    }
    function BahanBakar(){
        echo "dengan berbahan bakar $this->bbm,";
    }
    function Jenis(){
        echo "mobil ini bertipe $this->tipe.";
    }
}
?>