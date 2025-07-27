<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">المحادثات</h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto">
        @foreach ($chats as $chat)
            <div class="p-4 mb-2 bg-white rounded shadow">
                <div class="flex justify-between items-center">
                    <div>
                        <p><strong>{{ $chat->user->name }}</strong></p>
                        <p>{{ $chat->content }}</p>
                        <p class="text-sm text-gray-500">{{ $chat->created_at->diffForHumans() }}</p>
                    </div>
                    <form action="{{ route('admin.simple-chats.destroy', $chat->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد؟')">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>حذف</x-danger-button>
                    </form>
                </div>
            </div>
        @endforeach

        <div class="mt-4">
            {{ $chats->links() }}
        </div>
    </div>
</x-app-layout>
