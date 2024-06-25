<?php

namespace App\Http\Resources\CarCategory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public static $wrap = 'categories';

    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
