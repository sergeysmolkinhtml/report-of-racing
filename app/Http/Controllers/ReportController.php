<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\DriversArrayAction;


class ReportController extends Controller
{
    private DriversArrayAction $drivers;

    public function __construct()
    {
        $this->drivers = new DriversArrayAction('../app/DriversLogs');
    }

    public function displayCommonStats()
    {
        return view('report.CommonStatistic', [
                'drivers' => $this->drivers->handle()
            ]
        );
    }


    public function showDrivers()
    {
        return view('report.DriversList', [
                'drivers' => $this->drivers->handle()
            ]
        );
    }


    public function retrieveDriver()
    {
        return view('report.DriverInfo', [
            'drivers' => $this->drivers->handle()
        ]);
    }

    public function sortDrivers()
    {
        return view('report.OrderedStatistic', [
            'drivers' => $this->drivers->handle()
        ]);
    }

}
