<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class car extends Model
{
    use HasFactory;

    protected $fillable = ['car_category_id', 'registration_number', 'brand', 'model', 'image', 
    'mileage', 'seats', 'gearbox', 'price', 'description', 'fuel_options_id', 'is_available'];
    protected $casts = ['is_available' => 'boolean'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(car_category::class, 'car_category_id');
    }

    public function fuel(): BelongsTo
    {
        return $this->belongsTo(fuel_option::class, 'fuel_options_id');
    }

    public function rental(): HasMany
    {
        return $this->hasMany(rental::class);
    }
}
