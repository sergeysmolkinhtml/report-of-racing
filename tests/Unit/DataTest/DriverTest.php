<?php

namespace Tests\Unit\DataTest;

use App\DataDrivers\Driver;
use App\DataDrivers\DriverStorage;
use App\DataDrivers\FlightStorage;
use PHPUnit\Framework\TestCase;
use SplObjectStorage;

class DriverTest extends TestCase
{
    protected SplObjectStorage $drivers;
    protected DriverStorage $driverStorage;
    protected FlightStorage $flightsStorage;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        $this->flightsStorage = new FlightStorage();
        $this->driverStorage = new DriverStorage();
        $this->drivers = new SplObjectStorage();

        parent::__construct($name, $data, $dataName);
    }

    public function testGettingDriverData()
    {
        $output = (new Driver('SSW','Sergey Sirotkin','Williams-Mercedes'));

        $this->assertEquals('Williams-Mercedes',$output->getTeam());
        $this->assertEquals('SSW',$output->getAbbreviation());
        $this->assertEquals('Sergey Sirotkin',$output->getName());
    }

    public function testDriverStorageGetAndAddDrivers()
    {
        $driver = new Driver('SSW','Sergey Sirotkin','Williams-Mercedes');
        $this->driverStorage->addDriver($driver);
        $this->drivers->attach($driver);

        self::assertEquals($this->driverStorage->getList(),$this->drivers);
    }

    public function testFindingADriver()
    {
        $driver = new Driver('PGS','Pierre Gasly','SCUDERIA TORO ROSSO HONDA');
        $this->driverStorage->addDriver($driver);
        $output = $this->driverStorage->find('PGS');

        self::assertEquals('Pierre Gasly', $output->getName());

    }


}
