<?php

namespace App\Http\Resources\Cars;

use App\Http\Resources\CarCategory\CarCategoryResource;
use App\Http\Resources\FuelOptions\FuelOptionsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public static $wrap = 'cars';

    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'category' => new CarCategoryResource($this->category),
            'registration_number' => $this->registration_number,
            'brand' => $this->brand,
            'model' => $this->model,
            'image' => asset('Images/'. $this->image),
            'mileage' => $this->mileage,
            'seats' => $this->seats,
            'gearbox' => $this->gearbox,
            'price' => $this->price,
            'description' => $this->description,
            'fuel_option' => new FuelOptionsResource($this->fuel),
            'is_available' => $this->is_available,
        ];
    }
}
