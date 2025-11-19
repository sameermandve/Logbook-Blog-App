<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function commentPost(string $username, Post $post, Request $req)
    {
        $req->validate([
            "comment_content" => ["required", "string"],
        ]);

        $comment = Comment::create([
            "comment_content" => $req->input("comment_content"),
            "post_id" => $post->id,
            "user_id" => Auth::user()->id,
        ]);

        if (!$comment) {
            return redirect()
                ->back()
                ->with("error-comment", "Unable to post your comment.");
        }

        return redirect()
            ->back()
            ->with("success-comment", "Comment posted!");
    }

    public function commentDelete(string $username, Post $post, Comment $comment){

        $deleted = $comment->destroy($comment->id);

        if (!$deleted) {
            return redirect()->back()->with("error-comment", "Failed to delete the comment!");
        }

        return redirect()->back()->with("success-comment", "Comment deleted!");
    }
}
