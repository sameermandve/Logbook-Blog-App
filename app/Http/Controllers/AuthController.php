<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\Lowercase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(){
        return view("auth.login");
    }

    public function loginPost(Request $req){
        $req->validate([
            "email" => ["required", "string", "email"],
            "password" => ["required", "string", "min:8"],
        ]);

        $credentials = $req->only("email", "password");

        if (Auth::attempt($credentials)){
            return redirect()->intended(route("home"));
        }

        return redirect(route("login"))
            ->with("error", "Invalid Credentials");
    }

    public function register(){
        return view("auth.register");
    }

    public function registerPost(Request $req){
        $req->validate([
            "username" => ["required", "string", new Lowercase(), "max:255", "unique:users"],
            "email" => ["required", "string", "email", "unique:users"],
            "password" => ["required", "string", "min:8", "confirmed"]
        ]);

        $data["username"] = $req->input("username");
        $data["email"] = $req->input("email");
        $data["password"] = Hash::make($req->input("password"));
        $user = User::create($data);

        if (!$user) {
            return redirect(route("register"))
                ->with("error", "Registration failed. Try again shortly.");
        }

        return redirect(route("login"))
                ->with("success", "Registration successful. Log in now.");
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route("login"))
                ->with("success", "Logout successful. Log in now.");
    }
}
