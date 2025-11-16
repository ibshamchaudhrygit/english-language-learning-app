<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create(){
        return view("auth.login");
    }

    public function store()
    {
        // validate
        $validatedAttributes = request()->validate([
            "email" => ['required', 'email'],
            "password" => ['required'], // password_confirmation
        ]);

        if(!Auth::attempt($validatedAttributes)){
            throw ValidationException::withMessages([
                "email" => "Sorry , those credentials do not match our records."
            ]);
        }

        request()->session()->regenerate();

        $user = Auth::user();

        // Redirect based on role
        if ($user->role === 'admin') {
            return redirect('/admin');
        } elseif ($user->role === 'teacher') {
            return redirect('/teacher');
        } else {
            return redirect('/lessons');
        }

    }

    public function destroy()
    {
        Auth::logout();
        return redirect("/login");
    }
}
