<?php
class Visibility{
    public $public = 'public';
    protected $protected = 'protected';
    private $private = 'private';

    function CetakProperti() {
        echo "Akses dari dalam class : <br>";
        echo "Public : " .$this->public. "<br>";
        echo "Protected : " .$this->protected. "<br>";
        echo "Private : " .$this->private. "<br>";
    }
}

$obj = new Visibility();
$obj -> CetakProperti();
echo "<br> Pengaksesan dari luar class : <br>";
echo "Public : " .$obj->public. "<br>"; //OK
echo "Protected : " .$obj->protected. "<br>"; //ERROR
echo "Private : " .$obj->private. "<br>"; //ERROR
?>