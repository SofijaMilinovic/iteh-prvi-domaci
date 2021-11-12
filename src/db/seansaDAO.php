<?php

include_once "klijentDAO.php";
include_once "psihoterapeutDAO.php";
include_once($_SERVER['DOCUMENT_ROOT'] . "/ITEH/iteh-prvi-domaci/src/model/seansa.php");

class SeansaDAO {

    private $nazivTabele = "seansa";
    private $kolonaSeansaId = "seansaId";
    private $kolonaDatum = "datum";
    private $kolonaVreme = "vreme";
    private $kolonaTrajanjeMin = "trajanjeMin";
    private $kolonaBeleske = "beleske";
    private $kolonaKlijentJmbg = "klijentJmbg";
    private $kolonaPsihoterapeutId = "psihoterapeutId";

    private $klijentDAO;
    private $psihoterapeutDAO;

    public function __construct()
    {
        $this->klijentDAO = new KlijentDAO();
        $this->psihoterapeutDAO = new PsihoterapeutDAO();
    }

    public function vratiSveSeanse() {
        $query = "SELECT * FROM $this->nazivTabele";
        $connection = DBBroker::getConnection();
        $rezultujucaTabela = $connection->query($query);
        $seanse = array();
        while ($red = $rezultujucaTabela->fetch_array()) {
            $klijent = $this->vratiKlijenta($red[$this->kolonaKlijentJmbg]);
            $psihoterapeut = $this->vratiPsihoterapeuta($red[$this->kolonaPsihoterapeutId]);
            $seansa = new Seansa(
                $red[$this->kolonaSeansaId],
                $red[$this->kolonaDatum],
                $red[$this->kolonaVreme],
                $red[$this->kolonaTrajanjeMin],
                $red[$this->kolonaBeleske],
                $klijent,
                $psihoterapeut
            );
            array_push($seanse, $seansa);
        }
        return $seanse;
    }

    public function ubaciNovuSeansu($seansa) {
        $klijentJmbg = $seansa->klijent->jmbg;
        $psihoterapeutId = $seansa->psihoterapeut->psihoterapeutId;
        $query = "INSERT INTO $this->nazivTabele ($this->kolonaDatum, $this->kolonaVreme, $this->kolonaTrajanjeMin, $this->kolonaBeleske, $this->kolonaKlijentJmbg, $this->kolonaPsihoterapeutId) VALUES ('$seansa->datum', '$seansa->vreme', $seansa->trajanjeMin, '$seansa->beleske', $klijentJmbg, $psihoterapeutId)";
        $connection = DBBroker::getConnection();
        return $connection->query($query);
    }

    public function obrisiSeansu($seansa) {
        $query = "DELETE FROM $this->nazivTabele WHERE $this->kolonaSeansaId = $seansa->seansaId";
        $connection = DBBroker::getConnection();
        return $connection->query($query);
    }

    public function izmeniSeansu($seansa) {
        $klijentJmbg = $seansa->klijent->jmbg;
        $psihoterapeutId = $seansa->psihoterapeut->psihoterapeutId;
        $query = "UPDATE $this->nazivTabele SET $this->kolonaDatum = '$seansa->datum', $this->kolonaVreme = '$seansa->vreme', $this->kolonaTrajanjeMin = $seansa->trajanjeMin, $this->kolonaBeleske = '$seansa->beleske', $this->kolonaKlijentJmbg = $klijentJmbg, $this->kolonaPsihoterapeutId = $psihoterapeutId WHERE $this->kolonaSeansaId = $seansa->seansaId";
        $connection = DBBroker::getConnection();
        return $connection->query($query);
    }

    private function vratiKlijenta($klijentJmbg) {
        return $this->klijentDAO->pronadjiKlijenta($klijentJmbg);
    }

    private function vratiPsihoterapeuta($psihoterapeutId) {
        return $this->psihoterapeutDAO->pronadjiPsihoterapeuta($psihoterapeutId);
    }

}

?>
