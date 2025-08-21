<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6">
        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
            <h1 class="text-3xl font-bold text-gray-800">قائمة المستخدمين</h1>

            <!-- User Type Filter -->
            {{-- <form method="GET" class="flex items-center">
                <select name="user_type" onchange="this.form.submit()"
                        class="border border-gray-300 rounded-lg p-2 pr-8 bg-white text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">كل الأنواع</option>
                    <option value="admin" {{ request('user_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="consultant" {{ request('user_type') == 'consultant' ? 'selected' : '' }}>Consultant</option>
                    <option value="entrepreneur" {{ request('user_type') == 'entrepreneur' ? 'selected' : '' }}>Entrepreneur</option>
                </select>
            </form> --}}
        </div>

        <!-- Users Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach ($users as $user)
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <!-- User Image with Fallback -->
                    <div class="h-48 bg-gray-100 flex items-center justify-center overflow-hidden">
                        @php
                            $avatar = $user->avatar
                                ? asset('images/profile_photos/' . $user->avatar)
                                : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=beige&color=fff&size=200';
                        @endphp
                        <img src="{{ $avatar }}"
                             alt="{{ $user->name }}"
                             class="w-full h-full object-cover"
                             onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&color=fff&size=200'">
                    </div>

                    <!-- User Info -->
                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                                <p class="text-blue-600 text-sm mt-1">{{ $user->email }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $user->user_type == 'admin' ? 'bg-purple-100 text-purple-800' :
                                   ($user->user_type == 'consultant' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ $user->user_type }}
                            </span>
                        </div>

                        <!-- User Details -->
                        <div class="mt-4 space-y-2">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-briefcase mr-2 text-blue-500"></i>
                                <span>{{ $user->specialization ?? 'غير محدد' }}</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-star mr-2 text-yellow-500"></i>
                                <span>{{ $user->experience ?? 'غير محدد' }} خبرة</span>
                            </div>
                            @if($user->whatsapp)
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fab fa-whatsapp mr-2 text-green-500"></i>
                                <a href="https://wa.me/{{ $user->whatsapp }}"
                                   target="_blank"
                                   class="hover:text-green-600 transition-colors">
                                    {{ $user->whatsapp }}
                                </a>
                            </div>
                            @endif
                            <div class="text-sm text-gray-600 mt-3 line-clamp-2">
                                <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                                {{ $user->bio ?? 'لا يوجد وصف' }}
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="mt-5 flex justify-between items-center">
                            <a href="{{ route('users.show', $user->id) }}"
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-eye mr-2"></i>
                                عرض الملف
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8 px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Add some custom styling -->
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .pagination {
            display: flex;
            justify-content: center;
        }
        .pagination li {
            margin: 0 4px;
        }
        .pagination li a,
        .pagination li span {
            padding: 8px 16px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            color: #4a5568;
        }
        .pagination li.active span {
            background-color: #4299e1;
            color: white;
            border-color: #4299e1;
        }
        .pagination li a:hover {
            background-color: #ebf8ff;
        }
    </style>
</x-app-layout>
