<?php

class Psihoterapeut {

    public $psihoterapeutId;
    public $username;
    public $password;
    public $ime;
    public $prezime;
    
    public function __construct($psihoterapeutId=null, $username=null, $password=null, $ime=null, $prezime=null)
    {
        $this->psihoterapeutId = $psihoterapeutId;
        $this->username = $username;
        $this->password = $password;
        $this->ime = $ime;
        $this->prezime = $prezime;
    }
    
}

?>