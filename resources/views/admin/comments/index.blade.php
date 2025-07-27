<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            التعليقات
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <table class="min-w-full border-collapse block md:table">
                        <thead class="block md:table-header-group">
                            <tr class="border border-gray-300 md:border-none block md:table-row">
                                <th class="p-2 text-right font-bold md:border md:border-gray-300 block md:table-cell">رقم التعليق</th>
                                <th class="p-2 text-right font-bold md:border md:border-gray-300 block md:table-cell">المستخدم</th>
                                <th class="p-2 text-right font-bold md:border md:border-gray-300 block md:table-cell">المحتوى</th>
                                <th class="p-2 text-right font-bold md:border md:border-gray-300 block md:table-cell">تاريخ التعليق</th>
                                <th class="p-2 text-right font-bold md:border md:border-gray-300 block md:table-cell">إجراءات</th>
                            </tr>
                        </thead>
                        <tbody class="block md:table-row-group">
                            @forelse ($comments as $comment)
                                <tr class="bg-gray-100 dark:bg-gray-700 border border-gray-300 md:border-none block md:table-row">
                                    <td class="p-2 md:border md:border-gray-300 block md:table-cell">{{ $comment->id }}</td>
                                    <td class="p-2 md:border md:border-gray-300 block md:table-cell">{{ $comment->user->name ?? 'مستخدم مجهول' }}</td>
                                    <td class="p-2 md:border md:border-gray-300 block md:table-cell">{{ \Illuminate\Support\Str::limit($comment->body, 50) }}</td>
                                    <td class="p-2 md:border md:border-gray-300 block md:table-cell">{{ $comment->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="p-2 md:border md:border-gray-300 block md:table-cell">
                                        <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف التعليق؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                                حذف
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-2 text-center">لا توجد تعليقات.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $comments->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
