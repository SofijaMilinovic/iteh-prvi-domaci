<?php

require_once "../src/db/seansaDAO.php";

$seansaDAO = new SeansaDAO();

if (isset($_POST['seansaId'])) {
    $seansaId = $_POST['seansaId'];
    $rezultat = $seansaDAO->obrisiSeansu($seansaId) == 1 ? true : false;
    echo "{ rezultat: ".$rezultat." }";
} else {
    $psihoterapeutId = $_GET['psihoterapeutId'];
    $seanse = $seansaDAO->vratiSveSeanse($psihoterapeutId);
    echo json_encode($seanse);
}
