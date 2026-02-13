<?php

include_once 'db.php';

$id = $_GET['id'] ?? null;
$boek_id = $_GET['boek_id'] ?? null;

if (!$id) {
    die("Recensie bestaat niet.");
}


$stmt = $conn->prepare("DELETE FROM recensies WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: ../boek_info.php?id=$boek_id");