<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
      protected $fillable = [
        'code',
        'created_at',
        'updated_at',
        'dimensions',
        'parking_id',
    ];

    protected $casts = [
        'dimensions' => 'array', 
    ];

    public function vehicles()
{
    return $this->belongsToMany(Vehicle::class, 'vehicle_slot')
                ->withPivot('parked_at', 'left_at')
                ->withTimestamps();
}

public function parking()
{
    return $this->belongsTo(Parking::class);
}


}
