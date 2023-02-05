<?php

declare(strict_types=1);

namespace App\DataDrivers;

use App\Exceptions\DriverNotFoundException;
use SplObjectStorage;

final class DriverStorage implements DriverRepositoryInterface
{
    private SplObjectStorage $drivers;

    public function __construct()
    {
        $this->drivers = new SplObjectStorage();
    }

    public function addDriver(Driver $driver): void
    {
        $this->drivers->attach($driver);
    }

    public function getList(): SplObjectStorage
    {
        return $this->drivers;
    }

    public function find(string $abbreviation): Driver
    {
        $this->drivers->rewind();
        while ($this->drivers->valid()) {
            $driver = $this->drivers->current();
            if (($driver->getAbbreviation()) === $abbreviation) {
                return $driver;
            }
            $this->drivers->next();
        }
        throw new DriverNotFoundException(sprintf($abbreviation, $abbreviation));
    }

}
