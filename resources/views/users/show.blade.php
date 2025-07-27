<x-app-layout>
    <div class="max-w-4xl mx-auto p-4 sm:p-6">
        <!-- Profile Header -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <!-- Cover Photo - Beige and white gradient -->
            <div class="relative">
                <div class="h-48 bg-gradient-to-r from-beige-100 to-white"></div>

                <!-- Profile Picture and Basic Info -->
                <div class="flex flex-col md:flex-row items-start md:items-end px-6 -mt-16">
                    <!-- Avatar -->
                    <div class="relative">
                        @php
                            $avatar = $user->avatar
                                ? asset('images/profile_photos/' . $user->avatar)
                                : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=beige&color=6b7280&size=200';
                        @endphp
                        <img src="{{ $avatar }}"
                             alt="{{ $user->name }}"
                             class="w-32 h-32 rounded-full border-4 border-white object-cover shadow-lg"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ substr($user->name, 0, 1) }}&background=beige&color=6b7280&size=200'">
                        <!-- Online status indicator -->
                        <div class="absolute bottom-2 right-2 w-4 h-4 bg-green-500 rounded-full border-2 border-white"></div>
                    </div>

                    <!-- User Info -->
                    <div class="md:ml-6 mt-4 md:mt-0 flex-1">
                        <div class="flex flex-col md:flex-row md:items-center justify-between">
                            <div>
                                <h1 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h1>
                                <p class="text-gray-600 mt-1">{{ $user->specialization ?? 'لا يوجد تخصص' }}</p>
                            </div>


                        </div>

                        <!-- User Type Badge -->
                        <span class="inline-block mt-2 px-3 py-1 rounded-full text-sm font-semibold
                            {{ $user->user_type == 'admin' ? 'bg-purple-100 text-purple-800' :
                               ($user->user_type == 'consultant' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800') }}">
                            {{ $user->user_type }}
                        </span>

                        <!-- Social/Contact Info -->
                        <div class="flex flex-wrap items-center mt-4 gap-3">
                            @if($user->whatsapp)
                            <a href="https://wa.me/{{ $user->whatsapp }}" target="_blank"
                               class="flex items-center text-green-600 hover:text-green-800 bg-green-50 px-3 py-1 rounded-lg">
                                <i class="fab fa-whatsapp text-lg mr-2"></i>
                                <span>واتساب</span>
                            </a>
                            @endif

                            @if($user->phone)
                            <a href="tel:{{ $user->phone }}"
                               class="flex items-center text-blue-600 hover:text-blue-800 bg-blue-50 px-3 py-1 rounded-lg">
                                <i class="fas fa-phone text-lg mr-2"></i>
                                <span>اتصال</span>
                            </a>
                            @endif

                            @if($user->email)
                            <a href="mailto:{{ $user->email }}"
                               class="flex items-center text-gray-600 hover:text-gray-800 bg-gray-50 px-3 py-1 rounded-lg">
                                <i class="fas fa-envelope text-lg mr-2"></i>
                                <span>بريد</span>
                            </a>
                            @endif

                            <!-- Social Media Links -->
                            @if($user->twitter)
                            <a href="{{ $user->twitter }}" target="_blank"
                               class="flex items-center text-blue-400 hover:text-blue-600 bg-blue-50 px-3 py-1 rounded-lg">
                                <i class="fab fa-twitter text-lg mr-2"></i>
                                <span>تويتر</span>
                            </a>
                            @endif

                            @if($user->linkedin)
                            <a href="{{ $user->linkedin }}" target="_blank"
                               class="flex items-center text-blue-700 hover:text-blue-900 bg-blue-50 px-3 py-1 rounded-lg">
                                <i class="fab fa-linkedin text-lg mr-2"></i>
                                <span>لينكدإن</span>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="p-6">
                <!-- Stats Bar -->


                <!-- About Section -->
                <div class="mb-8">
                    <h2 class="text-xl font-bold text-gray-800 border-b pb-2 mb-4 flex items-center">
                        <i class="fas fa-user-circle text-beige-500 mr-2"></i>
                        معلومات عني
                    </h2>
                    <p class="text-gray-700 leading-relaxed bg-beige-50 p-4 rounded-lg">
                        {{ $user->bio ?? 'لا يوجد وصف شخصي' }}
                    </p>
                </div>

                <!-- Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Experience -->
                    <div class="bg-white border border-gray-100 p-4 rounded-lg shadow-sm">
                        <div class="flex items-center mb-2">
                            <div class="bg-beige-100 p-2 rounded-full mr-3">
                                <i class="fas fa-briefcase text-beige-600 text-lg"></i>
                            </div>
                            <h3 class="font-semibold text-gray-800">الخبرة</h3>
                        </div>
                        <p class="text-gray-700 pl-11">{{ $user->experience ?? 'غير محدد' }}</p>
                    </div>

                    <!-- Education -->
                    <div class="bg-white border border-gray-100 p-4 rounded-lg shadow-sm">
                        <div class="flex items-center mb-2">
                            <div class="bg-beige-100 p-2 rounded-full mr-3">
                                <i class="fas fa-graduation-cap text-beige-600 text-lg"></i>
                            </div>
                            <h3 class="font-semibold text-gray-800">التعليم</h3>
                        </div>
                        <p class="text-gray-700 pl-11">{{ $user->education ?? $user->specialization ?? 'غير محدد' }}</p>
                    </div>

                    <!-- Location -->
                    <div class="bg-white border border-gray-100 p-4 rounded-lg shadow-sm">
                        <div class="flex items-center mb-2">
                            <div class="bg-beige-100 p-2 rounded-full mr-3">
                                <i class="fas fa-map-marker-alt text-beige-600 text-lg"></i>
                            </div>
                            <h3 class="font-semibold text-gray-800">الموقع</h3>
                        </div>
                        <p class="text-gray-700 pl-11">{{ $user->location ?? 'غير محدد' }}</p>
                    </div>

                    <!-- Join Date -->
                    <div class="bg-white border border-gray-100 p-4 rounded-lg shadow-sm">
                        <div class="flex items-center mb-2">
                            <div class="bg-beige-100 p-2 rounded-full mr-3">
                                <i class="fas fa-calendar-alt text-beige-600 text-lg"></i>
                            </div>
                            <h3 class="font-semibold text-gray-800">تاريخ الانضمام</h3>
                        </div>
                        <p class="text-gray-700 pl-11">{{ $user->created_at->format('Y/m/d') }}</p>
                    </div>
                </div>

                <!-- Skills Section -->


                <!-- Call to Action -->
                <div class="flex flex-col sm:flex-row justify-center gap-4 mt-8">
                    @if($user->whatsapp)
                    <a href="https://wa.me/{{ $user->whatsapp }}" target="_blank"
                       class="flex items-center justify-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors shadow-md">
                        <i class="fab fa-whatsapp text-xl mr-2"></i>
                        تواصل عبر واتساب
                    </a>
                    @endif

                    @if($user->phone)
                    <a href="tel:{{ $user->phone }}"
                       class="flex items-center justify-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-md">
                        <i class="fas fa-phone text-xl mr-2"></i>
                        اتصل الآن
                    </a>
                    @endif

                
                </div>
            </div>
        </div>
    </div>

    <style>
        .bg-beige-100 {
            background-color: #f5f5dc;
        }
        .bg-beige-50 {
            background-color: #fafaf5;
        }
        .bg-beige-500 {
            background-color: #d2b48c;
        }
        .bg-beige-600 {
            background-color: #c2a47c;
        }
        .text-beige-500 {
            color: #d2b48c;
        }
        .text-beige-600 {
            color: #c2a47c;
        }
        .text-beige-800 {
            color: #8b7355;
        }
        .border-beige-500 {
            border-color: #d2b48c;
        }
        .skill-tag {
            transition: all 0.3s ease;
        }
        .skill-tag:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #e6d8b5;
        }
    </style>
</x-app-layout>
