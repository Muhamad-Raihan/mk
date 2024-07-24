<?php
class Nilai {
    private $tugas = 0, $uts = 0, $uas = 0;
    function settugas ($nilai){
        if(($nilai<=100)&&($nilai>=0))$this->tugas = $nilai;
    }
    function setuts ($nilai){
        if(($nilai<=100)&&($nilai>=0))$this->uts = $nilai;
    }
    function setuas ($nilai){
        if(($nilai<=100)&&($nilai>=0))$this->uas = $nilai;
    }
    function gettugas(){
        return $this->tugas;
    }
    function getuts(){
        return $this->uts;
    }
    function getuas(){
        return $this->uas;
    }
    function getNA(){
        $nilaiakhir = 0.2 * $this->tugas +
                    0.3 * $this->uts +
                    0.5 * $this->uas;
        return $nilaiakhir;
    }
    function tampil() {
        echo "Nilai Tugas : ".$this->tugas.
            " Nilai UTS : ".$this->uts.
            " Nilai UAS : ".$this->uas.
            " Nilai Akhir : ".$this->getNA().
            "<br>";
    }
}

//Contoh penggunaan class nilai

$nilai = new Nilai();
$nilai->settugas(80); //nilai berubah
echo "Nilai Tugas sekarang adalah : ".$nilai->gettugas()."<br>";
$nilai->setuts(60); //nilai berubah
$nilai->setuas(90); //nilai berubah

$nilai->tampil();
$nilai->setuas(110); //nilai uas tidak berubah, nilai baru tidak valid
echo "Nilai akhir adalah : ".$nilai->getNA()."<br><br>";

$skor = new Nilai();
$skor->settugas(95);
echo "Nilai Tugas sekarang adalah : ".$skor->gettugas()."<br>";
$skor->setuts(80); 
$skor->setuas(90); 
$skor->tampil();
$skor->setuas(90);
echo "Nilai akhir adalah : ".$skor->getNA();

?>