<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|string|max:10|min:3',
            'fullname' => 'required|string|max:25',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:5',
            'role' => 'required|string',
        ]);

        $validate['password'] = Hash::make($validate['password']);

        User::create($validate);
        return redirect()->route('users.index')->with('success', 'Successfully created new user');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->load('profile');
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validate = $request->validate([
            'username' => 'string|required|min:3',
            'fullname' => 'string|required|max:50',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data['password'] = $user->password;
        }
        $user->update($data);
        return redirect()->route('users.index')->with('success', 'Successfully updated new user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Successfully deleted new user');
    }

    // Call Stored Procedure
    public function storeProcedure()
    {
        $user = DB::unprepared('CALL GetUsers');

        return response()->json($user);
    }

    // Call SQL function get user by id
    public function getUserById($id)
    {
        $username = DB::unprepared('SELECT get_username(?)', [$id]);

        return response()->json([
            'username' => $username[0],
        ]);
    }
}
