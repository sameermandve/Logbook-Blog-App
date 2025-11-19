<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'email',
        'avatar',
        'bio',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function following()
    {
        return $this->belongsToMany(
            User::class,
            "followers",
            "follower_id",
            "user_id",
        );
    }

    public function followers()
    {
        return $this->belongsToMany(
            User::class,
            "followers",
            "user_id",
            "follower_id",
        );
    }

    public function isFollowedBy(User $user)
    {
        return $user->following()->where("user_id", $this->id)->exists();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function hasLiked(Post $post)
    {
        return $post->likedByUsers()->where("user_id", $this->id)->exists();
    }

    public function likedPosts()
    {
        return $this->belongsToMany(
            Post::class,
            "likes",
            "user_id",
            "post_id",
        )->withPivot("created_at");
    }

    public function commentedPosts()
    {
        return $this->belongsToMany(
            Post::class,
            "comments",
            "user_id",
            "post_id",
        )->withPivotValue("created_at");
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
