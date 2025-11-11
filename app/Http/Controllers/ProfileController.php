<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\Lowercase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function profile(Request $req)
    {
        return view("profile.edit-profile", [
            "user" => $req->user(),
        ]);
    }

    public function editUserInfo(Request $req)
    {
        $user_id = Auth::id();

        $req->validate([
            "username" => ["string", new Lowercase()],
            "email" => ["string", "email", Rule::unique("users")->ignore($user_id)],
            "bio" => ["string", "required", "max:150"]
        ]);

        $user = User::find($user_id);

        if ($user) {
            $user->username = $req->input("username");
            $user->email = $req->input("email");
            $user->bio = $req->input("bio");

            $user->save();

            return redirect(route("profile.view"))
                ->with("status", "Profile updated successfully");
        }

        return redirect(route("profile.view"))
            ->with("error", "Request failed. Try again shortly.");
    }

    public function changeUserPassword(Request $req)
    {
        $user_id = Auth::id();

        $req->validate([
            "old_password" => ["required", "string", "current_password"],
            "new_password" => ["required", "string", "min:8", "confirmed"],
        ]);

        $user = User::find($user_id);

        if ($user) {
            $user->password = Hash::make($req->input("new_password"));
            $user->save();

            Session::flush();
            Auth::logout();

            return redirect(route("login"))
                ->with("success", "Password updated. Please log in again.");
        }

        return redirect(route("profile.view"))
            ->with("error", "Request failed. Try again shortly.");
    }

    public function deleteUser(Request $req){
        $user_id = Auth::id();

        $req->validate([
            "password" => ["required", "string", "current_password", "confirmed"],
        ]);

        $deleted = User::destroy($user_id);

        if ($deleted) {
            return redirect(route("login"))
                ->with("success", "Your account has been removed.");
        }

        return redirect(route("login"))
                ->with("error", "Request failed. Try again shortly.");
    }
}
