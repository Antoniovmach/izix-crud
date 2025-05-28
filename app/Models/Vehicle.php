<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{

 
        protected $fillable = [
        'license_plate',
        'category',
        'brand',
        'model',
        'dimensions',
        'fuel_type',
        'primary_owner_id',
    ];

    protected $casts = [
        'dimensions' => 'array', // Para que Laravel lo trate como JSON
    ];

public function users()
{
    return $this->belongsToMany(User::class, 'user_vehicle');
}

public function primaryOwner()
{
    return $this->belongsTo(User::class, 'primary_owner_id');
}

public function slots()
{
    return $this->belongsToMany(Slot::class, 'vehicle_slot')
                ->withPivot('parked_at', 'left_at')
                ->withTimestamps();
}

}

