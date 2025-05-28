<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
 protected $fillable = [
        'user_id',
        'slot_id',
        'reserved_from', 
        'reserved_until',
        'created_at',
        'updated_at',
       
    ];


  public function user()
{
    return $this->belongsTo(User::class);
}

public function slot()
{
    return $this->belongsTo(Slot::class);
}
}
