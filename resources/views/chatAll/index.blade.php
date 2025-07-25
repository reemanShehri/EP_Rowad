<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('الدردشة العامة') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <!-- شريط معلومات الدردشة -->
                <div class="bg-indigo-600 px-4 py-3 flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-white font-semibold">الدردشة العامة</h3>
                            <p class="text-indigo-200 text-sm">{{ Auth::user()->name }} - أنت متصل الآن</p>
                        </div>
                    </div>
                    <div class="text-indigo-200 text-sm">
                        <span id="online-count">0</span> مستخدم متصل
                    </div>
                </div>

                <!-- منطقة الرسائل -->
                <div id="chat-container" class="h-[500px] overflow-y-auto p-4 space-y-4 bg-gray-50">
                    @foreach($messages as $message)
                    <div class="flex {{ $message->user_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                        <div class="max-w-xs md:max-w-md lg:max-w-lg rounded-lg p-3
                            {{ $message->user_id == Auth::id() ? 'bg-indigo-500 text-white' : 'bg-white border border-gray-200' }}">
                            <div class="flex items-center mb-1">
                                @if($message->user_id != Auth::id())
                                <div class="w-6 h-6 rounded-full bg-gray-300 flex items-center justify-center mr-2 text-xs">
                                    {{ substr($message->user->name, 0, 1) }}
                                </div>
                                <span class="font-medium text-xs {{ $message->user_id == Auth::id() ? 'text-indigo-200' : 'text-gray-600' }}">
                                    {{ $message->user->name }}
                                </span>
                                @endif
                            </div>
                            <p class="{{ $message->user_id == Auth::id() ? 'text-white' : 'text-gray-800' }}">{{ $message->content }}</p>
                            <p class="text-xs mt-1 {{ $message->user_id == Auth::id() ? 'text-indigo-200' : 'text-gray-500' }}">
                                {{ $message->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- منطقة إدخال الرسالة -->
                <div class="border-t border-gray-200 p-4 bg-white">
                    <form id="chat-form" class="flex space-x-2">
                        @csrf
                        <input
                            type="text"
                            id="message-input"
                            placeholder="اكتب رسالتك هنا..."
                            class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            autocomplete="off"
                            required
                        >
                        <button
                            type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg transition duration-200 flex items-center justify-center"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </form>
                    <p class="text-xs text-gray-500 mt-2">الرسائل مرئية لجميع المستخدمين</p>
                </div>
            </div>
        </div>
    </div>

 @push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatForm = document.getElementById('chat-form');
        const messageInput = document.getElementById('message-input');
        const chatContainer = document.getElementById('chat-container');

        // التمرير إلى الأسفل عند تحميل الصفحة
        chatContainer.scrollTop = chatContainer.scrollHeight;

        // إرسال الرسالة
        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const message = messageInput.value.trim();
            if (message === '') return;

            // إظهار مؤشر تحميل
            const submitBtn = chatForm.querySelector('button[type="submit"]');
            submitBtn.innerHTML = `
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            `;
            submitBtn.disabled = true;

            // إرسال الرسالة عبر AJAX
            fetch("{{ route('chat.store') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ content: message })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // إظهار رسالة نجاح
                    showSuccessAlert('تم إرسال الرسالة بنجاح');

                    // مسح حقل الإدخال
                    messageInput.value = '';

                    // إضافة الرسالة للدردشة
                    addMessageToChat(data.data);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorAlert('حدث خطأ أثناء إرسال الرسالة');
            })
            .finally(() => {
                // إعادة زر الإرسال إلى وضعه الطبيعي
                submitBtn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                    </svg>
                `;
                submitBtn.disabled = false;
            });
        });

        // وظيفة لإضافة رسالة للدردشة
        function addMessageToChat(message) {
            const messageDiv = document.createElement('div');
            const isCurrentUser = message.user_id == {{ Auth::id() }};

            messageDiv.className = `flex ${isCurrentUser ? 'justify-end' : 'justify-start'}`;
            messageDiv.innerHTML = `
                <div class="max-w-xs md:max-w-md lg:max-w-lg rounded-lg p-3
                    ${isCurrentUser ? 'bg-indigo-500 text-white' : 'bg-white border border-gray-200'}">
                    ${!isCurrentUser ? `
                    <div class="flex items-center mb-1">
                        <div class="w-6 h-6 rounded-full bg-gray-300 flex items-center justify-center mr-2 text-xs">
                            ${message.user.name.substring(0, 1)}
                        </div>
                        <span class="font-medium text-xs ${isCurrentUser ? 'text-indigo-200' : 'text-gray-600'}">
                            ${message.user.name}
                        </span>
                    </div>
                    ` : ''}
                    <p class="${isCurrentUser ? 'text-white' : 'text-gray-800'}">${message.content}</p>
                    <p class="text-xs mt-1 ${isCurrentUser ? 'text-indigo-200' : 'text-gray-500'}">
                        الآن
                    </p>
                </div>
            `;

            chatContainer.appendChild(messageDiv);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        // وظيفة لعرض رسالة نجاح
        function showSuccessAlert(message) {
            const alertDiv = document.createElement('div');
            alertDiv.className = 'fixed top-4 right-4 z-50 px-4 py-2 bg-green-500 text-white rounded-md shadow-lg flex items-center';
            alertDiv.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                ${message}
            `;

            document.body.appendChild(alertDiv);

            // إخفاء الرسالة بعد 3 ثواني
            setTimeout(() => {
                alertDiv.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                setTimeout(() => alertDiv.remove(), 500);
            }, 3000);
        }

        // وظيفة لعرض رسالة خطأ
        function showErrorAlert(message) {
            const alertDiv = document.createElement('div');
            alertDiv.className = 'fixed top-4 right-4 z-50 px-4 py-2 bg-red-500 text-white rounded-md shadow-lg flex items-center';
            alertDiv.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
                ${message}
            `;

            document.body.appendChild(alertDiv);

            // إخفاء الرسالة بعد 3 ثواني
            setTimeout(() => {
                alertDiv.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                setTimeout(() => alertDiv.remove(), 500);
            }, 3000);
        }
    });
</script>
@endpush

    @push('styles')
    <style>
        /* تخصيم شريط التمرير */
        #chat-container::-webkit-scrollbar {
            width: 6px;
        }
        #chat-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        #chat-container::-webkit-scrollbar-thumb {
            background: #c7c7c7;
            border-radius: 10px;
        }

        /* تأثيرات للرسائل */
        #chat-container > div {
            opacity: 0;
            transform: translateY(10px);
            animation: fadeInUp 0.3s ease-out forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    @endpush
</x-app-layout>
