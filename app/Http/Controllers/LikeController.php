<?php

namespace App\Http\Controllers;
use App\Models\Like;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //
public function store(Request $request)
{
    $likeableType = $request->type; // 'post' أو 'comment'
    $likeableId = $request->id;

    $model = $likeableType === 'post' ? Post::class : Comment::class;

    $likeable = $model::findOrFail($likeableId);

    $like = $likeable->likes()->where('user_id', auth()->id())->first();

    if ($like) {
        $like->delete(); // إزالة اللايك
    } else {
        $likeable->likes()->create(['user_id' => auth()->id()]);
    }

    return back();
}

}
