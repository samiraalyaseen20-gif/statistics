@php
$pathsHtml = '';
if (file_exists(base_path('iraq.svg'))) {
    $svgContent = file_get_contents(base_path('iraq.svg'));
    if (preg_match_all('/<path[^>]+>/i', $svgContent, $matches)) {
        $pathsHtml = implode("\n", $matches[0]);
    }
}
@endphp
{{-- PAGE: CLINICAL COMPARISON DASHBOARD (لوحة المفاضلة السريرية) --}}
<section id="page-comparison" class="page-section space-y-6 hidden">

    {{-- ══ Header / Filter Bar ══ --}}
    <div class="custom-card p-4 rounded-2xl">
        <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-violet-500/10 flex items-center justify-center text-violet-500">
                    <i data-lucide="git-compare" class="w-4 h-4"></i>
                </div>
                <div>
                    <h2 class="text-xs font-bold text-text-main">لوحة المفاضلة السريرية</h2>
                    <p class="text-[9px] text-slate-400 mt-0.5">مقارنة تفاعلية شاملة بين طبيبين أو فترتين زمنيتين</p>
                </div>
            </div>
            <button onclick="runComparison()" id="cmp-run-btn"
                class="py-2 px-5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-violet-500 to-purple-500 hover-press flex items-center gap-2 shadow-md">
                <i data-lucide="zap" class="w-3.5 h-3.5"></i>
                <span>تنفيذ المقارنة</span>
            </button>
        </div>

        {{-- Filter Panels --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            {{-- Side A --}}
            <div class="bg-blue-500/5 border border-blue-400/20 rounded-xl p-4 space-y-3">
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 rounded-full bg-blue-500 flex items-center justify-center text-white text-[9px] font-black">أ</div>
                    <span class="text-[10px] font-bold text-blue-600">الجهة الأولى (أ)</span>
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <div class="flex flex-col gap-1">
                        <label class="text-[9px] font-bold text-slate-400">الطبيب:</label>
                        <select id="cmp-doc-a" class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-2 text-[10px] font-bold text-text-main font-['Tajawal']">
                            <option value="">كل الأطباء</option>
                            @foreach($filterDoctors as $doc)
                            <option value="{{ $doc->id }}">{{ $doc->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-[9px] font-bold text-slate-400">من:</label>
                        <input type="date" id="cmp-from-a" value="{{ $start_date ?? '2026-05-01' }}"
                            class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-2 text-[10px] font-bold text-text-main custom-date-input">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-[9px] font-bold text-slate-400">إلى:</label>
                        <input type="date" id="cmp-to-a" value="{{ $end_date ?? '2026-05-31' }}"
                            class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-2 text-[10px] font-bold text-text-main custom-date-input">
                    </div>
                </div>
            </div>
            {{-- Side B --}}
            <div class="bg-rose-500/5 border border-rose-400/20 rounded-xl p-4 space-y-3">
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 rounded-full bg-rose-500 flex items-center justify-center text-white text-[9px] font-black">ب</div>
                    <span class="text-[10px] font-bold text-rose-600">الجهة الثانية (ب)</span>
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <div class="flex flex-col gap-1">
                        <label class="text-[9px] font-bold text-slate-400">الطبيب:</label>
                        <select id="cmp-doc-b" class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-2 text-[10px] font-bold text-text-main font-['Tajawal']">
                            <option value="">كل الأطباء</option>
                            @foreach($filterDoctors as $doc)
                            <option value="{{ $doc->id }}">{{ $doc->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-[9px] font-bold text-slate-400">من:</label>
                        <input type="date" id="cmp-from-b" value="{{ $start_date ?? '2026-05-01' }}"
                            class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-2 text-[10px] font-bold text-text-main custom-date-input">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-[9px] font-bold text-slate-400">إلى:</label>
                        <input type="date" id="cmp-to-b" value="{{ $end_date ?? '2026-05-31' }}"
                            class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-2 text-[10px] font-bold text-text-main custom-date-input">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Loading Spinner --}}
    <div id="cmp-loading" class="hidden">
        <div class="flex flex-col items-center justify-center py-16 gap-3">
            <div class="w-10 h-10 border-4 border-violet-400/30 border-t-violet-500 rounded-full animate-spin"></div>
            <p class="text-xs text-slate-400 font-bold">جاري تحليل ومقارنة البيانات...</p>
        </div>
    </div>

    {{-- ══ RESULTS (hidden until first run) ══ --}}
    <div id="cmp-results" class="hidden space-y-6">

        {{-- ═══ KPI Summary Row ═══ --}}
        <div class="grid grid-cols-3 gap-4">
            <div class="custom-card p-4 rounded-2xl text-center space-y-2">
                <div class="flex items-center justify-center gap-1.5 mb-2">
                    <i data-lucide="users" class="w-3.5 h-3.5 text-emerald-500"></i>
                    <span class="text-[10px] font-bold text-text-main">الزيارات</span>
                </div>
                <div class="flex gap-2 justify-center">
                    <div class="flex-1 bg-blue-50 rounded-lg py-2">
                        <div class="text-[8px] text-blue-400 font-bold mb-0.5">أ</div>
                        <div id="kpi-v-a" class="text-base font-black text-blue-600">—</div>
                    </div>
                    <div class="flex-1 bg-rose-50 rounded-lg py-2">
                        <div class="text-[8px] text-rose-400 font-bold mb-0.5">ب</div>
                        <div id="kpi-v-b" class="text-base font-black text-rose-600">—</div>
                    </div>
                </div>
                <div id="kpi-v-diff" class="text-[9px] font-bold text-slate-400">—</div>
            </div>
            <div class="custom-card p-4 rounded-2xl text-center space-y-2">
                <div class="flex items-center justify-center gap-1.5 mb-2">
                    <i data-lucide="eye" class="w-3.5 h-3.5 text-orange-500"></i>
                    <span class="text-[10px] font-bold text-text-main">الفحوصات</span>
                </div>
                <div class="flex gap-2 justify-center">
                    <div class="flex-1 bg-blue-50 rounded-lg py-2">
                        <div class="text-[8px] text-blue-400 font-bold mb-0.5">أ</div>
                        <div id="kpi-t-a" class="text-base font-black text-blue-600">—</div>
                    </div>
                    <div class="flex-1 bg-rose-50 rounded-lg py-2">
                        <div class="text-[8px] text-rose-400 font-bold mb-0.5">ب</div>
                        <div id="kpi-t-b" class="text-base font-black text-rose-600">—</div>
                    </div>
                </div>
                <div id="kpi-t-diff" class="text-[9px] font-bold text-slate-400">—</div>
            </div>
            <div class="custom-card p-4 rounded-2xl text-center space-y-2">
                <div class="flex items-center justify-center gap-1.5 mb-2">
                    <i data-lucide="scissors" class="w-3.5 h-3.5 text-rose-500"></i>
                    <span class="text-[10px] font-bold text-text-main">العمليات</span>
                </div>
                <div class="flex gap-2 justify-center">
                    <div class="flex-1 bg-blue-50 rounded-lg py-2">
                        <div class="text-[8px] text-blue-400 font-bold mb-0.5">أ</div>
                        <div id="kpi-s-a" class="text-base font-black text-blue-600">—</div>
                    </div>
                    <div class="flex-1 bg-rose-50 rounded-lg py-2">
                        <div class="text-[8px] text-rose-400 font-bold mb-0.5">ب</div>
                        <div id="kpi-s-b" class="text-base font-black text-rose-600">—</div>
                    </div>
                </div>
                <div id="kpi-s-diff" class="text-[9px] font-bold text-slate-400">—</div>
            </div>
        </div>

        {{-- ═══ جدول 1: الاستشاريات ═══ --}}
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="stethoscope" class="w-4 h-4 text-pink-500"></i>
                جدول (1): مقارنة أعداد المراجعين في الاستشاريات
            </h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <div class="cmp-side-label-a mb-3"></div>
                    <div class="flex justify-center"><svg id="cmp-svg-1-a" viewBox="0 0 350 200" class="w-full max-w-[320px] h-auto overflow-visible"></svg></div>
                    <div class="overflow-x-auto mt-3">
                        <table class="custom-table text-xs w-full"><thead><tr><th>الوحدة</th><th class="text-center">العدد</th></tr></thead>
                        <tbody id="cmp-tbl-1-a"><tr><td colspan="2" class="text-center text-slate-300 py-4 text-[10px]">في انتظار البيانات...</td></tr></tbody></table>
                    </div>
                </div>
                <div>
                    <div class="cmp-side-label-b mb-3"></div>
                    <div class="flex justify-center"><svg id="cmp-svg-1-b" viewBox="0 0 350 200" class="w-full max-w-[320px] h-auto overflow-visible"></svg></div>
                    <div class="overflow-x-auto mt-3">
                        <table class="custom-table text-xs w-full"><thead><tr><th>الوحدة</th><th class="text-center">العدد</th></tr></thead>
                        <tbody id="cmp-tbl-1-b"><tr><td colspan="2" class="text-center text-slate-300 py-4 text-[10px]">في انتظار البيانات...</td></tr></tbody></table>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══ جدول 2: مراجعو كل طبيب ═══ --}}
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="users" class="w-4 h-4 text-emerald-500"></i>
                جدول (2): مقارنة مراجعي الاستشارية لكل طبيب اختصاص
            </h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <div class="cmp-side-label-a mb-2"></div>
                    <div class="w-full overflow-x-auto py-2">
                        <svg id="cmp-svg-2-a" viewBox="0 0 900 240" class="w-full min-w-[600px] h-[240px] overflow-visible"></svg>
                    </div>
                </div>
                <div>
                    <div class="cmp-side-label-b mb-2"></div>
                    <div class="w-full overflow-x-auto py-2">
                        <svg id="cmp-svg-2-b" viewBox="0 0 900 240" class="w-full min-w-[600px] h-[240px] overflow-visible"></svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══ جداول 3 & 4: التوزيع الجغرافي ═══ --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- داخل العراق --}}
            <div class="custom-card p-6 rounded-2xl">
                <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                    <i data-lucide="flag" class="w-4 h-4 text-sky-500"></i>
                    جدول (3): مقارنة التوزيع الجغرافي داخل العراق
                </h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div>
                        <div class="cmp-side-label-a mb-2"></div>
                        <div class="w-full overflow-x-auto py-1">
                            <svg id="cmp-svg-3-a" viewBox="0 0 584 594" class="w-full max-w-[320px] h-[340px] overflow-visible mx-auto">
                                <g id="cmp-svg-3-a-paths" fill="rgba(14, 165, 233, 0.03)" stroke="#cbd5e1" stroke-width="1.2">
                                    {!! $pathsHtml !!}
                                </g>
                                <g id="cmp-svg-3-a-nodes"></g>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <div class="cmp-side-label-b mb-2"></div>
                        <div class="w-full overflow-x-auto py-1">
                            <svg id="cmp-svg-3-b" viewBox="0 0 584 594" class="w-full max-w-[320px] h-[340px] overflow-visible mx-auto">
                                <g id="cmp-svg-3-b-paths" fill="rgba(14, 165, 233, 0.03)" stroke="#cbd5e1" stroke-width="1.2">
                                    {!! $pathsHtml !!}
                                </g>
                                <g id="cmp-svg-3-b-nodes"></g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            {{-- خارج العراق --}}
            <div class="custom-card p-6 rounded-2xl">
                <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                    <i data-lucide="globe" class="w-4 h-4 text-pink-500"></i>
                    جدول (4): مقارنة المراجعين من خارج العراق
                </h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div>
                        <div class="cmp-side-label-a mb-2"></div>
                        <div class="w-full overflow-x-auto py-1">
                            <svg id="cmp-svg-4-a" viewBox="0 0 450 180" class="w-full min-w-[300px] h-auto overflow-visible"></svg>
                        </div>
                    </div>
                    <div>
                        <div class="cmp-side-label-b mb-2"></div>
                        <div class="w-full overflow-x-auto py-1">
                            <svg id="cmp-svg-4-b" viewBox="0 0 450 180" class="w-full min-w-[300px] h-auto overflow-visible"></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══ جداول 5 & 6: الفحوصات والتحاليل ═══ --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- فحوصات بصرية --}}
            <div class="custom-card p-6 rounded-2xl">
                <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                    <i data-lucide="eye" class="w-4 h-4 text-orange-500"></i>
                    جدول (5): مقارنة الفحوصات البصرية والساندة
                </h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div>
                        <div class="cmp-side-label-a mb-2"></div>
                        <div class="w-full overflow-x-auto py-1">
                            <svg id="cmp-svg-5-a" viewBox="0 0 450 200" class="w-full min-w-[300px] h-auto overflow-visible"></svg>
                        </div>
                    </div>
                    <div>
                        <div class="cmp-side-label-b mb-2"></div>
                        <div class="w-full overflow-x-auto py-1">
                            <svg id="cmp-svg-5-b" viewBox="0 0 450 200" class="w-full min-w-[300px] h-auto overflow-visible"></svg>
                        </div>
                    </div>
                </div>
            </div>
            {{-- تحاليل مختبرية --}}
            <div class="custom-card p-6 rounded-2xl">
                <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                    <i data-lucide="test-tube" class="w-4 h-4 text-purple-500"></i>
                    جدول (6): مقارنة التحاليل المختبرية
                </h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div>
                        <div class="cmp-side-label-a mb-2"></div>
                        <div class="w-full overflow-x-auto py-1">
                            <svg id="cmp-svg-6-a" viewBox="0 0 450 180" class="w-full min-w-[300px] h-[180px] overflow-visible"></svg>
                        </div>
                    </div>
                    <div>
                        <div class="cmp-side-label-b mb-2"></div>
                        <div class="w-full overflow-x-auto py-1">
                            <svg id="cmp-svg-6-b" viewBox="0 0 450 180" class="w-full min-w-[300px] h-[180px] overflow-visible"></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══ جدول 7: تصنيف العمليات ═══ --}}
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="scissors" class="w-4 h-4 text-rose-500"></i>
                جدول (7): مقارنة أعداد وتصنيف العمليات الجراحية للعيون
            </h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <div class="cmp-side-label-a mb-3"></div>
                    <div class="flex justify-center">
                        <svg id="cmp-svg-7-a" viewBox="0 0 520 220" class="w-full max-w-[480px] h-[220px] overflow-visible"></svg>
                    </div>
                    <div class="overflow-x-auto mt-3">
                        <table class="custom-table text-xs"><thead><tr><th>التصنيف</th><th class="text-center">العدد</th></tr></thead>
                        <tbody id="cmp-tbl-7-a"><tr><td colspan="2" class="text-center text-slate-300 py-4 text-[10px]">—</td></tr></tbody></table>
                    </div>
                </div>
                <div>
                    <div class="cmp-side-label-b mb-3"></div>
                    <div class="flex justify-center">
                        <svg id="cmp-svg-7-b" viewBox="0 0 520 220" class="w-full max-w-[480px] h-[220px] overflow-visible"></svg>
                    </div>
                    <div class="overflow-x-auto mt-3">
                        <table class="custom-table text-xs"><thead><tr><th>التصنيف</th><th class="text-center">العدد</th></tr></thead>
                        <tbody id="cmp-tbl-7-b"><tr><td colspan="2" class="text-center text-slate-300 py-4 text-[10px]">—</td></tr></tbody></table>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══ جدول 10: عمليات كل طبيب (إجمالي) ═══ --}}
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="award" class="w-4 h-4 text-violet-500"></i>
                جدول (10): مقارنة إجمالي العمليات الجراحية المنجزة لكل طبيب اختصاص
            </h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <div class="cmp-side-label-a mb-2"></div>
                    <div class="w-full overflow-x-auto py-2">
                        <svg id="cmp-svg-10-a" viewBox="0 0 900 240" class="w-full min-w-[600px] h-[240px] overflow-visible"></svg>
                    </div>
                </div>
                <div>
                    <div class="cmp-side-label-b mb-2"></div>
                    <div class="w-full overflow-x-auto py-2">
                        <svg id="cmp-svg-10-b" viewBox="0 0 900 240" class="w-full min-w-[600px] h-[240px] overflow-visible"></svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══ الإحصائية التفصيلية للعمليات ═══ --}}
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="user-cog" class="w-4 h-4 text-violet-500"></i>
                مقارنة الإحصائية التفصيلية للعمليات الجراحية
            </h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Side A Detail --}}
                <div>
                    <div class="cmp-side-label-a mb-3"></div>
                    <div class="flex flex-col gap-4">
                        <div class="w-full overflow-x-auto">
                            <svg id="cmp-svg-detail-a" viewBox="0 0 450 50" class="w-full h-auto overflow-visible"></svg>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="custom-table text-xs w-full">
                                <thead><tr><th>ت</th><th>اسم العملية</th><th>التصنيف</th><th class="text-center">العدد</th></tr></thead>
                                <tbody id="cmp-tbl-detail-a"><tr><td colspan="4" class="text-center text-slate-300 py-6 text-[10px]">—</td></tr></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- Side B Detail --}}
                <div>
                    <div class="cmp-side-label-b mb-3"></div>
                    <div class="flex flex-col gap-4">
                        <div class="w-full overflow-x-auto">
                            <svg id="cmp-svg-detail-b" viewBox="0 0 450 50" class="w-full h-auto overflow-visible"></svg>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="custom-table text-xs w-full">
                                <thead><tr><th>ت</th><th>اسم العملية</th><th>التصنيف</th><th class="text-center">العدد</th></tr></thead>
                                <tbody id="cmp-tbl-detail-b"><tr><td colspan="4" class="text-center text-slate-300 py-6 text-[10px]">—</td></tr></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══ Footer ═══ --}}
        <div class="custom-card p-5 rounded-2xl">
            <div class="grid grid-cols-2 gap-4 text-center text-xs text-text-main">
                <div class="border-l border-slate-200/20 pl-4 space-y-1.5">
                    <p class="font-bold opacity-60">المهندسة</p>
                    <p class="font-extrabold text-sm">سميره علي ياسين</p>
                    <p class="opacity-50 text-[10px]">مسؤول الإحصاء الطبي</p>
                </div>
                <div class="pr-4 space-y-1.5">
                    <p class="font-bold opacity-60">الطبيب الاستشاري</p>
                    <p class="font-extrabold text-sm">د. عدي عبد الحسين السالمي</p>
                    <p class="opacity-50 text-[10px]">مدير مركز السيدة زينب(ع) الجراحي التخصصي للعيون</p>
                </div>
            </div>
        </div>

    </div>{{-- end #cmp-results --}}

</section>

<style>
.cmp-side-badge-a {
    display:inline-flex; align-items:center; gap:5px;
    background:#3b82f6; color:#fff; font-size:9px; font-weight:800;
    padding:2px 10px; border-radius:20px; font-family:'Outfit',sans-serif;
}
.cmp-side-badge-b {
    display:inline-flex; align-items:center; gap:5px;
    background:#f43f5e; color:#fff; font-size:9px; font-weight:800;
    padding:2px 10px; border-radius:20px; font-family:'Outfit',sans-serif;
}
</style>

<script>
// ═══════════════════════════════════════════════════════════════
//  COMPARISON PAGE ENGINE — Full Mirror of Reports Page
// ═══════════════════════════════════════════════════════════════

const CMP_COLORS_A = ['#3b82f6','#2563eb','#60a5fa','#93c5fd','#bfdbfe','#dbeafe','#1d4ed8','#1e40af','#1e3a8a','#172554','#3730a3','#312e81'];
const CMP_COLORS_B = ['#f43f5e','#e11d48','#fb7185','#fda4af','#f87171','#fca5a5','#ef4444','#dc2626','#b91c1c','#991b1b','#7f1d1d','#450a0a'];

// ── Scroll-triggered chart animation registry (comparison) ──
const _cmpSvgDrawFns = new Map();
const _cmpScrollObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const fn = _cmpSvgDrawFns.get(entry.target.id);
            if (fn) fn();
        }
    });
}, { threshold: 0.15 });

function cmpWatchChart(svgId, drawFn) {
    _cmpSvgDrawFns.set(svgId, drawFn);
    const el = document.getElementById(svgId);
    if (el) _cmpScrollObserver.observe(el);
    else drawFn(); // fallback: draw immediately if SVG not found yet
}
// ───────────────────────────────────────────────────────────────

const CMP_BADGE = {
    'خاصة':       'bg-purple-100 text-purple-700',
    'فوق الكبرى': 'bg-rose-100 text-rose-700',
    'كبرى':       'bg-orange-100 text-orange-700',
    'وسطى (حقن)': 'bg-blue-100 text-blue-700',
    'وسطى (ليزر)':'bg-blue-100 text-blue-700',
    'وسطى':       'bg-blue-100 text-blue-700',
    'صغرى':       'bg-yellow-100 text-yellow-700',
    'ليزر':       'bg-cyan-100 text-cyan-700',
};

// ── Helpers ──────────────────────────────────────────────────
function cmpDiff(elId, a, b) {
    const el = document.getElementById(elId);
    if (!el) return;
    const d = Number(a) - Number(b);
    if (d === 0) { el.textContent = 'متساويان'; el.className = 'text-[9px] font-bold text-slate-400'; }
    else if (d > 0) { el.textContent = `(أ) أعلى بـ ${Math.abs(d).toLocaleString()}`; el.className = 'text-[9px] font-bold text-blue-500'; }
    else { el.textContent = `(ب) أعلى بـ ${Math.abs(d).toLocaleString()}`; el.className = 'text-[9px] font-bold text-rose-500'; }
}

// Inject side labels into all .cmp-side-label-a and .cmp-side-label-b placeholders
function cmpInjectLabels(labelA, labelB) {
    document.querySelectorAll('.cmp-side-label-a').forEach(el => {
        el.innerHTML = `<span class="cmp-side-badge-a">● ${labelA}</span>`;
    });
    document.querySelectorAll('.cmp-side-label-b').forEach(el => {
        el.innerHTML = `<span class="cmp-side-badge-b">● ${labelB}</span>`;
    });
}

// ── Draw Branching Arrow (Table 1 consultations) ──────────────
function cmpDrawBranching(svgId, items, totalVal, colors) {
    const svg = document.getElementById(svgId);
    if (!svg) return;
    svg.innerHTML = '';

    const val1 = items[0]?.total || 0;
    const val2 = items[1]?.total || 0;
    const label1 = items[0]?.unit || '—';
    const label2 = items[1]?.unit || '—';
    const cx = 175;
    const cy = 180;
    const col1 = colors[0] || '#3b82f6';
    const col2 = colors[1] || '#ec4899';

    const leftPath = document.createElementNS("http://www.w3.org/2000/svg","path");
    leftPath.setAttribute('d',`M ${cx-15} ${cy} L ${cx-15} ${cy-50} C ${cx-15} ${cy-80} ${cx-50} ${cy-90} ${cx-70} ${cy-105} L ${cx-80} ${cy-97} L ${cx-65} ${cy-125} L ${cx-37} ${cy-107} L ${cx-47} ${cy-112} C ${cx-35} ${cy-100} ${cx-5} ${cy-90} ${cx-5} ${cy-50} L ${cx-5} ${cy} Z`);
    leftPath.setAttribute('fill', col1);
    svg.appendChild(leftPath);

    const rightPath = document.createElementNS("http://www.w3.org/2000/svg","path");
    rightPath.setAttribute('d',`M ${cx-15} ${cy} L ${cx-15} ${cy-50} C ${cx-15} ${cy-80} ${cx-50} ${cy-90} ${cx-70} ${cy-105} L ${cx-80} ${cy-97} L ${cx-65} ${cy-125} L ${cx-37} ${cy-107} L ${cx-47} ${cy-112} C ${cx-35} ${cy-100} ${cx-5} ${cy-90} ${cx-5} ${cy-50} L ${cx-5} ${cy} Z`);
    rightPath.setAttribute('fill', col2);
    rightPath.setAttribute('transform',`translate(${cx},0) scale(-1,1) translate(-${cx},0)`);
    svg.appendChild(rightPath);

    const totalStr = totalVal.toLocaleString();
    const tpW = Math.max(36, totalStr.length * 6.5 + 10);
    const tp = document.createElementNS("http://www.w3.org/2000/svg","rect");
    tp.setAttribute('x', cx - tpW/2); tp.setAttribute('y', cy-12);
    tp.setAttribute('width', tpW); tp.setAttribute('height',16);
    tp.setAttribute('rx','8'); tp.setAttribute('fill','#334155');
    svg.appendChild(tp);
    const tt = document.createElementNS("http://www.w3.org/2000/svg","text");
    tt.setAttribute('x',cx); tt.setAttribute('y',cy-0.5);
    tt.setAttribute('font-family','Outfit'); tt.setAttribute('font-size','10px');
    tt.setAttribute('font-weight','black'); tt.setAttribute('fill','#ffffff');
    tt.setAttribute('text-anchor','middle'); tt.textContent = totalStr;
    svg.appendChild(tt);

    [[val1, label1, cx-80, col1],[val2, label2, cx+80, col2]].forEach(([v,l,bx,bc]) => {
        const s = `${l}: ${v.toLocaleString()}`;
        const bw = s.length*6+12;
        const b = document.createElementNS("http://www.w3.org/2000/svg","rect");
        b.setAttribute('x', bx-bw/2); b.setAttribute('y',cy-145);
        b.setAttribute('width',bw); b.setAttribute('height',18);
        b.setAttribute('rx','9'); b.setAttribute('fill',bc);
        svg.appendChild(b);
        const bt = document.createElementNS("http://www.w3.org/2000/svg","text");
        bt.setAttribute('x',bx); bt.setAttribute('y',cy-133);
        bt.setAttribute('font-family','Tajawal'); bt.setAttribute('font-size','9px');
        bt.setAttribute('font-weight','bold'); bt.setAttribute('fill','#ffffff');
        bt.setAttribute('text-anchor','middle'); bt.textContent = s;
        svg.appendChild(bt);
    });
}

// ── Draw Vertical Arrows ──────────────────────────────────────
function cmpDrawVertical(svgId, values, labels, colors) {
    const svg = document.getElementById(svgId);
    if (!svg) return;
    svg.innerHTML = '';
    if (!values.length) { cmpDrawEmptySvg(svgId, 'لا بيانات'); return; }

    const maxVal = Math.max(...values, 1);
    const n = values.length;
    const viewBoxStr = svg.getAttribute('viewBox') || "0 0 900 240";
    const width  = parseInt(viewBoxStr.split(' ')[2]);
    const height = parseInt(viewBoxStr.split(' ')[3]);
    const marginL = 40, marginR = 40;
    const availableW = width - marginL - marginR;
    const spacing = n > 1 ? availableW / (n-1) : availableW;
    const floorY = n > 6 ? height-50 : height-30;

    const line = document.createElementNS("http://www.w3.org/2000/svg","line");
    line.setAttribute('x1',marginL-15); line.setAttribute('y1',floorY);
    line.setAttribute('x2',width-marginR+15); line.setAttribute('y2',floorY);
    line.setAttribute('stroke','#cbd5e1'); line.setAttribute('stroke-width','1.5');
    svg.appendChild(line);

    values.forEach((val, i) => {
        const x = marginL + i * spacing;
        const color = colors[i % colors.length];
        const minH = 20, maxH = floorY - 55;
        const scaleVal = maxVal > 1 ? Math.sqrt(val) / Math.sqrt(maxVal) : 1;
        const H = minH + (maxH - minH) * scaleVal;
        const startDelay = (i * 80) + 'ms';
        const dur = '0.65s';

        const g = document.createElementNS("http://www.w3.org/2000/svg","g");

        // ── Arrow Body — grows from floorY upwards ──
        const body = document.createElementNS("http://www.w3.org/2000/svg","rect");
        body.setAttribute('x',x-8); body.setAttribute('y',floorY-H);
        body.setAttribute('width','16'); body.setAttribute('height',H);
        body.setAttribute('fill',color); body.setAttribute('rx','1');
        body.style.transformOrigin = `${x}px ${floorY}px`;
        body.style.transform = 'scaleY(0)';
        body.style.transition = `transform ${dur} cubic-bezier(0.25,0.46,0.45,0.94) ${startDelay}`;
        g.appendChild(body);

        // ── Arrow Head ──
        const head = document.createElementNS("http://www.w3.org/2000/svg","polygon");
        head.setAttribute('points',`${x-12},${floorY-H} ${x+12},${floorY-H} ${x},${floorY-H-10}`);
        head.setAttribute('fill',color);
        head.style.opacity = '0';
        head.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
        g.appendChild(head);

        // ── Dashed + Pill + Value (appear after body finishes) ──
        const dashed = document.createElementNS("http://www.w3.org/2000/svg","line");
        dashed.setAttribute('x1',x); dashed.setAttribute('y1',floorY-H-12);
        dashed.setAttribute('x2',x); dashed.setAttribute('y2',floorY-H-26);
        dashed.setAttribute('stroke',color); dashed.setAttribute('stroke-width','1');
        dashed.setAttribute('stroke-dasharray','2 2');
        dashed.style.opacity = '0';
        dashed.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
        g.appendChild(dashed);

        const valStr = val.toLocaleString();
        const pillW = Math.max(20, valStr.length*6+6);
        const pill = document.createElementNS("http://www.w3.org/2000/svg","rect");
        pill.setAttribute('x',x-pillW/2); pill.setAttribute('y',floorY-H-36);
        pill.setAttribute('width',pillW); pill.setAttribute('height',14);
        pill.setAttribute('rx','7'); pill.setAttribute('fill',color);
        pill.style.opacity = '0';
        pill.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
        g.appendChild(pill);

        const tVal = document.createElementNS("http://www.w3.org/2000/svg","text");
        tVal.setAttribute('x',x); tVal.setAttribute('y',floorY-H-25.5);
        tVal.setAttribute('font-family','Outfit'); tVal.setAttribute('font-size','8.5px');
        tVal.setAttribute('font-weight','bold'); tVal.setAttribute('fill','#ffffff');
        tVal.setAttribute('text-anchor','middle'); tVal.textContent = valStr;
        tVal.style.opacity = '0';
        tVal.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
        g.appendChild(tVal);

        const label = document.createElementNS("http://www.w3.org/2000/svg","text");
        label.setAttribute('x', x-4);
        label.setAttribute('font-family','Tajawal'); label.setAttribute('font-weight','bold');
        label.setAttribute('fill','#64748b');

        let labelText = labels[i] || '';
        if (n > 6) {
            label.setAttribute('y', floorY+10);
            label.setAttribute('font-size','8.5px');
            label.setAttribute('text-anchor','end');
            label.setAttribute('transform',`rotate(28, ${x-4}, ${floorY+10})`);
            if (labelText.length > 25) labelText = labelText.substring(0,23)+'..';
        } else {
            label.setAttribute('x', x);
            label.setAttribute('y', floorY+16);
            label.setAttribute('font-size','9.5px');
            label.setAttribute('text-anchor','middle');
            if (labelText.length > 30) labelText = labelText.substring(0,27)+'..';
        }
        label.textContent = labelText;
        g.appendChild(label);

        svg.appendChild(g);
        // trigger entrance animation
        requestAnimationFrame(() => requestAnimationFrame(() => {
            body.style.transform = 'scaleY(1)';
            const totalMs = (parseFloat(startDelay) || 0) + parseFloat(dur) * 1000;
            setTimeout(() => {
                head.style.opacity = '1';
                dashed.style.opacity = '1';
                pill.style.opacity = '1';
                tVal.style.opacity = '1';
            }, totalMs);
        }));
    });
}

// ── Draw Horizontal Chevrons ──────────────────────────────────
function cmpDrawChevrons(svgId, values, labels, colors) {
    const svg = document.getElementById(svgId);
    if (!svg) return;
    svg.innerHTML = '';
    if (!values.length) { cmpDrawEmptySvg(svgId, 'لا بيانات'); return; }

    const n = values.length;
    const spacing = 42, marginT = 16, marginB = 16;
    const dynamicHeight = marginT + marginB + (n-1)*spacing + 22;
    svg.setAttribute('viewBox', `0 0 450 ${dynamicHeight}`);
    svg.style.height = `${dynamicHeight}px`;

    const maxVal = Math.max(...values, 1);
    const startX = 435, chartStartX = 10;
    const maxL = startX - chartStartX - 45;

    values.forEach((val, i) => {
        const labelY = marginT + i*spacing;
        const barY = labelY + 16;
        const color = colors[i % colors.length];
        const L = 15 + maxL * (val / maxVal);
        const endX = startX - L;
        const startDelay = (i * 80) + 'ms';
        const dur = '0.65s';

        const g = document.createElementNS("http://www.w3.org/2000/svg","g");

        // ── Label ──
        const label = document.createElementNS("http://www.w3.org/2000/svg","text");
        label.setAttribute('x',startX); label.setAttribute('y',labelY+4);
        label.setAttribute('font-family','Tajawal'); label.setAttribute('font-size','10.5px');
        label.setAttribute('font-weight','bold'); label.setAttribute('fill','#475569');
        label.setAttribute('text-anchor','end');
        label.textContent = labels[i] || '';
        g.appendChild(label);

        // ── Chevron Body — grows from startX leftwards via scaleX ──
        const body = document.createElementNS("http://www.w3.org/2000/svg","polygon");
        body.setAttribute('points',`${startX},${barY-6} ${endX+6},${barY-6} ${endX},${barY} ${endX+6},${barY+6} ${startX},${barY+6}`);
        body.setAttribute('fill',color);
        body.style.transformOrigin = `${startX}px ${barY}px`;
        body.style.transform = 'scaleX(0)';
        body.style.transition = `transform ${dur} cubic-bezier(0.25,0.46,0.45,0.94) ${startDelay}`;
        g.appendChild(body);

        // ── Pill & value (appear after bar) ──
        const valStr = val.toLocaleString();
        const pillW = Math.max(18, valStr.length*6+6);
        const pill = document.createElementNS("http://www.w3.org/2000/svg","rect");
        pill.setAttribute('x',endX-pillW-6); pill.setAttribute('y',barY-7);
        pill.setAttribute('width',pillW); pill.setAttribute('height',14);
        pill.setAttribute('rx','7'); pill.setAttribute('fill',color);
        pill.style.opacity = '0';
        pill.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
        g.appendChild(pill);

        const tVal = document.createElementNS("http://www.w3.org/2000/svg","text");
        tVal.setAttribute('x',endX-pillW/2-6); tVal.setAttribute('y',barY+4);
        tVal.setAttribute('font-family','Outfit'); tVal.setAttribute('font-size','8.5px');
        tVal.setAttribute('font-weight','bold'); tVal.setAttribute('fill','#ffffff');
        tVal.setAttribute('text-anchor','middle'); tVal.textContent = valStr;
        tVal.style.opacity = '0';
        tVal.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
        g.appendChild(tVal);

        svg.appendChild(g);
        requestAnimationFrame(() => requestAnimationFrame(() => {
            body.style.transform = 'scaleX(1)';
            const totalMs = (parseFloat(startDelay) || 0) + parseFloat(dur) * 1000;
            setTimeout(() => {
                pill.style.opacity = '1';
                tVal.style.opacity = '1';
            }, totalMs);
        }));
    });
}

function cmpDrawEmptySvg(svgId, msg) {
    const svg = document.getElementById(svgId);
    if (!svg) return;
    svg.setAttribute('viewBox','0 0 450 60');
    svg.style.height = '60px';
    svg.innerHTML = `<text x="225" y="35" font-family="Tajawal" font-size="11" font-weight="bold" fill="#94a3b8" text-anchor="middle">${msg}</text>`;
}

function cmpRenderTable(tbodyId, rows, cols, emptyMsg) {
    const tbody = document.getElementById(tbodyId);
    if (!tbody) return;
    if (!rows || rows.length === 0) {
        tbody.innerHTML = `<tr><td colspan="${cols}" class="text-center text-slate-300 py-4 text-[10px]">${emptyMsg || 'لا بيانات'}</td></tr>`;
        return;
    }
    tbody.innerHTML = rows;
}

// ── Draw Interactive Iraq Governorates Map for Comparison ────
const CMP_GOV_COORDS = {
    'دهوك':       { x: 258, y:  50, pathId: 'IQ-DA' },
    'أربيل':      { x: 358, y:  65, pathId: 'IQ-AR' },
    'السليمانية': { x: 415, y: 150, pathId: 'IQ-SU' },
    'نينوى':      { x: 195, y: 185, pathId: 'IQ-NI' },
    'كركوك':      { x: 370, y: 165, pathId: 'IQ-KI' },
    'صلاح الدين': { x: 285, y: 225, pathId: 'IQ-SD' },
    'ديالى':      { x: 385, y: 260, pathId: 'IQ-DI' },
    'بغداد':      { x: 348, y: 307, pathId: 'IQ-BG' },
    'الأنبار':    { x: 148, y: 305, pathId: 'IQ-AN' },
    'بابل':       { x: 322, y: 338, pathId: 'IQ-BB' },
    'كربلاء':     { x: 305, y: 358, pathId: 'IQ-KA' },
    'واسط':       { x: 422, y: 362, pathId: 'IQ-WA' },
    'النجف':      { x: 280, y: 465, pathId: 'IQ-NA' },
    'القادسية':   { x: 383, y: 408, pathId: 'IQ-QA' },
    'ميسان':      { x: 490, y: 412, pathId: 'IQ-MA' },
    'ذي قار':     { x: 455, y: 475, pathId: 'IQ-DQ' },
    'المثنى':     { x: 348, y: 485, pathId: 'IQ-MU' },
    'البصرة':     { x: 532, y: 492, pathId: 'IQ-BA' }
};

function cmpDrawIraqMap(svgId, values, labels, colorTheme) {
    const svg = document.getElementById(svgId);
    if (!svg) return;

    const pathsGroup = document.getElementById(svgId + '-paths');
    const nodesGroup = document.getElementById(svgId + '-nodes');
    if (!pathsGroup || !nodesGroup) return;

    nodesGroup.innerHTML = '';

    const dataMap = {};
    labels.forEach((label, idx) => { dataMap[label] = values[idx] || 0; });
    const maxVal = Math.max(...Object.values(dataMap), 1);

    // colour each path using getAttribute('id') — querySelector('#IQ-XX') fails silently
    pathsGroup.querySelectorAll('path').forEach(path => {
        const pid = path.getAttribute('id');
        const govName = Object.keys(CMP_GOV_COORDS).find(n => CMP_GOV_COORDS[n].pathId === pid);
        const val = govName ? (dataMap[govName] || 0) : 0;
        if (val > 0) {
            path.setAttribute('fill', 'rgba(2,132,199,0.18)');
            path.setAttribute('stroke', colorTheme || '#0ea5e9');
            path.setAttribute('stroke-width', '1.8');
        } else {
            path.setAttribute('fill', 'rgba(148,163,184,0.04)');
            path.setAttribute('stroke', '#cbd5e1');
            path.setAttribute('stroke-width', '0.9');
        }
    });

    // draw labels at fixed calibrated coordinates
    Object.keys(CMP_GOV_COORDS).forEach((govArabicName, i) => {
        const info = CMP_GOV_COORDS[govArabicName];
        const val  = dataMap[govArabicName] || 0;

        const g = document.createElementNS('http://www.w3.org/2000/svg', 'g');
        const delay = i * 55;
        g.style.opacity    = '0';
        g.style.transform  = `translate(${info.x}px, ${info.y + 35}px)`;
        g.style.transition = `opacity 0.5s ease ${delay}ms, transform 0.55s cubic-bezier(0.34,1.56,0.64,1) ${delay}ms`;

        if (val > 0) {
            const halo = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
            const r0 = 6 + (val / maxVal) * 6;
            halo.setAttribute('r', r0);
            halo.setAttribute('fill', colorTheme || '#0ea5e9');
            halo.setAttribute('opacity', '0.18');
            const anim = document.createElementNS('http://www.w3.org/2000/svg', 'animate');
            anim.setAttribute('attributeName', 'r');
            anim.setAttribute('values', `${r0};${r0 * 1.9};${r0}`);
            anim.setAttribute('dur', '2.4s');
            anim.setAttribute('repeatCount', 'indefinite');
            halo.appendChild(anim);
            g.appendChild(halo);
            const dot = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
            dot.setAttribute('r', 3 + (val / maxVal) * 2.5);
            dot.setAttribute('fill', colorTheme || '#0ea5e9');
            g.appendChild(dot);
        } else {
            const dot = document.createElementNS('http://www.w3.org/2000/svg', 'circle');
            dot.setAttribute('r', '2');
            dot.setAttribute('fill', '#94a3b8');
            dot.setAttribute('opacity', '0.5');
            g.appendChild(dot);
        }

        const textStr = `${govArabicName}: ${val.toLocaleString()}`;
        const chipW   = textStr.length * 5.0 + 10;
        const chipY   = val > 0 ? -(3 + (val / maxVal) * 2.5) - 15 : -15;

        const chip = document.createElementNS('http://www.w3.org/2000/svg', 'rect');
        chip.setAttribute('x', -chipW / 2);
        chip.setAttribute('y', chipY - 11);
        chip.setAttribute('width', chipW);
        chip.setAttribute('height', '12');
        chip.setAttribute('rx', '3');
        chip.setAttribute('fill', val > 0 ? (colorTheme || '#0ea5e9') : '#64748b');
        chip.setAttribute('opacity', val > 0 ? '0.92' : '0.6');
        g.appendChild(chip);

        const lbl = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        lbl.setAttribute('x', '0');
        lbl.setAttribute('y', chipY - 2);
        lbl.setAttribute('font-family', 'Tajawal, sans-serif');
        lbl.setAttribute('font-size', '7.5');
        lbl.setAttribute('font-weight', 'bold');
        lbl.setAttribute('fill', '#fff');
        lbl.setAttribute('text-anchor', 'middle');
        lbl.textContent = textStr;
        g.appendChild(lbl);

        nodesGroup.appendChild(g);

        // trigger entrance animation on next paint
        requestAnimationFrame(() => requestAnimationFrame(() => {
            g.style.opacity   = '1';
            g.style.transform = `translate(${info.x}px, ${info.y}px)`;
        }));
    });
}

// ── Main run function ─────────────────────────────────────────
async function runComparison() {
    const docAId = document.getElementById('cmp-doc-a').value;
    const fromA  = document.getElementById('cmp-from-a').value;
    const toA    = document.getElementById('cmp-to-a').value;
    const docBId = document.getElementById('cmp-doc-b').value;
    const fromB  = document.getElementById('cmp-from-b').value;
    const toB    = document.getElementById('cmp-to-b').value;

    if (!fromA || !toA || !fromB || !toB) {
        showToast('يرجى تحديد التواريخ لكلتا الجهتين', 'error');
        return;
    }

    const selA = document.getElementById('cmp-doc-a');
    const selB = document.getElementById('cmp-doc-b');
    const docNameA = selA.options[selA.selectedIndex].text;
    const docNameB = selB.options[selB.selectedIndex].text;
    const labelA = `${docNameA} (${fromA} : ${toA})`;
    const labelB = `${docNameB} (${fromB} : ${toB})`;

    document.getElementById('cmp-loading').classList.remove('hidden');
    document.getElementById('cmp-results').classList.add('hidden');
    document.getElementById('cmp-run-btn').disabled = true;

    try {
        const params = new URLSearchParams({
            doctor_id_a: docAId, start_date_a: fromA, end_date_a: toA,
            doctor_id_b: docBId, start_date_b: fromB, end_date_b: toB,
        });
        const data = await fetch(`/api/comparison-data?${params}`, {
            headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content }
        }).then(r => r.json());

        renderAllCmpCharts(data, labelA, labelB);
    } catch(e) {
        showToast('فشل جلب البيانات، يرجى المحاولة مجدداً', 'error');
        console.error(e);
    } finally {
        document.getElementById('cmp-loading').classList.add('hidden');
        document.getElementById('cmp-run-btn').disabled = false;
    }
}

function renderAllCmpCharts(data, labelA, labelB) {
    const A = data.side_a;
    const B = data.side_b;

    // ─ Inject labels ─
    cmpInjectLabels(labelA, labelB);

    // ─ KPI ─
    document.getElementById('kpi-v-a').textContent = Number(A.total_visits  || 0).toLocaleString();
    document.getElementById('kpi-v-b').textContent = Number(B.total_visits  || 0).toLocaleString();
    cmpDiff('kpi-v-diff', A.total_visits, B.total_visits);

    document.getElementById('kpi-t-a').textContent = Number(A.total_eye_tests || 0).toLocaleString();
    document.getElementById('kpi-t-b').textContent = Number(B.total_eye_tests || 0).toLocaleString();
    cmpDiff('kpi-t-diff', A.total_eye_tests, B.total_eye_tests);

    document.getElementById('kpi-s-a').textContent = Number(A.total_surgeries || 0).toLocaleString();
    document.getElementById('kpi-s-b').textContent = Number(B.total_surgeries || 0).toLocaleString();
    cmpDiff('kpi-s-diff', A.total_surgeries, B.total_surgeries);

    // ─ جدول 1: الاستشاريات ─
    const consA = A.consultations || [];
    const consB = B.consultations || [];
    cmpDrawBranching('cmp-svg-1-a', consA, A.total_visits, CMP_COLORS_A);
    cmpDrawBranching('cmp-svg-1-b', consB, B.total_visits, CMP_COLORS_B);
    cmpRenderTable('cmp-tbl-1-a', consA.map((r,i) => `<tr class="table-row"><td>${r.unit}</td><td class="text-center font-bold">${r.total.toLocaleString()}</td></tr>`).join('') + (consA.length ? `<tr class="table-row font-extrabold text-theme-pink"><td class="text-center">الإجمالي</td><td class="text-center">${A.total_visits.toLocaleString()}</td></tr>` : ''), 2, 'لا بيانات');
    cmpRenderTable('cmp-tbl-1-b', consB.map((r,i) => `<tr class="table-row"><td>${r.unit}</td><td class="text-center font-bold">${r.total.toLocaleString()}</td></tr>`).join('') + (consB.length ? `<tr class="table-row font-extrabold text-theme-pink"><td class="text-center">الإجمالي</td><td class="text-center">${B.total_visits.toLocaleString()}</td></tr>` : ''), 2, 'لا بيانات');

    // ─ جدول 2: مراجعو كل طبيب ─
    // ─ جدول 2: مراجعو كل طبيب ─
    const vdA = A.visits_by_doctor || [];
    const vdB = B.visits_by_doctor || [];
    cmpWatchChart('cmp-svg-2-a', () => cmpDrawVertical('cmp-svg-2-a', vdA.map(r => r.total), vdA.map(r => r.doctor.replace('د. ','')), CMP_COLORS_A));
    cmpWatchChart('cmp-svg-2-b', () => cmpDrawVertical('cmp-svg-2-b', vdB.map(r => r.total), vdB.map(r => r.doctor.replace('د. ','')), CMP_COLORS_B));

    // ─ جدول 3: داخل العراق ─
    const gvA = A.visits_by_gov || [];
    const gvB = B.visits_by_gov || [];
    cmpWatchChart('cmp-svg-3-a', () => cmpDrawIraqMap('cmp-svg-3-a', gvA.map(r => r.total), gvA.map(r => r.gov), '#3b82f6'));
    cmpWatchChart('cmp-svg-3-b', () => cmpDrawIraqMap('cmp-svg-3-b', gvB.map(r => r.total), gvB.map(r => r.gov), '#f43f5e'));

    // ─ جدول 4: خارج العراق ─
    const cvA = A.visits_by_country || [];
    const cvB = B.visits_by_country || [];
    cmpWatchChart('cmp-svg-4-a', () => cmpDrawChevrons('cmp-svg-4-a', cvA.map(r => r.total), cvA.map(r => r.country), CMP_COLORS_A));
    cmpWatchChart('cmp-svg-4-b', () => cmpDrawChevrons('cmp-svg-4-b', cvB.map(r => r.total), cvB.map(r => r.country), CMP_COLORS_B));

    // ─ جدول 5: الفحوصات البصرية ─
    const etA = A.eye_tests_by_type || [];
    const etB = B.eye_tests_by_type || [];
    cmpWatchChart('cmp-svg-5-a', () => cmpDrawChevrons('cmp-svg-5-a', etA.map(r => r.total), etA.map(r => r.type), ['#f97316','#ea580c','#c2410c','#9a3412','#7c2d12']));
    cmpWatchChart('cmp-svg-5-b', () => cmpDrawChevrons('cmp-svg-5-b', etB.map(r => r.total), etB.map(r => r.type), ['#e11d48','#be123c','#9f1239','#881337','#4c0519']));

    // ─ جدول 6: التحاليل المختبرية ─
    const ltA = A.lab_tests_by_type || [];
    const ltB = B.lab_tests_by_type || [];
    cmpWatchChart('cmp-svg-6-a', () => cmpDrawVertical('cmp-svg-6-a', ltA.map(r => r.total), ltA.map(r => r.type), ['#3b82f6','#6366f1','#8b5cf6','#a855f7','#d946ef']));
    cmpWatchChart('cmp-svg-6-b', () => cmpDrawVertical('cmp-svg-6-b', ltB.map(r => r.total), ltB.map(r => r.type), ['#f43f5e','#e11d48','#fb923c','#f59e0b','#84cc16']));

    // ─ جدول 7: تصنيف العمليات ─
    const scA = A.surgeries_by_cat || [];
    const scB = B.surgeries_by_cat || [];
    const catOrder = ['صغرى','ليزر','كبرى','خاصة','فوق الكبرى','وسطى'];
    const catColors = ['#0ea5e9','#db2777','#d97706','#475569','#6d28d9','#e11d48'];
    const scAOrdered = catOrder.map(c => scA.find(r => r.classification === c)?.total || 0);
    const scBOrdered = catOrder.map(c => scB.find(r => r.classification === c)?.total || 0);
    cmpWatchChart('cmp-svg-7-a', () => cmpDrawVertical('cmp-svg-7-a', scAOrdered, catOrder, catColors));
    cmpWatchChart('cmp-svg-7-b', () => cmpDrawVertical('cmp-svg-7-b', scBOrdered, catOrder, catColors));
    cmpRenderTable('cmp-tbl-7-a', scA.map(r => `<tr class="table-row"><td>${r.classification}</td><td class="text-center font-bold text-rose-600">${r.total.toLocaleString()}</td></tr>`).join(''), 2, 'لا عمليات');
    cmpRenderTable('cmp-tbl-7-b', scB.map(r => `<tr class="table-row"><td>${r.classification}</td><td class="text-center font-bold text-rose-600">${r.total.toLocaleString()}</td></tr>`).join(''), 2, 'لا عمليات');

    // ─ جدول 10: عمليات كل طبيب (إجمالي) ─
    const sdA = A.surgs_by_doctor || [];
    const sdB = B.surgs_by_doctor || [];
    cmpWatchChart('cmp-svg-10-a', () => cmpDrawVertical('cmp-svg-10-a', sdA.map(r => r.total), sdA.map(r => r.doctor.replace('د. ','')), CMP_COLORS_A));
    cmpWatchChart('cmp-svg-10-b', () => cmpDrawVertical('cmp-svg-10-b', sdB.map(r => r.total), sdB.map(r => r.doctor.replace('د. ','')), CMP_COLORS_B));

    // ─ التفصيلي (combined_ops) ─
    const coA = A.combined_ops || [];
    const coB = B.combined_ops || [];
    cmpWatchChart('cmp-svg-detail-a', () => cmpDrawChevrons('cmp-svg-detail-a', coA.map(r => r.total), coA.map(r => r.op), CMP_COLORS_A));
    cmpWatchChart('cmp-svg-detail-b', () => cmpDrawChevrons('cmp-svg-detail-b', coB.map(r => r.total), coB.map(r => r.op), CMP_COLORS_B));

    const detailRowHtml = (ops) => ops.map((op,i) => {
        const cls = CMP_BADGE[op.classification] || 'bg-slate-100 text-slate-600';
        return `<tr class="table-row">
            <td class="w-8 text-center">${i+1}</td>
            <td>${op.op}</td>
            <td><span class="text-[9px] font-bold px-2 py-0.5 rounded-full ${cls}">${op.classification}</span></td>
            <td class="text-center font-bold text-violet-600 text-xs">${op.total.toLocaleString()}</td>
        </tr>`;
    }).join('');
    cmpRenderTable('cmp-tbl-detail-a', detailRowHtml(coA), 4, 'لا عمليات مسجلة');
    cmpRenderTable('cmp-tbl-detail-b', detailRowHtml(coB), 4, 'لا عمليات مسجلة');

    // ─ Show results ─
    document.getElementById('cmp-results').classList.remove('hidden');
    setTimeout(() => { if (window.lucide) lucide.createIcons(); }, 100);
}

// Page init hook
window.initComparisonPage = function() {
    setTimeout(() => { if (window.lucide) lucide.createIcons(); }, 100);
};
</script>
