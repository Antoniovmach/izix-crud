<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Localities extends Model
{
     protected $fillable = [
        'name',
        'province_id'
    ];

     public function countries()
    {
        return $this->belongsTo(Countries::class);
    }
}
