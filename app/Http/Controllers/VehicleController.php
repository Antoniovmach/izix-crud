<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
   

    public function index()
{
    $vehicle = Vehicle::all();
    return view('vehicles', compact('vehicles')); 
}

public function showAll()
    {
        return response()->json(Vehicle::all());
    }
    
    public function UsersByVehicle(Request $request)
{

     $id = $request->query('id');
       // $user = User::find($id);
    $vehicle = Vehicle::with('users')->find($id);

    if (!$vehicle) {
        return response()->json(['message' => 'User not found'], 404);
    }

    return response()->json($vehicle->users);
}


public function store(Request $request)
{
    $validated = $request->validate([
        'license_plate' => 'required|string|unique:vehicles,license_plate',
        'category' => 'required|string',
        'brand' => 'required|string',
        'model' => 'required|string',
        'dimensions' => 'required|array', 
        'fuel_type' => 'required|string',
        'primary_owner_id' => 'nullable|exists:users,id',
    ]);
    $vehicle = Vehicle::create($validated);
     if (isset($validated['primary_owner_id'])) {
        $vehicle->users()->attach($validated['primary_owner_id']);
    }
  

    return response()->json($vehicle, 201);
}



}
