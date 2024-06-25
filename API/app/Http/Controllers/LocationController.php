<?php

namespace App\Http\Controllers;

use App\Http\Requests\Locations\LocationStoreRequest;
use App\Http\Requests\Locations\LocationUpdateRequest;
use App\Http\Resources\Locations\LocationsCollection;
use App\Http\Resources\Locations\LocationsResource;
use App\Models\location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new LocationsCollection(location::all());
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
    public function store(LocationStoreRequest $request)
    {
        $validated = $request->validated();

        $location = location::create($validated);

        $message = ['message' => 'Location has been created successfully'];

        return response()->json($message + ['location' => new LocationsResource($location)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(location $location)
    {
        return new LocationsResource($location);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(location $location)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocationUpdateRequest $request, location $location)
    {
        $validated = $request->validated();

        $location->update($validated);

        $message = ['message' => 'Location has been updated successfully'];

        return response()->json($message + ['location' => new LocationsResource($location)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(location $location)
    {
        $location->delete();
        $msg = ['message' => 'Location has been deleted successfuly'];
        return $msg;
    }

    public function getSearchedLocation(Request $request) 
    {
        $query = location::query();

        $keyword = $request->input('keyword');

        if($keyword) {
            $query->where('street_adress', 'like', $keyword . '%');
            // $query->where('city', 'like', $keyword . '%');
        }

        $location = $query->get();

        return response()->json($location);
    }
}
