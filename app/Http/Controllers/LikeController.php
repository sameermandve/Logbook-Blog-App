<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function toggle(string $username, Post $post)
    {
        if ($post->likedByUsers()->where("user_id", Auth::id())->exists()) {
            $post->likedByUsers()->detach(Auth::id());
            return response()->json([
                "isLiked" => false,
                "likes_count" => $post->likedByUsers()->count(),
            ]);
        }

        $post->likedByUsers()->attach(Auth::id());
        return response()->json([
            "isLiked" => true,
            "likes_count" => $post->likedByUsers()->count(),
        ]);
    }
}
