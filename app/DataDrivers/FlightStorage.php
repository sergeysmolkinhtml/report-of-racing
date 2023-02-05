<?php

declare(strict_types=1);

namespace App\DataDrivers;

use App\Exceptions\DriverNotFoundException;
use App\Exceptions\FlightNotFoundException;
use DateTimeImmutable;
use SplObjectStorage;


final class FlightStorage implements FlightRepositoryInterface
{
    private SplObjectStorage $flights;
    private DriverStorage $drivers;

    public function __construct()
    {
        $this->flights = new SplObjectStorage();
    }

    public function setDrivers(DriverStorage $drivers): void
    {
        $this->drivers = $drivers;
    }

    public function getFlights(): SplObjectStorage
    {
        return $this->flights;
    }

    public function addFlightStart(string $index, DateTimeImmutable $start): void
    {
        $this->setDrivers($this->drivers);
        $driver = $this->drivers->find($index);
        $nameDriver = $driver->getName();
        $team = $driver->getTeam();
        $this->flights->attach(new Flight($index, $nameDriver, $team, $start));
    }

    public function addFlightFinish(string $index, DateTimeImmutable $finish): void
    {
        $flight = $this->find($index);
        $flight->setFinish($finish);
    }

    public function dropFlight(string $index): void
    {
        $flight = $this->find($index);
        $this->flights->detach($flight);
    }

    public function find(string $abbreviation): Flight
    {
        $this->flights->rewind();
        while ($this->flights->valid()) {
            $flight = $this->flights->current();
            if ($flight->getDriverId() === $abbreviation) {
                return $flight;
            }
            $this->flights->next();
        }
        throw new FlightNotFoundException(sprintf('Flight with driver abbreviation %d not found.', $abbreviation));
    }

    public function findByName(string $name): Flight
    {
        $this->flights->rewind();
        while ($this->flights->valid()) {
            $flight = $this->flights->current();
            if ($flight->getDriverName() == $name) {
                return $flight;
            }
            $this->flights->next();
        }
        throw new DriverNotFoundException(sprintf('Flight with driver name %d not found.', $name));
    }
}
