<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    protected $fillable = [
        'name',
        'countries_id', 
    ];

    public function countries_id()
{
    return $this->belongsTo(Countries::class, 'id');
}
}
