<?php

namespace App\Http\Resources\FuelOptions;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FuelOptionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public static $wrap = 'fuel_options'; 

    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
