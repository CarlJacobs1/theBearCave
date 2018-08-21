<?php

define('dbHost', 'localhost');
define('dbDatabase', 'theBearCave');
define('dbUsername', 'root');
define('dbPassword', '');

function createConnection() {

    $connectionString = 'mysql:host=' . dbHost . ';' . 'dbname=' . dbDatabase;
    try {

        $conn = new PDO($connectionString, dbUsername, dbPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    } catch (PDOException $e) {
        echo $e;
    }

}

function executeQuery($queryString, $conn = false) {
    try {
        if (!$conn) {
            $conn = createConnection();
        }
        $sth = $conn->prepare($queryString);

        $sth->execute();

        return $sth;

    } catch (PDOException $e) {
        return $e;

    }

}

function generateUUID() {
    $data = openssl_random_pseudo_bytes(16);
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

?>
