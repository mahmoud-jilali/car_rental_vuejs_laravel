<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class car_category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function car(): HasMany
    {
        return $this->hasMany(car::class);
    }
}
