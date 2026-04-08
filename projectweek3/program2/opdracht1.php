<?php

declare(strict_types=1);

require_once __DIR__ . '/classes/Attraction.php';

$attractions = [
    new Attraction('Aqua Spin', 20, 'open', 120, 'Zone A', 24),
    new Attraction('Big Thunder Track', 45, 'gesloten', 140, 'Zone B', 18),
    // Pas deze naam aan op basis van de eerste letter van je achternaam als nodig.
    new Attraction('Kasteelplein Showpodium', 10, 'open', 0, 'Zone K', 250),
];

$rows = [];
foreach ($attractions as $attraction) {
    $info = $attraction->showInfo();

    $rows[] = [
        'name' => $info['name'],
        'waitTime' => $info['waitTime'],
        'status' => $info['status'],
        'minHeight' => $info['minHeight'],
        'location' => $info['location'],
        'capacity' => $info['capacity'],
        'isOpen' => $attraction->isOpen(),
    ];
}
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Opdracht 1A/1B - Attraction class</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h1>Opdracht 1A/1B</h1>
        <p class="lead">Overzicht van 3 objecten van class <strong>Attraction</strong>.</p>
        <div class="nav">
            <a href="index.php">Terug naar index</a>
            <a href="opdracht2.php">Ga naar opdracht 2:</a>
        </div>
    </div>

    <div class="card table-wrap">
        <table>
            <thead>
            <tr>
                <th>Naam</th>
                <th>Wachttijd</th>
                <th>Status</th>
                <th>Min. lengte</th>
                <th>Locatie</th>
                <th>Capaciteit</th>
                <th>isOpen()</th>
                <th>showInfo()</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?= htmlspecialchars((string) $row['name']) ?></td>
                    <td><?= (int) $row['waitTime'] ?> min</td>
                    <td class="<?= $row['status'] === 'open' ? 'status-open' : 'status-closed' ?>">
                        <?= htmlspecialchars((string) $row['status']) ?>
                    </td>
                    <td><?= (int) $row['minHeight'] ?> cm</td>
                    <td><?= htmlspecialchars((string) $row['location']) ?></td>
                    <td><?= (int) $row['capacity'] ?> p/u</td>
                    <td>
                        <span class="pill"><?= $row['isOpen'] ? 'true' : 'false' ?></span>
                    </td>
                    <td>
                        <span class="pill">array</span>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
