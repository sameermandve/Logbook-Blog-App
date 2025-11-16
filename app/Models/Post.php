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

    protected function publishedAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format("d M, Y"),
        );
    }

    public function author()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
