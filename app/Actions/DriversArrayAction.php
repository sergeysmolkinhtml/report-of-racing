<?php

declare(strict_types=1);

namespace App\Actions;

use App\DataDrivers\DriverStorage;
use App\DataDrivers\FlightStorage;
use App\DataDrivers\ScoreSorter;
use App\DriversCfg\BuildDataReport;
use Exception;
use Psy\Readline\Hoa\FileDoesNotExistException;
use function request;

class DriversArrayAction
{
    private BuildDataReport $builder;
    private FlightStorage $racingData;
    private ScoreSorter $scoresorter;

    /**
     * @throws Exception
     */
    public function __construct(string $LogsFile)
    {
        $this->builder = new BuildDataReport(new FlightStorage(),new DriverStorage());

        if (!file_exists($LogsFile)) {
            throw new FileDoesNotExistException("File with such name doesn't exist");
        }

        $this->racingData = $this->builder->buildReport($LogsFile);
        $this->scoresorter = new ScoreSorter($this->racingData);
    }


    public function handle(): array
    {
        $sort = request('sort') == 'false' ?  false : true;
        $sortedDrivers = $this->scoresorter->execute($sort);

        foreach ($sortedDrivers as $ordered) {
            $index = $ordered['driver'];
            $flight = $this->racingData->find($index);
            $drivers[] = [
                'id' => $flight->getDriverId(),
                'name' => $flight->getDriverName(),
                'score' => $flight->getDuration(),
                'team' => $flight->getTeam()
            ];
        }
        return $drivers;
    }
}
