<?php

namespace App\Http\Controllers;

use App\Http\Requests\Services\ServiceStoreRequest;
use App\Http\Requests\Services\ServiceUpdateRequest;
use App\Http\Resources\Services\ServicesCollection;
use App\Http\Resources\Services\ServicesResource;
use App\Models\service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ServicesCollection(service::all());
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
    public function store(ServiceStoreRequest $request)
    {
        $validated = $request->validated();

        $service = service::create($validated);

        $message = ['message' => 'Service has been created successfully'];

        return response()->json($message + ['service' => new ServicesResource($service)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(service $service)
    {
        return new ServicesResource($service);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(service $service)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceUpdateRequest $request, service $service)
    {
        $validated = $request->validated();

       $service->update($validated);

        $message = ['message' => 'Service has been updated successfully'];

        return response()->json($message + ['service' => new ServicesResource($service)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(service $service)
    {
        $service->delete();

        $message = ['message' => 'Service has been deleted successfuly'];

        return response()->json($message);
    }
}
