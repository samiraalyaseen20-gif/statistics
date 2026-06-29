<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تسجيل الدخول - نظام إدارة العيادات</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Tajawal', 'Outfit', sans-serif; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4" data-theme="soft">
    
    <!-- Background blobs -->
    <div class="fixed top-10 left-10 w-80 h-80 rounded-full bg-pink-400/30 blur-3xl glass-blob pointer-events-none z-[-1]"></div>
    <div class="fixed bottom-20 right-10 w-96 h-96 rounded-full bg-sky-400/30 blur-3xl glass-blob pointer-events-none z-[-1]"></div>

    <div class="w-full max-w-md custom-card p-8 rounded-3xl relative overflow-hidden">
        
        <div class="flex flex-col items-center justify-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-pink-500 to-pink-400 flex items-center justify-center text-white shadow-soft-out-sm font-bold mb-4">
                <i data-lucide="activity" class="w-8 h-8"></i>
            </div>
            <h2 class="text-2xl font-bold text-text-main">عيادتنا الذكية</h2>
            <span class="text-xs text-text-main opacity-60 font-semibold mt-1">تسجيل الدخول للنظام</span>
        </div>

        @if ($errors->any())
            <div class="mb-6 alert-warning alert-box">
                <i data-lucide="alert-circle" class="w-5 h-5 shrink-0"></i>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            
            <div>
                <label class="block text-xs font-bold text-text-main opacity-80 mb-2">اسم المستخدم (Username)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-text-main opacity-50">
                        <i data-lucide="user" class="w-4 h-4"></i>
                    </div>
                    <input type="text" name="username" value="{{ old('username') }}" required autofocus
                           class="w-full custom-inset border-none focus:outline-none focus:ring-2 focus:ring-pink-400 rounded-xl py-3 pr-10 pl-4 text-sm font-medium text-text-main placeholder-text-main placeholder-opacity-50" 
                           placeholder="أدخل اسم المستخدم...">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-text-main opacity-80 mb-2">كلمة المرور (Password)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-text-main opacity-50">
                        <i data-lucide="lock" class="w-4 h-4"></i>
                    </div>
                    <input type="password" name="password" required
                           class="w-full custom-inset border-none focus:outline-none focus:ring-2 focus:ring-pink-400 rounded-xl py-3 pr-10 pl-4 text-sm font-medium text-text-main placeholder-text-main placeholder-opacity-50" 
                           placeholder="أدخل كلمة المرور...">
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full py-3 px-4 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-emerald-500 to-emerald-400 hover-press shadow-soft-out-sm flex justify-center items-center gap-2">
                    <span>دخول آمن</span>
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                </button>
            </div>
        </form>

        <div class="mt-8 pt-6 border-t border-slate-200/20 text-center">
             <span class="text-[11px] text-text-main opacity-50 font-semibold block mb-2">حسابات للتجربة:</span>
             <div class="flex justify-center gap-4 text-[10px] text-text-main opacity-70 font-['Outfit'] font-bold">
                 <span>User: admin / Pass: 123456</span>
                 <span>|</span>
                 <span>User: employee / Pass: 123456</span>
             </div>
        </div>

    </div>

    <script>
        lucide.createIcons();
        // Load saved theme to match dashboard style
        const savedTheme = localStorage.getItem('theme') || 'soft';
        document.body.setAttribute('data-theme', savedTheme);
        
        // Setup initial UI states based on theme
        const btn = document.querySelector('button[type="submit"]');
        if (savedTheme === 'brutal') {
            btn.className = 'w-full py-3 px-4 border-3 border-black text-sm font-bold bg-[#ffde43] text-black hover-press shadow-[4px_4px_0px_#000000] flex justify-center items-center gap-2';
        } else if (savedTheme === 'minimalist') {
            btn.className = 'w-full py-3 px-4 rounded-lg text-sm font-medium text-white bg-slate-900 hover:bg-slate-800 flex justify-center items-center gap-2';
        } else if (savedTheme === 'excel') {
            btn.className = 'w-full py-2 px-4 border border-[#107c41] bg-[#107c41] text-white text-sm font-bold hover:bg-[#0b592e] flex justify-center items-center gap-2';
        }
    </script>
</body>
</html>
