<?php


namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PostAController extends Controller
{
    // عرض كل المنشورات
    public function index()
    {
        $posts = Post::with(['user', 'category'])->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    // عرض فورم الإنشاء
    public function create()
    {
        $categories = Category::all();
        $users = User::all();
        return view('admin.posts.create', compact('categories', 'users'));
    }

    // حفظ منشور جديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'is_question' => 'nullable|boolean',
            'status' => 'nullable|in:active,inactive',
            'image' => 'nullable|image',
            'link' => 'nullable|url',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        Post::create($validated);
        return redirect()->route('admin.posts.index')->with('success', 'تم إنشاء المنشور بنجاح');
    }

    // عرض تفاصيل منشور
    // public function show(Post $post)
    // {
    //     return view('admin.posts.show', compact('post'));
    // }

    // عرض فورم التعديل
    public function edit(Post $post)
    {
        $categories = Category::all();
        $users = User::all();
        return view('admin.posts.edit', compact('post', 'categories', 'users'));
    }

    // تعديل منشور
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'is_question' => 'nullable|boolean',
            'status' => 'nullable|in:active,inactive',
            'image' => 'nullable|image',
            'link' => 'nullable|url',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($validated);
        return redirect()->route('admin.posts.index')->with('success', 'تم تعديل المنشور بنجاح');
    }

    // حذف منشور
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'تم حذف المنشور بنجاح');
    }
}
