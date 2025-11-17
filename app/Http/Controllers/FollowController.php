<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function toggleFollow(User $user)
    {
        $auth_user = Auth::user();
        $target = User::findOrFail($user->id);

        if ($auth_user->id === $target->id) {
            return back()
                ->with("error-follow", "User cannot follow itself");
        }

        $Following = $auth_user->following()
            ->where("user_id", $target->id)
            ->where("follower_id", $auth_user->id)
            ->exists();

        if ($Following) {
            $auth_user->following()->detach($target->id);
        } else {
            $auth_user->following()->attach($target->id);
        }

        return response()->json([
            "isFollowing" => !$Following,
            "followers_count" => $target->followers()->count(),
            "following_count" => $user->following()->where("follower_id", $user->id)->count(),
        ]);
    }
}
