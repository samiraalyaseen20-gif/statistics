<!-- PAGE 4: SETTINGS PAGE SECTION (Full Settings page) -->
<section id="page-settings" class="page-section space-y-6 hidden">

    <!-- Visual theme switcher -->
    <div class="custom-card p-6">
        <h3 class="text-md font-bold text-text-main mb-4 flex items-center gap-2">
            <i data-lucide="palette" class="w-5 h-5 text-pink-500"></i>
            مظهر النظام والهوية البصرية
        </h3>
        <p class="text-xs text-text-main opacity-60 mb-6 leading-relaxed">
            قم بتغيير مظهر النظام بالكامل وتغيير الهوية البصرية. سيقوم هذا الإعداد بتحديث ألوان الواجهة فوراً.
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

    <!-- System Settings -->
    <div class="custom-card p-6">
        <h3 class="text-md font-bold text-text-main mb-1 flex items-center gap-2">
            <i data-lucide="settings-2" class="w-5 h-5 text-violet-500"></i>
            إعدادات النظام
        </h3>
        <p class="text-xs text-text-main opacity-55 mb-5 leading-relaxed">
            تحكم في خيارات العرض وميزات التقارير.
        </p>

        <div class="divide-y divide-slate-200/20">

            <!-- Row: Copyright -->
            <div class="flex items-center justify-between py-4">
                <div class="flex items-center gap-3">
                    <i data-lucide="copyright" class="w-4 h-4 text-violet-400 shrink-0"></i>
                    <div>
                        <p class="text-sm font-semibold text-text-main leading-tight">هامش حقوق الملكية</p>
                        <p class="text-[11px] text-slate-400 mt-0.5">إظهار "جميع الحقوق محفوظة لدى المهندسة سميره علي ياسين" أسفل كل جدول تفصيلي</p>
                    </div>
                </div>
                <!-- Toggle Switch -->
                <label class="setting-toggle shrink-0 ms-6 cursor-pointer" title="تفعيل / تعطيل هامش الملكية">
                    <input type="checkbox" id="copyright-checkbox" onchange="toggleCopyrightSetting(this)"
                        class="sr-only" {{ $showCopyright ? 'checked' : '' }}>
                    <span class="setting-toggle-track">
                        <span class="setting-toggle-thumb"></span>
                    </span>
                </label>
            </div>

        </div>
    </div>

</section>

<style>
/* ── Clean Toggle Switch ───────────────── */
.setting-toggle { display: inline-flex; align-items: center; }

.setting-toggle-track {
    display: block;
    width: 44px;
    height: 24px;
    border-radius: 999px;
    background: #cbd5e1;
    position: relative;
    transition: background 0.25s ease;
}

.setting-toggle input:checked + .setting-toggle-track {
    background: #8b5cf6;
}

.setting-toggle-thumb {
    position: absolute;
    top: 3px;
    right: 3px;
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: #fff;
    box-shadow: 0 1px 4px rgba(0,0,0,0.18);
    transition: transform 0.25s ease;
}

.setting-toggle input:checked + .setting-toggle-track .setting-toggle-thumb {
    transform: translateX(-20px);
}
</style>

<script>
function toggleCopyrightSetting(checkbox) {
    const enabled = checkbox.checked;

    fetch('/api/settings', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ key: 'show_copyright', value: enabled ? '1' : '0' })
    }).then(r => r.json()).then(data => {
        if (!data.success) {
            // rollback
            checkbox.checked = !enabled;
        }
    }).catch(() => {
        checkbox.checked = !enabled;
    });
}
</script>
