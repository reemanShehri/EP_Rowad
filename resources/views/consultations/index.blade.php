<x-app-layout>

          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            قائمة الاستشارات
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">ID</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">الموضوع</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">تاريخ الاستشارة</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">السعر</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">الحالة</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-600">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($consultations as $consultation)
                            <tr>
                                <td class="px-4 py-2">{{ $consultation->id }}</td>
                                <td class="px-4 py-2">{{ $consultation->topic }}</td>
                                <td class="px-4 py-2">{{ $consultation->scheduled_at }}</td>
                                <td class="px-4 py-2">{{ $consultation->price }}</td>
                                <td class="px-4 py-2">{{ $consultation->status }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('consultations.show', $consultation->id) }}" class="text-blue-600 hover:underline">عرض</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 py-2 text-center text-gray-500">لا توجد استشارات حالياً.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
