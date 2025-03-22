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
    public function index()
    {
        return new LocationsCollection(location::all());
    }

    public function store(LocationStoreRequest $request)
    {
        $validated = $request->validated();

        $location = location::create($validated);

        $message = ['message' => 'Location has been created successfully'];

        return response()->json($message + ['location' => new LocationsResource($location)]);
    }

    public function show(location $location)
    {
        return new LocationsResource($location);
    }

    public function update(LocationUpdateRequest $request, location $location)
    {
        $validated = $request->validated();

        $location->update($validated);

        $message = ['message' => 'Location has been updated successfully'];

        return response()->json($message + ['location' => new LocationsResource($location)]);
    }

    public function destroy(location $location)
    {
        $location->delete();
        $msg = ['message' => 'Location has been deleted successfuly'];
        return $msg;
    }

    public function getSearchedPickUpLocation(Request $request) 
    {
        $query = location::query();

        $keyword = $request->input('keyword');

        if($keyword) {
            $query->where('street_adress', 'like', $keyword . '%');
        }

        $location = $query->get();

        return response()->json(['locations' => $location]);
    }

    public function getSearchedDropOffLocation(Request $request) 
    {
        $query = location::query();

        $keyword = $request->input('keyword');

        if($keyword) {
            $query->where('street_adress', 'like', $keyword . '%');
        }

        $location = $query->get();

        return response()->json(['locations' => $location]);
    }
}
