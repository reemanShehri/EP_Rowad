<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">تعديل البوست</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">
                <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- العنوان -->
                    <div class="mb-4">
                        <label class="block mb-1 font-medium text-gray-700">العنوان</label>
                        <input type="text" name="title" value="{{ old('title', $post->title) }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <!-- التصنيف -->
                    <div class="mb-4">
                        <label class="block mb-1 font-medium text-gray-700">التصنيف</label>
                        <select name="category_id" class="w-full border rounded px-3 py-2">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- محتوى البوست -->
                    <div class="mb-4">
                        <label class="block mb-1 font-medium text-gray-700">المحتوى</label>
                        <textarea name="body" rows="6" class="w-full border rounded px-3 py-2">{{ old('body', $post->body) }}</textarea>
                    </div>

                    <!-- هل هو سؤال -->
                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="is_question" value="1" {{ $post->is_question ? 'checked' : '' }} class="mr-2">
                            هل هذا المنشور عبارة عن سؤال؟
                        </label>
                    </div>

                    <!-- الحالة -->
                    <div class="mb-4">
                        <label class="block mb-1 font-medium text-gray-700">الحالة</label>
                        <select name="status" class="w-full border rounded px-3 py-2">
                            <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>منشور</option>
                            <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>مسودة</option>
                        </select>
                    </div>

                    <!-- رابط -->
                    <div class="mb-4">
                        <label class="block mb-1 font-medium text-gray-700">رابط (اختياري)</label>
                        <input type="url" name="link" value="{{ old('link', $post->link) }}" class="w-full border rounded px-3 py-2">
                    </div>

                    <!-- صورة -->
                    <div class="mb-4">
                        <label class="block mb-1 font-medium text-gray-700">صورة (اختياري)</label>
                        <input type="file" name="image" class="w-full border rounded px-3 py-2">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" class="w-32 mt-2">
                        @endif
                    </div>

                    <!-- زر الحفظ -->
                    <div class="mt-6">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            حفظ التعديلات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
