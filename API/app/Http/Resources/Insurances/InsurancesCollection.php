<?php

namespace App\Http\Resources\Insurances;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class InsurancesCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */

    public static $wrap = 'insurances';

    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
