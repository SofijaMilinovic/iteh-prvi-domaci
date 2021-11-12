<?php

$host = "localhost";
$username = "root";
$password = "";
$dbName = "iteh-prvi-domaci";

$connection = new mysqli($host, $username, $password, $dbName);

echo "connection err number: " . $connection->connect_errno;

if ($connection->connect_errno) {
    exit("Neuspesna konekcija: greska > " . $connection->connect_error . ", err kod > " . $connection->connect_errno);
} else {
    echo "Uspesna konekcija";
}

?>