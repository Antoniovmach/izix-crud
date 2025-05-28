<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle_slot extends Model
{

protected $table = 'vehicle_slot';


  protected $fillable = [
        'vehicle_id',
        'slot_id',
        'parked_at',
        'left_at',
        'license_plate',
    ];


     public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }
}
