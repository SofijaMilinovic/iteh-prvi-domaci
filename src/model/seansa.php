<?php

class Seansa {

    public $seansaId;
    public $datum;
    public $vreme;
    public $trajanjeMin;
    public $beleske;
    public $klijent;
    public $psihoterapeut;
    
    public function __construct($seansaId=null, $datum=null, $vreme=null, $trajanjeMin=null, $beleske=null, $klijent=null, $psihoterapeut=null)
    {
        $this->seansaId = $seansaId;
        $this->datum = $datum;
        $this->vreme = $vreme;
        $this->trajanjeMin = $trajanjeMin;
        $this->beleske = $beleske;
        $this->klijent = $klijent;
        $this->psihoterapeut = $psihoterapeut;
    }
    
}

?>