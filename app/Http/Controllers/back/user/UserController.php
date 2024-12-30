<?php

namespace App\Http\Controllers\back\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $data = User::get();
        return view('back.users.userlist',compact('data'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,user',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'password' => bcrypt('password')
        ]);

        return response()->json(['message' => 'User added successfully']);
    }

     public function edit($id)
     {
         $user = User::findOrFail($id);
         return response()->json($user);
     }

     public function update(Request $request, $id)
     {
         $user = User::findOrFail($id);
         $user->update($request->all());
         return response()->json(['message' => 'User updated successfully']);
     }

     public function destroy(Request $request,$id)
     {
         $user = User::findOrFail($id);
         $user->delete();

         return response()->json(['message' => 'User deleted successfully']);
     }
}
