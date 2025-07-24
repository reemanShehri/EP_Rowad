<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>

    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-md border border-beige-200 p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">تعديل المنشور</h1>

            <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- عنوان المنشور -->
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">العنوان</label>
                    <input type="text" name="title"
                           value="{{ old('title', $post->title) }}"
                           class="w-full px-4 py-3 border border-beige-300 rounded-lg focus:ring-2 focus:ring-beige-300">
                </div>

                <!-- محتوى المنشور -->
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">المحتوى</label>
                    <textarea name="body" rows="5"
                              class="w-full px-4 py-3 border border-beige-300 rounded-lg focus:ring-2 focus:ring-beige-300">{{ old('body', $post->body) }}</textarea>
                </div>

                <!-- صورة المنشور (إذا كنت تريد تعديلها) -->
                @if($post->image)
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">الصورة الحالية</label>
                    <img src="{{ asset($post->image) }}" class="max-h-48 rounded-lg mb-2">
                    <label class="flex items-center">
                        <input type="checkbox" name="remove_image" class="mr-2">
                        <span class="text-gray-700">حذف الصورة</span>
                    </label>
                </div>
                @endif

                <!-- رفع صورة جديدة -->
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">صورة جديدة (اختياري)</label>
                    <input type="file" name="image" class="border border-beige-300 rounded-lg p-2">
                </div>

                <!-- أزرار التحكم -->
                <div class="flex justify-end space-x-3 space-x-reverse mt-6">
                    <a href="{{ route('posts.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100">
                        إلغاء
                    </a>
                    <button type="submit" class="px-6 py-2 bg-beige-600 text-white rounded-lg hover:bg-beige-700">
                        حفظ التغييرات
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
