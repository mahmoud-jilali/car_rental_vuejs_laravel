<?php

namespace App\Http\Controllers;

use App\Http\Requests\Insurances\InsuranceStoreRequest;
use App\Http\Requests\Insurances\InsuranceUpdateRequest;
use App\Http\Resources\Insurances\InsurancesCollection;
use App\Http\Resources\Insurances\InsurancesResource;
use App\Models\insurance;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new InsurancesCollection(insurance::all());
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
    public function store(InsuranceStoreRequest $request)
    {
        $validated = $request->validated();
        
        $insurance = insurance::create($validated);

        $message = ['message' => 'Insurance has been created successfully'];

        return response()->json($message + ['insurance' => new InsurancesResource($insurance)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(insurance $insurance)
    {
        return new InsurancesResource($insurance);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(insurance $insurance)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(InsuranceUpdateRequest $request, insurance $insurance)
    {
        $validated = $request->validated();

        $insurance->update($validated);

        $message = ['message' => 'Insurance has been updated successfully'];

        return response()->json($message + ['insurance' => new InsurancesResource($insurance)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(insurance $insurance)
    {
        $insurance->delete();

        $msg = ['message' => 'Insurance has been deleted successfuly'];
        
        return $msg;
    }
}
