<!-- PAGE 4: SETTINGS PAGE SECTION (Full Settings page) -->
<section id="page-settings" class="page-section space-y-6 hidden">
    <!-- Visual theme switcher general settings -->
    <div class="custom-card p-6">
        <h3 class="text-md font-bold text-text-main mb-4 flex items-center gap-2">
            <i data-lucide="palette" class="w-5 h-5 text-pink-500"></i>
            مظهر النظام والهوية البصرية (Theme Paradigm)
        </h3>
        <p class="text-xs text-text-main opacity-60 mb-6 leading-relaxed">
            قم بتغيير مظهر النظام بالكامل وتغيير الهوية البصرية. سيقوم هذا الإعداد بتحديث ألوان الواجهة، نوع الخطوط، والنمط العام بناءً على اختيارك فوراً.
        </p>
        
        <div class="flex flex-wrap gap-4">
            <button onclick="changeTheme('soft')" class="theme-btn py-3 px-5 rounded-xl text-xs font-bold custom-card flex items-center gap-3 text-text-main animate-fade-in" data-theme-btn="soft">
                <span class="w-4 h-4 rounded-full bg-[#eef2f7] border border-slate-300"></span>
                ثيم ناعم (Soft UI)
            </button>
            <button onclick="changeTheme('glass')" class="theme-btn py-3 px-5 rounded-xl text-xs font-bold custom-card flex items-center gap-3 text-text-main" data-theme-btn="glass">
                <span class="w-4 h-4 rounded-full bg-gradient-to-r from-pink-500 to-sky-500 border border-slate-300 animate-pulse"></span>
                ثيم زجاجي (Glassmorphism)
            </button>
            <button onclick="changeTheme('brutal')" class="theme-btn py-3 px-5 rounded-xl text-xs font-bold custom-card flex items-center gap-3 text-text-main" data-theme-btn="brutal">
                <span class="w-4 h-4 rounded-full bg-[#ffde43] border-2 border-black"></span>
                ثيم قاسي (Brutalism)
            </button>
            <button onclick="changeTheme('minimalist')" class="theme-btn py-3 px-5 rounded-xl text-xs font-bold custom-card flex items-center gap-3 text-text-main" data-theme-btn="minimalist">
                <span class="w-4 h-4 rounded-full bg-[#ffffff] border border-slate-300"></span>
                ثيم بسيط (Minimalist)
            </button>
            <button onclick="changeTheme('excel')" class="theme-btn py-3 px-5 rounded-xl text-xs font-bold custom-card flex items-center gap-3 text-text-main" data-theme-btn="excel">
                <span class="w-4 h-4 rounded-full bg-[#107c41] border border-slate-300"></span>
                ثيم إكسل (Excel)
            </button>
        </div>
    </div>




</section>
