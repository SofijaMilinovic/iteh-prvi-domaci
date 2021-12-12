<?php

class DBBroker {

    private static $host = "localhost";
    private static $username = "root";
    private static $password = "root";
    private static $dbName = "iteh-prvi-domaci";
    private static $connection = null;
    
    public static function getConnection() {
        if (DBBroker::$connection == null) {
            DBBroker::$connection = new mysqli(DBBroker::$host, DBBroker::$username, DBBroker::$password, DBBroker::$dbName);
            if (DBBroker::$connection->connect_errno) {
                exit("Neuspesna konekcija: greska > " . DBBroker::$connection->connect_error . ", err kod > " . DBBroker::$connection->connect_errno);
                return null;
            }
        }
        return DBBroker::$connection;
    }

}
