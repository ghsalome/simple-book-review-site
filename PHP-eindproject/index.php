<?php
include_once 'includes/db.php';

$order_column = $_GET['order_column'] ?? 'publicatiejaar';
$sterren_order = $_GET['sterren_order'] ?? 'DESC';
$jaar_order = $_GET['jaar_order'] ?? 'DESC';
$order_direction = ($order_column === 'gemiddelde_beoordeling') ? $sterren_order : $jaar_order;

$result = $conn->query("with r as
(SELECT boek_id , round(AVG(beoordeling),1) as gemiddelde_beoordeling
 FROM recensies r
 group by boek_id
)
SELECT b.id , b.titel , b.auteur , b.publicatiejaar, b.afbeelding, r.gemiddelde_beoordeling
FROM boeken b
     left join r
       on r.boek_id = b.id
 ORDER BY $order_column $order_direction;");

?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>De Leeshoek</title>
</head>

<body>

    <h1 class="pagina-titel">📚 De Leeshoek</h1>
    <p class="pagina-subtitel">Bekijk onze collectie en lees wat anderen ervan vinden</p>

    <div class="sorteer-balk">
        <a href="index.php?sterren_order=<?= $sterren_order == 'DESC' ? 'ASC' : 'DESC' ?>&jaar_order=<?= $jaar_order ?>&order_column=gemiddelde_beoordeling" class="sorteer-knop <?= $order_column === 'gemiddelde_beoordeling' ? 'actief' : '' ?>">
            ⭐ Sterren <?= $sterren_order == 'DESC' ? '↓' : '↑' ?>
        </a>
        <a href="index.php?jaar_order=<?= $jaar_order == 'DESC' ? 'ASC' : 'DESC' ?>&sterren_order=<?= $sterren_order ?>&order_column=publicatiejaar" class="sorteer-knop <?= $order_column === 'publicatiejaar' ? 'actief' : '' ?>">
            📅 Jaar <?= $jaar_order == 'DESC' ? '↓' : '↑' ?>
        </a>
    </div>

    <div class="boeken">
        <?php while ($boek = $result->fetch_assoc()): ?>
            <div class="boek">
                <img src="img/bk_cover/<?= $boek['afbeelding'] ?>" alt="<?= $boek['titel'] ?>">
                <h2><?= $boek['titel'] ?></h2>
                <p><?= $boek['auteur'] ?> (<?= $boek['publicatiejaar'] ?>)</p>
                <span class="beoordeling-badge">⭐ <?= $boek['gemiddelde_beoordeling'] ?>/5</span>
                <a href="boek_info.php?id=<?= $boek['id'] ?>" class="knop">Bekijk details</a>
            </div>
        <?php endwhile; ?>
    </div>

</body>

</html>