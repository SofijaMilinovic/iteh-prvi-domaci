<?php

require_once "../src/db/seansaDAO.php";

$seansaDAO = new SeansaDAO();

if (isset($_POST['seansaId'])) {
    $seansaId = $_POST['seansaId'];
    $method = $_POST['method'];
    if ($method == "DELETE") {
        $rezultat = $seansaDAO->obrisiSeansu($seansaId) == 1 ? true : false;
        echo "{ rezultat: ".$rezultat." }";
    }
    if ($method == "UPDATE") {
        echo "{ method: UPDATE }";
    }
} else {
    $psihoterapeutId = $_GET['psihoterapeutId'];
    $seanse = $seansaDAO->vratiSveSeanse($psihoterapeutId);
    echo json_encode($seanse);
}
