<?php

include_once "dbBroker.php";
include_once($_SERVER['DOCUMENT_ROOT'] . "/iteh-prvi-domaci/src/model/psihoterapeut.php");

class PsihoterapeutDAO {

    private $nazivTabele = "psihoterapeut";
    private $kolonaPsihoterapeutId = "psihoterapeutId";
    private $kolonaUsername = "username";
    private $kolonaPassword = "password";
    private $kolonaIme = "ime";
    private $kolonaPrezime = "prezime";

    public function pronadjiPsihoterapeutaSaUsernamePassword($username, $password) {
        $query = "SELECT * FROM $this->nazivTabele WHERE $this->kolonaUsername = '$username' AND $this->kolonaPassword = '$password'";
        $connection = DBBroker::getConnection();
        $rezultujucaTabela = $connection->query($query);
        if ($red = $rezultujucaTabela->fetch_array()) {
            return new Psihoterapeut(
                $red[$this->kolonaPsihoterapeutId],
                $red[$this->kolonaUsername],
                $red[$this->kolonaIme],
                $red[$this->kolonaPrezime],
            );
        }
        return null;
    }

    public function pronadjiPsihoterapeuta($psihoterapeutId) {
        $query = "SELECT * FROM $this->nazivTabele WHERE $this->kolonaPsihoterapeutId = '$psihoterapeutId'";
        $connection = DBBroker::getConnection();
        $rezultujucaTabela = $connection->query($query);
        if ($red = $rezultujucaTabela->fetch_array()) {
            return new Psihoterapeut(
                $red[$this->kolonaPsihoterapeutId],
                $red[$this->kolonaUsername],
                $red[$this->kolonaIme],
                $red[$this->kolonaPrezime],
            );
        }
        return null;
    }

    public function ubaciNovogPsihoterapeuta($psihoterapeut) {
        if ($this->psihoterapeutSaUsernameomVecPostoji($psihoterapeut->username)) {
            return -1;
        }   

        $query = "INSERT INTO $this->nazivTabele ($this->kolonaUsername, $this->kolonaPassword, $this->kolonaIme, $this->kolonaPrezime) VALUES ('$psihoterapeut->username', '$psihoterapeut->password', '$psihoterapeut->ime', '$psihoterapeut->prezime')";
        $connection = DBBroker::getConnection();
        return $connection->query($query);
    }

    private function psihoterapeutSaUsernameomVecPostoji($username) {
        $query = "SELECT * FROM $this->nazivTabele WHERE $this->kolonaUsername = '$username'";
        $connection = DBBroker::getConnection();
        if ($rezultujucaTabela = $connection->query($query)) {
            $red = $rezultujucaTabela->fetch_array(1);
            return $red != null;
        }
        return false;
    }

}

?>
