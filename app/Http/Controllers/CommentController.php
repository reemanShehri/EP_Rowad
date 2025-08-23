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

// CommentController.php
public function edit(Comment $comment)
{
    // تأكد أن المستخدم صاحب التعليق أو صاحب البوست
    if(auth()->id() !== $comment->user_id && auth()->id() !== $comment->post->user_id) {
        abort(403);
    }

    return view('comments.edit', compact('comment'));
}

public function update(Request $request, Comment $comment)
{
    if(auth()->id() !== $comment->user_id) {
        return response()->json(['error' => 'غير مسموح'], 403);
    }

    $request->validate(['content' => 'required|string|max:1000']);

    $comment->update(['body' => $request->content]);

    return response()->json(['body' => $comment->body]);
}


   public function destroy(Comment $comment)
    {
        // تأكد أن صاحب التعليق أو صاحب البوست فقط يستطيع الحذف
        if(auth()->id() !== $comment->user_id && auth()->id() !== $comment->post->user_id) {
            abort(403, 'غير مسموح');
        }

        $comment->delete();

        // لو كان الطلب AJAX
        if(request()->ajax()) {
            return response()->json(['success' => true]);
        }

        // إذا كان Submit عادي
        return back()->with('success', 'تم حذف التعليق بنجاح');
    }


}
