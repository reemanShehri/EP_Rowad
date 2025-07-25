<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('المحادثة') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <!-- معلومات المحادثة -->
                <div class="p-4 bg-white border-b border-gray-200 flex items-center">
                    @foreach($conversation->participants as $participant)
                        @if($participant->id != Auth::id())
                        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center mr-3">
                            {{ substr($participant->name, 0, 1) }}
                        </div>
                        <span class="font-medium">{{ $participant->name }}</span>
                        @endif
                    @endforeach
                </div>

                <!-- منطقة الرسائل -->
                <div class="h-[500px] overflow-y-auto p-4 space-y-4" id="messages-container">
                    @foreach($messages as $message)
                    <div class="flex {{ $message->user_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-xs md:max-w-md lg:max-w-lg rounded-lg p-3
                            {{ $message->user_id == Auth::id() ? 'bg-blue-500 text-white' : 'bg-gray-100' }}">
                            <p>{{ $message->content }}</p>
                            <p class="text-xs mt-1 {{ $message->user_id == Auth::id() ? 'text-blue-200' : 'text-gray-500' }}">
                                {{ $message->created_at->diffForHumans() }}
                                @if($message->user_id == Auth::id() && $message->read_at)
                                <span class="text-xs">✓ مقروء</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- إرسال رسالة جديدة -->
                <div class="border-t border-gray-200 p-4">
                    <form action="{{ route('chat.store', $conversation) }}" method="POST" class="flex space-x-2">
                        @csrf
                        <input
                            type="text"
                            name="content"
                            placeholder="اكتب رسالتك هنا..."
                            class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            autocomplete="off"
                            required
                        >
                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition duration-200"
                        >
                            إرسال
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // التمرير إلى أحدث رسالة
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('messages-container');
            container.scrollTop = container.scrollHeight;
        });
    </script>
    @endpush
</x-app-layout>
