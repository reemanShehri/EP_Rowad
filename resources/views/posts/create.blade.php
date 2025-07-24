<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            إنشاء منشور جديد
        </h2>
    </x-slot>

    <div class="py-6 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-md rounded-lg p-6">

            {{-- عرض أخطاء التحقق --}}
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-100 border border-red-400 rounded text-red-700">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('posts.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="title" class="block font-medium text-gray-700 mb-1">العنوان</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title') }}"
                        required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="أدخل عنوان المنشور"
                    >
                </div>

                <div class="mb-6">
                    <label for="body" class="block font-medium text-gray-700 mb-1">محتوى المنشور</label>
                    <textarea
                        name="body"
                        id="body"
                        rows="6"
                        required
                        class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="أكتب محتوى المنشور هنا..."
                    >{{ old('body') }}</textarea>
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('posts.index') }}" class="mr-4 px-4 py-2 border border-gray-300 rounded hover:bg-gray-100 transition">
                        إلغاء
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition font-semibold">
                        نشر المنشور
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
