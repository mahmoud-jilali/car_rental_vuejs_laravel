<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class location extends Model
{
    use HasFactory;

    protected $fillable = ['country', 'city', 'state', 'zip_code', 'street_adress'];

    public function rental(): HasMany
    {
        return $this->hasMany(rental::class);
    }
}
