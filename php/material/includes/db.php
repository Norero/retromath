<?php
//http://46.101.232.235
//root
//retromath2018
$servername = "localhost:3306";
$username = "admin";
$password = "25740c1ab758bf6d9db8b5b1fdabf429b5fb6752c9fdcde8";
$dbname = "retromath";

$connection = new mysqli($servername, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
