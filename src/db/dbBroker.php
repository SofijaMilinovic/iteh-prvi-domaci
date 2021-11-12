<?php

$host = "localhost";
$username = "root";
$password = "";
$dbName = "iteh-prvi-domaci";

$connection = new mysqli($host, $username, $password, $dbName);

if ($connection->connect_errno) {
    exit("Neuspesna konekcija: greska > " . $connection->connect_error . ", err kod > " . $connection->connect_errno);
}

?>
