<?php
include_once 'includes/db.php';

$id = $_GET['id'] ?? null;
$boek_id = $_GET['boek_id'] ?? null;

$stmt = $conn->prepare("SELECT beoordeling, tekst, boek_id FROM recensies WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$edit_recensie = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recensie bewerken</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="formulier-wrapper">
        <a href="boek_info.php?id=<?= $boek_id ?>" class="terug">← Terug naar boek</a>
        <h1>Recensie bewerken</h1>

        <form action="includes/update.php?id=<?= $id ?>&boek_id=<?= $boek_id ?>" method="post">

            <div class="formulier-veld">
                <label for="beoordeling">Beoordeling (1–5)</label>
                <input type="number" name="beoordeling" id="beoordeling" min="1" max="5"
                    value="<?= $edit_recensie['beoordeling'] ?>" required>
            </div>

            <div class="formulier-veld">
                <label for="tekst">Commentaar</label>
                <input type="text" name="tekst" id="tekst"
                    value="<?= $edit_recensie['tekst'] ?>" placeholder="Commentaar">
            </div>

            <button type="submit" class="submit-knop">Recensie updaten</button>
        </form>
    </div>

</body>

</html>