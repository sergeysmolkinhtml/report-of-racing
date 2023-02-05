<?php

declare(strict_types=1);

namespace App\DataDrivers;

final class ScoreSorter
{
    const UNDERLINE_DRIVERS = 16;
    const UPPERLINE_DRIVERS = 14;

    private FlightStorage $flightsStorage;

    public function __construct(FlightStorage $flights)
    {
        $this->flightsStorage = $flights;
    }

    final public function execute(bool $descending): array
    {
        $flightsData = $this->flightsStorage->getFlights();
        $orderedDrivers = [];

        $flightsData->rewind();
        while ($flightsData->valid()) {
            $flight = $flightsData->current();
            $duration = $flight->getDurationInt();
            $orderedDrivers[] = ['driver' => $flight->getDriverId(), 'score' => $duration, 'lined' => false];
            $flightsData->next();
        }

        if ($descending) {
            $lineNumber = count($orderedDrivers) - self::UNDERLINE_DRIVERS;
            usort($orderedDrivers, function ($a, $b) {
                return ($b['score'] - $a['score']);
            });
        } else {
            $lineNumber = self::UPPERLINE_DRIVERS;
            usort($orderedDrivers, function ($a, $b) {
                return ($a['score'] - $b['score']);
            });
        }
        $orderedDrivers[$lineNumber]['lined'] = true;

        return $orderedDrivers;
    }
}
