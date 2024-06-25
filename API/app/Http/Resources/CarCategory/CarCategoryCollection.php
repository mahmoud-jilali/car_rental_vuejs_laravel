<?php

namespace App\Http\Resources\CarCategory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CarCategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */

    public static $wrap = 'categories';

    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
