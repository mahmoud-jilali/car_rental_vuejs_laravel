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
    public function index()
    {
        return new CarCategoryCollection(car_category::all());
    }

    public function store(CarCategoryRequest $request)
    {
        $validated = $request->validated();

        $category = car_category::create($validated);

        $message = ['message' => 'Category has been created successfully'];

        return response()->json($message + ['category' => new CarCategoryResource($category)]);
    }

    public function show(car_category $car_category)
    {
        return new CarCategoryResource($car_category);
    }

    public function update(CarCategoryUpdateRequest $request, car_category $car_category)
    {
        $validated = $request->validated();
        
        $car_category->update($validated);

        $message = ['message' => 'Category has been updated successfully'];

        return response()->json($message + ['category' => new CarCategoryResource($car_category)]);
    }

    public function destroy(car_category $car_category)
    {
        $car_category->delete();

        $msg = ['message' => 'Category has been deleted successfuly'];
        
        return $msg;
    }
}
