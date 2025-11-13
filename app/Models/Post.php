<?php

namespace App\Models;

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

    public function user(){
        return $this->belongsTo(User::class);
    }
}
