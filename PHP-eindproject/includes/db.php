<?php
$host = 'localhost';
$user = 'bit_academy';
$pass = 'bit_academy';
$dbname = 'boeken_db';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}
?>
