<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    use HasFactory;

    protected $fillable = [
        'location',       
        'locality_id',
        'name',
    ];

    protected $casts = [
        'location' => 'array',
    ];

    // Relación: un parking pertenece a una localidad
    public function locality()
    {
        return $this->belongsTo(Localities::class);
    }

    // Relación: un parking tiene muchos slots
    public function slots()
    {
        return $this->hasMany(Slot::class);
    }
}