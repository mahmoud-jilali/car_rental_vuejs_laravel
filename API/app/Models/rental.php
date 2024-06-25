<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class rental extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'car_id', 'pick_up_location', 'drop_off_location', 'start_date', 'end_date'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(customer::class, 'customer_id');
    }

    public function car(): BelongsTo
    {
        return $this->belongsTo(car::class, 'car_id');
    }

    public function pickUpLocation(): BelongsTo
    {
        return $this->belongsTo(location::class, 'pick_up_location');
    }

    public function dropOffLocation(): BelongsTo
    {
        return $this->belongsTo(location::class, 'drop_off_location');
    }
}
