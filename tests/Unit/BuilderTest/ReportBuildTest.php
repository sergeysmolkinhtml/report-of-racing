<?php


namespace Tests\Unit\BuilderTest;

use App\DataDrivers\Driver;
use App\DataDrivers\DriverStorage;
use App\DataDrivers\Flight;
use App\DataDrivers\FlightStorage;
use App\DriverCfg\BuildDataReport;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class ReportBuildTest extends TestCase
{
    private DriverStorage $driverStorage;
    private FlightStorage $flightStorage;
    private BuildDataReport $buildDataReport;
    private Flight $flight;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->driverStorage = new DriverStorage();
        $this->flightStorage = new FlightStorage();
        $this->buildDataReport = new BuildDataReport();
        parent::__construct($name, $data, $dataName);
    }

    public function testBuildReport()
    {
        $this->driverStorage->addDriver(new Driver('NHR', 'Nico Hulkenberg', 'Renault'));
        $this->flightStorage->setDrivers($this->driverStorage);

        $start = new DateTimeImmutable('2018-05-24 12:02:49.914');
        $finish = new DateTimeImmutable('2018-05-24 13:04:02.979');

        $this->flight = (new Flight('NHR', 'Nico Hulkenberg', 'Renault', $start));
        $this->flight->setFinish($finish);

        $this->flightStorage->addFlightStart('NHR', $start);
        $this->flightStorage->addFlightFinish('NHR', $finish);


        self::assertEquals($this->flightStorage->find('NHR')->getDriverName(),
            $this->buildDataReport->buildReport('./Report of Monaco 2018 Racing')->find('NHR')->getDriverName());
    }

    public function testReadDrivers()
    {
        $file = file_get_contents('./Report of Monaco 2018 Racing/abbreviations.txt');
        $rows = explode("\n", $file);
        foreach ($rows as $data) {
            $index = substr($data, 0, 3);
            $name = substr($data, 3, 26);
            $team = substr($data, 30, 25);
            $this->driverStorage->addDriver(new Driver($index, $name, $team));
        }

        self::assertEquals('NHR', $this->driverStorage->find('NHR')->getAbbreviation());
    }

}
