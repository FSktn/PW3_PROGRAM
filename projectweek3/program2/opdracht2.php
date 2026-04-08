<?php

declare(strict_types=1);

require_once __DIR__ . '/classes/InteractiveRide.php';

// test data voor opdracht 2

$rides = [
    new InteractiveRide(
        name: 'Lego Battle Arena',
        waitTime: 12,
        status: 'open',
        minHeight: 110,
        score: 780,
        maxPlayers: 4,
        location: 'Game Zone',
        capacity: 120
    ),
    new InteractiveRide(
        name: 'Pirate Laser Quest',
        waitTime: 18,
        status: 'open',
        minHeight: 120,
        score: 960,
        maxPlayers: 6,
        location: 'Harbor Hall',
        capacity: 160
    ),
    new InteractiveRide(
        name: 'Space Defender',
        waitTime: 5,
        status: 'gesloten',
        minHeight: 100,
        score: 430,
        maxPlayers: 2,
        location: 'Future Dome',
        capacity: 90
    ),
];
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Opdracht 2A/2B - Child class InteractiveRide</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h1>Opdracht 2A/2B</h1>
        <p class="lead">Child-class van Attraction: <strong>InteractiveRide</strong> (eindcijfer 7).</p>
        <div class="nav">
            <a href="index.php">Terug naar index</a>
            <a href="opdracht1.php">Ga naar opdracht 1</a>
        </div>
    </div>

    <div class="card table-wrap">
        <table>
            <thead>
            <tr>
                <th>Naam</th>
                <th>Status</th>
                <th>Score</th>
                <th>Max players</th>
                <th>startGame()</th>
                <th>getHoghScore()</th>
                <th>isOpen()</th>
                <th>showInfo()</th>
            </tr>
            </thead>
            <tbody>
            <?php // toon elke ride ?>
            <?php foreach ($rides as $ride): ?>
                <?php $info = $ride->showInfo(); ?>
                <tr>
                    <td><?= htmlspecialchars($ride->getName()) ?></td>
                    <td class="<?= $ride->getStatus() === 'open' ? 'status-open' : 'status-closed' ?>">
                        <?= htmlspecialchars($ride->getStatus()) ?>
                    </td>
                    <td><?= (int) $ride->getScore() ?></td>
                    <td><?= (int) $ride->getMaxPlayers() ?></td>
                    <td><span class="pill"><?= htmlspecialchars($ride->startGame()) ?></span></td>
                    <td><span class="pill"><?= (int) $ride->getHoghScore() ?></span></td>
                    <td>
                        <span class="pill"><?= $ride->isOpen() ? 'true' : 'false' ?></span>
                    </td>
                    <td>
                        <span class="pill">array (<?= count($info) ?> keys)</span>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="card">
        <h2>Geteste methods van InteractiveRide</h2>
        <p class="small">startGame() en getHoghScore() zijn zichtbaar in de tabel.</p>
    </div>
</div>
</body>
</html>
