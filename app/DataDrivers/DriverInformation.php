<?php

namespace App\DataDrivers;

use DateTimeImmutable;

final class DriverInformation
{
    private string $driverId;
    private string $driverName;
    private string $driverTeam;
    private DateTimeImmutable $start;
    private DateTimeImmutable $finish;

    public function __construct(string $driverId,string $driverName,string $driverTeam,DateTimeImmutable $start,DateTimeImmutable $finish)
    {
        $this->driverId = $driverId;
        $this->driverName = $driverName;
        $this->driverTeam = $driverTeam;
        $this->start = $start;
        $this->finish = $finish;
    }

    public function driverId(): string
    {
        return $this->driverId;
    }

    public function driverName()
    {
        return $this->driverName;
    }

    public function driverTeam()
    {
        return $this->driverTeam;
    }

    public function start(): DateTimeImmutable
    {
        return $this->start;
    }

    public function finish(): DateTimeImmutable
    {
        return $this->finish;
    }


}
