<?php
namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\SimpleMessage;
use App\Http\Controllers\Controller;

class DashboardAController extends Controller
{
    // public function adminIndex()
    // {
    //     $models = [
    //         ['name' => 'المستخدمين', 'route' => 'users', 'icon' => 'fas fa-users'],
    //         ['name' => 'الاستشاريين', 'route' => 'consultants', 'icon' => 'fas fa-user-tie'],
    //         ['name' => 'المنشورات', 'route' => 'posts', 'icon' => 'fas fa-pen'],
    //         ['name' => 'التعليقات', 'route' => 'comments', 'icon' => 'fas fa-comment'],
    //         ['name' => 'الأسئلة الشائعة', 'route' => 'faqs', 'icon' => 'fas fa-question-circle'],
    //         ['name' => 'الخدمات', 'route' => 'services', 'icon' => 'fas fa-cogs'],
    //         ['name' => 'التواصلات', 'route' => 'contacts', 'icon' => 'fas fa-envelope'],
    //         ['name' => 'الإعجابات', 'route' => 'likes', 'icon' => 'fas fa-heart'],
    //         ['name' => 'المحادثات', 'route' => 'chats', 'icon' => 'fas fa-comment-dots'],
    //         ['name' => 'شات الذكاء', 'route' => 'ai-chats', 'icon' => 'fas fa-robot'],
    //         ['name' => 'المحادثات البسيطة', 'route' => 'simple-chats', 'icon' => 'fas fa-comments'],
    //         ['name' => 'الفئات', 'route' => 'category', 'icon' => 'fas fa-layer-group'],
    //     ];

    //     return view('admin.dashboard', [
    //         'models' => $models,
    //         'usersCount' => User::count(),
    //         // 'consultantsCount' => Consultant::count(),
    //         'postsCount' => Post::count(),
    //         'commentsCount' => Comment::count(),
    //     ]);
    // }


    // AdminDashboardController.php
public function adminIndex()
{
    return view('admin.dashboard', [
        'counts' => [
            'users' => \App\Models\User::count(),
            'posts' => \App\Models\Post::count(),
            'comments' => \App\Models\Comment::count(),
            'services' => \App\Models\Service::count(),
            'likes' => \App\Models\Like::count(),
            'simple_chats' => SimpleMessage::count(),
            'categories' => \App\Models\Category::count(),
        ]
    ]);
}

}
