{{-- resources/views/admin/posts/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-gray-700">إضافة منشور جديد</h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 bg-white p-6 shadow rounded-lg">
                @csrf

                <div>
                    <label for="title" class="block font-medium">العنوان</label>
                    <input type="text" name="title" id="title" class="w-full rounded border-gray-300" required>
                </div>

                <div>
                    <label for="body" class="block font-medium">المحتوى</label>
                    <textarea name="body" id="body" rows="5" class="w-full rounded border-gray-300" required></textarea>
                </div>

                <div>
                    <label for="category_id" class="block font-medium">التصنيف</label>
                    <select name="category_id" id="category_id" class="w-full rounded border-gray-300">
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="is_question" class="block font-medium">هل هو سؤال؟</label>
                    <select name="is_question" id="is_question" class="w-full rounded border-gray-300">
                        <option value="0">لا</option>
                        <option value="1">نعم</option>
                    </select>
                </div>

                <div>
                    <label for="image" class="block font-medium">صورة</label>
                    <input type="file" name="image" id="image" class="w-full">
                </div>

                <div>
                    <label for="link" class="block font-medium">رابط خارجي (اختياري)</label>
                    <input type="url" name="link" id="link" class="w-full rounded border-gray-300">
                </div>

                <div>
                    <button type="submit" class="bg-beige-600 text-white px-4 py-2 rounded hover:bg-beige-700">حفظ</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
