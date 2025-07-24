<section class="max-w-4xl mx-auto p-8 bg-white rounded-2xl shadow-lg border border-gray-200">
    {{-- العنوان --}}
    <header class="mb-8 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">الملف الشخصي</h2>
    </header>

    {{-- نموذج موحد لجميع البيانات --}}
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        {{-- صورة المستخدم --}}
        <div class="flex items-center gap-6 mb-8">
            <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-gray-300 bg-gray-100">
                <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}"
                     class="w-full h-full object-cover" alt="صورة المستخدم">
            </div>
            <div>
                <x-input-label for="avatar" value="تغيير الصورة" />
                <input type="file" id="avatar" name="avatar" accept="image/*"
                    class="block mt-1 w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:border-0 file:rounded-lg file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
            </div>
        </div>

        {{-- البيانات الأساسية --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <x-input-label for="name" value="الاسم الكامل" />
                <x-text-input id="name" name="name" value="{{ old('name', $user->name) }}" required />
            </div>

            <div>
                <x-input-label for="email" value="البريد الإلكتروني" />
                <x-text-input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required />
            </div>

            <div>
                <x-input-label for="whatsapp" value="واتساب" />
                <x-text-input id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $user->whatsapp) }}" />
            </div>

            <div>
                <x-input-label for="specialization" value="التخصص" />
                <x-text-input id="specialization" name="specialization" value="{{ old('specialization', $user->specialization) }}" />
            </div>

            <div>
                <x-input-label for="experience" value="سنوات الخبرة" />
                <x-text-input id="experience" name="experience" type="number" value="{{ old('experience', $user->experience) }}" />
            </div>

            <div>
                <x-input-label for="user_type" value="نوع المستخدم" />
                <x-text-input id="user_type" name="user_type" value="{{ old('user_type', $user->user_type) }}" readonly />
            </div>
        </div>

        {{-- النبذة الشخصية --}}
        <div class="mt-6">
            <x-input-label for="bio" value="النبذة الشخصية" />
            <textarea id="bio" name="bio" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('bio', $user->bio) }}</textarea>
        </div>

        {{-- زر الحفظ --}}
        <div class="flex justify-end mt-8">
            <x-primary-button>حفظ التغييرات</x-primary-button>
        </div>
    </form>
</section>
