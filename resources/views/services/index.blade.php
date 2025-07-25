<x-app-layout>
    @section('title', 'خدمات موقع رواد')

  <header class="bg-transparent" style="background-color: rgb(254, 247, 234)">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-beige-800 leading-tight" >
            {{ __('خدمات موقع رواد') }}
        </h2>
    </x-slot>
</header>



    <div class="py-12 bg-beige-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-beige-200 overflow-hidden shadow-sm rounded-lg mb-8">
                <div class="p-8 text-center">
                    <h1 class="text-3xl font-bold mb-3 text-beige-800">خدمات موقع رواد</h1>
                    <p class="text-beige-700 text-lg">اكتشف الخدمات المميزة التي نقدمها لريادي الأعمال والمستشارين</p>
                    <div class="mt-4">
                        <svg class="w-12 h-12 mx-auto text-amber-500 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Entrepreneur Services -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-8 relative group">
                <div class="p-6 bg-white border-b border-beige-200">
                    <div class="text-center mb-8">
                        <div class="flex items-center justify-center space-x-2">
                            <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <h2 class="text-2xl font-semibold text-beige-800">خدمات ريادي الأعمال</h2>
                        </div>
                    </div>

                    <div class="relative">
                        <button class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-3 shadow-lg hover:bg-amber-50 transition-all duration-300 opacity-0 group-hover:opacity-100 ml-2 entrepreneur-prev" onclick="scrollServices('entrepreneur', -1)">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>

                        <div id="entrepreneurServices" class="overflow-x-auto pb-6 scrollbar-hide">
                            <div class="flex space-x-6 px-4" style="width: max-content; min-width: 100%;">
                                @foreach($entrepreneurServices as $service)
                                <div class="flex-shrink-0" style="width: 350px;">
                                    <div class="service-card bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-2 border border-beige-100 h-full">
                                        <div class="overflow-hidden h-48">
                           <img src="{{ asset('images/im.png') }}" class="w-full h-48 object-cover" alt="{{ $service->title }}">
                                        </div>
                                        <div class="p-5">
                                            <div class="flex items-start">
                                                <svg class="w-6 h-6 text-amber-500 mt-1 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                <div>
                                                    <h3 class="text-xl font-bold mb-2 text-beige-800">{{ $service->title }}</h3>
                                                    <p class="text-beige-600 line-clamp-3">{{ $service->description }}</p>
                                                </div>
                                            </div>
                                            <div class="mt-4 flex justify-end">
                                                {{-- <a href="#" class="text-amber-600 hover:text-amber-800 font-medium flex items-center">
                                                    التفاصيل
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <button class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-3 shadow-lg hover:bg-amber-50 transition-all duration-300 opacity-0 group-hover:opacity-100 mr-2 entrepreneur-next" onclick="scrollServices('entrepreneur', 1)">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Consultant Services -->
            <div class="bg-beige-100 overflow-hidden shadow-sm rounded-lg mb-8 relative group">
                <div class="p-6 border-b border-beige-200">
                    <div class="text-center mb-8">
                        <div class="flex items-center justify-center space-x-2">
                            <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <h2 class="text-2xl font-semibold text-beige-800">خدمات المستشارين</h2>
                        </div>
                    </div>

                    <div class="relative">
                        <button class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-3 shadow-lg hover:bg-amber-50 transition-all duration-300 opacity-0 group-hover:opacity-100 ml-2 consultant-prev" onclick="scrollServices('consultant', -1)">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>

                        <div id="consultantServices" class="overflow-x-auto pb-6 scrollbar-hide">
                            <div class="flex space-x-6 px-4" style="width: max-content; min-width: 100%;">
                                @foreach($consultantServices as $service)
                                <div class="flex-shrink-0" style="width: 350px;">
                                    <div class="service-card bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-2 border border-beige-100 h-full">
                                        <div class="overflow-hidden h-48">
                           <img src="{{ asset('images/im.png') }}" class="w-full h-48 object-cover" alt="{{ $service->title }}">
                                        </div>
                                        <div class="p-5">
                                            <div class="flex items-start">
                                                <svg class="w-6 h-6 text-amber-500 mt-1 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                <div>
                                                    <h3 class="text-xl font-bold mb-2 text-beige-800">{{ $service->title }}</h3>
                                                    <p class="text-beige-600 line-clamp-3">{{ $service->description }}</p>
                                                </div>
                                            </div>
                                            <div class="mt-4 flex justify-end">
                                                {{-- <a href="#" class="text-amber-600 hover:text-amber-800 font-medium flex items-center">
                                                    التفاصيل
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <button class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-3 shadow-lg hover:bg-amber-50 transition-all duration-300 opacity-0 group-hover:opacity-100 mr-2 consultant-next" onclick="scrollServices('consultant', 1)">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="bg-beige-200 overflow-hidden shadow-sm rounded-lg">
                <div class="p-8 text-center">
                    <h3 class="text-2xl font-bold mb-6 text-beige-800">هل أنت مستعد للاستفادة من خدماتنا؟</h3>
                    <a href="{{ route('contact.index') }}" class="inline-flex items-center bg-white text-beige-800 font-bold py-3 px-8 rounded-lg hover:bg-amber-50 transition duration-300 border border-beige-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        تواصل معنا الآن
                    </a>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .bg-beige-50 { background-color: #faf9f6; }
        .bg-beige-100 { background-color: #f5f3ee; }
        .bg-beige-200 { background-color: #e8e4d9; }
        .border-beige-100 { border-color: #f5f3ee; }
        .border-beige-200 { border-color: #e8e4d9; }
        .border-beige-300 { border-color: #d7d1bf; }
        .text-beige-600 { color: #8a8374; }
        .text-beige-700 { color: #6b654b; }
        .text-beige-800 { color: #4d4735; }

        .service-card {
            border-radius: 0.75rem;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        function scrollServices(type, direction) {
            const container = document.getElementById(`${type}Services`);
            const scrollAmount = container.offsetWidth * 0.8;
            container.scrollBy({
                left: direction * scrollAmount,
                behavior: 'smooth'
            });
        }

        // إظهار/إخفاء الأزرار حسب موضع التمرير
        document.addEventListener('DOMContentLoaded', function() {
            setupScrollButtons('entrepreneur');
            setupScrollButtons('consultant');
        });

        function setupScrollButtons(type) {
            const container = document.getElementById(`${type}Services`);
            const prevBtn = document.querySelector(`.${type}-prev`);
            const nextBtn = document.querySelector(`.${type}-next`);

            container.addEventListener('scroll', function() {
                // زر السابق
                if (container.scrollLeft > 0) {
                    prevBtn.classList.remove('opacity-0', 'cursor-default');
                    prevBtn.classList.add('opacity-100', 'cursor-pointer');
                } else {
                    prevBtn.classList.add('opacity-0', 'cursor-default');
                    prevBtn.classList.remove('opacity-100', 'cursor-pointer');
                }

                // زر التالي
                if (container.scrollLeft < (container.scrollWidth - container.offsetWidth - 1)) {
                    nextBtn.classList.remove('opacity-0', 'cursor-default');
                    nextBtn.classList.add('opacity-100', 'cursor-pointer');
                } else {
                    nextBtn.classList.add('opacity-0', 'cursor-default');
                    nextBtn.classList.remove('opacity-100', 'cursor-pointer');
                }
            });
        }
    </script>
    @endpush
</x-app-layout>
