<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{

    use AuthorizesRequests;
    //
// public function index()
// {

//     $posts = Post::withCount(['likes', 'comments'])->latest()->paginate(10);

//     // تجيب كل المنشورات مرتبة حسب الأحدث
//     // $posts = Post::latest()->paginate(10); // او كلها لو بتحب

//     return view('posts.index', compact('posts'));
// }


public function index()
{
    $posts = Post::with(['user'])->withCount(['likes', 'comments'])->latest()->paginate(10);

    return view('posts.index', compact('posts'));
}


 public function create()
    {
        return view('posts.create');
    }






// public function store(Request $request)
// {
//     $request->validate([
//         'title' => 'nullable|string|max:255',
//         'body' => 'required|string',
//         'category_id' => 'nullable|exists:categories,id',
//         'is_question' => 'nullable|boolean',
//         'image' => 'nullable|image|max:2048',
//         'link' => 'nullable|url',
//     ]);

//     $post = Post::create([
//         'user_id' => auth()->id(),
//         'category_id' => $request->category_id,
//         'title' => $request->title ?? null,  // العنوان اختياري
//         'slug' => $request->title ? Str::slug($request->title) . '-' . uniqid() : null,
//         'body' => $request->body,
//         'is_question' => $request->is_question ?? false,
//         'link' => $request->link,
//     ]);

//     if ($request->hasFile('image')) {
//         $path = $request->file('image')->store('posts', 'public');
//         // تحديث المسار في السجل بعد الرفع
//         $post->update(['image' => $path]);
//     }

//     return redirect()->back()->with('success', 'تم نشر المنشور بنجاح.');
// }

public function store(Request $request)
{
    $request->validate([
        'title' => 'nullable|string|max:255',
        'body' => 'required|string',
        'category_id' => 'nullable|exists:categories,id',
        'is_question' => 'nullable|boolean',
        'image' => 'nullable|image|max:2048',
        'link' => 'nullable|url',
    ]);

    $post = Post::create([
        'user_id' => auth()->id(),
        'category_id' => $request->category_id,
        'title' => $request->title ?? null,
        'slug' => $request->title ? Str::slug($request->title) . '-' . uniqid() : null,
        'body' => $request->body,
        'is_question' => $request->is_question ?? false,
        'link' => $request->link,
    ]);

    if ($request->hasFile('image')) {
        // تخزين الصورة في المجلد public/images/posts
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/posts'), $imageName);

        // حفظ اسم الصورة فقط في قاعدة البيانات
        $post->update(['image' => 'images/posts/'.$imageName]);
    }

    return redirect()->back()->with('success', 'تم نشر المنشور بنجاح.');
}


public function update(Request $request, Post $post)
{
    // التحقق من أن المستخدم الحالي هو صاحب المنشور
    if (auth()->id() !== $post->user_id) {
        abort(403, 'غير مصرح لك بتعديل هذا المنشور');
    }

    // التحقق من صحة البيانات
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'remove_image' => 'nullable'
    ]);

    // معالجة إزالة الصورة
    if ($request->has('remove_image')) {
        // حذف الصورة القديمة من السيرفر
        if ($post->image && file_exists(public_path($post->image))) {
            unlink(public_path($post->image));
        }
        $data['image'] = null;
    }

    // معالجة رفع صورة جديدة
    if ($request->hasFile('image')) {
        // حذف الصورة القديمة أولاً إذا وجدت
        if ($post->image && file_exists(public_path($post->image))) {
            unlink(public_path($post->image));
        }

        // تخزين الصورة الجديدة في public/images/posts
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images/posts'), $imageName);

        // حفظ المسار النسبي للصورة
        $data['image'] = 'images/posts/'.$imageName;
    }

    // تحديث بيانات المنشور
    $post->update($data);

    return redirect()->route('posts.index')->with('success', 'تم تحديث المنشور بنجاح');
}

public function destroy(Post $post)
{
    if ($post->user_id !== auth()->id()) {
        abort(403);
    }

    $post->delete();

    return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
}




public function likedUsers(Post $post)
{
    $users = $post->likes()->with('user')->get()->map(fn($like) => [
        'id' => $like->user->id,
        'name' => $like->user->name,
    ]);

    return response()->json(['users' => $users]);
}




public function edit(Post $post)
{

    return view('posts.edit', compact('post'));

}




// public function like(Post $post)
// {
//     $user = auth()->user();

//     $like = $post->likes()->where('user_id', $user->id)->first();

//     if ($like) {
//         $like->delete();
//         $status = 'unliked';
//     } else {
//         $post->likes()->create(['user_id' => $user->id]);
//         $status = 'liked';
//     }

//     return response()->json([
//         'status' => $status,
//         'likes_count' => $post->likes()->count(),
//     ]);
// }


public function like(Post $post)
{
    $user = auth()->user();

    $like = $post->likes()->where('user_id', $user->id)->first();

    if ($like) {
        $like->delete();
        $status = 'unliked';
    } else {
        $post->likes()->create(['user_id' => $user->id]);
        $status = 'liked';
    }

    // return response()->json([
    //     'status' => $status,
    //     'likes_count' => $post->likes()->count(),
    // ]);

       return back();
}



}
