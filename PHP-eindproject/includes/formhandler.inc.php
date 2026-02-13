<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['username'];
    $beoordeling = $_POST['beoordeling'];
    $commentaar = $_POST['tekst'];
    $boek_id = $_GET['id'];

    require_once "db.php";

    $query_GetUserId = $conn->prepare("SELECT id FROM gebruikers WHERE naam = ?");
    $query_GetUserId->bind_param("s", $username);
    $query_GetUserId->execute();
    $result = $query_GetUserId->get_result();

    if ($result->num_rows === 0) {
        die("Gebruiker niet gevonden");
    }

    $row = $result->fetch_assoc();
    $gebruiker_id = $row['id'];
    $query_GetUserId->close();

    $query = "INSERT INTO recensies(gebruiker_id, boek_id, beoordeling, tekst) VALUES (?, ?, ?, ?)";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("iiis", $gebruiker_id, $boek_id, $beoordeling, $commentaar);

        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();

            header("Location: ../boek_info.php?id=" . $boek_id);
            exit();
        } else {
            die("Execute failed: " . $stmt->error);
        }
    } else {
        die("Prepare failed: " . $conn->error);
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>