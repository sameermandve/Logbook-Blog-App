<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Like extends Model
{
    use HasFactory, Notifiable;

    protected const UPDATED_AT = null;

    protected $fillable = [
        "post_id",
        "user_id",
    ];
}
