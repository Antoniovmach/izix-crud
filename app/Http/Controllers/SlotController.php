<?php

namespace App\Http\Controllers;

use App\Models\Slot;
use Illuminate\Http\Request;

class SlotController extends Controller
{
   

    public function index()
{
    $users = Slot::all(); // Obtiene todos los usuarios
    return view('slots', compact('slots')); // Pasa la colección a la vista 'users'
}
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string',
            'dimensions' => 'required|array', 
           
        ]);

        $slot = Slot::create([
            'code' => $validated['code'],
            'dimensions' => $validated['dimensions']
        ]);

        return response()->json($slot, 201);
    }

        public function showAll()
    {
        return response()->json(Slot::all());
    }


}
