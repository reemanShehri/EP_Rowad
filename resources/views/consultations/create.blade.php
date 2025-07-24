<x-app-layout>


          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>


    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-semibold leading-tight text-beige-800">
                <i class="mr-2 fas fa-calendar-plus text-beige-600"></i> حجز استشارة جديدة
            </h2>
            <a href="{{ route('consultations.index') }}" class="flex items-center text-beige-600 hover:text-beige-800 transition-colors">
                <i class="fas fa-arrow-left ml-1"></i> العودة إلى القائمة
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-beige-50">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl rounded-lg border border-beige-200">
                <div class="p-8">
                    <form action="{{ route('consultations.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Consultant Selection -->
                        <div class="space-y-2">
                            <label for="consultant_id" class="block text-sm font-medium text-beige-700 flex items-center">
                                <i class="fas fa-user-tie ml-2"></i> المستشار
                            </label>
                            <div class="relative">
                                <select name="consultant_id" id="consultant_id" class="block w-full px-4 py-3 pr-10 border-beige-300 rounded-lg shadow-sm focus:ring-beige-500 focus:border-beige-500 text-beige-700 bg-beige-50 transition-all hover:bg-white">
                                    @foreach ($consultants as $consultant)
                                        <option value="{{ $consultant->id }}" class="bg-white">{{ $consultant->name }} - {{ $consultant->specialization }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="fas fa-chevron-down text-beige-400"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Topic -->
                        <div class="space-y-2">
                            <label for="topic" class="block text-sm font-medium text-beige-700 flex items-center">
                                <i class="fas fa-heading ml-2"></i> موضوع الاستشارة
                            </label>
                            <input type="text" name="topic" id="topic" required
                                class="block w-full px-4 py-3 border-beige-300 rounded-lg shadow-sm focus:ring-beige-500 focus:border-beige-500 text-beige-700 placeholder-beige-400 bg-beige-50 transition-all hover:bg-white"
                                placeholder="أدخل موضوع الاستشارة">
                        </div>

                        <!-- Description -->
                        <div class="space-y-2">
                            <label for="description" class="block text-sm font-medium text-beige-700 flex items-center">
                                <i class="fas fa-align-left ml-2"></i> التفاصيل
                            </label>
                            <textarea name="description" id="description" rows="4" required
                                class="block w-full px-4 py-3 border-beige-300 rounded-lg shadow-sm focus:ring-beige-500 focus:border-beige-500 text-beige-700 placeholder-beige-400 bg-beige-50 transition-all hover:bg-white"
                                placeholder="صف تفاصيل الاستشارة"></textarea>
                        </div>

                        <!-- Date and Time -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="scheduled_at" class="block text-sm font-medium text-beige-700 flex items-center">
                                    <i class="fas fa-calendar-day ml-2"></i> التاريخ والوقت
                                </label>
                                <input type="datetime-local" name="scheduled_at" id="scheduled_at" required
                                    class="block w-full px-4 py-3 border-beige-300 rounded-lg shadow-sm focus:ring-beige-500 focus:border-beige-500 text-beige-700 bg-beige-50 transition-all hover:bg-white">
                            </div>

                            <div class="space-y-2">
                                <label for="duration" class="block text-sm font-medium text-beige-700 flex items-center">
                                    <i class="fas fa-clock ml-2"></i> المدة (دقائق)
                                </label>
                                <input type="number" name="duration" id="duration" required min="15" step="15" value="30"
                                    class="block w-full px-4 py-3 border-beige-300 rounded-lg shadow-sm focus:ring-beige-500 focus:border-beige-500 text-beige-700 bg-beige-50 transition-all hover:bg-white">
                            </div>
                        </div>

                        <!-- Price and Payment -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="price" class="block text-sm font-medium text-beige-700 flex items-center">
                                    <i class="fas fa-money-bill-wave ml-2"></i> السعر ($)
                                </label>
                                <input type="number" name="price" id="price" required min="0" step="5"
                                    class="block w-full px-4 py-3 border-beige-300 rounded-lg shadow-sm focus:ring-beige-500 focus:border-beige-500 text-beige-700 bg-beige-50 transition-all hover:bg-white">
                            </div>

                            <div class="space-y-2">
                                <label for="payment_status" class="block text-sm font-medium text-beige-700 flex items-center">
                                    <i class="fas fa-credit-card ml-2"></i> حالة الدفع
                                </label>
                                <select name="payment_status" id="payment_status"
                                    class="block w-full px-4 py-3 pr-10 border-beige-300 rounded-lg shadow-sm focus:ring-beige-500 focus:border-beige-500 text-beige-700 bg-beige-50 transition-all hover:bg-white">
                                    <option value="unpaid">غير مدفوع</option>
                                    <option value="paid">مدفوع</option>
                                </select>
                            </div>
                        </div>

                        <!-- Meeting Link -->
                        <div class="space-y-2">
                            <label for="meeting_link" class="block text-sm font-medium text-beige-700 flex items-center">
                                <i class="fas fa-video ml-2"></i> رابط الاجتماع (اختياري)
                            </label>
                            <input type="url" name="meeting_link" id="meeting_link"
                                class="block w-full px-4 py-3 border-beige-300 rounded-lg shadow-sm focus:ring-beige-500 focus:border-beige-500 text-beige-700 placeholder-beige-400 bg-beige-50 transition-all hover:bg-white"
                                placeholder="https://meet.example.com/your-room">
                        </div>

                        <!-- Status -->
                        <div class="space-y-2">
                            <label for="status" class="block text-sm font-medium text-beige-700 flex items-center">
                                <i class="fas fa-info-circle ml-2"></i> الحالة
                            </label>
                            <select name="status" id="status"
                                class="block w-full px-4 py-3 pr-10 border-beige-300 rounded-lg shadow-sm focus:ring-beige-500 focus:border-beige-500 text-beige-700 bg-beige-50 transition-all hover:bg-white">
                                <option value="pending">معلق</option>
                                <option value="confirmed">مؤكد</option>
                                <option value="completed">مكتمل</option>
                                <option value="cancelled">ملغى</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit"
                                class="w-full flex justify-center items-center px-6 py-3 border border-transparent rounded-lg shadow-sm text-white bg-beige-600 hover:bg-beige-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-beige-500 transition-colors">
                                <i class="fas fa-save ml-2"></i> حفظ الاستشارة
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --beige-50: #faf8f5;
            --beige-100: #f0ece4;
            --beige-200: #e6dfd3;
            --beige-300: #d9cdb8;
            --beige-400: #c9b798;
            --beige-500: #b89f7a;
            --beige-600: #a78c65;
            --beige-700: #8c7350;
            --beige-800: #735e43;
            --beige-900: #5c4c36;
        }

        .bg-beige-50 { background-color: var(--beige-50); }
        .bg-beige-100 { background-color: var(--beige-100); }
        .bg-beige-200 { background-color: var(--beige-200); }
        .bg-beige-300 { background-color: var(--beige-300); }
        .bg-beige-400 { background-color: var(--beige-400); }
        .bg-beige-500 { background-color: var(--beige-500); }
        .bg-beige-600 { background-color: var(--beige-600); }
        .bg-beige-700 { background-color: var(--beige-700); }
        .bg-beige-800 { background-color: var(--beige-800); }
        .bg-beige-900 { background-color: var(--beige-900); }

        .text-beige-50 { color: var(--beige-50); }
        .text-beige-100 { color: var(--beige-100); }
        .text-beige-200 { color: var(--beige-200); }
        .text-beige-300 { color: var(--beige-300); }
        .text-beige-400 { color: var(--beige-400); }
        .text-beige-500 { color: var(--beige-500); }
        .text-beige-600 { color: var(--beige-600); }
        .text-beige-700 { color: var(--beige-700); }
        .text-beige-800 { color: var(--beige-800); }
        .text-beige-900 { color: var(--beige-900); }

        .border-beige-200 { border-color: var(--beige-200); }
        .focus:ring-beige-500:focus { --tw-ring-color: var(--beige-500); }
        .focus:border-beige-500:focus { border-color: var(--beige-500); }
    </style>
</x-app-layout>
