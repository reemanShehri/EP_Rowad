<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Consultation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('dashboard', [
            // إحصائيات المنشورات والتعليقات
            'postsCount' => Post::where('user_id', $user->id)->count(),
            'commentsCount' => Comment::where('user_id', $user->id)->count(),

            // استشارات المستخدم القادمة
            'upcomingConsultations' => Consultation::where('user_id', $user->id)
                                                    ->where('scheduled_at', '>', now())
                                                    ->count(),

            // عدد المستشارين المتاحين (المستخدمون الذين لديهم دور مستشار)
            'consultantsCount' => User::where('user_type', 'consultant')->count(),

            // ✅ عدد رواد الأعمال
            'entrepreneursCount' => User::where('user_type', 'entrepreneur')->count(),

            // الاستشارات القادمة للمستخدم مع العلاقات
            'recentConsultations' => Consultation::with('consultant')
                                                  ->where('user_id', $user->id)
                                                  ->where('scheduled_at', '>', now())
                                                  ->orderBy('scheduled_at', 'asc')
                                                  ->limit(5)
                                                  ->get(),

            // المستشارون المتاحون (يمكن إضافة شروط إضافية مثل التوفر)
            'availableConsultants' => User::where('user_type', 'consultant')
                                           ->limit(5)
                                           ->get(),

            // أحدث المنشورات (يمكن تخصيصها حسب احتياجاتك)
            'latestPosts' => Post::with(['user', 'category'])
                                 ->latest()
                                 ->limit(3)
                                 ->get(),
        ]);
    }
}
