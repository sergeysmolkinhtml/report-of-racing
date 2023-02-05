<?php

namespace Tests\Unit;

use App\Actions\DriversArrayAction;

use Illuminate\Http\Request;
use Tests\TestCase;


class RoutesTest extends TestCase
{

    public function testHomePage()
    {
        $response = $this->get('/');
        $response->assertViewIs('report.index');
        $response->assertSuccessful();
    }

    public function testCommonStatsShowsCorrectly()
    {
        $response = $this->get('/report');
        $response->assertViewIs('report.CommonStatistic');
        $response->assertViewHas('drivers');
        $response->assertSuccessful();
    }

    public function testDriversListIsLoaded()
    {
        $response = $this->get('/report/drivers/');
        $response->assertViewIs('report.DriversList');
        $response->assertViewHas('drivers');
        $response->assertOk();
    }

    public function testRetrievingExactDriver()
    {
        $response = $this->get('/report/drivers/driver_id=SVF');
        $response->assertViewHas('drivers');
        $response->assertViewIs('report.DriverInfo');
        $response->assertSeeText(\request('SVF'));
    }

    public function testAscendingOrderDrivers()
    {
        $drivers = (new DriversArrayAction())->handle(); // asc order
        $response = $this->get('/report/drivers/order=true/');
        $response->assertViewIs('report.OrderedStatistic');
        $response->assertViewHas('drivers',$drivers);


    }

    public function testServerEfficiency()
    {
        $response = $this->get('/report/drivers/order=true/');
        $response->assertCookie('XSRF-TOKEN');
        $response->assertStatus(200);
    }





}
