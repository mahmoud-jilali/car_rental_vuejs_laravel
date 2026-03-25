<?php

namespace App\Http\Controllers;

use App\Http\Requests\Brands\BrandsRequest;
use App\Http\Requests\Brands\BrandsUpdateRequest;
use App\Http\Resources\Brands\BrandsCollection;
use App\Http\Resources\Brands\BrandsResource;
use App\Models\brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return new BrandsCollection(brand::all());
    }

    public function store(BrandsRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('logo')) {
            $imagePath = $request->file('logo')->store('Images', 'public');
            $validated['logo'] = basename($imagePath);
        } else {
            return response()->json(['error' => 'Logo is required'], 400);
        }

        $brand = brand::create($validated);

        $message = ['message' => 'Brand has been created successfully'];

        return response()->json($message + ['brand' => new BrandsResource($brand)]);
    }

    public function show(brand $brand)
    {
        return new BrandsResource($brand);
    }

    public function update(BrandsUpdateRequest $request, brand $brand)
    {
        $validated = $request->validated();

        if ($request->hasFile('logo')) {
            $imagePath = $request->file('logo')->store('Images', 'public');
            $validated['logo'] = basename($imagePath);
        // } else {
        //     return response()->json(['error' => 'Logo is required'], 400);
        }
        
        $brand->update($validated);

        $message = ['message' => 'Brand has been updated successfully'];

        return response()->json($message + ['brand' => new BrandsResource($brand)]);
    }

    public function destroy(brand $brand)
    {
        $brand->delete();

        $msg = ['message' => 'brand has been deleted successfuly'];
        
        return $msg;
    }
}
