<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Validación
        $this->validate($request, [
            'name' => 'required',
            'user' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'user' => Str::slug($request->user),
            'email' => $request->email,
            'password' => $request->password,
        ]);

        /**
         * Logear user, 1
         auth()->attempt(['email' => $request->email, 'password' => $request->password]);
         * Logear user, 2
         */
        auth()->attempt($request->only('email', 'password'));
        
        return redirect()->route('dashboard');
    }
}
