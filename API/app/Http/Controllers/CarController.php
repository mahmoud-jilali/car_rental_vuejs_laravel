<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cars\CarStoreRequest;
use App\Http\Requests\Cars\CarUpdateRequest;
use App\Http\Resources\Cars\CarsCollection;
use App\Http\Resources\Cars\CarsResource;
use App\Models\car;
use App\Models\car_category;
use App\Models\fuel_option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new CarsCollection(car::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarStoreRequest $request)
    {
        $validated = $request->validated();

        $carCategoryName = $validated['car_category_id'];
        $carCategory = car_category::where('name', $carCategoryName)->first();

        $fuelName = $validated['fuel_options_id'];
        $carFuel = fuel_option::where('name', $fuelName)->first();

        if (!$carCategory) {
            return response()->json(['error' => 'Invalid car category'], 400);
        }

        elseif(!$carFuel){
            return response()->json(['error' => 'Invalid fuel type'], 400);
        }

        $validated['car_category_id'] = $carCategory->id;
        $validated['fuel_options_id'] = $carFuel->id;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('Images', 'public');
            $validated['image'] = basename($imagePath);
        } else {
            return response()->json(['error' => 'Image is required'], 400);
        }

        $car = car::create($validated);

        $message = ['message' => 'Car has been created successfully'];

        return response()->json($message + ['car' => new CarsResource($car)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(car $car)
    {
        return new CarsResource($car);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(car $car)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarUpdateRequest $request, car $car)
    {
        $validated = $request->validated();

        $carCategoryName = $validated['car_category_id'];
        $carCategory = car_category::where('name', $carCategoryName)->first();

        $fuelName = $validated['fuel_options_id'];
        $carFuel = fuel_option::where('name', $fuelName)->first();

        if (!$carCategory) {
            return response()->json(['error' => 'Invalid car category'], 400);
        }

        elseif(!$carFuel){
            return response()->json(['error' => 'Invalid fuel type'], 400);
        }

        $validated['car_category_id'] = $carCategory->id;
        $validated['fuel_options_id'] = $carFuel->id;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('Images', 'public');
            $validated['image'] = basename($imagePath);
        } else {
            return response()->json(['error' => 'Image is required'], 400);
        }

        $car->update($validated);

        $message = ['message' => 'Car has been updated successfully'];

        return response()->json($message + ['car' => new CarsResource($car)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(car $car)
    {
        $car->delete();
        $msg = ['message' => 'Car has been deleted successfuly'];
        return $msg;
    }
}
