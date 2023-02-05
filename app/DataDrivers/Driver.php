<?php

declare(strict_types=1);

namespace App\DataDrivers;

final class Driver
{
    private string $abbreviation;
    private string $name;
    private string $team;

    public function __construct(string $abbreviation, string $name, string $team)
    {
        $this->abbreviation = $abbreviation;
        $this->name = $name;
        $this->team = $team;
    }

    public function getAbbreviation(): string
    {
        return $this->abbreviation;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTeam(): string
    {
        return $this->team;
    }
}
