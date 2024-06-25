<?php

namespace App\Http\Controllers;

use App\Http\Requests\Rentals\RentalStoreRequest;
use App\Http\Requests\Rentals\RentalUpdateRequest;
use App\Http\Resources\Rentals\RentalsCollection;
use App\Http\Resources\Rentals\RentalsResource;
use App\Models\car;
use App\Models\rental;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return RentalsCollection::collection(rental::all());
        return rental::all();
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
    public function store(RentalStoreRequest $request)
    {
        $validated = $request->validated();
        
        $rental = rental::create($validated);

        $message = ['message' => 'Rental has been created successfully'];

        return response()->json($message + ['rental' => new RentalsResource($rental)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(rental $rental)
    {
        return new RentalsResource($rental);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(rental $rental)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(RentalUpdateRequest $request, rental $rental)
    {
        $validated = $request->validated();
        
        $rental->update($validated);

        $message = ['message' => 'Rental has been updated successfully'];

        return response()->json($message + ['rental' => new RentalsResource($rental)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(rental $rental)
    {
        //
    }

    public function getOldRentals()
    {
        $user = auth()->user();

        $customer = $user->customer;

        if (!$customer) {
            return response()->json([
                'message' => "You don't have any old rentals.",
            ], 404);
        }

        $currentDate = Carbon::now();

        $oldRentals = rental::where('customer_id', $customer->id)->whereDate('end_date', '<', $currentDate)->get();

        if ($oldRentals->isEmpty()) {
            return response()->json([
                'message' => "You don't have any old rentals.",
            ], 404);
        } 

        return RentalsResource::collection($oldRentals);
    }

    public function getCurrentRentals()
    {
        $user = auth()->user();

        $customer = $user->customer;

        if (!$customer) {
            return response()->json([
                'message' => "You don't have any current rentals.",
            ], 404);
        }

        $currentDate = Carbon::now();

        $currentRentals = rental::where('customer_id', $customer->id)->whereDate('start_date', '<=', $currentDate)
        ->whereDate('end_date', '>=', $currentDate)->get();

        if ($currentRentals->isEmpty()) {
            return response()->json([
                'message' => "You don't have any current rentals.",
            ], 404);
        }    

        return RentalsResource::collection($currentRentals);
    }

    public function getNewRentals()
    {
        $user = auth()->user();

        $customer = $user->customer;

        if (!$customer) {
            return response()->json([
                'message' => "You don't have any new rentals.",
            ], 404);
        }

        $currentDate = Carbon::now();

        $newRentals = rental::where('customer_id', $customer->id)->whereDate('start_date', '>', $currentDate)->get();

        if ($newRentals->isEmpty()) {
            return response()->json([
                'message' => "You don't have any new rentals.",
            ], 404);
        } 

        return RentalsResource::collection($newRentals);
    } 
}
