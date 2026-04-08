<?php

declare(strict_types=1);

require_once __DIR__ . '/Attraction.php';

class Show extends Attraction
{
    /** @var string[] */
    private array $showTimes;
    private int $seats;

    /** @var int */
    private int $soldTickets;

    /**
     * @param string[] $showTimes
     */
    public function __construct(
        string $name,
        int $waitTime,
        string $status,
        int $minHeight,
        array $showTimes,
        int $seats,
        int $soldTickets = 0,
        string $location = 'Onbekend',
        int $capacity = 0
    ) {
        parent::__construct($name, $waitTime, $status, $minHeight, $location, $capacity);

        $this->setShowTimes($showTimes);
        $this->setSeats($seats);
        $this->setSoldTickets($soldTickets);
    }

    public function showInfo(): array
    {
        return array_merge(parent::showInfo(), [
            'showTimes' => $this->showTimes,
            'seats' => $this->seats,
            'soldTickets' => $this->soldTickets,
        ]);
    }

    public function getNextShowTime(): ?string
    {
        if (empty($this->showTimes)) {
            return null;
        }

        $now = new DateTimeImmutable('now');
        $today = $now->format('Y-m-d');

        foreach ($this->showTimes as $time) {
            $candidate = DateTimeImmutable::createFromFormat('Y-m-d H:i', $today . ' ' . $time);
            if ($candidate !== false && $candidate >= $now) {
                return $candidate->format('H:i');
            }
        }

        return $this->showTimes[0];
    }

    public function hasAvailableSeats(): bool
    {
        return $this->soldTickets < $this->seats;
    }

    /**
     * backward-compatible alias from opdracht sheet typo.
     */
    public function hasAvailibleSeats(): bool
    {
        return $this->hasAvailableSeats();
    }

    /**
     * @return string[]
     */
    public function getShowTimes(): array
    {
        return $this->showTimes;
    }

    /**
     * @param string[] $showTimes
     */
    public function setShowTimes(array $showTimes): void
    {
        if (empty($showTimes)) {
            throw new InvalidArgumentException('Er moet minimaal 1 showtijd zijn.');
        }

        $validated = [];
        foreach ($showTimes as $time) {
            if (!preg_match('/^([01]\d|2[0-3]):[0-5]\d$/', (string) $time)) {
                throw new InvalidArgumentException('Ongeldig tijdformaat. Gebruik HH:MM.');
            }

            $validated[] = (string) $time;
        }

        sort($validated);
        $this->showTimes = $validated;
    }

    public function getSeats(): int
    {
        return $this->seats;
    }

    public function setSeats(int $seats): void
    {
        if ($seats <= 0) {
            throw new InvalidArgumentException('Aantal zitplaatsen moet groter dan 0 zijn.');
        }

        $this->seats = $seats;
    }

    public function getSoldTickets(): int
    {
        return $this->soldTickets;
    }

    public function setSoldTickets(int $soldTickets): void
    {
        if ($soldTickets < 0) {
            throw new InvalidArgumentException('Verkochte tickets mag niet negatief zijn.');
        }

        if (isset($this->seats) && $soldTickets > $this->seats) {
            throw new InvalidArgumentException('Verkochte tickets kunnen niet hoger zijn dan zitplaatsen.');
        }

        $this->soldTickets = $soldTickets;
    }
}
