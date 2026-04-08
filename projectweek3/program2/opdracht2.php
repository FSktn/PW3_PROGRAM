<?php

declare(strict_types=1);

require_once __DIR__ . '/classes/Show.php';

$shows = [
    new Show(
        name: 'Piraten Live',
        waitTime: 5,
        status: 'open',
        minHeight: 100,
        showTimes: ['10:30', '13:00', '16:15'],
        seats: 300,
        soldTickets: 248,
        location: 'Theaterplein',
        capacity: 300
    ),
    new Show(
        name: 'Lego Heroes Musical',
        waitTime: 15,
        status: 'open',
        minHeight: 0,
        showTimes: ['11:15', '14:00', '17:30'],
        seats: 450,
        soldTickets: 450,
        location: 'Main Stage',
        capacity: 450
    ),
    new Show(
        name: 'Night Parade Intro',
        waitTime: 0,
        status: 'gesloten',
        minHeight: 0,
        showTimes: ['20:30'],
        seats: 150,
        soldTickets: 0,
        location: 'Boulevard',
        capacity: 150
    ),
];
?>
<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Opdracht 2A/2B - Child class Show</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h1>Opdracht 2A/2B</h1>
        <p class="lead">Child-class van Attraction: <strong>Show</strong> (eindcijfer 5).</p>
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
                <th>Showtijden</th>
                <th>Volgende show</th>
                <th>Stoelen</th>
                <th>Beschikbaar?</th>
                <th>isOpen()</th>
                <th>showInfo()</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($shows as $show): ?>
                <?php $info = $show->showInfo(); ?>
                <tr>
                    <td><?= htmlspecialchars($show->getName()) ?></td>
                    <td class="<?= $show->getStatus() === 'open' ? 'status-open' : 'status-closed' ?>">
                        <?= htmlspecialchars($show->getStatus()) ?>
                    </td>
                    <td><?= htmlspecialchars(implode(', ', $show->getShowTimes())) ?></td>
                    <td>
                        <?php $next = $show->getNextShowTime(); ?>
                        <?= $next !== null ? htmlspecialchars($next) : '-' ?>
                    </td>
                    <td><?= (int) $show->getSoldTickets() ?> / <?= (int) $show->getSeats() ?></td>
                    <td>
                        <span class="pill"><?= $show->hasAvailableSeats() ? 'ja' : 'nee' ?></span>
                    </td>
                    <td>
                        <span class="pill"><?= $show->isOpen() ? 'true' : 'false' ?></span>
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
        <h2>Geteste methods van Show</h2>
        <p class="small">getNextShowTime() en hasAvailableSeats() zijn zichtbaar in de tabel.</p>
    </div>
</div>
</body>
</html>
