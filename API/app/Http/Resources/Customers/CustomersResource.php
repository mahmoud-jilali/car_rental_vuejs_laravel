<?php

namespace App\Http\Resources\Customers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public static $wrap = 'customers';

    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'user' => $this->user->toArray(),
            'full_name' => $this->full_name,
            'birth_date' => $this->birth_date,
            'driving_license_number' => $this->driving_license_number,
            'driving_license_date' => $this->driving_license_date
        ];
    }
}
