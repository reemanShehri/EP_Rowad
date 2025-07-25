<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AIChatController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\Admin\Consultant2Controller;
use App\Http\Controllers\FaqController;  // تأكد أنك تستورد هذا ال Controller

Route::get('/', function () {
    return view('welcome');
});

// صفحة الداشبورد مع middleware التحقق من الدخول
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // البروفايل
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // روتات الاستشارات (resource route يغطي كل دوال CRUD)
    Route::resource('consultations', ConsultationController::class);

    // صفحة المستشارين مع فلترة
    Route::get('/consultants', [Consultant2Controller::class, 'index'])->name('consultants.index');

    // صفحة الأسئلة الشائعة
    Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');

  Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
// Route::get('/contact', [ContactController::class, 'index'])->name('contact');

    Route::resource('posts', PostController::class);

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

    // المنشورات
   Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

    // الدردشة الذكية
    Route::get('/chat', [AIChatController::class, 'index'])->name('ai-chat.index');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
    ->name('posts.comments.store');


  Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
  Route::post('/like', [LikeController::class, 'store'])->name('like');

    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');








    // روتات الادمن داخل المجموعة مع بادئة admin
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users');



    });
});

require __DIR__.'/auth.php';
