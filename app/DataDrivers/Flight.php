<?php

declare(strict_types=1);

namespace App\DataDrivers;

use DateTimeImmutable;


final class Flight
{
    private string $driverId;
    private string $driverName;
    private string $team;
    private DateTimeImmutable $start;
    private DateTimeImmutable $finish;


    public function __construct(string $driverId, string $driverName, string $team, DateTimeImmutable $start)
    {
        $this->driverId = $driverId;
        $this->driverName = $driverName;
        $this->team = $team;
        $this->start = $start;
    }

    public function getDriverId(): string
    {
        return $this->driverId;
    }

    public function getDriverName(): string
    {
        return trim($this->driverName);
    }

    public function getTeam(): string
    {
        return $this->team;
    }

    public function getStart(): DateTimeImmutable
    {
        return $this->start;
    }

    public function setStart(DateTimeImmutable $start): void
    {
        $this->start = $start;
    }

    public function getFinish(): DateTimeImmutable
    {
        return $this->finish;
    }

    public function setFinish(DateTimeImmutable $finish): void
    {
        $this->finish = $finish;
    }

    public function getDuration(): string
    {
        $minutes = $this->start->diff($this->finish)->format('%I');
        $seconds = $this->start->diff($this->finish)->format('%S');
        $microseconds = str_pad(strval((int)($this->start->diff($this->finish)->format('%f')) / 1000), 3, '0', STR_PAD_LEFT);
        return $minutes . ':' . $seconds . '.' . $microseconds;
    }

    public function getDurationInt(): int
    {
        $minutes = (int)($this->start->diff($this->finish)->format('%I%S')) * 1000000;
        $seconds = (int)($this->start->diff($this->finish)->format('%f'));
        return intval($minutes + $seconds) / 1000;
    }

}
