<?php

include_once 'db.php';

$id = $_GET['id'] ?? null;
$boek_id = $_GET['boek_id'] ?? null;
$recensie = $_POST['tekst'] ?? null;
$beoordeling = $_POST['beoordeling'] ?? null;

if (!$id) {
    die("Recensie bestaat niet.");
}


$stmt = $conn->prepare("UPDATE recensies SET tekst = ?, beoordeling = ? WHERE id = ?");
$stmt->bind_param("sii", $recensie, $beoordeling, $id);
$stmt->execute();

header("Location: ../boek_info.php?id=$boek_id");