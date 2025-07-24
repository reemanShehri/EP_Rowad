<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{


    protected $fillable = [
    'user_id',
    'category_id',
    'title',
    'slug',
    'body',
    'is_question',
    'status',
    'image',
        'link',
];



    //

    public function user()
{
    return $this->belongsTo(User::class);
}

public function category()
{
    return $this->belongsTo(Category::class)->withDefault(); // لمنع المشاكل إذا كانت null
}

public function comments()
{
    return $this->hasMany(Comment::class);
}

public function likes()
{
    return $this->morphMany(Like::class, 'likeable');
}

public function tags()
{
    return $this->belongsToMany(Tag::class);
}
}
