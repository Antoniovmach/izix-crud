<?php

namespace App\Http\Controllers;

use App\Models\Parking;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    
public function showAll()
    {
        return response()->json(Parking::all());
    }


    
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'location' => 'required|array', 
        'locality_id' => 'nullable|exists:localities,id',
    ]);
    $parking = Parking::create($validated);
    return response()->json($parking, 201);
}
}
