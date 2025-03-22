<?php

use App\Http\Controllers\Auth\EditInfoController;
use App\Http\Controllers\CarCategoryController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FuelOptionController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RentalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/car_category', CarCategoryController::class);
Route::apiResource('/car', CarController::class);
Route::apiResource('/customer', CustomerController::class);
Route::apiResource('/fuel_option', FuelOptionController::class);
Route::apiResource('/insurance', InsuranceController::class);
Route::apiResource('/location', LocationController::class);
Route::apiResource('/rental', RentalController::class);
Route::get('/old_rentals', [RentalController::class, 'getOldRentals'])->middleware('auth');
Route::get('/current_rentals', [RentalController::class, 'getCurrentRentals'])->middleware('auth');
Route::get('/new_rentals', [RentalController::class, 'getNewRentals'])->middleware('auth');
Route::get('/searched_pickup_location', [LocationController::class, 'getSearchedPickUpLocation']);
Route::get('/searched_dropoff_location', [LocationController::class, 'getSearchedDropOffLocation']);