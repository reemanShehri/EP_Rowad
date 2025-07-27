<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">إدارة الخدمات</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('admin.services.create') }}" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded">إضافة خدمة</a>

            @if(session('success'))
                <div class="mb-4 text-green-600">{{ session('success') }}</div>
            @endif

            <div class="bg-white shadow rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-right">#</th>
                            <th class="px-4 py-2 text-right">العنوان</th>
                            <th class="px-4 py-2 text-right">الوصف</th>

                            <th class="px-4 py-2 text-right">تحكم</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($services as $service)
                            <tr>
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">{{ $service->title }}</td>

                                <td class="px-4 py-2">{{ $service->description }}</td>

                                <td class="px-4 py-2 flex gap-2">
                                    <a href="{{ route('admin.services.edit', $service->id) }}" class="text-blue-500">تعديل</a>
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500">حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="p-4">
                    {{ $services->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
