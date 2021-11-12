<?php

include "dbBroker.php";
include($_SERVER['DOCUMENT_ROOT'] . "/ITEH/iteh-prvi-domaci/src/model/klijent.php");

class KlijentDAO {

    private $nazivTabele = "klijent";
    private $kolonaJmbg = "jmbg";
    private $kolonaIme = "ime";
    private $kolonaPrezime = "prezime";
    private $kolonaDatumRodjenja = "datumRodjenja";

    public function vratiSveKlijente() {
        $query = "SELECT * FROM $this->nazivTabele";
        $connection = DBBroker::getConnection();
        $rezultujucaTabela = $connection->query($query);
        $klijenti = array();
        while ($red = $rezultujucaTabela->fetch_array()) {
            $klijent = new Klijent(
                $red[$this->kolonaJmbg],
                $red[$this->kolonaIme],
                $red[$this->kolonaPrezime],
                $red[$this->kolonaDatumRodjenja]
            );
            array_push($klijenti, $klijent);
        }
        return $klijenti;
    }

    public function ubaciNovogKlijenta($klijent) {
        $query = "INSERT INTO $this->nazivTabele ($this->kolonaJmbg, $this->kolonaIme, $this->kolonaPrezime, $this->kolonaDatumRodjenja) VALUES ('$klijent->jmbg', '$klijent->ime', '$klijent->prezime', '$klijent->datumRodjenja')";
        $connection = DBBroker::getConnection();
        return $connection->query($query);
    }

}

?>
