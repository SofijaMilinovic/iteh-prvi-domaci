<?php

class Klijent {

    public $klijentId;
    public $ime;
    public $prezime;
    public $datumRodjenja;
    
    public function __construct($klijentId=null, $ime=null, $prezime=null, $datumRodjenja=null)
    {
        $this->klijentId = $klijentId;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->datumRodjenja = $datumRodjenja;
    }
    
}

?>