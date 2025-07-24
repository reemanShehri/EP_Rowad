<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //



    public function index()
{
    // ممكن تعرض كل التعليقات، أو تعليقات منشور معين مثلاً
    $comments = Comment::latest()->paginate(10);

    return view('comments.index', compact('comments'));
}


// app/Http/Controllers/CommentController.php
 public function store(Request $request)
{
    $request->validate([
        'content' => 'required|string|max:1000',
        'parent_id' => 'nullable|exists:comments,id',
        'post_id' => 'required|exists:posts,id',
    ]);

    Comment::create([
        'user_id' => auth()->id(),
        'body' => $request->content,
        'post_id' => $request->post_id,
        'parent_id' => $request->parent_id,
    ]);

    return back()->with('success', 'تم إضافة التعليق بنجاح');
}


}
