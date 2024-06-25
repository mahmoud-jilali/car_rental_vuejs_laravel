<?php

namespace App\Http\Resources\Rentals;

use App\Http\Resources\Cars\CarsResource;
use App\Http\Resources\Customers\CustomersResource;
use App\Http\Resources\Locations\LocationsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RentalsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public static $wrap = 'rentals';

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer' => new CustomersResource($this->customer),
            'car' => new CarsResource($this->car),
            'pick_up_location' => new LocationsResource($this->pickUpLocation),
            'drop_off_location' => new LocationsResource($this->dropOffLocation),
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
    }
}
