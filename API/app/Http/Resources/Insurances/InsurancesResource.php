<?php

namespace App\Http\Resources\Insurances;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InsurancesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public static $wrap = 'insurances';

    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
