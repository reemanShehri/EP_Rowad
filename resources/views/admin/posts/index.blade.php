{{-- resources/views/admin/posts/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg font-semibold text-gray-700">كل المنشورات</h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('posts.create') }}" class="bg-beige-600 hover:bg-beige-700 text-white px-4 py-2 rounded mb-4 inline-block">إضافة منشور جديد</a>

            <div class="bg-white shadow rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-4 py-2">#</th>
                            <th class="px-4 py-2">العنوان</th>
                            <th class="px-4 py-2">المستخدم</th>
                            <th class="px-4 py-2">الحالة</th>
                            <th class="px-4 py-2">تاريخ الإنشاء</th>
                            <th class="px-4 py-2">التحكم</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($posts as $post)
                        <tr>
                            <td class="px-4 py-2">{{ $post->id }}</td>
                            <td class="px-4 py-2">{{ $post->title }}</td>
                            <td class="px-4 py-2">{{ $post->user->name ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $post->status }}</td>
                            <td class="px-4 py-2">{{ $post->created_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('posts.edit', $post->id) }}" class="text-blue-600 hover:underline">تعديل</a>
                                {{-- <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="inline-block" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">حذف</button>
                                </form> --}}

                                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="inline-block" onsubmit="return confirm('هل أنت متأكد من الحذف؟');">
    @csrf
    @method('DELETE')
    <button type="submit" class="text-red-600 hover:underline">حذف</button>
</form>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
