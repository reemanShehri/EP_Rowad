<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-white">
            💬 دردشة مبسطة
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <!-- منطقة الرسائل -->
                <div id="chat-container" class="h-96 overflow-y-auto mb-4 p-4 bg-gray-50 rounded border">
                    @foreach($messages as $message)
                    <div id="message-{{ $message->id }}" class="mb-4 flex {{ $message->user_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-xs md:max-w-md bg-{{ $message->user_id == auth()->id() ? 'blue-100' : 'gray-100' }} rounded-lg p-3">
                            <div class="flex justify-between items-center">
                                <div class="font-semibold text-sm">
                                    {{ $message->user->name }}
                                </div>
                                @if($message->user_id == auth()->id())
                                <button onclick="deleteMessage({{ $message->id }})" class="text-red-500 hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                                @endif
                            </div>
                            <p class="text-gray-800 mt-1">{{ $message->content }}</p>
                            <div class="text-xs text-gray-500 mt-1">
                                {{ $message->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- نموذج إرسال الرسالة -->
                <form id="message-form" method="POST" action="{{ route('simple-chat.store') }}">
                    @csrf
                    <div class="flex">
                        <input type="text" name="content" placeholder="اكتب رسالتك هنا..."
                               class="flex-1 border rounded-l-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r-lg hover:bg-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // التمرير للأسفل عند تحميل الصفحة
        const chatContainer = document.getElementById('chat-container');
        chatContainer.scrollTop = chatContainer.scrollHeight;

        // إرسال الرسالة عبر AJAX
        document.getElementById('message-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            const submitBtn = form.querySelector('button[type="submit"]');

            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            `;

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const messageDiv = document.createElement('div');
                    messageDiv.id = `message-${data.message.id}`;
                    messageDiv.className = 'mb-4 flex justify-end';
                    messageDiv.innerHTML = `
                        <div class="max-w-xs md:max-w-md bg-blue-100 rounded-lg p-3">
                            <div class="flex justify-between items-center">
                                <div class="font-semibold text-sm">
                                    ${data.message.user.name}
                                </div>
                                <button onclick="deleteMessage(${data.message.id})" class="text-red-500 hover:text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                            <p class="text-gray-800 mt-1">${data.message.content}</p>
                            <div class="text-xs text-gray-500 mt-1">
                                الآن
                            </div>
                        </div>
                    `;
                    chatContainer.appendChild(messageDiv);
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                    form.querySelector('input[name="content"]').value = '';
                }
            })
            .catch(error => {
                console.error('Error:', error);
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                    </svg>
                `;
            });
        });

      // دالة الحذف المعدلة
async function deleteMessage(messageId) {
    if (!confirm('هل أنت متأكد من حذف هذه الرسالة؟')) return;

    try {
        const response = await fetch(`/messages/${messageId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            credentials: 'include' // مهم للجلسات
        });

        const result = await response.json();

        if (!response.ok) {
            throw new Error(result.message || 'خطأ في الشبكة');
        }

        if (result.success) {
            const messageElement = document.getElementById(`message-${messageId}`);
            if (messageElement) {
                messageElement.remove();
            }
        } else {
            alert(result.message || 'فشل في الحذف');
        }
    } catch (error) {
        console.error('Error:', error);
        alert(`خطأ: ${error.message}`);
    }
}
    </script>
    @endpush
</x-app-layout>
