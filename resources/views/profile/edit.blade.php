<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('الملف الشخصي') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- نموذج موحد لجميع البيانات -->
            <div class="p-8 bg-white shadow rounded-lg">
            @if(session('success'))
    <div id="successMessage" class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg transition-opacity duration-1000 ease-in-out">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(function () {
            const msg = document.getElementById('successMessage');
            if (msg) {
                msg.style.opacity = '0';
                setTimeout(() => msg.style.display = 'none', 1000); // بعد إخفاء الشفافية اختفيه نهائيًا
            }
        }, 3000); // بعد 3 ثوانٍ
    </script>
@endif


                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- قسم الصورة الشخصية -->
                    <div class="flex flex-col md:flex-row gap-8 items-center mb-8">
                        <div class="flex-shrink-0 relative">
                            <img src="{{ Auth::user()->avatar
                                ? asset('images/profile_photos/' . Auth::user()->avatar)
                                : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                                class="w-32 h-32 rounded-full object-cover border-4 border-gray-200 shadow-md">
                        </div>
                        <div class="flex-grow">
                            <label class="block text-sm font-medium text-gray-700 mb-2">تغيير الصورة الشخصية</label>
                            <input type="file" name="profile_photo" class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-md file:border-0
                                file:text-sm file:font-semibold
                                file:bg-gray-50 file:text-gray-700
                                hover:file:bg-gray-100">
                        </div>
                    </div>

                    <!-- المعلومات الأساسية -->
                    <h3 class="text-xl font-semibold mb-6 text-gray-800 border-b pb-2">المعلومات الأساسية</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">الاسم الكامل</label>
                            <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                            <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    <!-- المعلومات المهنية -->
                    <h3 class="text-xl font-semibold mb-6 text-gray-800 border-b pb-2">المعلومات المهنية</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label for="bio" class="block text-sm font-medium text-gray-700">نبذة عنك</label>
                            <textarea id="bio" name="bio" rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('bio', Auth::user()->bio) }}</textarea>
                        </div>

                        <div>
                            <label for="specialization" class="block text-sm font-medium text-gray-700">التخصص</label>
                            <input type="text" id="specialization" name="specialization"
                                value="{{ old('specialization', Auth::user()->specialization) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="experience" class="block text-sm font-medium text-gray-700">سنوات الخبرة</label>
                            <input type="number" id="experience" name="experience"
                                value="{{ old('experience', Auth::user()->experience) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label for="whatsapp" class="block text-sm font-medium text-gray-700">واتساب</label>
                            <input type="text" id="whatsapp" name="whatsapp"
                                value="{{ old('whatsapp', Auth::user()->whatsapp) }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>
                    </div>

                    <!-- معلومات للعرض فقط -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">رقم العضوية</label>
                            <p class="mt-1 text-gray-900">{{ Auth::user()->id }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">تاريخ التسجيل</label>
                            <p class="mt-1 text-gray-900">{{ Auth::user()->created_at->format('Y/m/d') }}</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">حالة الحساب</label>
                            <p class="mt-1 text-gray-900">
                                {{ Auth::user()->email_verified_at ? 'مفعل' : 'غير مفعل' }}
                            </p>
                        </div>
                    </div>

                    <!-- زر الحفظ -->
                    <div class="flex justify-end">
                        <x-primary-button class="px-6 py-3">حفظ جميع التغييرات</x-primary-button>
                    </div>
                </form>
            </div>

            <!-- أقسام إضافية -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- تغيير كلمة المرور -->
                <div class="p-6 bg-white shadow rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- حذف الحساب -->
                <div class="p-6 bg-white shadow rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
