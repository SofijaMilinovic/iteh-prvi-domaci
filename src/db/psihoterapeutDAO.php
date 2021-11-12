<?php

include "dbBroker.php";
include($_SERVER['DOCUMENT_ROOT'] . "/ITEH/iteh-prvi-domaci/src/model/psihoterapeut.php");

class PsihoterapeutDAO {

    private $nazivTabele = "psihoterapeut";
    private $kolonaUsername = "username";
    private $kolonaPassword = "password";
    private $kolonaIme = "ime";
    private $kolonaPrezime = "prezime";

    public function pronadjiPsihoterapeuta($username, $password) {
        $query = "SELECT * FROM $this->nazivTabele WHERE $this->kolonaUsername = '$username' AND $this->kolonaPassword = '$password'";
        $connection = DBBroker::getConnection();
        $psihoterapeut;
        if ($rezultujucaTabela = $connection->query($query)) {
            $red = $rezultujucaTabela->fetch_array(1);
            if ($red != null) {
                return new Psihoterapeut(
                    $red["psihoterapeutId"],
                    $red["username"],
                    $red["password"],
                    $red["ime"],
                    $red["prezime"]
                );
            }
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
        $psihoterapeut;
        if ($rezultujucaTabela = $connection->query($query)) {
            $red = $rezultujucaTabela->fetch_array(1);
            return $red != null;
        }
        return false;
    }

}

?>
