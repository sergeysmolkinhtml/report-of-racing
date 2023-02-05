<?php
declare(strict_types=1);

namespace App\DataDrivers;

interface FlightRepositoryInterface
{
    public function find(string $abbreviation): Flight;
}
