<?php

namespace App\Models\Post;

use Database\Factories\PostResponseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostResponse extends Model
{
    use HasFactory, SoftDeletes;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    protected static function newFactory()
    {
        return PostResponseFactory::new();
    }
}
