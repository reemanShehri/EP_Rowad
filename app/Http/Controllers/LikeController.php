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



public function toggleLike(Post $post)
{
    $user = auth()->user();

    $like = $post->likes()->where('user_id', $user->id)->first();

    if ($like) {
        $like->delete();
        $isLiked = false;
    } else {
        $post->likes()->create(['user_id' => $user->id]);
        $isLiked = true;
    }

    return response()->json([
        'success' => true,
        'isLiked' => $isLiked,
        'likesCount' => $post->likes()->count(),
        'likedUsers' => $post->likes()->with('user:id,name')->get()->pluck('user')
    ]);
}

}
