<?php

require_once "../src/db/klijentDAO.php";

$klijentDAO = new KlijentDAO();
$klijenti = $klijentDAO->vratiSveKlijente();
echo json_encode($klijenti);