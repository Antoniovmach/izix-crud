<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
 

    public function index()
{
    $users = User::all(); 
    return view('users', compact('users'));
}


    /**
     * Show the form for creating a new resource.
     */
   public function create()
{
    return view('create_users'); 
}


    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'nullable|string',
            'loyalty_points' => 'nullable|integer',
            'created_at' => 'nullable|date'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'] ?? 'user',
            'loyalty_points' => $validated['loyalty_points'] ?? 0,
            'created_at' => $validated['created_at'] ?? now(),
           
        ]);

        return response()->json($user, 201);
    }

        public function showAll()
    {
        return response()->json(User::all());
    }


    /**
     * Display the specified resource.
     */
    public function showById(Request $request)
    {
        $id = $request->query('id');
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

        public function showByEmail(Request $request)
    {
        $email = $request->query('email');
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }


    public function vehiclesByUser(Request $request)
{

     $id = $request->query('id');
       // $user = User::find($id);
    $user = User::with('vehicles')->find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    return response()->json($user->vehicles);
}


    /**
     * Show the form for editing the specified resource.
     */
public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'nullable|string',
        'email' => "nullable|email|unique:users,email,$id", 
        'password' => 'nullable|string|min:6',
        'role' => 'nullable|string',
        'loyalty_points' => 'nullable|integer',
        'created_at' => 'nullable|date',
    ]);

    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $user->name = $validated['name'] ?? $user->name;
    $user->email = $validated['email'] ?? $user->email;

    if (!empty($validated['password'])) {
        $user->password = Hash::make($validated['password']);
    }

    $user->role = $validated['role'] ?? $user->role;
    $user->loyalty_points = $validated['loyalty_points'] ?? $user->loyalty_points;
    $user->created_at = $validated['created_at'] ?? $user->created_at;

    $user->save();

    return response()->json($user, 200);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function deleteById(Request $request)
{

    $id = $request->input('id');
    if (!$id) {
       $id = $request->query('id');
    }
  

    $user = User::find($id);
   

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

  if (!$this->checkIfAdmin()) {
        return response()->json(['message' => 'Unauthorized'], 403);

  }

    $user->delete();

    return response()->json(['message' => 'User deleted successfully']);
}



public function checkIfAdmin()
{
    // LOGIN NOT IMPLEMENTED :)
    return true;
}
}