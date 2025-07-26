<x-app-layout :bodyClass="'no-dark-bg'">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">المستشارون</h2>
    </x-slot>

    <div class="py-6 bg-beige-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- نموذج الفلترة -->
            <form method="GET" action="{{ route('consultants.index') }}" class="mb-8 bg-white p-4 rounded-lg shadow border border-beige-200">
                <label for="specialization" class="block mb-2 font-medium text-beige-800">اختر التخصص:</label>
                <div class="flex items-center gap-4">
                    <select name="specialization" id="specialization" class="border border-beige-300 rounded-lg p-2 w-full max-w-xs focus:ring-2 focus:ring-beige-500 focus:border-beige-500">
                        <option value="">الكل</option>
                        @foreach($specializations as $spec)
                            <option value="{{ $spec }}" {{ request('specialization') == $spec ? 'selected' : '' }}>
                                {{ $spec }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="px-6 py-2 bg-beige-600 text-white rounded-lg hover:bg-beige-700 transition duration-300 flex items-center gap-2">
                        <i class="fas fa-filter"></i> فلتر
                    </button>
                </div>
            </form>

       <!-- قائمة المستشارين -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($consultants as $consultant)
        <div class="bg-white p-6 rounded-xl shadow-md border border-beige-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
            <!-- رأس الكارد (الصورة + الاسم + التخصص) -->
            <div class="flex items-center gap-4 mb-5">
                <!-- صورة المستشار -->

                @php
        $avatar = $consultant->avatar
            ? asset('images/profile_photos/' . $consultant->avatar)
            : 'https://ui-avatars.com/api/?name=' . urlencode($consultant->name) . '&background=beige&color=fff&size=200';
    @endphp

<div class="relative flex items-center space-x-4 mb-4">
    <img src="{{ $avatar }}" alt="{{ $consultant->name }}" class="w-20 h-20 rounded-full object-cover border-2 border-gray-300">
    <div>
        <div class="font-bold text-lg">{{ $consultant->name }}</div>
        <div class="text-sm text-gray-500">{{ $consultant->specialization }}</div>
    </div>



                    <div class="absolute -bottom-1 -right-1 bg-beige-500 rounded-full p-1">
                        <i class="fas fa-check text-white text-xs"></i>
                    </div>
                </div>

                <!-- الاسم والتخصص -->
                {{-- <div>
                    <h3 class="font-bold text-lg text-gray-800 group-hover:text-beige-700 transition-colors duration-300">
                        {{ $consultant->name }}
                    </h3>
                    <span class="inline-flex items-center text-sm text-beige-600 bg-beige-50 px-3 py-1 rounded-full mt-1">
                        <i class="fas fa-briefcase mr-1 text-xs"></i>
                        {{ $consultant->specialization }}
                    </span>
                </div> --}}
            </div>

            <!-- معلومات المستشار -->
            <div class="space-y-3 mb-5">
                <!-- البايو -->
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-beige-400 mt-1 mr-2 text-sm"></i>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        {{ $consultant->bio ?? 'لا يوجد وصف شخصي متاح' }}
                    </p>
                </div>

                <!-- البريد الإلكتروني -->
                <div class="flex items-center text-sm text-gray-600 hover:text-beige-600 transition-colors">
                    <i class="far fa-envelope text-beige-400 mr-2"></i>
                    <a href="mailto:{{ $consultant->email }}" class="truncate">{{ $consultant->email }}</a>
                </div>

                <!-- الهاتف (إذا موجود) -->
                @if($consultant->phone)
                <div class="flex items-center text-sm text-gray-600 hover:text-beige-600 transition-colors">
                    <i class="fas fa-phone-alt text-beige-400 mr-2 transform rotate-90"></i>
                    <a href="tel:{{ $consultant->phone }}">{{ $consultant->phone }}</a>
                </div>
                @endif

                <!-- الموقع (إذا موجود) -->
                @if($consultant->location)
                <div class="flex items-center text-sm text-gray-600">
                    <i class="fas fa-map-marker-alt text-beige-400 mr-2"></i>
                    <span>{{ $consultant->location }}</span>
                </div>
                @endif
            </div>

            <!-- أزرار التواصل -->
            <div class="flex items-center justify-between border-t border-beige-100 pt-4">
                <!-- زر الواتساب -->
                <a href="https://wa.me/{{ $consultant->whatsapp }}" target="_blank"
                   class="flex-1 bg-green-50 text-green-700 hover:bg-green-100 px-3 py-2 rounded-lg flex items-center justify-center gap-2 transition-colors duration-300 mr-2">
                    <i class="fab fa-whatsapp text-lg"></i>
                    <span class="text-sm font-medium">واتساب</span>
                </a>

                <!-- زر الملف الشخصي -->
                {{-- <a href="{{ route('consultants.show', $consultant->id) }}"
                   class="flex-1 bg-beige-50 text-beige-700 hover:bg-beige-100 px-3 py-2 rounded-lg flex items-center justify-center gap-2 transition-colors duration-300">
                    <i class="far fa-user-circle text-lg"></i>
                    <span class="text-sm font-medium">الملف الشخصي</span>
                </a> --}}
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-12 bg-white rounded-xl shadow-sm border border-beige-100">
            <div class="inline-flex items-center justify-center bg-beige-50 rounded-full p-4 mb-4">
                <i class="fas fa-user-slash text-3xl text-beige-400"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-600 mb-2">لا يوجد مستشارون متاحون</h3>
            <p class="text-sm text-gray-500 mb-4">حاول تغيير فلتر البحث أو العودة لاحقاً</p>
            <a href="{{ route('consultants.index') }}"
               class="inline-flex items-center px-5 py-2 bg-beige-600 text-white rounded-lg hover:bg-beige-700 transition-colors duration-300">
                <i class="fas fa-redo mr-2"></i> عرض الكل
            </a>
        </div>
    @endforelse
</div>

            <!-- ترقيم الصفحات -->
            @if($consultants->hasPages())
            <div class="mt-8 bg-white p-4 rounded-lg border border-beige-200">
                {{ $consultants->links() }}
            </div>
            @endif
        </div>
    </div>

    <style>
        .bg-beige-50 { background-color: #f8f4ee; }
        .bg-beige-100 { background-color: #f0e6d6; }
        .bg-beige-200 { background-color: #e5d5bc; }
        .bg-beige-300 { background-color: #d9c4a3; }
        .bg-beige-600 { background-color: #a78a6e; }
        .bg-beige-700 { background-color: #8a725b; }
        .bg-beige-900 { background-color: #4a3c2c; }

        .text-beige-500 { color: #c0a78a; }
        .text-beige-600 { color: #a78a6e; }
        .text-beige-700 { color: #8a725b; }
        .text-beige-800 { color: #6d5a48; }
        .text-beige-900 { color: #4a3c2c; }
    </style>
</x-app-layout>
