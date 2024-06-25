<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customers\CustomerStoreRequest;
use App\Http\Resources\Customers\CustomersCollection;
use App\Http\Resources\Customers\CustomersResource;
use App\Models\customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new CustomersCollection(customer::all());
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
    public function store(CustomerStoreRequest $request)
    {
        $validated = $request->validated();

        $customer = customer::create($validated);

        $message = ['message' => 'Customer has been created successfully'];

        return response()->json($message + ['customer' => new CustomersResource($customer)]);
    }

    /**
     * Display the specified resource.
     */
    public function show(customer $customer)
    {
        return new CustomersResource($customer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(customer $customer)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerStoreRequest $request, customer $customer)
    {
        $validated = $request->validated();

        $customer->update($validated);

        $message = ['message' => 'Customer has been updated successfully'];

        return response()->json($message + ['customer' => new CustomersResource($customer)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(customer $customer)
    {
        $customer->delete();

        $msg = ['message' => 'Customer has been deleted successfully'];

        return $msg;
    }
}
