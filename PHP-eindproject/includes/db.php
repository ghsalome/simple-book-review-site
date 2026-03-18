<?php
// CHANGE TO YOUR INFORMATION
$host = 'localhost';
$user = 'your_user';
$pass = 'your_pass';
$dbname = 'boeken_db';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}
?>
