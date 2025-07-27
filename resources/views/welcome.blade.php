<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>منتدى روّاد | مجتمع ريادي متكامل</title>
    <meta name="description" content="منصة عربية لرواد الأعمال للحصول على استشارات في التسويق، التمويل والتقنية">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=tajawal:400,500,700" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary: #F5F1E8;
            --secondary: #E8E0D1;
            --accent: #A38A67;
            --text: #3A3A3A;
            --light-text: #7A7A7A;
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background-color: var(--primary);
            color: var(--text);
        }

        .nav-link {
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            right: 0;
            background-color: var(--accent);
            transition: width 0.3s ease;
        }

        .nav-link:hover:after {
            width: 100%;
        }

        .btn-primary {
            background-color: var(--accent);
            color: white;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #8C735A;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .feature-card {
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            border-color: var(--accent);
        }

        .section-divider {
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23E8E0D1' fill-opacity='1' d='M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E") no-repeat;
            background-size: cover;
            height: 100px;
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="antialiased">
    <!-- شريط التنقل -->
    <nav class="bg-white shadow-sm py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-[var(--accent)]">
                        <i class="fas fa-lightbulb mr-2"></i> روّاد
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8 space-x-reverse">
                    <a href="#home" class="nav-link text-[var(--text)]">الرئيسية</a>
                    <a href="#categories" class="nav-link text-[var(--text)]">الأقسام</a>
                    <a href="#features" class="nav-link text-[var(--text)]">المستشارون</a>
                    <a href="#how-it-works" class="nav-link text-[var(--text)]">كيف يعمل</a>
                </div>

                <div class="flex items-center space-x-4 space-x-reverse">
                    <div class="md:hidden">
                        <button id="menu-toggle" class="text-[var(--text)] focus:outline-none">
                            <i class="fas fa-bars text-2xl"></i>
                        </button>
                    </div>

                    <div class="hidden md:flex items-center space-x-4 space-x-reverse">
                        @auth
                            <a href="/dashboard" class="btn-primary px-6 py-2 rounded-full text-sm font-medium">
                                لوحة التحكم <i class="fas fa-tachometer-alt mr-2"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-2 rounded-full text-sm font-medium border border-[var(--accent)] text-[var(--accent)] hover:bg-[var(--accent)] hover:text-white transition">
                                تسجيل الدخول
                            </a>
                            <a href="{{ route('register') }}" class="btn-primary px-6 py-2 rounded-full text-sm font-medium">
                                انضم إلينا
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- القائمة المنسدلة للجوال -->
        <div id="mobile-menu" class="hidden md:hidden bg-white shadow-lg z-50 py-4 px-6">
            <div class="flex flex-col space-y-4">
                <a href="#home" class="nav-link text-[var(--text)]">الرئيسية</a>
                <a href="#categories" class="nav-link text-[var(--text)]">الأقسام</a>
                <a href="#features" class="nav-link text-[var(--text)]">المستشارون</a>
                <a href="#how-it-works" class="nav-link text-[var(--text)]">كيف يعمل</a>
                @auth
                    <a href="/dashboard" class="btn-primary px-6 py-2 rounded-full text-sm font-medium text-center">
                        لوحة التحكم
                    </a>
                @else
                    <a href="{{ route('login') }}" class="px-6 py-2 rounded-full text-sm font-medium border border-[var(--accent)] text-[var(--accent)] hover:bg-[var(--accent)] hover:text-white transition text-center">
                        تسجيل الدخول
                    </a>
                    <a href="{{ route('register') }}" class="btn-primary px-6 py-2 rounded-full text-sm font-medium text-center">
                        انضم إلينا
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- القسم الرئيسي -->
    <main>
        <!-- الهيرو -->
        <section id="home" class="relative bg-[var(--primary)] pt-16 pb-32">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 mb-12 md:mb-0">
                        <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
                            مجتمع <span class="text-[var(--accent)]">ريادي</span> لرواد الأعمال الطموحين
                        </h1>
                        <p class="text-xl text-[var(--light-text)] mb-8">
                            احصل على إجابات من خبراء في مجالات التسويق، التمويل والتقنية. انضم إلى آلاف الرواد الذين طوروا مشاريعهم معنا.
                        </p>
                        <div class="flex space-x-4 space-x-reverse">
                            <a href="{{ route('register') }}" class="btn-primary px-8 py-3 rounded-full text-lg font-medium">
                                ابدأ الآن <i class="fas fa-arrow-left ml-2"></i>
                            </a>
                            {{-- <a href="#" class="px-8 py-3 rounded-full text-lg font-medium border border-[var(--accent)] text-[var(--accent)] hover:bg-[var(--accent)] hover:text-white transition">
                                <i class="fas fa-play-circle ml-2"></i> شاهد الفيديو
                            </a> --}}
                        </div>
                    </div>
                    <div class="md:w-1/2">
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                             alt="رواد الأعمال"
                             class="rounded-lg shadow-xl w-full h-auto object-cover"
                             style="max-height: 500px;">
                    </div>
                </div>
            </div>
        </section>

        <!-- موجات الفاصل -->
        <div class="section-divider"></div>

        <!-- مميزات المنصة -->
        <section id="features" class="py-20 bg-[var(--secondary)]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold mb-4">لماذا <span class="text-[var(--accent)]">منتدى روّاد؟</span></h2>
                    <p class="text-xl text-[var(--light-text)] max-w-2xl mx-auto">
                        نوفر لك كل ما تحتاجه لتطوير مشروعك الناشئ في مكان واحد
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="feature-card bg-white p-8 rounded-lg shadow-sm text-center">
                        <div class="text-[var(--accent)] text-4xl mb-4">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">مجتمع خبير</h3>
                        <p class="text-[var(--light-text)]">
                            تواصل مع مستشارين معتمدين وخبراء في مختلف المجالات
                        </p>
                    </div>

                    <div class="feature-card bg-white p-8 rounded-lg shadow-sm text-center">
                        <div class="text-[var(--accent)] text-4xl mb-4">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">حلول مبدعة</h3>
                        <p class="text-[var(--light-text)]">
                            احصل على أفكار وحلول مبتكرة لمشاكل مشروعك
                        </p>
                    </div>

                    <div class="feature-card bg-white p-8 rounded-lg shadow-sm text-center">
                        <div class="text-[var(--accent)] text-4xl mb-4">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">نمو مستمر</h3>
                        <p class="text-[var(--light-text)]">
                            طور مهاراتك ووسع معرفتك مع دورات وموارد متخصصة
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- الأقسام الرئيسية -->
        <section id="categories" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold mb-4">استكشف <span class="text-[var(--accent)]">أقسامنا</span></h2>
                    <p class="text-xl text-[var(--light-text)] max-w-2xl mx-auto">
                        اختر مجال استشارتك وابدأ رحلة النجاح مع خبرائنا
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-[var(--primary)] p-6 rounded-lg">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                             alt="التسويق"
                             class="w-full h-48 object-cover rounded-lg mb-4">
                        <div class="flex items-center mb-3">
                            <div class="bg-[var(--accent)] p-2 rounded-full mr-3">
                                <i class="fas fa-bullhorn text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold">التسويق</h3>
                        </div>
                        <p class="text-[var(--light-text)] mb-4">
                            استشارات في التسويق الرقمي، العلامات التجارية، دراسة السوق واستراتيجيات النمو
                        </p>
                        <a href="#" class="text-[var(--accent)] font-medium flex items-center">
                            تصفح القسم <i class="fas fa-arrow-left ml-2"></i>
                        </a>
                    </div>

                    <div class="bg-[var(--primary)] p-6 rounded-lg">
                        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                             alt="التمويل"
                             class="w-full h-48 object-cover rounded-lg mb-4">
                        <div class="flex items-center mb-3">
                            <div class="bg-[var(--accent)] p-2 rounded-full mr-3">
                                <i class="fas fa-coins text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold">التمويل</h3>
                        </div>
                        <p class="text-[var(--light-text)] mb-4">
                            نصائح تمويلية، استثمارية، إدارة مالية وتحليل التكاليف لمشروعك
                        </p>
                        <a href="#" class="text-[var(--accent)] font-medium flex items-center">
                            تصفح القسم <i class="fas fa-arrow-left ml-2"></i>
                        </a>
                    </div>

                    <div class="bg-[var(--primary)] p-6 rounded-lg">
                        <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1172&q=80"
                             alt="التقنية"
                             class="w-full h-48 object-cover rounded-lg mb-4">
                        <div class="flex items-center mb-3">
                            <div class="bg-[var(--accent)] p-2 rounded-full mr-3">
                                <i class="fas fa-laptop-code text-white"></i>
                            </div>
                            <h3 class="text-xl font-bold">التقنية</h3>
                        </div>
                        <p class="text-[var(--light-text)] mb-4">
                            حلول تقنية، برمجة، أتمتة واختيار الأدوات المناسبة لمشروعك
                        </p>
                        <a href="#" class="text-[var(--accent)] font-medium flex items-center">
                            تصفح القسم <i class="fas fa-arrow-left ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- كيف يعمل -->
        <section id="how-it-works" class="py-20 bg-[var(--secondary)]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold mb-4">كيف <span class="text-[var(--accent)]">تعمل المنصة؟</span></h2>
                    <p class="text-xl text-[var(--light-text)] max-w-2xl mx-auto">
                        ثلاث خطوات بسيطة تفصلك عن الحصول على استشارتك
                    </p>
                </div>

                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="step-card mb-12 md:mb-0 text-center md:w-1/4">
                        <div class="bg-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-md">
                            <span class="text-2xl font-bold text-[var(--accent)]">1</span>
                        </div>
                        <img src="https://images.unsplash.com/photo-1543269664-76bc3997d9ea?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80"
                             alt="التسجيل"
                             class="w-full h-48 object-cover rounded-lg mb-4">
                        <h3 class="text-xl font-bold mb-3">انضم إلينا</h3>
                        <p class="text-[var(--light-text)] px-4">
                            سجل حسابك في دقائق واختر نوع عضويتك (رائد أعمال أو مستشار)
                        </p>
                    </div>

                    <div class="step-card mb-12 md:mb-0 text-center md:w-1/4">
                        <div class="bg-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-md">
                            <span class="text-2xl font-bold text-[var(--accent)]">2</span>
                        </div>
                        <img src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80"
                             alt="طرح السؤال"
                             class="w-full h-48 object-cover rounded-lg mb-4">
                        <h3 class="text-xl font-bold mb-3">اطرح سؤالك</h3>
                        <p class="text-[var(--light-text)] px-4">
                            اكتب استفسارك في القسم المناسب مع ذكر التفاصيل المهمة
                        </p>
                    </div>

                    <div class="step-card text-center md:w-1/4">
                        <div class="bg-white w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-md">
                            <span class="text-2xl font-bold text-[var(--accent)]">3</span>
                        </div>
                        <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1169&q=80"
                             alt="الحصول على إجابة"
                             class="w-full h-48 object-cover rounded-lg mb-4">
                        <h3 class="text-xl font-bold mb-3">احصل على إجابة</h3>
                        <p class="text-[var(--light-text)] px-4">
                            تلقى ردوداً من خبراء واختر الحل الأنسب لمشروعك
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- دعوة للعمل -->
        <section class="py-20 bg-[var(--accent)] text-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold mb-6">جاهز لبدء رحلتك الريادية</h2>
                <p class="text-xl mb-8 opacity-90">
                    انضم إلى آلاف الرواد الذين طوروا مشاريعهم بمساعدة خبرائنا
                </p>
                <a href="{{ route('register') }}" class="inline-block bg-white text-[var(--accent)] px-8 py-3 rounded-full text-lg font-medium hover:bg-gray-100 transition">
                    سجل حسابك الآن <i class="fas fa-arrow-left ml-2"></i>
                </a>
            </div>
        </section>
    </main>

    <!-- تذييل الصفحة -->
    <footer class="bg-[var(--text)] text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 flex items-center">
                        <i class="fas fa-lightbulb mr-2"></i> روّاد
                    </h3>
                    <p class="text-gray-300">
                        منصة عربية تهدف إلى تمكين رواد الأعمال من خلال توفير مجتمع تفاعلي لتبادل الخبرات والمعرفة.
                    </p>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-4">روابط سريعة</h3>
                    <ul class="space-y-2">
                        <li><a href="#home" class="text-gray-300 hover:text-white transition">الرئيسية</a></li>
                        <li><a href="#categories" class="text-gray-300 hover:text-white transition">الأقسام</a></li>
                        <li><a href="#features" class="text-gray-300 hover:text-white transition">المستشارون</a></li>
                        <li><a href="#how-it-works" class="text-gray-300 hover:text-white transition">كيف يعمل</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-4">المساعدة</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition">الأسئلة الشائعة</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">الشروط والأحكام</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">سياسة الخصوصية</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">اتصل بنا</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-lg font-bold mb-4">تابعنا</h3>
                    <div class="flex space-x-4 space-x-reverse">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-700 hover:bg-gray-600 transition flex items-center justify-center">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-700 hover:bg-gray-600 transition flex items-center justify-center">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-700 hover:bg-gray-600 transition flex items-center justify-center">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-700 hover:bg-gray-600 transition flex items-center justify-center">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-300">
                <p>© 2025 منصة روّاد. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </footer>

    <script>
        // تبديل القائمة على الهواتف
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // إغلاق القائمة عند النقر على رابط
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                document.getElementById('mobile-menu').classList.add('hidden');
            });
        });
    </script>
</body>
</html>
