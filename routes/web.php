<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::view('/','report.index')->name('home');

Route::get('admin',[AdminController::class,'index'])->name('admin');

Route::controller(ReportController::class)->as('report.')->prefix('report')->group(function () {

    Route::get('','displayCommonStats')->name('drivers');

    Route::get('drivers/','showDrivers')->name('drivers.show');

    Route::get('drivers/driver_id={driverID?}','retrieveDriver')->name('drivers.retrieve');

    Route::get('drivers/order={sort?}','sortDrivers')->name('drivers.sort');

});


Route::fallback(function () {
    return 'fallback';
});

