<?php

namespace App\Http\Controllers\back\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect()->route('dashboard');
        }
        return view('back.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->role === 'admin') {
                return response()->json(['status'=>1,'message' => 'Login Successfully'], 200);
            } else {
                Auth::logout();
                return response()->json(['status'=>0,'message' => 'You are not authorized to access the admin panel.'], 200);
            }
        }
        return response()->json(['status'=>0,'message' => 'Invalid credentials.'], 200);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
