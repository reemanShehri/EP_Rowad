<x-app-layout>
    @push('styles')
        {{-- Tailwind CDN + FontAwesome + Tajawal --}}
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Tajawal', sans-serif;
            }
            .gold-text {
                color: #c2a675;
            }
            .gold-bg {
                background-color: #c2a675;
            }
            .hover-gold:hover {
                color: #c2a675;
            }
        </style>
    @endpush

    <div dir="rtl" class="bg-gray-100">
        <main class="container mx-auto px-6 py-10">
            <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="md:flex">
                    {{-- قسم معلومات التواصل --}}
                    <div class="md:w-1/2 p-8">
                        <h1 class="text-3xl font-bold gold-text mb-2">تواصل معنا</h1>
                        <p class="text-gray-600 mb-8">نحن هنا لمساعدتك في أي استفسار لديك. لا تتردد في التواصل معنا عبر أي من الطرق التالية:</p>

                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="gold-bg text-white p-3 rounded-full mr-4">
                                    <i class="fas fa-headset text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">الدعم الفوري</h3>
                                    <p class="text-gray-600">متاح من الساعة 8 صباحاً حتى 5 مساءً</p>
                                    <a href="tel:+966123456789" class="text-gray-800 hover:text-[#c2a675] font-medium mt-1 block">+966 12 345 6789</a>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="gold-bg text-white p-3 rounded-full mr-4">
                                    <i class="fas fa-envelope text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">البريد الإلكتروني</h3>
                                    <p class="text-gray-600">سيتم الرد خلال 24 ساعة</p>
                                    <a href="mailto:info@consultants.com" class="text-gray-800 hover:text-[#c2a675] font-medium mt-1 block">info@consultants.com</a>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="gold-bg text-white p-3 rounded-full mr-4">
                                    <i class="fab fa-whatsapp text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">واتساب</h3>
                                    <p class="text-gray-600">متاح 24/7 للاستفسارات العامة</p>
                                    <a href="https://wa.me/966123456789" class="text-gray-800 hover:text-[#c2a675] font-medium mt-1 block">+966 12 345 6789</a>
                                </div>
                            </div>

                            {{-- وسائل التواصل الاجتماعي --}}
                            <div class="pt-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3">وسائل التواصل الاجتماعي</h3>
                                <div class="flex space-x-4 space-x-reverse">
                                    <a href="#" class="bg-blue-600 text-white p-3 rounded-full hover:bg-blue-700 transition">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" class="bg-blue-400 text-white p-3 rounded-full hover:bg-blue-500 transition">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="#" class="bg-[#0077b5] text-white p-3 rounded-full hover:bg-[#006097] transition">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a href="#" class="bg-[#E1306C] text-white p-3 rounded-full hover:bg-[#C13584] transition">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- قسم نموذج التواصل --}}
                    <div class="md:w-1/2 bg-gray-50 p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">أرسل لنا رسالة</h2>
@if(session('success'))
    <div id="success-message" class="text-green-600 font-bold mb-4">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(function() {
            const successMsg = document.getElementById('success-message');
            if (successMsg) {
                successMsg.style.display = 'none';
            }
        }, 2500); // 2500 milliseconds = 2.5 seconds
    </script>
@endif



{{-- <form method="POST" action="{{ route('contact.send') }}" class="space-y-5">
    @csrf



    <div>
        <label for="name" class="block text-gray-700 mb-2">الاسم الكامل</label>
        <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#c2a675]" placeholder="أدخل اسمك">
    </div>

    <div>
        <label for="email" class="block text-gray-700 mb-2">البريد الإلكتروني</label>
        <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#c2a675]" placeholder="أدخل بريدك الإلكتروني">
    </div>

    <div>
        <label for="phone" class="block text-gray-700 mb-2">رقم الهاتف</label>
        <input type="tel" id="phone" name="phone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#c2a675]" placeholder="أدخل رقم هاتفك">
    </div>

    <div>
        <label for="subject" class="block text-gray-700 mb-2">الموضوع</label>
        <select id="subject" name="subject" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#c2a675]">
            <option value="">اختر موضوع الرسالة</option>
            <option value="consultation">استشارة أعمال</option>
            <option value="investment">فرص استثمارية</option>
            <option value="partnership">شراكة تجارية</option>
            <option value="other">استفسار آخر</option>
        </select>
    </div>

    <div>
        <label for="message" class="block text-gray-700 mb-2">الرسالة</label>
        <textarea id="message" name="message" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#c2a675]" placeholder="أدخل رسالتك هنا..."></textarea>
    </div>

    <button type="submit" class="w-full gold-bg text-white py-3 px-6 rounded-lg font-semibold hover:bg-[#b89a64] transition duration-300">
        إرسال الرسالة <i class="fas fa-paper-plane mr-2"></i>
    </button>
</form> --}}


<form action="mailto:your-email@example.com" method="post" enctype="text/plain" class="space-y-5">
    <div>
        <label for="name" class="block text-gray-700 mb-2">الاسم الكامل</label>
        <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="أدخل اسمك" required>
    </div>
    <div>
        <label for="email" class="block text-gray-700 mb-2">البريد الإلكتروني</label>
        <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="أدخل بريدك الإلكتروني" required>
    </div>
    <div>
        <label for="phone" class="block text-gray-700 mb-2">رقم الهاتف</label>
        <input type="tel" id="phone" name="phone" class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="أدخل رقم هاتفك">
    </div>
    <div>
        <label for="subject" class="block text-gray-700 mb-2">الموضوع</label>
        <select id="subject" name="subject" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
            <option value="">اختر موضوع الرسالة</option>
            <option value="consultation">استشارة أعمال</option>
            <option value="investment">فرص استثمارية</option>
            <option value="partnership">شراكة تجارية</option>
            <option value="other">استفسار آخر</option>
        </select>
    </div>
    <div>
        <label for="message" class="block text-gray-700 mb-2">الرسالة</label>
        <textarea id="message" name="message" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="أدخل رسالتك هنا..." required></textarea>
    </div>
   <button type="submit" class="w-full bg-yellow-800 text-white py-3 rounded-lg font-semibold hover:bg-yellow-600 transition duration-300">
    إرسال الرسالة <i class="fas fa-paper-plane mr-2"></i>
</button>

</form>


                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
