<x-app-layout>


         <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

         <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>

    <!-- زر فتح/إغلاق السايد بار -->
   <button id="sidebarToggle" class="fixed right-4 top-4 z-20 p-2 bg-white rounded-lg shadow-md text-gray-600 hover:bg-beige-100 transition-colors">
        <i class="fas fa-bars"></i>
    </button>

    <!-- شريط التنقل الجانبي -->
    <div id="sidebar" class="fixed inset-y-0 right-0 w-64 bg-white shadow-lg z-10 transform transition-transform duration-300 ease-in-out translate-x-0">
        <div class="flex flex-col h-full">
            <!-- رأس الشريط الجانبي -->
            <div class="p-4 border-b border-beige-200 bg-beige-50">
                <h2 class="text-xl font-semibold text-beige-800">نظام الاستشارات</h2>
            </div>

            <!-- معلومات المستخدم -->
            <div class="p-4 border-b border-beige-200 flex items-center space-x-3 space-x-reverse bg-white">
  <div class="relative mb-3">
                @php
                    $user = auth()->user();
                    $avatar = $user->avatar
                        ? asset('images/profile_photos/' . Auth::user()->avatar)
                        : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=7F9CF5&color=123001';
                @endphp
                <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-beige-300 bg-beige-100">
                    <img src="{{ $avatar }}"
                         class="w-full h-full object-cover"
                         alt="صورة المستخدم">
                </div>
                <!-- مؤشر حالة الاتصال -->
                <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></span>
            </div>                <div>
                    <p class="font-medium text-gray-800">{{ auth()->user()->name }}</p>
                    <p class="text-sm text-beige-600">{{ auth()->user()->role == 'consultant' ? 'مستشار' : 'رائد أعمال' }}</p>
                </div>
                   <div class="p-2 text-red-600">
{{ auth()->user()->role }}
    </div>
            </div>

            <!-- قائمة التنقل -->
          <nav class="flex-1 p-4 space-y-2 overflow-y-auto bg-white">
    <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-beige-100 text-beige-800' : 'text-gray-600 hover:bg-beige-50' }}">
        <i class="fas fa-home ml-3 text-beige-600"></i>
        <span>الرئيسية</span>
    </a>

    <a href="{{ route('consultants.index') }}" class="flex items-center p-3 rounded-lg transition-colors {{ request()->routeIs('consultants.*') ? 'bg-beige-100 text-beige-800' : 'text-gray-600 hover:bg-beige-50' }}">
        <i class="fas fa-user-tie ml-3 text-beige-600"></i>
        <span>المستشارون</span>
    </a>



    <a href="{{ route('users.index') }}" class="flex items-center p-3 rounded-lg transition-colors {{ request()->routeIs('users.*') ? 'bg-beige-100 text-beige-800' : 'text-gray-600 hover:bg-beige-50' }}">
    <i class="fas fa-users ml-3 text-beige-600"></i>
    <span>المستخدمون</span>
</a>


    <a href="{{ route('posts.index') }}" class="flex items-center p-3 rounded-lg transition-colors {{ request()->routeIs('posts.*') ? 'bg-beige-100 text-beige-800' : 'text-gray-600 hover:bg-beige-50' }}">
        <i class="fas fa-bullhorn ml-3 text-beige-600"></i>
        <span>المنشورات</span>
    </a>

    <a href="{{ route('ai-chat.index') }}" class="flex items-center p-3 rounded-lg transition-colors {{ request()->routeIs('ai-chat.*') ? 'bg-beige-100 text-beige-800' : 'text-gray-600 hover:bg-beige-50' }}">
        <i class="fas fa-brain ml-3 text-beige-600"></i>
        <span>الدردشة الذكية</span>
    </a>

    <a href="{{ route('contact.index') }}" class="flex items-center p-3 rounded-lg transition-colors {{ request()->routeIs('contact.*') ? 'bg-beige-100 text-beige-800' : 'text-gray-600 hover:bg-beige-50' }}">
        <i class="fas fa-envelope-open-text ml-3 text-beige-600"></i>
        <span>التواصل</span>
    </a>

    <a href="{{ route('services.index') }}" class="flex items-center p-3 rounded-lg transition-colors {{ request()->routeIs('services.*') ? 'bg-beige-100 text-beige-800' : 'text-gray-600 hover:bg-beige-50' }}">
        <i class="fas fa-concierge-bell ml-3 text-beige-600"></i>
        <span>الخدمات</span>
    </a>

    <a href="{{ route('simple-chat.index') }}" class="flex items-center p-3 rounded-lg transition-colors {{ request()->routeIs('simple-chat.*') ? 'bg-beige-100 text-beige-800' : 'text-gray-600 hover:bg-beige-50' }}">
        <i class="fas fa-comments ml-3 text-beige-600"></i>
        <span>الدردشة الجماعية</span>

    </a>


     @auth

{{ auth()->user()->role }}

@if(strtolower(auth()->user()->role) === 'admin')
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center p-3 rounded-lg transition-colors
           {{ request()->routeIs('admin.*') ? 'bg-beige-100 text-beige-800' : 'text-gray-600 hover:bg-beige-50' }}">
            <i class="fas fa-user-shield ml-3 text-beige-600"></i>
            <span>لوحة تحكم الأدمن</span>
        </a>
    @endif
@endauth

</nav>


            <!-- تسجيل الخروج -->
            <div class="p-4 border-t border-beige-200 bg-white">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full p-3 text-gray-600 hover:text-red-600 rounded-lg transition-colors hover:bg-beige-50">
                        <i class="fas fa-sign-out-alt ml-3"></i>
                        <span>تسجيل الخروج</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- المحتوى الرئيسي -->
    <div class="mr-0 transition-all duration-300 ease-in-out" id="mainContent">
        <div class="p-8">
            <!-- شريط العنوان -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800">  ...روَاد </h1>
                <p class="text-gray-600">مرحباً بك، {{ auth()->user()->name }}</p>
            </div>

            <!-- بطاقات الإحصاءات -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-beige-200 hover:shadow-md transition-all">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-50 text-blue-600 mr-4">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">عدد المستشارين</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ $consultantsCount }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-beige-200 hover:shadow-md transition-all">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-50 text-green-600 mr-4">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">منشوراتي</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ $postsCount }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-beige-200 hover:shadow-md transition-all">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-50 text-purple-600 mr-4">
                            <i class="fas fa-comments"></i>
                        </div>
                       <div>
                            <p class="text-sm text-gray-500">عدد رواد الاعمال</p>
                            <p class="text-2xl font-semibold text-gray-800">{{ $entrepreneursCount  }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- قسم إنشاء منشور سريع -->
  {{-- <form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <input type="text" name="title" class="w-full border mb-2 p-2 rounded" placeholder="عنوان المنشور">

    <textarea name="body"
              class="w-full border border-beige-300 rounded-lg p-3 focus:ring-2 focus:ring-beige-300 focus:border-beige-300 transition-all"
              placeholder="ماذا تريد أن تشارك اليوم؟" rows="3"></textarea>

    <div class="mt-3 flex justify-end">
        <button type="submit" class="bg-beige-600 hover:bg-beige-700 text-white px-6 py-2 rounded-lg transition-colors flex items-center">
            <i class="fas fa-paper-plane ml-2"></i> نشر
        </button>
    </div>
</form> --}}

<!-- قسم إنشاء منشور سريع -->
<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-6 mb-6">
    @csrf

    <!-- عنوان المنشور -->
    <div class="mb-4">
        <input type="text" name="title"
               class="w-full px-4 py-3 border border-beige-300 rounded-lg focus:ring-2 focus:ring-beige-300 focus:border-transparent text-lg"
               placeholder="عنوان المنشور" required>
    </div>

    <!-- محتوى المنشور -->
    <div class="mb-4">
        <textarea name="body" rows="5"
                  class="w-full px-4 py-3 border border-beige-300 rounded-lg focus:ring-2 focus:ring-beige-300 focus:border-transparent"
                  placeholder="ماذا تريد أن تشارك اليوم؟" required></textarea>
    </div>

    <!-- رفع صورة -->
    <div class="mb-4">
        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-beige-300 border-dashed rounded-lg cursor-pointer bg-beige-50 hover:bg-beige-100 transition">
            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <i class="fas fa-camera text-beige-600 text-2xl mb-2"></i>
                <p class="text-sm text-gray-500">اضغط لرفع صورة أو اسحبها هنا</p>
                <p class="text-xs text-gray-400">(اختياري)</p>
            </div>
            <input id="post-image" name="image" type="file" class="hidden" accept="image/*">
        </label>
        <div id="image-preview" class="mt-3 hidden">
            <img id="preview-image" class="max-h-48 rounded-lg shadow-sm">
            <button type="button" id="remove-image" class="text-red-500 hover:text-red-700 mt-2 text-sm">
                <i class="fas fa-times mr-1"></i> إزالة الصورة
            </button>
        </div>
    </div>

    <!-- رابط خارجي -->
    <div class="mb-4">
        <input type="url" name="link"
               class="w-full px-4 py-2 border border-beige-300 rounded-lg focus:ring-2 focus:ring-beige-300 focus:border-transparent"
               placeholder="أضف رابطًا خارجيًا (اختياري)">
    </div>

    <!-- خيارات إضافية -->
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center space-x-3 space-x-reverse">
            <!-- هل هو سؤال؟ -->


            <!-- الفئة -->
            {{-- <select name="category_id"
                    class="text-sm border border-beige-300 rounded-lg px-3 py-1 focus:ring-2 focus:ring-beige-300">
                <option value="">اختر فئة</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select> --}}
        </div>

        <!-- حالة المنشور -->
        {{-- <select name="status"
                class="text-sm border border-beige-300 rounded-lg px-3 py-1 focus:ring-2 focus:ring-beige-300">
            <option value="published" selected>منشور</option>
            <option value="draft">مسودة</option>
        </select> --}}
    </div>

    <!-- زر النشر -->
    <div class="flex justify-end">
        <button type="submit"
                class="bg-beige-600 hover:bg-beige-700 text-white px-6 py-2 rounded-lg transition-colors flex items-center">
            <i class="fas fa-paper-plane ml-2"></i> نشر
        </button>
    </div>
</form>

@push('scripts')
<script>
    // عرض معاينة الصورة عند اختيارها
    document.getElementById('post-image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('preview-image');
                preview.src = e.target.result;
                document.getElementById('image-preview').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    });

    // إزالة الصورة المختارة
    document.getElementById('remove-image').addEventListener('click', function() {
        document.getElementById('post-image').value = '';
        document.getElementById('image-preview').classList.add('hidden');
    });
</script>
@endpush


        <!-- أحدث المنشورات -->
{{-- <div class="bg-white p-6 rounded-xl shadow-sm border border-beige-200 mb-8">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-medium flex items-center text-gray-800">
            <i class="fas fa-newspaper text-blue-500 ml-2"></i>
            أحدث المنشورات
        </h3>
        <a href="{{ route('posts.index') }}" class="text-sm text-beige-600 hover:text-beige-800 transition-colors">
            عرض الكل <i class="fas fa-chevron-left mr-1"></i>
        </a>
    </div>

    <div class="space-y-4">
        @foreach($latestPosts as $post)
        <div class="p-4 border border-beige-200 rounded-lg hover:bg-beige-50 transition-colors">
            <div class="flex flex-col md:flex-row items-start gap-4">

                {{-- صورة المستخدم --}}
                    {{-- @php
                        $user = $post->user;
                        $avatar = $user->avatar
                            ? asset('storage/' . $user->avatar)
                            : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=7F9CF5&color=fff';
                    @endphp
                    <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-beige-300 bg-beige-100">
                        <img src="{{ $avatar }}" alt="صورة المستخدم" class="w-full h-full object-cover">
                    </div>

                <div class="flex-1">
                    <div class="flex items-center justify-between mb-1">
                        <h4 class="font-semibold text-gray-800">{{ $post->title }}</h4>
                        <span class="text-xs text-beige-600">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-gray-700 text-sm">{{ \Illuminate\Support\Str::limit($post->body, 100) }}</p>

                    <div class="mt-2 flex space-x-4 space-x-reverse text-sm">
                        <a href="#" class="text-gray-500 hover:text-red-500 transition-colors">
                            <i class="far fa-heart ml-1"></i> إعجاب
                        </a>
                        <a href="#" class="text-gray-500 hover:text-beige-600 transition-colors">
                            <i class="far fa-comment ml-1"></i> تعليق
                        </a>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
</div> --}}



<!-- أحدث المنشورات -->
<div class="bg-white p-6 rounded-xl shadow-sm border border-beige-200 mb-8">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-medium flex items-center text-gray-800">
            <i class="fas fa-newspaper text-blue-500 ml-2"></i>
            أحدث المنشورات
        </h3>
        <a href="{{ route('posts.index') }}" class="text-sm text-beige-600 hover:text-beige-800 transition-colors">
            عرض الكل <i class="fas fa-chevron-left mr-1"></i>
        </a>
    </div>

    <div class="space-y-4">
        @foreach($latestPosts as $post)
        <div class="p-4 border border-beige-200 rounded-lg hover:bg-beige-50 transition-colors">
            <div class="flex flex-col md:flex-row items-start gap-4">
                <!-- صورة المستخدم -->
                @php
                    $user = $post->user;
                    $avatar = $user->avatar
                        ? asset('images/profile_photos/' . Auth::user()->avatar)
                        : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=a38a5f&color=fff';
                @endphp
              <div class="w-16 h-16 rounded-full overflow-hidden border-2 border-beige-300 bg-beige-100">
    <img src="{{ $post->user->avatar ? asset('images/profile_photos/' . $post->user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($post->user->name) }}" alt="صورة المستخدم" class="w-full h-full object-cover">
</div>


                <div class="flex-1">
                    <div class="flex items-center justify-between mb-1">
                        <h4 class="font-semibold text-gray-800">{{ $post->title }}</h4>
                        <span class="text-xs text-beige-600">{{ $post->created_at->diffForHumans() }}</span>
                    </div>

                    <!-- محتوى المنشور -->
                    <p class="text-gray-700 text-sm mb-2">{{ \Illuminate\Support\Str::limit($post->body, 100) }}</p>

                    <!-- صورة المنشور المصغرة -->
                <!-- صورة المنشور المصغرة -->
@if($post->image)
<div class="mb-2 w-1/4">
    <img src="{{ asset($post->image) }}" alt="صورة المنشور" class="w-full h-40 object-cover rounded-md mx-auto">
</div>
@endif


                    <!-- رابط خارجي -->
                    @if($post->link)
                    <div class="mb-2">
                        <a href="{{ $post->link }}" target="_blank" class="text-xs text-beige-600 hover:text-beige-800 truncate block">
                            <i class="fas fa-link ml-1"></i> {{ $post->link }}
                        </a>
                    </div>
                    @endif

                    <!-- معلومات إضافية -->
                    <div class="flex flex-wrap gap-2 mt-2">
                        @if($post->is_question)
                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">
                            <i class="fas fa-question-circle mr-1"></i> سؤال
                        </span>
                        @endif

                        @if($post->category)
                        <span class="bg-beige-100 text-beige-800 text-xs px-2 py-1 rounded">
                            {{ $post->category->name }}
                        </span>
                        @endif
                    </div>

                    <!-- تفاعلات المنشور -->
                    <div class="flex space-x-4 space-x-reverse text-sm mt-3">
                        {{-- <button class="text-gray-500 hover:text-red-500 transition-colors">
                            <i class="far fa-heart ml-1"></i> إعجاب
                        </button>

                        <button class="text-gray-500 hover:text-beige-900 transition-colors">
                            <i class="far fa-comment ml-1"></i> تعليق
                        </button> --}}

                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

            <!-- الأسئلة الشائعة -->
         <div class="bg-white p-6 rounded-xl shadow-sm border border-beige-200">
    <h3 class="text-lg font-medium mb-4 flex items-center text-gray-800">
        <i class="fas fa-question-circle text-purple-500 ml-2"></i>
        الأسئلة الشائعة
    </h3>

    <div class="space-y-3">
        <!-- سؤال 1 -->
        <div class="border border-beige-200 rounded-lg overflow-hidden transition-all">
            <details class="group">
                <summary class="flex justify-between items-center p-4 cursor-pointer list-none bg-beige-50 hover:bg-beige-100 transition-colors">
                    <span class="font-medium text-gray-800">كيف يمكنني إنشاء حساب جديد؟</span>
                    <i class="fas fa-chevron-down text-beige-600 group-open:rotate-180 transform transition"></i>
                </summary>
                <div class="p-4 bg-white border-t border-beige-200 text-gray-700">
                    يمكنك إنشاء حساب من خلال صفحة التسجيل بإدخال بريدك الإلكتروني وكلمة المرور، ثم تفعيل الحساب عبر الرابط المرسل إلى بريدك.
                </div>
            </details>
        </div>

        <!-- سؤال 2 -->
        <div class="border border-beige-200 rounded-lg overflow-hidden transition-all">
            <details class="group">
                <summary class="flex justify-between items-center p-4 cursor-pointer list-none bg-beige-50 hover:bg-beige-100 transition-colors">
                    <span class="font-medium text-gray-800">كيف أشارك منشورًا أو سؤالًا؟</span>
                    <i class="fas fa-chevron-down text-beige-600 group-open:rotate-180 transform transition"></i>
                </summary>
                <div class="p-4 bg-white border-t border-beige-200 text-gray-700">
                    من صفحة المنتدى أو لوحة النقاش، يمكنك الضغط على "إضافة منشور" وكتابة السؤال أو المعلومة التي تريد مشاركتها.
                </div>
            </details>
        </div>

        <!-- سؤال 3 -->


        <!-- سؤال 4 -->
        <div class="border border-beige-200 rounded-lg overflow-hidden transition-all">
            <details class="group">
                <summary class="flex justify-between items-center p-4 cursor-pointer list-none bg-beige-50 hover:bg-beige-100 transition-colors">
                    <span class="font-medium text-gray-800">هل يمكنني التواصل مع مستشار جامعي؟</span>
                    <i class="fas fa-chevron-down text-beige-600 group-open:rotate-180 transform transition"></i>
                </summary>
                <div class="p-4 bg-white border-t border-beige-200 text-gray-700">
                    نعم، يمكنك الدخول إلى صفحة المستشارين واختيار مستشارك المناسب للتواصل أو حجز موعد.
                </div>
            </details>
        </div>
    </div>
</div>

        </div>
    </div>

    <!-- JavaScript للتحكم في السايد بار -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebarToggle');
            const mainContent = document.getElementById('mainContent');

            // التحقق من حالة السايد بار في localStorage
            const isSidebarOpen = localStorage.getItem('sidebarOpen') !== 'false';

            // تعيين الحالة الأولية
            if (!isSidebarOpen) {
                sidebar.classList.add('translate-x-full');
                mainContent.classList.remove('mr-64');
                mainContent.classList.add('mr-0');
            }

            // حدث النقر على زر التبديل
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('translate-x-full');

                if (sidebar.classList.contains('translate-x-full')) {
                    mainContent.classList.remove('mr-64');
                    mainContent.classList.add('mr-0');
                    localStorage.setItem('sidebarOpen', 'false');
                } else {
                    mainContent.classList.remove('mr-0');
                    mainContent.classList.add('mr-64');
                    localStorage.setItem('sidebarOpen', 'true');
                }
            });

            // تعديل الهوامش عند تغيير حجم الشاشة
            window.addEventListener('resize', function() {
                if (window.innerWidth < 768) {
                    sidebar.classList.add('translate-x-full');
                    mainContent.classList.remove('mr-64');
                    mainContent.classList.add('mr-0');
                } else if (localStorage.getItem('sidebarOpen') !== 'false') {
                    sidebar.classList.remove('translate-x-full');
                    mainContent.classList.remove('mr-0');
                    mainContent.classList.add('mr-64');
                }
            });
        });
    </script>

    <!-- التنسيقات الإضافية -->
    <style>
        :root {
            --beige-50: #faf9f7;
            --beige-100: #f5f2ee;
            --beige-200: #eae5dd;
            --beige-300: #ddd6c9;
            --beige-400: #cfc3b1;
            --beige-500: #b8a58e;
            --beige-600: #a38d73;
            --beige-700: #89745d;
            --beige-800: #6f5f4e;
            --beige-900: #5b4f42;
            --beige-950: #302a23;
        }

        .bg-beige-50 { background-color: var(--beige-50); }
        .bg-beige-100 { background-color: var(--beige-100); }
        .bg-beige-200 { background-color: var(--beige-200); }
        .bg-beige-600 { background-color: var(--beige-600); }
        .bg-beige-700 { background-color: var(--beige-700); }

        .border-beige-200 { border-color: var(--beige-200); }
        .border-beige-300 { border-color: var(--beige-300); }

        .text-beige-600 { color: var(--beige-600); }
        .text-beige-700 { color: var(--beige-700); }
        .text-beige-800 { color: var(--beige-800); }

        .hover\:bg-beige-50:hover { background-color: var(--beige-50); }
        .hover\:bg-beige-100:hover { background-color: var(--beige-100); }

        .focus\:ring-beige-300:focus { --tw-ring-color: var(--beige-300); }
        .focus\:border-beige-300:focus { border-color: var(--beige-300); }
    </style>

</x-app-layout>
