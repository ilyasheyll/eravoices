<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create() {
        return view('auth.register');
    }

    public function store(Request $request) {
        $request->validate([
            'last_name' => ['required', 'string', 'max:45'],
            'first_name' => ['required', 'string', 'max:45'],
            'father_name' => ['required', 'string', 'max:45'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'min:8']
        ]);
        
        $user = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'father_name' => $request->father_name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);

        return redirect('/');
    }
}
