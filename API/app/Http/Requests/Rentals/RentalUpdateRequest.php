<?php

namespace App\Http\Requests\Rentals;

use Illuminate\Foundation\Http\FormRequest;

class RentalUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => 'required',
            'car_id' => 'required',
            'pick_up_location' => 'required',
            'drop_off_location' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ];
    }
}
