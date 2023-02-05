<?php

declare(strict_types=1);

namespace App\DriversCfg;

use App\DataDrivers\Driver;
use App\DataDrivers\DriverStorage;
use App\DataDrivers\FlightStorage;
use DateTimeImmutable;
use Exception;

final class BuildDataReport
{
    private DriverStorage $drivers;
    private FlightStorage $flights;


    public function __construct(?FlightStorage $flights, ?DriverStorage $drivers)
    {
        $this->drivers = $drivers;
        $this->flights = $flights;
    }



    /**
     * @throws Exception
     */
    public function buildReport(string $logsLocation): FlightStorage
    {
        $this->readDrivers($logsLocation . '/abbreviations.txt');
        $this->flights->setDrivers($this->drivers);
        $this->readLog('start', $logsLocation . '/start.log');
        $this->readLog('end', $logsLocation . '/end.log');
        return $this->flights;
    }

    private function readDrivers(string $dataFile): void
    {
        $txtFile = file_get_contents($dataFile);
        $rows = explode("\n", $txtFile);

        foreach ($rows as $data) {
            $index = substr($data, 0, 3);
            $name = substr($data, 4, 26);
            $team = substr($data, 30, 25);
            $this->drivers->addDriver(new Driver($index, $name, $team));
        }

    }

    /**
     * @throws Exception
     */
    private function readLog(string $typeLog, string $dataFile): void
    {
        $txtFile = file_get_contents($dataFile);
        $rows = explode("\n", $txtFile);
        foreach ($rows as $data) {
            $index = substr($data,0,3);
            $dataString = substr($data,3,10);
            $timeString = substr($data,14,12);


            if ($typeLog == 'start') {
                $start = new DateTimeImmutable($dataString . ' ' . $timeString);
                $this->flights->addFlightStart($index, $start);
            }
            if ($typeLog == 'end') {
                if (trim($dataString) == '') {
                    $this->flights->dropFlight($index);
                } else {
                    $finish = new DateTimeImmutable($dataString . ' ' . $timeString);
                    $this->flights->addFlightFinish($index, $finish);
                }
            }
        }
    }


}
