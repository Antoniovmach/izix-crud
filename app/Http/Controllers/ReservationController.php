<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Reservation;

class ReservationController extends Controller
{
 
public function show(Request $request)
{
    $id = $request->query('id');
    $user = User::with('reservations.slot')->findOrFail($id);

    return response()->json($user->reservations);
}


public function store(Request $request)
{
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'slot_id' => 'required|exists:slots,id', 
        'reserved_from' => 'required|date|after_or_equal:now',
        'reserved_until' => 'required|date|after:reserved_from',
    ]);

   $conflictingReservation = Reservation::where('slot_id', $validated['slot_id'])
        ->where(function ($query) use ($validated) {
            $query->whereBetween('reserved_from', [$validated['reserved_from'], $validated['reserved_until']])
                  ->orWhereBetween('reserved_until', [$validated['reserved_from'], $validated['reserved_until']])
                  ->orWhere(function ($query) use ($validated) {
                      $query->where('reserved_from', '<=', $validated['reserved_from'])
                            ->where('reserved_until', '>=', $validated['reserved_until']);
                  });
        })
        ->first();

    if ($conflictingReservation) {
        return response()->json([
            'message' => 'The slot is already reserved.'
        ], 409);
    }else{
            $reservation = Reservation::create($validated);

            $user = User::find($validated['user_id']);
            $user->loyalty_points = ($user->loyalty_points ?? 0) + 10;
            $user->save();


    return response()->json($reservation, 201);
       
    }

   // $reservation = Reservation::create($validated);
}
}
