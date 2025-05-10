<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'surname' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|digits_between:10,15|unique:users,phone',
            'birthday' => 'nullable|date',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->birthday = $request->birthday;
        $user->save();

        return redirect()->route('login')->with('success', 'User registered successfully!');
    }
}

