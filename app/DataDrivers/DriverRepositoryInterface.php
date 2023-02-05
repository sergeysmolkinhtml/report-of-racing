<?php

declare(strict_types=1);

namespace App\DataDrivers;

interface DriverRepositoryInterface
{
    public function find(string $abbreviation): Driver;
}
