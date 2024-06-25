<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuelOptions\FuelOptionStoreRequest;
use App\Http\Requests\FuelOptions\FuelOptionUpdateRequest;
use App\Http\Resources\FuelOptions\FuelOptionsCollection;
use App\Http\Resources\FuelOptions\FuelOptionsResource;
use App\Models\fuel_option;
use Illuminate\Http\Request;

class FuelOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new FuelOptionsCollection(fuel_option::all());
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
    public function store(FuelOptionStoreRequest $request)
    {
        $validated  = $request->validated();

        $fuel_option = fuel_option::create($validated);

        return new FuelOptionsResource($fuel_option);
    }

    /**
     * Display the specified resource.
     */
    public function show(fuel_option $fuel_option)
    {
        return new FuelOptionsResource($fuel_option);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(fuel_option $fuel_option)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(FuelOptionUpdateRequest $request, fuel_option $fuel_option)
    {
        $validated  = $request->validated();

        $fuel_option->update($validated);

        return new FuelOptionsResource($fuel_option);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(fuel_option $fuel_option)
    {
        $fuel_option->delete();
        $msg = ['message' => 'Fuel option has been deleted successfuly'];
        return $msg;
    }
}
