<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(){
        return inertia('Index',
    [
        //go to web dev vue and index chech attribute it will be there this message
        'message' => "Hi from laravel, yo"
    ]);
    }

    public function showLoginForm()
    {
        return inertia('Login');
    }

    public function showRegistrationForm()
    {
        return inertia('Register');
    }

    public function register(Request $request)
    {
        $user = User::create($request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed'
        ]));

        Auth::login($user);

        //password is hashed already
        
        return redirect()->intended('Shopping')->with('success', 'Account created');
    }
    public function logintwo(Request $request){
        if (!Auth::attempt($request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]), true)) {
            throw ValidationException::withMessages([
                'email' => 'Authentication failed'
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended('calendar')->with('success', 'logged in');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->back()->with('success', 'logged out');
    }


}
