<?php

declare(strict_types=1);

class Attraction
{
    // basis gegevens
    private string $name;
    private int $waitTime;
    private string $status;
    private int $minHeight;

    // extra gegevens
    protected string $location;
    protected int $capacity;

    public function __construct(
        string $name,
        int $waitTime,
        string $status,
        int $minHeight,
        string $location = 'Onbekend',
        int $capacity = 0
    ) {
        $this->setName($name);
        $this->setWaitTime($waitTime);
        $this->setStatus($status);
        $this->setMinHeight($minHeight);
        $this->setLocation($location);
        $this->setCapacity($capacity);
    }

    public function showInfo(): array
    {
        // geef alle data terug
        return [
            'name' => $this->name,
            'waitTime' => $this->waitTime,
            'status' => $this->status,
            'minHeight' => $this->minHeight,
            'location' => $this->location,
            'capacity' => $this->capacity,
        ];
    }

    public function isOpen(): bool
    {
        // check status
        return strtolower($this->status) === 'open';
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $trimmed = trim($name);
        if ($trimmed === '') {
            throw new InvalidArgumentException('Naam mag niet leeg zijn.');
        }

        $this->name = $trimmed;
    }

    public function getWaitTime(): int
    {
        return $this->waitTime;
    }

    public function setWaitTime(int $waitTime): void
    {
        if ($waitTime < 0) {
            throw new InvalidArgumentException('Wachttijd mag niet negatief zijn.');
        }

        $this->waitTime = $waitTime;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $normalized = strtolower(trim($status));
        $allowed = ['open', 'gesloten'];

        if (!in_array($normalized, $allowed, true)) {
            throw new InvalidArgumentException('Status moet "open" of "gesloten" zijn.');
        }

        $this->status = $normalized;
    }

    public function getMinHeight(): int
    {
        return $this->minHeight;
    }

    public function setMinHeight(int $minHeight): void
    {
        if ($minHeight < 0) {
            throw new InvalidArgumentException('Minimale lengte mag niet negatief zijn.');
        }

        $this->minHeight = $minHeight;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $trimmed = trim($location);
        if ($trimmed === '') {
            throw new InvalidArgumentException('Locatie mag niet leeg zijn.');
        }

        $this->location = $trimmed;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): void
    {
        if ($capacity < 0) {
            throw new InvalidArgumentException('Capaciteit mag niet negatief zijn.');
        }

        $this->capacity = $capacity;
    }
}
