<?php

namespace App\Http\Requests\Cars;

use App\Http\Resources\CarCategory\CarCategoryResource;
use Illuminate\Foundation\Http\FormRequest;

class CarStoreRequest extends FormRequest
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
            'car_category_id' => 'required|string',
            'registration_number' => 'required|max:100',
            'brand' => 'required|max:50',
            'model' => 'required|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'mileage'=> 'required',
            'seats' => 'required',
            'gearbox' => 'required|max:25',
            'price' => 'required',
            'description' => 'required',
            'fuel_options_id' => 'required|string',
            'is_available' => 'required',
        ];
    }
}
