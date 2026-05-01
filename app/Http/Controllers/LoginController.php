<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)
                    ->orWhere('email', $request->username)
                    ->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            if ($user->role == 'admin') {
                return redirect()->route('admin.index');
            } else {
                return redirect()->route('dashboard');
            }
        } else {
            return back()->withErrors(['login' => 'Invalid username or password']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
