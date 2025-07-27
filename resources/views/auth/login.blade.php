<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تسجيل الدخول | منتدى روّاد</title>
    <meta name="description" content="منصة عربية لرواد الأعمال للحصول على استشارات في التسويق، التمويل والتقنية">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=tajawal:400,500,700" rel="stylesheet" />

    <link rel="icon" href="/images/im.png" type="image/png">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #F5F1E8;
            --secondary: #E8E0D1;
            --accent: #A38A67;
            --text: #3A3A3A;
            --light-text: #7A7A7A;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background-color: var(--primary);
            color: var(--text);
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
        }

        .btn-primary {
            background-color: var(--accent);
            color: white;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #8C735A;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .input-field {
            border: 1px solid var(--secondary);
            transition: all 0.3s ease;
        }

        .input-field:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 2px rgba(163, 138, 103, 0.2);
        }
    </style>
</head>
<body class="antialiased">
    <!-- شريط التنقل -->
    <nav class="bg-white/80 shadow-sm py-4 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-[var(--accent)]">
                        <i class="fas fa-lightbulb mr-2"></i> روّاد
                    </a>
                </div>

                <div class="flex items-center space-x-4 space-x-reverse">
                    <a href="{{ route('register') }}" class="text-[var(--accent)] hover:text-[#8C735A] transition">
                        ليس لديك حساب؟ <span class="font-semibold">سجل الآن</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- محتوى صفحة تسجيل الدخول -->
    <div class="min-h-screen flex items-center justify-center px-4 py-10 relative">
        <!-- خلفية الصفحة الرئيسية -->
        <div class="absolute inset-0 overflow-hidden z-0">
            <!-- محتوى الويلكم بيج -->
            <section class="relative bg-[var(--primary)] pt-16 pb-32 h-full">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
                    <div class="flex flex-col md:flex-row items-center h-full">
                        <div class="md:w-1/2 mb-12 md:mb-0">
                            <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
                                مجتمع <span class="text-[var(--accent)]">ريادي</span> لرواد الأعمال الطموحين
                            </h1>
                            <p class="text-xl text-[var(--light-text)] mb-8">
                                احصل على إجابات من خبراء في مجالات التسويق، التمويل والتقنية.
                            </p>
                        </div>
                        <div class="md:w-1/2">
                            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                                 alt="رواد الأعمال"
                                 class="rounded-lg shadow-xl w-full h-auto object-cover"
                                 style="max-height: 500px;">
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- نموذج تسجيل الدخول -->
        <div class="w-full max-w-md login-container rounded-xl shadow-xl p-8 space-y-6 border border-[var(--secondary)] relative z-10">
            <!-- عنوان النموذج -->
            <div class="text-center">
                <h2 class="text-3xl font-bold text-[var(--accent)]">مرحبًا بعودتك</h2>
                <p class="text-sm text-[var(--light-text)]">سجل الدخول للوصول إلى لوحة التحكم</p>
            </div>

            <!-- رسائل الجلسة -->
            @if(session('status'))
                <div class="mb-4 text-sm font-medium text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- البريد الإلكتروني -->
                <div>
                    <label for="email" class="block text-sm font-medium text-[var(--text)]">البريد الإلكتروني</label>
                    <input
                        id="email"
                        class="mt-1 block w-full rounded-lg input-field px-4 py-2 shadow-sm focus:ring-2 focus:ring-[var(--accent)]"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="username"
                        placeholder="example@email.com">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- كلمة المرور -->
                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-[var(--text)]">كلمة المرور</label>
                    <input
                        id="password"
                        class="mt-1 block w-full rounded-lg input-field px-4 py-2 shadow-sm focus:ring-2 focus:ring-[var(--accent)]"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- تذكرني -->
                <div class="flex items-center mt-4">
                    <input id="remember_me" type="checkbox"
                        class="h-4 w-4 text-[var(--accent)] border-gray-300 focus:ring-[var(--accent)] rounded"
                        name="remember">
                    <label for="remember_me" class="mr-2 text-sm text-[var(--text)]">
                        تذكرني
                    </label>
                </div>

                <!-- أزرار التنفيذ -->
                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-sm text-[var(--accent)] hover:underline font-semibold">
                            نسيت كلمة المرور؟
                        </a>
                    @endif

                    <button type="submit" class="btn-primary px-6 py-2 rounded-full text-sm font-medium">
                        تسجيل الدخول
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // يمكنك إضافة أي سكريبتات إضافية هنا
    </script>
</body>
</html>
