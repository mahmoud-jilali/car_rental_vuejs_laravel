<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarCategory\CarCategoryRequest;
use App\Http\Requests\CarCategory\CarCategoryUpdateRequest;
use App\Http\Resources\CarCategory\CarCategoryCollection;
use App\Http\Resources\CarCategory\CarCategoryResource;
use App\Models\car_category;
use Illuminate\Http\Request;

class CarCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new CarCategoryCollection(car_category::all());
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
    public function store(CarCategoryRequest $request)
    {
        $validated = $request->validated();

        $category = car_category::create($validated);

        $message = ['message' => 'Category has been created successfully'];

        return response()->json($message + ['category' => new CarCategoryResource($category)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(car_category $car_category)
    {
        return new CarCategoryResource($car_category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(car_category $car_category)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarCategoryUpdateRequest $request, car_category $car_category)
    {
        $validated = $request->validated();
        
        $car_category->update($validated);

        $message = ['message' => 'Category has been updated successfully'];

        return response()->json($message + ['category' => new CarCategoryResource($car_category)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(car_category $car_category)
    {
        $car_category->delete();

        $msg = ['message' => 'Category has been deleted successfuly'];
        
        return $msg;
    }
}
