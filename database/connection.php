<?php
// Database connection script

$host = 'localhost';
$dbname = '23164907';
$username = 'root';
$password = 'root';

try {
    $conn = mysqli_connect($host, $username, $password, $dbname);

    if (!$conn) {
        throw new Exception('Connection failed: ' . mysqli_connect_error());
    }
}
catch (Exception $e) {
    die('Connection failed: ' . $e->getMessage());
}