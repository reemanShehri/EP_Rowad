<x-app-layout>
    @section('title', 'خدمات موقع رواد')

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-beige-800 leading-tight">
            {{ __('خدمات موقع رواد') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-beige-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-beige-200 overflow-hidden shadow-sm rounded-lg mb-8">
                <div class="p-6 text-beige-800">
                    <div class="flex items-center justify-center space-x-4">
                        <svg class="w-12 h-12 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        <div>
                            <h1 class="text-3xl font-bold mb-2">خدمات موقع رواد</h1>
                            <p class="text-beige-700">اكتشف الخدمات المميزة التي نقدمها لريادي الأعمال والمستشارين</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Entrepreneur Services -->
            <div class="bg-white overflow-hidden shadow-sm rounded-lg mb-8">
                <div class="p-6 bg-white border-b border-beige-200">
                    <div class="text-center mb-8">
                        <div class="flex items-center justify-center space-x-2">
                            <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <h2 class="text-2xl font-semibold text-beige-800">خدمات ريادي الأعمال</h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($entrepreneurServices as $service)
                        <div class="service-card bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border border-beige-100">
                           <img src="{{ asset('images/im.png') }}" class="w-full h-48 object-cover" alt="{{ $service->title }}">
                            <div class="p-4">
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-amber-500 mt-1 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <div>
                                        <h3 class="text-xl font-bold mb-2 text-beige-800">{{ $service->title }}</h3>
                                        <p class="text-beige-600">{{ $service->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Consultant Services -->
            <div class="bg-beige-100 overflow-hidden shadow-sm rounded-lg mb-8">
                <div class="p-6 border-b border-beige-200">
                    <div class="text-center mb-8">
                        <div class="flex items-center justify-center space-x-2">
                            <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <h2 class="text-2xl font-semibold text-beige-800">خدمات المستشارين</h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($consultantServices as $service)
                        <div class="service-card bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border border-beige-100">
                            @if($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" class="w-full h-48 object-cover" alt="{{ $service->title }}">
                            @endif
                            <div class="p-4">
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-amber-500 mt-1 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <div>
                                        <h3 class="text-xl font-bold mb-2 text-beige-800">{{ $service->title }}</h3>
                                        <p class="text-beige-600">{{ $service->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- CTA Section -->
            <div class="bg-beige-200 overflow-hidden shadow-sm rounded-lg">
                <div class="p-6 text-beige-800 text-center">
                    <div class="flex items-center justify-center space-x-4 mb-4">
                        <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="text-2xl font-bold">هل أنت مستعد للاستفادة من خدماتنا؟</h3>
                    </div>
                    <a href="{{ route('contact.index') }}" class="inline-flex items-center bg-white text-beige-800 font-bold py-3 px-6 rounded-lg hover:bg-beige-100 transition duration-300 border border-beige-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        تواصل معنا
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
        .text-beige-600 { color: #8a8374; }
        .text-beige-700 { color: #6b654b; }
        .text-beige-800 { color: #4d4735; }

        .service-card {
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .service-card img {
            transition: transform 0.5s ease;
        }
        .service-card:hover img {
            transform: scale(1.05);
        }
    </style>
    @endpush
</x-app-layout>
