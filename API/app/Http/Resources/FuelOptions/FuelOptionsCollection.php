<?php

namespace App\Http\Resources\FuelOptions;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FuelOptionsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */

    public static $wrap = 'fuel_options';

    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
