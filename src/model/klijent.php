<?php

class Klijent {

    public $jmbg;
    public $ime;
    public $prezime;
    public $datumRodjenja;
    
    public function __construct($jmbg=null, $ime=null, $prezime=null, $datumRodjenja=null)
    {
        $this->jmbg = $jmbg;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->datumRodjenja = $datumRodjenja;
    }
    
}

?>
