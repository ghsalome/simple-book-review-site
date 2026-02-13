<?php
include_once 'includes/db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Geen boek opgegeven.");
}

$gebruikers = $conn->query("SELECT id, naam FROM gebruikers ORDER BY naam ASC");
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recensie toevoegen</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="formulier-wrapper">
        <a href="boek_info.php?id=<?= $id ?>" class="terug">← Terug naar boek</a>
        <h1>Recensie schrijven</h1>

        <form action="includes/formhandler.inc.php?id=<?= $id ?>" method="post">

            <div class="formulier-veld">
                <label for="username">Gebruikersnaam</label>
                <select name="username" id="username" required>
                    <option value="" disabled selected>Kies een gebruiker...</option>
                    <?php while ($gebruiker = $gebruikers->fetch_assoc()): ?>
                        <option value="<?= $gebruiker['naam'] ?>"><?= $gebruiker['naam'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="formulier-veld">
                <label for="beoordeling">Beoordeling (1–5)</label>
                <input type="number" placeholder="1 t/m 5" name="beoordeling" id="beoordeling" min="1" max="5" required>
            </div>

            <div class="formulier-veld">
                <label for="tekst">Commentaar</label>
                <input type="text" placeholder="Wat vond je van het boek?" name="tekst" id="tekst">
            </div>

            <button type="submit" class="submit-knop">Recensie plaatsen</button>
        </form>
    </div>

</body>
</html>