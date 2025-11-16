<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class RegisteredUserController extends Controller
{
    public function create(){
        return view('auth.register');
    }
    public function store(){
        // validate
        $validatedAttributes = request()->validate([
            "name" => ['required', 'string', 'max:255'],
            "email"      => ['required', 'email', 'max:255', 'unique:users,email'],
            "password"   => ['required', Password::min(6), 'confirmed'],
            "role" => ['required'],
        ]);

        $user = User::create($validatedAttributes);

        Auth::login($user);

        return redirect("/lessons");
    }
}
