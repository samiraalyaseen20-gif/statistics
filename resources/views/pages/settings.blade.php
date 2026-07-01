<!-- PAGE 4: SETTINGS PAGE SECTION (Full Settings page) -->
<section id="page-settings" class="page-section space-y-6 hidden">
    <!-- Visual theme switcher general settings -->
    <div class="custom-card p-6">
        <h3 class="text-md font-bold text-text-main mb-4 flex items-center gap-2">
            <i data-lucide="palette" class="w-5 h-5 text-pink-500"></i>
            مظهر النظام والهوية البصرية (Theme Paradigm)
        </h3>
        <p class="text-xs text-text-main opacity-60 mb-6 leading-relaxed">
            قم باختيار مدرسة التصميم والهوية البصرية المفضلة لديك. سيقوم هذا الإعداد بتحديث مظهر الشريط الجانبي والجدول والنوافذ المنبثقة وكافة الرسوم البيانية فورياً في جميع الصفحات معاً.
        </p>
        
        <div class="flex flex-wrap gap-4">
            <button onclick="changeTheme('soft')" class="theme-btn py-3 px-5 rounded-xl text-xs font-bold custom-card flex items-center gap-3 text-text-main animate-fade-in" data-theme-btn="soft">
                <span class="w-4 h-4 rounded-full bg-[#eef2f7] border border-slate-300"></span>
                ثيم سوفت (Soft UI)
            </button>
            <button onclick="changeTheme('glass')" class="theme-btn py-3 px-5 rounded-xl text-xs font-bold custom-card flex items-center gap-3 text-text-main" data-theme-btn="glass">
                <span class="w-4 h-4 rounded-full bg-gradient-to-r from-pink-500 to-sky-500 border border-slate-300 animate-pulse"></span>
                ثيم زجاجي (Glassmorphism)
            </button>
            <button onclick="changeTheme('brutal')" class="theme-btn py-3 px-5 rounded-xl text-xs font-bold custom-card flex items-center gap-3 text-text-main" data-theme-btn="brutal">
                <span class="w-4 h-4 rounded-full bg-[#ffde43] border-2 border-black"></span>
                ثيم بروتاليزم (Brutalism)
            </button>
            <button onclick="changeTheme('minimalist')" class="theme-btn py-3 px-5 rounded-xl text-xs font-bold custom-card flex items-center gap-3 text-text-main" data-theme-btn="minimalist">
                <span class="w-4 h-4 rounded-full bg-[#ffffff] border border-slate-300"></span>
                ثيم مبسط (Minimalist)
            </button>
            <button onclick="changeTheme('excel')" class="theme-btn py-3 px-5 rounded-xl text-xs font-bold custom-card flex items-center gap-3 text-text-main" data-theme-btn="excel">
                <span class="w-4 h-4 rounded-full bg-[#107c41] border border-slate-300"></span>
                ثيم إكسل (Excel)
            </button>
        </div>
    </div>

    <!-- Clinic Details settings -->
    <div class="custom-card p-6">
        <h3 class="text-md font-bold text-text-main mb-4 flex items-center gap-2">
            <i data-lucide="building" class="w-5 h-5 text-emerald-500"></i>
            إعدادات ملف المركز الأساسية
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-[11px] font-bold text-text-main opacity-80 mb-2">اسم المركز الطبي</label>
                <input type="text" value="مجمع الشفاء الذكي" class="w-full custom-inset border-none focus:outline-none focus:ring-0 rounded-xl py-2.5 px-4 text-xs font-medium text-text-main">
            </div>
            <div>
                <label class="block text-[11px] font-bold text-text-main opacity-80 mb-2">ساعات العمل اليومية</label>
                <input type="text" value="08:00 AM - 10:00 PM" class="w-full custom-inset border-none focus:outline-none focus:ring-0 rounded-xl py-2.5 px-4 text-xs font-medium text-text-main">
            </div>
        </div>
    </div>

    <!-- Financial Settings Card -->
    <div class="custom-card p-6">
        <h3 class="text-md font-bold text-text-main mb-4 flex items-center gap-2">
            <i data-lucide="wallet" class="w-5 h-5 text-amber-500"></i>
            الصناديق والربط المالي
        </h3>
        <div class="space-y-4">
            <div class="flex justify-between items-center p-3 rounded-xl custom-inset">
                <div>
                    <h4 class="text-xs font-bold text-text-main">فصل صناديق الصيدلية والمختبر</h4>
                    <p class="text-[10px] text-text-main opacity-60">تفعيل صناديق مالية مستقلة للمبيعات الصيدلانية والفحوصات المخبرية</p>
                </div>
                <span class="badge-success shadow-soft-out-sm">مفعل تلقائياً</span>
            </div>
            <div class="flex justify-between items-center p-3 rounded-xl custom-inset">
                <div>
                    <h4 class="text-xs font-bold text-text-main">الربط الآلي مع حسابات الأطباء</h4>
                    <p class="text-[10px] text-text-main opacity-60">تحديث إيرادات الأطباء تلقائياً بناءً على كشفيات استشارياتهم المسجلة</p>
                </div>
                <span class="badge-success shadow-soft-out-sm">نشط</span>
            </div>
        </div>
    </div>
</section>
