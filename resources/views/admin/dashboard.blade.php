<x-app-layout dir="rtl">
    <div class="min-h-screen flex flex-col text-sm">
        <!-- Main Content -->
        <div class="flex-1 p-4 sm:p-6">
            <div class="max-w-7xl mx-auto">
                <!-- Header -->
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">لوحة تحكم الأدمن</h1>
                    <p class="text-gray-500 mt-1">إدارة جميع جوانب النظام من مكان واحد</p>
                </div>

                <!-- Actions Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                    @foreach([
                        ['icon' => 'users', 'route' => 'admin.users.index', 'title' => 'المستخدمون', 'count' => \App\Models\User::count()],
                        ['icon' => 'newspaper', 'route' => 'admin.posts.index', 'title' => 'المنشورات', 'count' => \App\Models\Post::count()],
                        ['icon' => 'comments', 'route' => 'admin.comments.index', 'title' => 'التعليقات', 'count' => \App\Models\Comment::count()],
                        ['icon' => 'cogs', 'route' => 'admin.services.index', 'title' => 'الخدمات', 'count' => \App\Models\Service::count()],
                        // ['icon' => 'thumbs-up', 'route' => 'admin.likes.index', 'title' => 'الإعجابات', 'count' => \App\Models\Like::count()],
                        ['icon' => 'users', 'route' => 'admin.simple-chats.index', 'title' => 'الدردشة الجماعية', 'count' => \App\Models\SimpleMessage::count()],
                        // ['icon' => 'list', 'route' => 'admin.category.index', 'title' => 'التصنيفات', 'count' => \App\Models\Category::count()],
                    ] as $item)
                    <a href="{{ route($item['route']) }}" class="group">
                        <div class="h-full bg-white rounded-xl shadow-sm border border-gray-200 p-4 text-center transition-all hover:shadow-md hover:border-indigo-200">
                            <div class="flex flex-col items-center space-y-2">
                                <div class="p-2 rounded-full bg-gray-100 text-gray-600 group-hover:bg-indigo-100 group-hover:text-indigo-600 transition">
                                    <i class="fas fa-{{ $item['icon'] }} text-xl"></i>
                                </div>
                                <h3 class="text-base font-semibold text-gray-700">{{ $item['title'] }}</h3>
                                <span class="text-sm text-indigo-600 font-bold">{{ $item['count'] }} عنصر</span>

                                <!-- شكل إحصائي صغير (progress bar) -->
                                <div class="w-full bg-gray-100 rounded-full h-2 mt-1">
                                    <div class="bg-indigo-500 h-2 rounded-full" style="width: {{ min(100, ($item['count'] ?? 1) * 2) }}%"></div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-[#f5f2ea] border-t border-gray-200 py-3">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <p class="text-gray-500 text-xs">
                    نظام إدارة المحتوى &copy; {{ date('Y') }}
                </p>
            </div>
        </footer>
    </div>
</x-app-layout>
