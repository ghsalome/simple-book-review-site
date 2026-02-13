<?php
include 'includes/db.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("Geen boek opgegeven.");
}

$stmt = $conn->prepare("SELECT * FROM boeken WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$boek = $result->fetch_assoc();

$stmt_recensies = $conn->prepare("SELECT r.id, r.boek_id, g.naam as gebruikersnaam, r.beoordeling, r.tekst FROM recensies r INNER JOIN gebruikers g ON g.id = r.gebruiker_id WHERE r.boek_id = ?");
$stmt_recensies->bind_param("i", $id);
$stmt_recensies->execute();
$result_recensies = $stmt_recensies->get_result();

if (!$boek) {
    die("Boek niet gevonden in de database.");
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $boek['titel'] ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="boek-detail">
        <a href="index.php" class="terug">← Terug naar overzicht</a>

        <div class="boek-header">
            <img src="img/bk_cover/<?= $boek['afbeelding'] ?>" alt="<?= $boek['titel'] ?>">
            <div class="boek-meta">
                <h1><?= $boek['titel'] ?></h1>
                <p><strong>Auteur:</strong> <?= $boek['auteur'] ?></p>
                <p><strong>Jaar:</strong> <?= $boek['publicatiejaar'] ?></p>
                <p><strong>Genre:</strong> <?= $boek['genre'] ?></p>
                <p class="boek-beschrijving"><?= $boek['beschrijving'] ?></p>
            </div>
        </div>

        <a href="maak_recensie.php?id=<?= $boek['id'] ?>" class="recensie-link">✏️ Schrijf een recensie</a>

        <table>
            <thead>
                <tr>
                    <th>Gebruiker</th>
                    <th>Beoordeling</th>
                    <th>Commentaar</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($recensie = $result_recensies->fetch_assoc()): ?>
                    <tr>
                        <td><?= $recensie['gebruikersnaam'] ?></td>
                        <td>⭐ <?= $recensie['beoordeling'] ?>/5</td>
                        <td><?= $recensie['tekst'] ?></td>
                        <td>
                            <a href="edit_recensie.php?id=<?= $recensie['id'] ?>&boek_id=<?= $recensie['boek_id'] ?>" class="tabel-knop bewerk">Bewerk</a>
                        </td>
                        <td>
                            <a href="includes/delete.php?id=<?= $recensie['id'] ?>&boek_id=<?= $recensie['boek_id'] ?>" class="tabel-knop verwijder">Verwijder</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</body>
</html>