<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\Lowercase;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
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
            "bio" => ["string", "required", "max:150"],
            "avatar" => ["image", "max:5048", "mimes:jpeg,jpg,png,svg"],
        ]);

        $user = User::find($user_id);
        $avatarUrl = null;
        $avatarPublicId = null;

        try {

            if ($req->hasFile("avatar")) {

                if ($user->public_id) {
                    Cloudinary::uploadApi()
                        ->destroy($user->public_id);
                }

                $uploaded = Cloudinary::uploadApi()->upload(
                    $req->file('avatar')->getRealPath(),
                    [
                        'folder' => 'logbook/avatars',
                        'transformation' => [
                            'width' => 400,
                            'height' => 400,
                            'crop' => 'fill',
                            'gravity' => 'auto',
                        ],
                    ]
                );

                $avatarUrl = $uploaded["secure_url"];
                $avatarPublicId = $uploaded["public_id"];

                $user->avatar = $avatarUrl;
                $user->public_id = $avatarPublicId;
            }
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with("avatar-error", "Avatar upload failed: " . $e->getMessage());
        }

        if ($user) {
            $user->username = $req->input("username");
            $user->email = $req->input("email");
            $user->bio = $req->input("bio");

            $user->save();

            return redirect(route("profile.view"))
                ->with("success-info", "Profile updated successfully");
        }

        return redirect(route("profile.view"))
            ->with("error-info", "Request failed. Try again shortly.");
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
            ->with("error-password", "Request failed. Try again shortly.");
    }

    public function deleteUser(Request $req)
    {
        $user_id = Auth::id();
        $user = User::find($user_id);

        $req->validate([
            "password" => ["required", "string", "current_password", "confirmed"],
        ]);

        if ($user->public_id) {
            Cloudinary::uploadApi()
                ->destroy($user->public_id);
        }

        $deleted = User::destroy($user_id);

        if ($deleted) {
            return redirect(route("login"))
                ->with("success", "Your account has been removed.");
        }

        return redirect(route("login"))
            ->with("error-delete", "Request failed. Try again shortly.");
    }

    public function deleteAvatar()
    {
        $user_id = Auth::id();
        $user = User::find($user_id);

        if ($user->public_id) {
            Cloudinary::uploadApi()
                ->destroy($user->public_id);
            $user->avatar = null;
            $user->public_id = null;
            $user->save();

            return redirect(route("profile.view"))
                ->with("success-avatar", "Avatar removed successfully");
        }

        return redirect(route("profile.view"))
            ->with("error-avatar", "Avatar not available to remove");
    }
}
