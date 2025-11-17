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
    public function __construct()
    {
        $this->middleware("auth");
    }

    // Show Profile Edit Page
    public function profile(Request $req)
    {
        return view("profile.edit-profile", [
            "user" => $req->user(),
        ]);
    }

    // Handle Profile Edit Request
    public function editUserInfo(Request $req)
    {
        $user = Auth::user();

        $req->validate([
            "username" => ["string", new Lowercase()],
            "email" => ["string", "email", Rule::unique("users")->ignore($user->id)],
            "bio" => ["string", "required", "max:200"],
            "avatar" => ["image", "max:5048", "mimes:jpeg,jpg,png,svg"],
        ]);

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

    // Handle Password Change Request
    public function changeUserPassword(Request $req)
    {
        $user = Auth::user();

        $req->validate([
            "old_password" => ["required", "string", "current_password"],
            "new_password" => ["required", "string", "min:8", "confirmed"],
        ]);

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

    // Handle User Deletion Request
    public function deleteUser(Request $req)
    {
        $user = Auth::user();

        $req->validate([
            "password" => ["required", "string", "current_password", "confirmed"],
        ]);

        if ($user->public_id) {
            Cloudinary::uploadApi()
                ->destroy($user->public_id);
        }

        $deleted = User::destroy($user->id);

        if ($deleted) {
            return redirect(route("login"))
                ->with("success", "Your account has been removed.");
        }

        return redirect(route("login"))
            ->with("error-delete", "Request failed. Try again shortly.");
    }

    // Handle Avatar Deletion Request
    public function deleteAvatar()
    {
        $user = Auth::user();

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

    // Show Searched User Profile
    public function showUserProfile(User $user)
    {
        $posts = $user->posts()->latest()->simplePaginate(3);

        return view("profile.show-profile", [
            "user" => $user,
            "posts" => $posts,
        ]);
    }

    // Show Self Profile
    public function selfProfileShow()
    {
        $user = Auth::user();
        $posts = $user->posts()->latest()->simplePaginate(3);

        return view("profile.self-show", [
            "user" => $user,
            "posts" => $posts,
        ]);
    }
}
