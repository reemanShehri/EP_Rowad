<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            دردشة مع الذكاء الاصطناعي
        </h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <!-- شريط معلومات الذكاء الاصطناعي -->
            <div class="bg-indigo-600 dark:bg-indigo-800 px-4 py-3 flex items-center">
                <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center mr-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-white font-semibold">مساعد الذكاء الاصطناعي</h3>
                    <p class="text-indigo-200 text-sm">متاح الآن للإجابة على أسئلتك</p>
                </div>
            </div>

            <!-- منطقة المحادثة -->
            <div id="chat-container" class="h-[500px] overflow-y-auto p-4 space-y-4">
                <!-- الرسائل ستظهر هنا ديناميكيًا -->
                <div class="flex justify-start">
                    <div class="max-w-xs md:max-w-md lg:max-w-lg bg-gray-100 dark:bg-gray-700 rounded-lg p-3">
                        <p class="text-gray-800 dark:text-gray-200">مرحباً! كيف يمكنني مساعدتك اليوم؟</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">الآن</p>
                    </div>
                </div>

                <!-- نموذج لرسالة المستخدم -->
                <div class="flex justify-end hidden" id="user-message-template">
                    <div class="max-w-xs md:max-w-md lg:max-w-lg bg-indigo-500 text-white rounded-lg p-3">
                        <p class="message-content"></p>
                        <p class="text-xs text-indigo-200 mt-1">الآن</p>
                    </div>
                </div>

                <!-- نموذج لرد الذكاء الاصطناعي -->
                <div class="flex justify-start hidden" id="ai-message-template">
                    <div class="max-w-xs md:max-w-md lg:max-w-lg bg-gray-100 dark:bg-gray-700 rounded-lg p-3">
                        <p class="text-gray-800 dark:text-gray-200 message-content"></p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">الآن</p>
                    </div>
                </div>
            </div>

            <!-- منطقة إدخال الرسالة -->
            <div class="border-t border-gray-200 dark:border-gray-700 p-4">
                <form id="chat-form" class="flex space-x-2">
                    @csrf
                    <input
                        type="text"
                        id="message-input"
                        placeholder="اكتب رسالتك هنا..."
                        class="flex-1 border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white"
                        autocomplete="off"
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
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">الذكاء الاصطناعي قد يقدم معلومات غير دقيقة أحياناً</p>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatForm = document.getElementById('chat-form');
        const messageInput = document.getElementById('message-input');
        const chatContainer = document.getElementById('chat-container');

        chatForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const message = messageInput.value.trim();
            if (!message) return;

            // إضافة رسالة المستخدم
            addMessageToChat(message, 'user');
            messageInput.value = '';
            showLoadingIndicator();

            try {
                const response = await fetch("{{ route('chat.send') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ message: message })
                });

                if (!response.ok) throw new Error('Network response was not ok');

                const data = await response.json();

                removeLoadingIndicator();

                if (data.error) {
                    addMessageToChat(data.error, 'ai');
                } else {
                    addMessageToChat(data.response, 'ai');
                }

            } catch (error) {
                console.error('Error:', error);
                removeLoadingIndicator();
                addMessageToChat('حدث خطأ في الاتصال بالخادم. يرجى المحاولة لاحقاً.', 'ai');
            }
        });

        function addMessageToChat(message, sender) {
            const templateId = `${sender}-message-template`;
            const template = document.getElementById(templateId).cloneNode(true);

            template.classList.remove('hidden');
            template.querySelector('.message-content').textContent = message;

            // تحديث الوقت
            const now = new Date();
            template.querySelector('p.text-xs').textContent =
                `${now.getHours()}:${now.getMinutes().toString().padStart(2, '0')}`;

            chatContainer.appendChild(template);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        function showLoadingIndicator() {
            const indicator = document.createElement('div');
            indicator.className = 'flex justify-start';
            indicator.id = 'loading-indicator';
            indicator.innerHTML = `
                <div class="max-w-xs md:max-w-md lg:max-w-lg bg-gray-100 dark:bg-gray-700 rounded-lg p-3">
                    <div class="flex space-x-2">
                        <div class="w-2 h-2 rounded-full bg-gray-400 animate-bounce"></div>
                        <div class="w-2 h-2 rounded-full bg-gray-400 animate-bounce" style="animation-delay: 0.2s"></div>
                        <div class="w-2 h-2 rounded-full bg-gray-400 animate-bounce" style="animation-delay: 0.4s"></div>
                    </div>
                </div>
            `;
            chatContainer.appendChild(indicator);
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        function removeLoadingIndicator() {
            const indicator = document.getElementById('loading-indicator');
            if (indicator) indicator.remove();
        }

        // إرسال بالضغط على Enter
        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                chatForm.dispatchEvent(new Event('submit'));
            }
        });
    });
</script>
@endpush

    @push('styles')
    <style>
        /* تخصيص شريط التمرير */
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

        .dark #chat-container::-webkit-scrollbar-track {
            background: #2d3748;
        }

        .dark #chat-container::-webkit-scrollbar-thumb {
            background: #4a5568;
        }

        /* تأثيرات للرسائل */
        .flex.justify-start div, .flex.justify-end div {
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
