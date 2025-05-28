<?php

namespace App\Http\Controllers;

use App\Models\Vehicle_slot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Vehicle_slotController extends Controller
{
   
public function store(Request $request)
{
    $validated = $request->validate([
        'vehicle_id' => 'nullable|exists:vehicles,id', 
        'slot_id' => 'required|exists:slots,id', 
        'parked_at' => 'required|date|after_or_equal:now',
        'left_at' => 'nullable|date|after_or_equal:now',
        'license_plate' => 'required|string',
    ]);

    $vehicle_slot = Vehicle_slot::create($validated);

    return response()->json($vehicle_slot, 201);
}

   public function showAll()
    {
        return response()->json(Vehicle_slot::all());
    }

   

    public function showCurrents()
{
    $now = Carbon::now();

    $currentSlots = Vehicle_slot::where('parked_at', '<=', $now)
        ->whereNull('left_at')
        ->get();

    return response()->json($currentSlots);
}

 public function showAnonymous()
{
   $currentSlots = Vehicle_slot::whereNull('vehicle_id')
       // ->whereNull('left_at')
        ->get();

    return response()->json($currentSlots);
}
}
