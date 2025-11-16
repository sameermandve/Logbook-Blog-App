<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $posts = $user->posts()
            ->with("author")
            ->latest()
            ->simplePaginate(5);

        return view("home", [
            "posts" => $posts,
        ]);
    }

    public function create()
    {
        return view("post.create");
    }

    public function createPost(Request $req)
    {
        $req->validate([
            "title" => ["required", "string", "max:100"],
            "cover_image" => ["required", "image", "max:10480", "mimes:jpeg,jpg,png,svg"],
            "description" => ["required", "string", "max:1000"],
        ]);

        $coverImageUrl = null;
        $coverImagePublicId = null;

        try {
            if ($req->hasFile("cover_image")) {
                $resultUrl = Cloudinary::uploadApi()->upload(
                    $req->file("cover_image")->getRealPath(),
                    [
                        'folder' => 'logbook/post_cover_image',
                    ]
                );

                $coverImageUrl = $resultUrl["secure_url"];
                $coverImagePublicId = $resultUrl["public_id"];
            }
        } catch (\Exception $e) {
            return redirect(route("post.form"))
                ->with("error-post", "Post creation failed: " . $e->getMessage());
        }

        $post = Post::create([
            "title" => $req->input("title"),
            "slug" => Str::slug($req->input("title")),
            "description" => $req->input("description"),
            "cover_image" => $coverImageUrl,
            "cover_public_id" => $coverImagePublicId,
            "published_at" => now(),
            "user_id" => Auth::id(),
        ]);

        if (!$post) {
            return redirect(route("post.form"))
                ->with("error-post", "❌ Post creation failed. Please try again shortly.");
        }

        return redirect(route("post.form"))
            ->with("success-post", "✅ Post has been created successfully.");
    }

    public function show(Post $post)
    {
        $post = $post->load("author");

        return view("post.show", [
            "post" => $post,
        ]);
    }
}
