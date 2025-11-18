<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use function Pest\Laravel\session;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $user = Auth::user();

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

    public function show(string $username, Post $post)
    {
        $post = $post->load("author");

        return view("post.show", [
            "post" => $post,
        ]);
    }

    public function editPostForm(string $username, Post $post)
    {
        return view("post.edit", [
            "username" => $username,
            "post" => $post,
        ]);
    }

    public function editPost(string $username, Post $post, Request $req)
    {
        $req->validate([
            "title" => ["required", "string", "max:100"],
            "cover_image" => ["image", "max:10480", "mimes:jpeg,jpg,png,svg"],
            "description" => ["required", "string", "max:1000"],
        ]);

        $post = Post::where("slug", $post->slug)->first();

        if ($post) {
            $coverImageUrl = null;
            $coverImagePublicId = null;

            if ($req->hasFile("cover_image")) {
                try {
                    if ($post->cover_public_id) {
                        Cloudinary::uploadApi()
                            ->destroy($post->cover_public_id);
                    }

                    $resultUrl = Cloudinary::uploadApi()->upload(
                        $req->file("cover_image")->getRealPath(),
                        [
                            'folder' => 'logbook/post_cover_image',
                        ]
                    );

                    $coverImageUrl = $resultUrl["secure_url"];
                    $coverImagePublicId = $resultUrl["public_id"];
                    $post->cover_image = $coverImageUrl;
                    $post->cover_public_id = $coverImagePublicId;
                } catch (\Exception $e) {
                    return redirect()
                        ->back()
                        ->with("error-edit-post", "Image upload failed: " . $e->getMessage());
                }
            }

            $post->title = $req->input("title");
            $post->slug = Str::slug($req->input("title"));
            $post->description = $req->input("description");

            $post->save();

            return redirect()
                ->to(route("post.show", [Auth::user()->username, $post->slug]))
                ->with("success-edit-post", "Post updated successfully.")
                ->withHeaders([
                    'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
                    'Pragma' => 'no-cache',
                ]);;
        }

        return redirect()
            ->back()
            ->with("error-edit-post", "Post updation failed. Try again shortly!");
    }

    public function deletePost(string $username, Post $post)
    {
        $postToDelete = Post::where("slug", $post->slug)->first();

        if (!$postToDelete) {
            return redirect(route("home"))
                ->with("error-delete", "Post not found!");
        }

        if ($postToDelete->cover_public_id) {
            Cloudinary::uploadApi()->destroy($postToDelete->cover_public_id);
        }

        $deleteResult = Post::destroy($postToDelete->id);

        if ($deleteResult) {
            return redirect(route("home"))
                ->with("success-delete", "Your post has been deleted successfully.");
        }

        return redirect()
            ->back()
            ->with("error-delete", "Something went wrong while deleting the post!");
    }
}
