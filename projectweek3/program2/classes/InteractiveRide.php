<?php

declare(strict_types=1);

require_once __DIR__ . '/Attraction.php';

class InteractiveRide extends Attraction
{
    // behaalde score
    private int $score;

    // max aantal spelers
    private int $maxPlayers;

    public function __construct(
        string $name,
        int $waitTime,
        string $status,
        int $minHeight,
        int $score,
        int $maxPlayers,
        string $location = 'Onbekend',
        int $capacity = 0
    ) {
        parent::__construct($name, $waitTime, $status, $minHeight, $location, $capacity);

        $this->setScore($score);
        $this->setMaxPlayers($maxPlayers);
    }

    public function showInfo(): array
    {
        // voeg ride data toe
        return array_merge(parent::showInfo(), [
            'score' => $this->score,
            'maxPlayers' => $this->maxPlayers,
        ]);
    }

    public function startGame(): string
    {
        // start spel als attractie open is
        if (!$this->isOpen()) {
            return 'spel kan niet starten';
        }

        return 'spel is gestart';
    }

    public function getHighScore(): int
    {
        // geef score terug
        return $this->score;
    }

    public function getHoghScore(): int
    {
        // oude naam uit opdracht
        return $this->getHighScore();
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function setScore(int $score): void
    {
        if ($score < 0) {
            throw new InvalidArgumentException('Score mag niet negatief zijn.');
        }

        $this->score = $score;
    }

    public function getMaxPlayers(): int
    {
        return $this->maxPlayers;
    }

    public function setMaxPlayers(int $maxPlayers): void
    {
        if ($maxPlayers <= 0) {
            throw new InvalidArgumentException('Max players moet groter dan 0 zijn.');
        }

        $this->maxPlayers = $maxPlayers;
    }
}