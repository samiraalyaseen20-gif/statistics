<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تسجيل الدخول - نظام إدارة العيادات</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Tajawal:wght@400;500;700;800&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Tajawal', 'Outfit', sans-serif; background-color: #f8fafc; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }
        .input-field {
            transition: all 0.3s ease;
        }
        .input-field:focus-within {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }
        /* Gradient Animation for the branding side */
        .bg-animated-gradient {
            background: linear-gradient(-45deg, #ff4d7e, #ff85a7, #10b981, #34d399);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    </style>
</head>
<body class="min-h-screen w-full overflow-hidden flex bg-slate-50 text-slate-800">

    <div class="flex w-full h-screen">
        
        <!-- Right Side: Branding (Visible on lg screens and up) -->
        <div class="hidden lg:flex w-1/2 bg-animated-gradient relative items-center justify-center overflow-hidden">
            <!-- Decorative circles -->
            <div class="absolute top-1/4 -right-20 w-96 h-96 bg-white opacity-10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-1/4 -left-20 w-80 h-80 bg-black opacity-10 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 text-center text-white p-12 max-w-xl glass-panel rounded-3xl shadow-2xl">
                <div class="w-24 h-24 mx-auto bg-white rounded-2xl flex items-center justify-center text-pink-500 shadow-xl mb-8 transform rotate-3 hover:rotate-0 transition-transform duration-500">
                    <i data-lucide="activity" class="w-12 h-12"></i>
                </div>
                <h1 class="text-4xl font-extrabold mb-4 font-['Tajawal'] leading-tight">عيادتنا الذكية</h1>
                <p class="text-lg opacity-90 leading-relaxed font-medium">نظام الإدارة المتكامل المصمم خصيصاً للارتقاء بجودة الرعاية الصحية وتنظيم سير العمل باحترافية.</p>
                
                <div class="mt-10 flex items-center justify-center gap-4 text-sm font-bold opacity-80">
                    <div class="flex items-center gap-2 bg-white/20 px-4 py-2 rounded-full">
                        <i data-lucide="shield-check" class="w-4 h-4"></i>
                        <span>نظام آمن</span>
                    </div>
                    <div class="flex items-center gap-2 bg-white/20 px-4 py-2 rounded-full">
                        <i data-lucide="zap" class="w-4 h-4"></i>
                        <span>سريع وفعال</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Left Side: Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 relative">
            
            <!-- Mobile Logo (hidden on large screens) -->
            <div class="absolute top-8 left-0 right-0 flex justify-center lg:hidden">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-pink-500 flex items-center justify-center text-white shadow-lg font-bold">
                        <i data-lucide="activity" class="w-5 h-5"></i>
                    </div>
                    <h2 class="text-xl font-bold text-slate-800">عيادتنا الذكية</h2>
                </div>
            </div>

            <div class="w-full max-w-md">
                <div class="mb-10">
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-2">مرحباً بعودتك! 👋</h2>
                    <p class="text-slate-500 font-medium">يرجى إدخال بيانات الدخول للمتابعة إلى لوحة التحكم.</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-r-4 border-red-500 p-4 rounded-xl flex items-start gap-3 shadow-sm">
                        <i data-lucide="alert-octagon" class="w-5 h-5 text-red-500 shrink-0 mt-0.5"></i>
                        <ul class="text-sm font-medium text-red-800 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Username Field -->
                    <div class="input-field bg-white border border-slate-200 rounded-2xl p-2 shadow-sm">
                        <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider px-3 pt-1">اسم المستخدم</label>
                        <div class="relative flex items-center mt-1">
                            <div class="pl-2 pr-3 text-slate-400">
                                <i data-lucide="user" class="w-5 h-5"></i>
                            </div>
                            <input type="text" name="username" value="{{ old('username') }}" required autofocus
                                   class="w-full bg-transparent border-none focus:ring-0 text-slate-800 font-bold text-lg p-0 pb-1"
                                   placeholder="admin" autocomplete="off">
                        </div>
                    </div>

                    <!-- Password Field -->
                    <div class="input-field bg-white border border-slate-200 rounded-2xl p-2 shadow-sm">
                        <label class="block text-[11px] font-bold text-slate-400 uppercase tracking-wider px-3 pt-1">كلمة المرور</label>
                        <div class="relative flex items-center mt-1">
                            <div class="pl-2 pr-3 text-slate-400">
                                <i data-lucide="lock" class="w-5 h-5"></i>
                            </div>
                            <input type="password" name="password" required
                                   class="w-full bg-transparent border-none focus:ring-0 text-slate-800 font-bold text-lg p-0 pb-1"
                                   placeholder="••••••••">
                        </div>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="w-full py-4 px-6 rounded-2xl text-white font-bold text-lg bg-slate-900 hover:bg-pink-500 transition-colors duration-300 shadow-xl shadow-slate-200 flex justify-center items-center gap-3 group relative overflow-hidden">
                        <span class="relative z-10">تسجيل الدخول</span>
                        <i data-lucide="arrow-left" class="w-5 h-5 relative z-10 transform group-hover:-translate-x-1 transition-transform"></i>
                    </button>
                </form>

                <!-- Demo Accounts Info -->
                <div class="mt-12 bg-slate-100 rounded-2xl p-5 border border-slate-200/60">
                    <h4 class="text-xs font-bold text-slate-500 mb-3 flex items-center gap-2">
                        <i data-lucide="info" class="w-4 h-4"></i>
                        حسابات تجريبية سريعة:
                    </h4>
                    <div class="grid grid-cols-2 gap-3 text-sm font-bold text-slate-700 font-['Outfit']">
                        <div class="bg-white px-3 py-2 rounded-xl shadow-sm flex flex-col">
                            <span class="text-[10px] text-slate-400 mb-0.5">مدير النظام</span>
                            <span>U: admin</span>
                            <span>P: 123456</span>
                        </div>
                        <div class="bg-white px-3 py-2 rounded-xl shadow-sm flex flex-col">
                            <span class="text-[10px] text-slate-400 mb-0.5">موظف استقبال</span>
                            <span>U: employee</span>
                            <span>P: 123456</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
