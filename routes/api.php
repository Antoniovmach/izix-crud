
<?php

use App\Http\Controllers\ParkingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Vehicle_slotController;
use App\Models\Parking;

//---------------------------------------------------------------------------------------------
//User

    // GET
Route::get('/users', [UserController::class, 'showAll']);

Route::get('/userById', [UserController::class, 'showById']);

Route::get('/vehiclesByUser', [UserController::class, 'vehiclesByUser']);

Route::get('/userByEmail', [UserController::class, 'showByEmail']);

    // POST
Route::post('/user', [UserController::class, 'store']);

    //PUT
Route::put('/user/{id}', [UserController::class, 'update']);


    //DELETE
Route::delete('/userById', [UserController::class, 'deleteById']);

//-------------------------------------------------------------------------------------------------------------------
//Reservation
    // GET
Route::get('/reservationByUser', [ReservationController::class, 'show']);

    // POST
Route::post('/reservation', [ReservationController::class, 'store']);
//-------------------------------------------------------------------------------------------------------------------
//VEHICLE

    // GET
Route::get('/vehicles', [VehicleController::class, 'showAll']);

Route::get('/usersByVehicle', [VehicleController::class, 'usersByVehicle']);

    // POST
Route::post('/vehicle', [VehicleController::class, 'store']);



//-------------------------------------------------------------------------------------------------------------------
//SLOT

    // GET
Route::get('/slots', [SlotController::class, 'showAll']);

    // POST
Route::post('/slots', [SlotController::class, 'store']);



//-------------------------------------------------------------------------------------------------------------------
//VEHICLE_SLOT

    // GET
Route::get('/showCurrent', [Vehicle_slotController::class, 'showCurrents']);
Route::get('/showAnonymous', [Vehicle_slotController::class, 'showAnonymous']);

    // POST
Route::post('/vehicle_slot', [Vehicle_slotController::class, 'store']);


//PARKING
    // GET
Route::get('/parkings', [ParkingController::class, 'showAll']);