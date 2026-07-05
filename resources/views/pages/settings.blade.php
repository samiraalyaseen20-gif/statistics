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

    <!-- Copyright watermark control -->
    <div class="custom-card p-6">
        <h3 class="text-md font-bold text-text-main mb-1 flex items-center gap-2">
            <i data-lucide="copyright" class="w-5 h-5 text-violet-500"></i>
            هامش حقوق الملكية
        </h3>
        <p class="text-xs text-text-main opacity-55 mb-6 leading-relaxed">
            التحكم في إظهار أو إخفاء نص حقوق الملكية أسفل كل جدول عمليات تفصيلي في التقارير.
        </p>

        <!-- Toggle Row -->
        <div class="flex items-center justify-between max-w-lg p-4 rounded-2xl border border-slate-200/20 bg-slate-50/30 dark:bg-slate-800/20">
            <!-- Info side -->
            <div class="flex items-center gap-3">
                <div id="copyright-icon-wrap" class="w-10 h-10 rounded-xl flex items-center justify-center transition-all duration-300 bg-slate-200/60">
                    <i data-lucide="eye-off" id="copyright-lucide-icon" class="w-5 h-5 text-slate-500 transition-all duration-300"></i>
                </div>
                <div>
                    <p id="copyright-toggle-label" class="text-sm font-bold text-text-main leading-tight">إظهار الهامش</p>
                    <p id="copyright-toggle-sub" class="text-[10px] text-slate-400 mt-0.5">اضغط للتغيير</p>
                </div>
            </div>

            <!-- Toggle switch -->
            <button
                id="copyright-toggle-btn"
                onclick="toggleCopyrightSetting()"
                role="switch"
                aria-checked="false"
                class="relative w-14 h-7 rounded-full transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-violet-400 focus:ring-offset-2 bg-slate-300 cursor-pointer border-0"
                style="padding:0">
                <span
                    id="copyright-toggle-dot"
                    class="absolute top-1 right-1 w-5 h-5 rounded-full bg-white shadow-md transition-all duration-300 flex items-center justify-center">
                    <i data-lucide="x" id="copyright-dot-icon" class="w-2.5 h-2.5 text-slate-400 transition-all duration-300"></i>
                </span>
            </button>
        </div>

        <!-- Status note -->
        <p id="copyright-status-note" class="mt-3 text-[11px] font-medium text-slate-400 flex items-center gap-1.5 transition-all duration-300">
            <i data-lucide="info" class="w-3 h-3"></i>
            <span id="copyright-status-text">الهامش حالياً غير مفعّل</span>
        </p>
    </div>

</section>

<script>
// ── Copyright Setting Toggle ──────────────────────────────
let _copyrightEnabled = {{ $showCopyright ? 'true' : 'false' }};

function updateCopyrightToggleUI() {
    const btn       = document.getElementById('copyright-toggle-btn');
    const dot       = document.getElementById('copyright-toggle-dot');
    const dotIcon   = document.getElementById('copyright-dot-icon');
    const iconWrap  = document.getElementById('copyright-icon-wrap');
    const lucideIcon= document.getElementById('copyright-lucide-icon');
    const label     = document.getElementById('copyright-toggle-label');
    const sub       = document.getElementById('copyright-toggle-sub');
    const statusTxt = document.getElementById('copyright-status-text');

    if (_copyrightEnabled) {
        // Track: violet
        btn.style.backgroundColor = '#8b5cf6';
        btn.setAttribute('aria-checked', 'true');
        // Dot: slide to left (RTL: to left = translateX positive)
        dot.style.transform = 'translateX(-112%)';
        // Dot icon: check mark
        dotIcon.setAttribute('data-lucide', 'check');
        dotIcon.className = 'w-2.5 h-2.5 text-violet-500 transition-all duration-300';
        // Icon wrap
        iconWrap.className = 'w-10 h-10 rounded-xl flex items-center justify-center transition-all duration-300 bg-violet-100';
        lucideIcon.setAttribute('data-lucide', 'eye');
        lucideIcon.className = 'w-5 h-5 text-violet-600 transition-all duration-300';
        // Label
        label.textContent = 'هامش الملكية مفعّل';
        sub.textContent   = 'سيظهر النص أسفل كل جدول طبيب';
        statusTxt.textContent = '✓ الهامش ظاهر حالياً في جميع تقارير العمليات التفصيلية';
        document.getElementById('copyright-status-note').className =
            'mt-3 text-[11px] font-medium text-violet-500 flex items-center gap-1.5 transition-all duration-300';
    } else {
        // Track: grey
        btn.style.backgroundColor = '';
        btn.setAttribute('aria-checked', 'false');
        // Dot: original position
        dot.style.transform = '';
        // Dot icon: X
        dotIcon.setAttribute('data-lucide', 'x');
        dotIcon.className = 'w-2.5 h-2.5 text-slate-400 transition-all duration-300';
        // Icon wrap
        iconWrap.className = 'w-10 h-10 rounded-xl flex items-center justify-center transition-all duration-300 bg-slate-200/60';
        lucideIcon.setAttribute('data-lucide', 'eye-off');
        lucideIcon.className = 'w-5 h-5 text-slate-500 transition-all duration-300';
        // Label
        label.textContent = 'هامش الملكية مخفي';
        sub.textContent   = 'لن يظهر النص في التقارير';
        statusTxt.textContent = 'الهامش مخفي حالياً من جميع التقارير';
        document.getElementById('copyright-status-note').className =
            'mt-3 text-[11px] font-medium text-slate-400 flex items-center gap-1.5 transition-all duration-300';
    }

    // Re-init lucide icons for new icon names
    if (typeof lucide !== 'undefined') lucide.createIcons();
}

function toggleCopyrightSetting() {
    _copyrightEnabled = !_copyrightEnabled;
    updateCopyrightToggleUI();

    fetch('/api/settings', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ key: 'show_copyright', value: _copyrightEnabled ? '1' : '0' })
    }).then(r => r.json()).then(data => {
        if (!data.success) {
            _copyrightEnabled = !_copyrightEnabled;
            updateCopyrightToggleUI();
        }
    }).catch(() => {
        _copyrightEnabled = !_copyrightEnabled;
        updateCopyrightToggleUI();
    });
}

document.addEventListener('DOMContentLoaded', function() {
    updateCopyrightToggleUI();
});
</script>
