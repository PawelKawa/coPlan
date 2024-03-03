<?php

namespace App\Http\Controllers;

use App\Models\Shopping;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function index(){
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
        
        Shopping::create([
            'user_id' => $user->id,
            'next_items' => null,
            'some_items' => null,
        ]);
        
        Auth::login($user);
        return redirect()->intended()->with('success', 'Account created');
    }
    public function login(Request $request){
        if (!Auth::attempt($request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]), true)) {
            throw ValidationException::withMessages([
                'password' => 'Authentication failed'
            ]);
        }

        $request->session()->regenerate();
        //intended will redirect you back where you come from, with this parameter it will redirect you to web.php name('homepage')
        return redirect()->intended(route('homepage'))->with('success', 'logged in');
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'logged out');
    }


}
