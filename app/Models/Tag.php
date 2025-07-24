<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    public function posts()
{
    return $this->belongsToMany(Post::class);
}
}
