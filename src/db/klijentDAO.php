<?php

include_once "dbBroker.php";
include_once($_SERVER['DOCUMENT_ROOT'] . "/iteh-prvi-domaci/src/model/klijent.php");

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

    public function pronadjiKlijenta($klijentJmbg) {
        $query = "SELECT * FROM $this->nazivTabele WHERE $this->kolonaJmbg = '$klijentJmbg'";
        $connection = DBBroker::getConnection();
        $rezultujucaTabela = $connection->query($query);
        while ($red = $rezultujucaTabela->fetch_array()) {
            return new Klijent(
                $red[$this->kolonaJmbg],
                $red[$this->kolonaIme],
                $red[$this->kolonaPrezime],
                $red[$this->kolonaDatumRodjenja]
            );
        }
        return null;
    }

}

?>
