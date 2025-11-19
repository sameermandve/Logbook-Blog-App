<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Post extends Model
{
    use HasFactory, Notifiable;

    protected $table = "posts";
    protected $fillable = [
        "title",
        "slug",
        "description",
        "cover_image",
        "cover_public_id",
        "user_id",
        "published_at",
    ];

    public function author()
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(
            User::class,
            "likes",
            "post_id",
            "user_id",
        )->withPivot("created_at");
    }

    public function commentedByUsers()
    {
        return $this->belongsToMany(
            User::class,
            "comments",
            "post_id",
            "user_id",
        );
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    protected function publishedAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format("M d, Y"),
        );
    }
}
