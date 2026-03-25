<?php

namespace App\Http\Resources\Brands;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public static $wrap = 'brands';

    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
