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
                </div>
            </div>
            <div class="flex items-center gap-2">
                <button onclick="runComparison()" id="cmp-run-btn"
                    class="py-2 px-5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-violet-500 to-purple-500 hover-press flex items-center gap-2 shadow-md">
                    <i data-lucide="zap" class="w-3.5 h-3.5"></i>
                    <span>تنفيذ المقارنة</span>
                </button>
                <button onclick="resetComparisonFilters()"
                    class="py-2 px-4 rounded-xl text-xs font-bold bg-slate-200/20 text-slate-400 hover:bg-slate-200/40 hover-press flex items-center gap-1.5 border border-slate-200/10">
                    <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
                    <span>تصفير المقارنة</span>
                </button>
            </div>
        </div>

        {{-- Filter Panels --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            {{-- Side A --}}
            <div class="bg-blue-500/5 border border-blue-400/20 rounded-xl p-4 space-y-3">
                <div class="flex items-center gap-2">
                    <div class="w-5 h-5 rounded-full bg-blue-500 flex items-center justify-center text-white text-[9px] font-black">أ</div>
                    <span class="text-[10px] font-bold text-blue-600">الجهة الأولى (أ)</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-2">
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
                        <label class="text-[9px] font-bold text-slate-400">تصنيف العملية:</label>
                        <select id="cmp-op-a" class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-2 text-[10px] font-bold text-text-main font-['Tajawal']">
                            <option value="">كل التصنيفات</option>
                            @foreach($filterClassifications as $cls)
                            <option value="{{ $cls->name }}">{{ $cls->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-[9px] font-bold text-slate-400">من:</label>
                        <input type="month" id="cmp-from-a" value="{{ substr($start_date ?? '2026-05-01', 0, 7) }}"
                            class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-2 text-[10px] font-bold text-text-main custom-date-input">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-[9px] font-bold text-slate-400">إلى:</label>
                        <input type="month" id="cmp-to-a" value="{{ substr($end_date ?? '2026-05-31', 0, 7) }}"
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
                <div class="grid grid-cols-1 sm:grid-cols-4 gap-2">
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
                        <label class="text-[9px] font-bold text-slate-400">تصنيف العملية:</label>
                        <select id="cmp-op-b" class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-2 text-[10px] font-bold text-text-main font-['Tajawal']">
                            <option value="">كل التصنيفات</option>
                            @foreach($filterClassifications as $cls)
                            <option value="{{ $cls->name }}">{{ $cls->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-[9px] font-bold text-slate-400">من:</label>
                        <input type="month" id="cmp-from-b" value="{{ substr($start_date ?? '2026-05-01', 0, 7) }}"
                            class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-2 text-[10px] font-bold text-text-main custom-date-input">
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-[9px] font-bold text-slate-400">إلى:</label>
                        <input type="month" id="cmp-to-b" value="{{ substr($end_date ?? '2026-05-31', 0, 7) }}"
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
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
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
            <h3 class="text-xs font-bold text-text-main flex items-center justify-between pb-3 mb-4 border-b border-slate-200/20">
                <div class="flex items-center gap-2">
                    <i data-lucide="stethoscope" class="w-4 h-4 text-pink-500"></i>
                    مقارنة أعداد المرضى في الاستشاريات
                    <span id="cmp-total-1" class="inline-flex items-center bg-pink-500/10 text-pink-600 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2 hidden"></span>
                </div>
                <div class="flex items-center gap-1.5 no-print">
                    <span class="text-[9px] font-bold text-slate-400 font-['Tajawal']">شكل السهم:</span>
                    <select id="select-cmp-svg-1" data-svg-id="cmp-svg-1" onchange="changeComparisonChartStyle('cmp-svg-1', this.value);" class="arrow-style-select bg-slate-200/20 text-slate-500 dark:text-slate-400 border border-slate-200/10 rounded-lg px-2 py-0.5 text-[9px] font-bold focus:outline-none cursor-pointer font-['Tajawal']">
                        <option value="flat">أسهم مسطحة</option>
                        <option value="glow">أسهم متوهجة</option>
                        <option value="bar">أعمدة رأسية (جارت)</option>
                        <option value="bar-h">أعمدة أفقية (جارت)</option>
                        <option value="donut">شكل دائري (جارت)</option>
                        <option value="area">مخطط مساحي (جارت)</option>
                    </select>
                </div>
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
            <h3 class="text-xs font-bold text-text-main flex items-center justify-between pb-3 mb-4 border-b border-slate-200/20">
                <div class="flex items-center gap-2">
                    <i data-lucide="users" class="w-4 h-4 text-emerald-500"></i>
                    مقارنة مرضى كل طبيب اختصاص
                    <span id="cmp-total-2" class="inline-flex items-center bg-pink-500/10 text-pink-600 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2 hidden"></span>
                </div>
                <div class="flex items-center gap-1.5 no-print">
                    <span class="text-[9px] font-bold text-slate-400 font-['Tajawal']">شكل السهم:</span>
                    <select id="select-cmp-svg-2" data-svg-id="cmp-svg-2" onchange="changeComparisonChartStyle('cmp-svg-2', this.value);" class="arrow-style-select bg-slate-200/20 text-slate-500 dark:text-slate-400 border border-slate-200/10 rounded-lg px-2 py-0.5 text-[9px] font-bold focus:outline-none cursor-pointer font-['Tajawal']">
                        <option value="flat">أسهم مسطحة</option>
                        <option value="glow">أسهم متوهجة</option>
                        <option value="bar">أعمدة رأسية (جارت)</option>
                        <option value="bar-h">أعمدة أفقية (جارت)</option>
                        <option value="donut">شكل دائري (جارت)</option>
                        <option value="area">مخطط مساحي (جارت)</option>
                    </select>
                </div>
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
                    مقارنة التوزيع الجغرافي داخل العراق
                    <span id="cmp-total-3" class="inline-flex items-center bg-pink-500/10 text-pink-600 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2 hidden"></span>
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
                <h3 class="text-xs font-bold text-text-main flex items-center justify-between pb-3 mb-4 border-b border-slate-200/20">
                    <div class="flex items-center gap-2">
                        <i data-lucide="globe" class="w-4 h-4 text-pink-500"></i>
                        المرضى من خارج العراق
                        <span id="cmp-total-4" class="inline-flex items-center bg-pink-500/10 text-pink-600 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2 hidden"></span>
                    </div>
                    <div class="flex items-center gap-1.5 no-print">
                        <span class="text-[9px] font-bold text-slate-400 font-['Tajawal']">شكل السهم:</span>
                        <select id="select-cmp-svg-4" data-svg-id="cmp-svg-4" onchange="changeComparisonChartStyle('cmp-svg-4', this.value);" class="arrow-style-select bg-slate-200/20 text-slate-500 dark:text-slate-400 border border-slate-200/10 rounded-lg px-2 py-0.5 text-[9px] font-bold focus:outline-none cursor-pointer font-['Tajawal']">
                            <option value="flat">أسهم مسطحة</option>
                            <option value="glow">أسهم متوهجة</option>
                            <option value="bar">أعمدة رأسية (جارت)</option>
                            <option value="bar-h">أعمدة أفقية (جارت)</option>
                            <option value="donut">شكل دائري (جارت)</option>
                            <option value="area">مخطط مساحي (جارت)</option>
                        </select>
                    </div>
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


        {{-- ═══ جداول 8 & 9: التوزيع الجغرافي للعمليات الجراحية ═══ --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- داخل العراق --}}
            <div class="custom-card p-6 rounded-2xl">
                <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                    <i data-lucide="flag" class="w-4 h-4 text-rose-500"></i>
                    مقارنة التوزيع الجغرافي للعمليات الجراحية داخل العراق
                    <span id="cmp-total-8" class="inline-flex items-center bg-pink-500/10 text-pink-600 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2 hidden"></span>
                </h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div>
                        <div class="cmp-side-label-a mb-2"></div>
                        <div class="w-full overflow-x-auto py-1">
                            <svg id="cmp-svg-8-a" viewBox="0 0 584 594" class="w-full max-w-[320px] h-[340px] overflow-visible mx-auto">
                                <g id="cmp-svg-8-a-paths" fill="rgba(244, 63, 94, 0.03)" stroke="#cbd5e1" stroke-width="1.2">
                                    {!! $pathsHtml !!}
                                </g>
                                <g id="cmp-svg-8-a-nodes"></g>
                            </svg>
                        </div>
                    </div>
                    <div>
                        <div class="cmp-side-label-b mb-2"></div>
                        <div class="w-full overflow-x-auto py-1">
                            <svg id="cmp-svg-8-b" viewBox="0 0 584 594" class="w-full max-w-[320px] h-[340px] overflow-visible mx-auto">
                                <g id="cmp-svg-8-b-paths" fill="rgba(244, 63, 94, 0.03)" stroke="#cbd5e1" stroke-width="1.2">
                                    {!! $pathsHtml !!}
                                </g>
                                <g id="cmp-svg-8-b-nodes"></g>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            {{-- خارج العراق --}}
            <div class="custom-card p-6 rounded-2xl">
                <h3 class="text-xs font-bold text-text-main flex items-center justify-between pb-3 mb-4 border-b border-slate-200/20">
                    <div class="flex items-center gap-2">
                        <i data-lucide="globe" class="w-4 h-4 text-pink-500"></i>
                        مقارنة العمليات الجراحية للمرضى من خارج العراق
                        <span id="cmp-total-9" class="inline-flex items-center bg-pink-500/10 text-pink-600 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2 hidden"></span>
                    </div>
                    <div class="flex items-center gap-1.5 no-print">
                        <span class="text-[9px] font-bold text-slate-400 font-['Tajawal']">شكل السهم:</span>
                        <select id="select-cmp-svg-9" data-svg-id="cmp-svg-9" onchange="changeComparisonChartStyle('cmp-svg-9', this.value);" class="arrow-style-select bg-slate-200/20 text-slate-500 dark:text-slate-400 border border-slate-200/10 rounded-lg px-2 py-0.5 text-[9px] font-bold focus:outline-none cursor-pointer font-['Tajawal']">
                            <option value="flat">أسهم مسطحة</option>
                            <option value="glow">أسهم متوهجة</option>
                            <option value="bar">أعمدة رأسية (جارت)</option>
                            <option value="bar-h">أعمدة أفقية (جارت)</option>
                            <option value="donut">شكل دائري (جارت)</option>
                            <option value="area">مخطط مساحي (جارت)</option>
                        </select>
                    </div>
                </h3>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div>
                        <div class="cmp-side-label-a mb-2"></div>
                        <div class="w-full overflow-x-auto py-1">
                            <svg id="cmp-svg-9-a" viewBox="0 0 450 180" class="w-full min-w-[300px] h-auto overflow-visible"></svg>
                        </div>
                    </div>
                    <div>
                        <div class="cmp-side-label-b mb-2"></div>
                        <div class="w-full overflow-x-auto py-1">
                            <svg id="cmp-svg-9-b" viewBox="0 0 450 180" class="w-full min-w-[300px] h-auto overflow-visible"></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- ═══ جدول 5: الفحوصات البصرية والساندة (مستقل - يعرض إجمالي الفترة بغض النظر عن باقي الفلاتر) ═══ --}}
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center justify-between pb-3 mb-4 border-b border-slate-200/20">
                <div class="flex items-center gap-2">
                    <i data-lucide="eye" class="w-4 h-4 text-orange-500"></i>
                    مقارنة البصرية والساندة
                    <span class="text-[9px] text-slate-400 font-normal mr-1">(مستقل — يعرض الفحوصات حسب الفترة فقط)</span>
                    <span id="cmp-total-5" class="inline-flex items-center bg-pink-500/10 text-pink-600 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2 hidden"></span>
                </div>
                <div class="flex items-center gap-1.5 no-print">
                    <span class="text-[9px] font-bold text-slate-400 font-['Tajawal']">شكل السهم:</span>
                    <select id="select-cmp-svg-5" data-svg-id="cmp-svg-5" onchange="changeComparisonChartStyle('cmp-svg-5', this.value);" class="arrow-style-select bg-slate-200/20 text-slate-500 dark:text-slate-400 border border-slate-200/10 rounded-lg px-2 py-0.5 text-[9px] font-bold focus:outline-none cursor-pointer font-['Tajawal']">
                        <option value="flat">أسهم مسطحة</option>
                        <option value="glow">أسهم متوهجة</option>
                        <option value="bar">أعمدة رأسية (جارت)</option>
                        <option value="bar-h">أعمدة أفقية (جارت)</option>
                        <option value="donut">شكل دائري (جارت)</option>
                        <option value="area">مخطط مساحي (جارت)</option>
                    </select>
                </div>
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

        {{-- ═══ جدول 7: تصنيف العمليات ═══ --}}
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center justify-between pb-3 mb-4 border-b border-slate-200/20">
                <div class="flex items-center gap-2">
                    <i data-lucide="scissors" class="w-4 h-4 text-rose-500"></i>
                    مقارنة أعداد وتصنيف العمليات الجراحية للعيون
                    <span id="cmp-total-7" class="inline-flex items-center bg-pink-500/10 text-pink-600 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2 hidden"></span>
                </div>
                <div class="flex items-center gap-1.5 no-print">
                    <span class="text-[9px] font-bold text-slate-400 font-['Tajawal']">شكل السهم:</span>
                    <select id="select-cmp-svg-7" data-svg-id="cmp-svg-7" onchange="changeComparisonChartStyle('cmp-svg-7', this.value);" class="arrow-style-select bg-slate-200/20 text-slate-500 dark:text-slate-400 border border-slate-200/10 rounded-lg px-2 py-0.5 text-[9px] font-bold focus:outline-none cursor-pointer font-['Tajawal']">
                        <option value="flat">أسهم مسطحة</option>
                        <option value="glow">أسهم متوهجة</option>
                        <option value="bar">أعمدة رأسية (جارت)</option>
                        <option value="bar-h">أعمدة أفقية (جارت)</option>
                        <option value="donut">شكل دائري (جارت)</option>
                        <option value="area">مخطط مساحي (جارت)</option>
                    </select>
                </div>
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
            <h3 class="text-xs font-bold text-text-main flex items-center justify-between pb-3 mb-4 border-b border-slate-200/20">
                <div class="flex items-center gap-2">
                    <i data-lucide="award" class="w-4 h-4 text-violet-500"></i>
                    مقارنة إجمالي العمليات الجراحية المنجزة لكل طبيب اختصاص
                    <span id="cmp-total-10" class="inline-flex items-center bg-pink-500/10 text-pink-600 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2 hidden"></span>
                </div>
                <div class="flex items-center gap-1.5 no-print">
                    <span class="text-[9px] font-bold text-slate-400 font-['Tajawal']">شكل السهم:</span>
                    <select id="select-cmp-svg-10" data-svg-id="cmp-svg-10" onchange="changeComparisonChartStyle('cmp-svg-10', this.value);" class="arrow-style-select bg-slate-200/20 text-slate-500 dark:text-slate-400 border border-slate-200/10 rounded-lg px-2 py-0.5 text-[9px] font-bold focus:outline-none cursor-pointer font-['Tajawal']">
                        <option value="flat">أسهم مسطحة</option>
                        <option value="glow">أسهم متوهجة</option>
                        <option value="bar">أعمدة رأسية (جارت)</option>
                        <option value="bar-h">أعمدة أفقية (جارت)</option>
                        <option value="donut">شكل دائري (جارت)</option>
                        <option value="area">مخطط مساحي (جارت)</option>
                    </select>
                </div>
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
                <span id="cmp-total-detail" class="inline-flex items-center bg-pink-500/10 text-pink-600 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2 hidden"></span>
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
    // استدعاء الرسم فوراً لتنفيذ التغيير لحظياً
    if (typeof drawFn === 'function') {
        drawFn();
    }
    const el = document.getElementById(svgId);
    if (el) _cmpScrollObserver.observe(el);
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

function adjustBrightness(hex, percent) {
    let R = parseInt(hex.substring(1, 3), 16);
    let G = parseInt(hex.substring(3, 5), 16);
    let B = parseInt(hex.substring(5, 7), 16);
    R = parseInt(R * (100 + percent) / 100);
    G = parseInt(G * (100 + percent) / 100);
    B = parseInt(B * (100 + percent) / 100);
    R = (R < 255) ? R : 255;
    G = (G < 255) ? G : 255;
    B = (B < 255) ? B : 255;
    R = (R > 0) ? R : 0;
    G = (G > 0) ? G : 0;
    B = (B > 0) ? B : 0;
    const rHex = R.toString(16).padStart(2, '0');
    const gHex = G.toString(16).padStart(2, '0');
    const bHex = B.toString(16).padStart(2, '0');
    return `#${rHex}${gHex}${bHex}`;
}

function changeComparisonChartStyle(svgId, style) {
    const prefix = svgId.replace(/-[ab]$/, ''); // e.g. "cmp-svg-1"
    localStorage.setItem('arrow_style_' + prefix, style);
    
    // مزامنة المنسدلة نفسها للجانبين
    const select = document.getElementById('select-' + prefix);
    if (select) select.value = style;

    // إعادة استدعاء رسم الشارت للطرفين
    const fnA = _cmpSvgDrawFns.get(prefix + '-a');
    const fnB = _cmpSvgDrawFns.get(prefix + '-b');
    if (fnA) fnA();
    if (fnB) fnB();
}

// دالة التبديل لصفحة المقارنة
const _activeComparisonApexCharts = new Map();
function drawComparisonToggleChart(svgId, defaultChartType, drawArrowFn, data, labels, title = '', colors = null) {
    const svgEl = document.getElementById(svgId);
    if (!svgEl) return;

    const prefix = svgId.replace(/-[ab]$/, ''); // e.g. "cmp-svg-1"
    const style = localStorage.getItem('arrow_style_' + prefix) || 'flat';
    
    if (_activeComparisonApexCharts.has(svgId)) {
        _activeComparisonApexCharts.get(svgId).destroy();
        _activeComparisonApexCharts.delete(svgId);
    }

    let apexDivId = 'apex-' + svgId;
    let apexDiv = document.getElementById(apexDivId);

    if (style === 'flat' || style === 'glow') {
        if (apexDiv) apexDiv.classList.add('hidden');
        svgEl.classList.remove('hidden');
        if (typeof drawArrowFn === 'function') {
            drawArrowFn();
        }
    } else {
        svgEl.classList.add('hidden');
        
        if (!apexDiv) {
            apexDiv = document.createElement('div');
            apexDiv.id = apexDivId;
            apexDiv.className = 'w-full overflow-visible transition-all duration-300';
            svgEl.parentNode.insertBefore(apexDiv, svgEl.nextSibling);
        }
        apexDiv.classList.remove('hidden');
        apexDiv.innerHTML = '';

        let chartType = style;
        let actualType = chartType === 'bar-h' ? 'bar' : chartType;
        let isHorizontal = chartType === 'bar-h';

        const chartColors = colors || ['#3b82f6', '#ec4899', '#f59e0b', '#10b981', '#8b5cf6', '#06b6d4', '#f97316', '#64748b'];

        let options = {
            chart: {
                type: actualType,
                height: 230,
                fontFamily: 'Tajawal, sans-serif',
                toolbar: { show: false },
                background: 'transparent',
                foreColor: '#94a3b8'
            },
            colors: chartColors,
            theme: {
                mode: document.documentElement.classList.contains('dark') ? 'dark' : 'light'
            },
            stroke: {
                show: true,
                width: actualType === 'area' ? 3 : 0,
                curve: 'smooth'
            },
            grid: {
                borderColor: 'rgba(148, 163, 184, 0.08)',
                strokeDashArray: 3,
                xaxis: { lines: { show: isHorizontal } },
                yaxis: { lines: { show: !isHorizontal } }
            },
            tooltip: {
                theme: 'dark',
                y: {
                    formatter: function(val) {
                        return val.toLocaleString() + ' حالة';
                    }
                }
            }
        };

        if (actualType === 'bar') {
            options.series = [{
                name: title || 'العدد',
                data: data
            }];
            options.plotOptions = {
                bar: {
                    horizontal: isHorizontal,
                    columnWidth: '55%',
                    endingShape: 'rounded',
                    borderRadius: 6
                }
            };
            options.xaxis = {
                categories: labels,
                labels: {
                    style: { fontSize: '10px', fontWeight: 'bold' }
                }
            };
        } else if (actualType === 'donut') {
            options.series = data;
            options.labels = labels;
            options.plotOptions = {
                pie: {
                    donut: {
                        size: '70%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'الإجمالي',
                                formatter: function (w) {
                                    return w.globals.seriesTotals.reduce((a, b) => a + b, 0).toLocaleString();
                                }
                            }
                        }
                    }
                }
            };
            options.legend = {
                position: 'bottom',
                fontSize: '11px',
                labels: { colors: '#94a3b8' }
            };
        } else if (actualType === 'area') {
            options.series = [{
                name: title || 'العدد',
                data: data
            }];
            options.xaxis = {
                categories: labels,
                labels: {
                    style: { fontSize: '10px', fontWeight: 'bold' }
                }
            };
            options.fill = {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.45,
                    opacityTo: 0.05,
                    stops: [0, 90, 100]
                }
            };
        }

        const chart = new ApexCharts(apexDiv, options);
        chart.render();
        _activeComparisonApexCharts.set(svgId, chart);
    }
}

// ── Draw Branching Arrow (Table 1 consultations) ──────────────
function cmpDrawBranching(svgId, items, totalVal, colors) {
    const svg = document.getElementById(svgId);
    if (!svg) return;
    svg.innerHTML = '';

    const prefix = svgId.replace(/-[ab]$/, ''); // e.g. "cmp-svg-1"
    const style = localStorage.getItem('arrow_style_' + prefix) || 'flat';

    const val1 = items[0]?.total || 0;
    const val2 = items[1]?.total || 0;
    const label1 = items[0]?.unit || '—';
    const label2 = items[1]?.unit || '—';
    const cx = 260;
    const cy = 200;
    const col1 = colors[0] || '#3b82f6';
    const col2 = colors[1] || '#ec4899';

    if (style === 'glow') {
        // ─── النمط نحيف متوهج ───
        const leftBranch = document.createElementNS("http://www.w3.org/2000/svg", "path");
        leftBranch.setAttribute('d', `M ${cx} ${cy} L ${cx} ${cy-50} C ${cx} ${cy-80} ${cx-60} ${cy-90} ${cx-80} ${cy-120}`);
        leftBranch.setAttribute('fill', 'none');
        leftBranch.setAttribute('stroke', col1);
        leftBranch.setAttribute('stroke-width', '4');
        leftBranch.setAttribute('stroke-linecap', 'round');
        leftBranch.style.filter = `drop-shadow(0 0 3px ${col1}80)`;
        svg.appendChild(leftBranch);

        const rightBranch = document.createElementNS("http://www.w3.org/2000/svg", "path");
        rightBranch.setAttribute('d', `M ${cx} ${cy} L ${cx} ${cy-50} C ${cx} ${cy-80} ${cx+60} ${cy-90} ${cx+80} ${cy-120}`);
        rightBranch.setAttribute('fill', 'none');
        rightBranch.setAttribute('stroke', col2);
        rightBranch.setAttribute('stroke-width', '4');
        rightBranch.setAttribute('stroke-linecap', 'round');
        rightBranch.style.filter = `drop-shadow(0 0 3px ${col2}80)`;
        svg.appendChild(rightBranch);

        const createCircularBadge = (bx, by, valStr, labelText, bc) => {
            const r = Math.max(12, valStr.length * 4.5 + 4);
            const pill = document.createElementNS("http://www.w3.org/2000/svg", "circle");
            pill.setAttribute('cx', bx);
            pill.setAttribute('cy', by - 22);
            pill.setAttribute('r', r);
            pill.setAttribute('fill', '#1e293b');
            pill.setAttribute('stroke', bc);
            pill.setAttribute('stroke-width', '2');
            pill.style.filter = `drop-shadow(0 0 2px ${bc})`;
            svg.appendChild(pill);

            const tVal = document.createElementNS("http://www.w3.org/2000/svg", "text");
            tVal.setAttribute('x', bx);
            tVal.setAttribute('y', by - 18);
            tVal.setAttribute('font-family', 'Outfit');
            tVal.setAttribute('font-size', '10px');
            tVal.setAttribute('font-weight', 'black');
            tVal.setAttribute('fill', '#ffffff');
            tVal.setAttribute('text-anchor', 'middle');
            tVal.textContent = valStr;
            svg.appendChild(tVal);

            const lbl = document.createElementNS("http://www.w3.org/2000/svg", "text");
            lbl.setAttribute('x', bx);
            lbl.setAttribute('y', by - 22 - r - 4);
            lbl.setAttribute('font-family', 'Tajawal');
            lbl.setAttribute('font-size', '11px');
            lbl.setAttribute('font-weight', 'bold');
            lbl.setAttribute('fill', '#cbd5e1');
            lbl.setAttribute('text-anchor', 'middle');
            lbl.textContent = labelText.replace('استشارية ', '');
            svg.appendChild(lbl);
        };

        createCircularBadge(cx - 80, cy - 120, val1.toLocaleString(), label1, col1);
        createCircularBadge(cx + 80, cy - 120, val2.toLocaleString(), label2, col2);

        const totalStr = totalVal.toLocaleString();
        const r = Math.max(15, totalStr.length * 5 + 4);
        const totalPill = document.createElementNS("http://www.w3.org/2000/svg", "circle");
        totalPill.setAttribute('cx', cx);
        totalPill.setAttribute('cy', cy - 12);
        totalPill.setAttribute('r', r);
        totalPill.setAttribute('fill', '#1e293b');
        totalPill.setAttribute('stroke', '#cbd5e1');
        totalPill.setAttribute('stroke-width', '2.5');
        svg.appendChild(totalPill);

        const tTotal = document.createElementNS("http://www.w3.org/2000/svg", "text");
        tTotal.setAttribute('x', cx);
        tTotal.setAttribute('y', cy - 8);
        tTotal.setAttribute('font-family', 'Outfit');
        tTotal.setAttribute('font-size', '11px');
        tTotal.setAttribute('font-weight', 'black');
        tTotal.setAttribute('fill', '#ffffff');
        tTotal.setAttribute('text-anchor', 'middle');
        tTotal.textContent = totalStr;
        svg.appendChild(tTotal);

    } else if (style === '3d') {
        // ─── النمط ثلاثي الأبعاد ───
        const defs = document.createElementNS("http://www.w3.org/2000/svg", "defs");
        defs.innerHTML = `
            <filter id="shadow-branch-${svgId}" x="-20%" y="-20%" width="140%" height="140%">
                <feDropShadow dx="2" dy="4" stdDeviation="3" flood-opacity="0.3"/>
            </filter>
        `;
        svg.appendChild(defs);

        const leftPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
        leftPath.setAttribute('d', `M ${cx-15} ${cy} L ${cx-15} ${cy-50} C ${cx-15} ${cy-80} ${cx-50} ${cy-90} ${cx-70} ${cy-105} L ${cx-80} ${cy-97} L ${cx-65} ${cy-125} L ${cx-37} ${cy-107} L ${cx-47} ${cy-112} C ${cx-35} ${cy-100} ${cx-5} ${cy-90} ${cx-5} ${cy-50} L ${cx-5} ${cy} Z`);
        leftPath.setAttribute('fill', col1);
        leftPath.setAttribute('filter', `url(#shadow-branch-${svgId})`);
        svg.appendChild(leftPath);

        const leftSide = document.createElementNS("http://www.w3.org/2000/svg", "path");
        leftSide.setAttribute('d', `M ${cx-5} ${cy} L ${cx-5} ${cy-50} C ${cx-5} ${cy-90} ${cx-35} ${cy-100} ${cx-47} ${cy-112} L ${cx-40} ${cy-115} C ${cx-28} ${cy-102} M ${cx} ${cy}`);
        leftSide.setAttribute('fill', adjustBrightness(col1, -25));
        svg.appendChild(leftSide);

        const rightPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
        rightPath.setAttribute('d', `M ${cx-15} ${cy} L ${cx-15} ${cy-50} C ${cx-15} ${cy-80} ${cx-50} ${cy-90} ${cx-70} ${cy-105} L ${cx-80} ${cy-97} L ${cx-65} ${cy-125} L ${cx-37} ${cy-107} L ${cx-47} ${cy-112} C ${cx-35} ${cy-100} ${cx-5} ${cy-90} ${cx-5} ${cy-50} L ${cx-5} ${cy} Z`);
        rightPath.setAttribute('fill', col2);
        rightPath.setAttribute('transform', `translate(${cx}, 0) scale(-1, 1) translate(-${cx}, 0)`);
        rightPath.setAttribute('filter', `url(#shadow-branch-${svgId})`);
        svg.appendChild(rightPath);

        [[val1, label1, cx-80, col1],[val2, label2, cx+80, col2]].forEach(([v,l,bx,bc]) => {
            const s = `${l.replace('استشارية ', '')}: ${v.toLocaleString()}`;
            const bw = s.length*8.5+16;
            const b = document.createElementNS("http://www.w3.org/2000/svg","rect");
            b.setAttribute('x', bx-bw/2); b.setAttribute('y',cy-148);
            b.setAttribute('width',bw); b.setAttribute('height',24);
            b.setAttribute('rx','6'); b.setAttribute('fill',bc);
            b.setAttribute('filter', `url(#shadow-branch-${svgId})`);
            svg.appendChild(b);
            const bt = document.createElementNS("http://www.w3.org/2000/svg","text");
            bt.setAttribute('x',bx); bt.setAttribute('y',cy-131);
            bt.setAttribute('font-family','Tajawal'); bt.setAttribute('font-size','13px');
            bt.setAttribute('font-weight','bold'); bt.setAttribute('fill','#ffffff');
            bt.setAttribute('text-anchor','middle'); bt.textContent = s;
            svg.appendChild(bt);
        });

        const totalStr = totalVal.toLocaleString();
        const tpW = Math.max(50, totalStr.length * 9.0 + 14);
        const tp = document.createElementNS("http://www.w3.org/2000/svg","rect");
        tp.setAttribute('x', cx - tpW/2); tp.setAttribute('y', cy-16);
        tp.setAttribute('width', tpW); tp.setAttribute('height',24);
        tp.setAttribute('rx','6'); tp.setAttribute('fill','#334155');
        tp.setAttribute('filter', `url(#shadow-branch-${svgId})`);
        svg.appendChild(tp);
        const tt = document.createElementNS("http://www.w3.org/2000/svg","text");
        tt.setAttribute('x',cx); tt.setAttribute('y',cy+1.5);
        tt.setAttribute('font-family','Outfit'); tt.setAttribute('font-size','14px');
        tt.setAttribute('font-weight','black'); tt.setAttribute('fill','#ffffff');
        tt.setAttribute('text-anchor','middle'); tt.textContent = totalStr;
        svg.appendChild(tt);

    } else {
        // ─── النمط الافتراضي المسطح ───
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
        const tpW = Math.max(50, totalStr.length * 9.0 + 14);
        const tp = document.createElementNS("http://www.w3.org/2000/svg","rect");
        tp.setAttribute('x', cx - tpW/2); tp.setAttribute('y', cy-16);
        tp.setAttribute('width', tpW); tp.setAttribute('height',24);
        tp.setAttribute('rx','12'); tp.setAttribute('fill','#334155');
        svg.appendChild(tp);
        const tt = document.createElementNS("http://www.w3.org/2000/svg","text");
        tt.setAttribute('x',cx); tt.setAttribute('y',cy+1.5);
        tt.setAttribute('font-family','Outfit'); tt.setAttribute('font-size','14px');
        tt.setAttribute('font-weight','black'); tt.setAttribute('fill','#ffffff');
        tt.setAttribute('text-anchor','middle'); tt.textContent = totalStr;
        svg.appendChild(tt);

        [[val1, label1, cx-80, col1],[val2, label2, cx+80, col2]].forEach(([v,l,bx,bc]) => {
            const s = `${l.replace('استشارية ', '')}: ${v.toLocaleString()}`;
            const bw = s.length*8.5+16;
            const b = document.createElementNS("http://www.w3.org/2000/svg","rect");
            b.setAttribute('x', bx-bw/2); b.setAttribute('y',cy-148);
            b.setAttribute('width',bw); b.setAttribute('height',24);
            b.setAttribute('rx','12'); b.setAttribute('fill',bc);
            svg.appendChild(b);
            const bt = document.createElementNS("http://www.w3.org/2000/svg","text");
            bt.setAttribute('x',bx); bt.setAttribute('y',cy-131);
            bt.setAttribute('font-family','Tajawal'); bt.setAttribute('font-size','13px');
            bt.setAttribute('font-weight','bold'); bt.setAttribute('fill','#ffffff');
            bt.setAttribute('text-anchor','middle'); bt.textContent = s;
            svg.appendChild(bt);
        });
    }
}

// ── Draw Vertical Arrows ──────────────────────────────────────
function cmpDrawVertical(svgId, values, labels, colors) {
    const svg = document.getElementById(svgId);
    if (!svg) return;
    svg.innerHTML = '';
    if (!values.length) { cmpDrawEmptySvg(svgId, 'لا بيانات'); return; }

    const prefix = svgId.replace(/-[ab]$/, ''); // e.g. "cmp-svg-2"
    const style = localStorage.getItem('arrow_style_' + prefix) || 'flat';

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

    if (style === '3d') {
        const defs = document.createElementNS("http://www.w3.org/2000/svg", "defs");
        defs.innerHTML = `
            <filter id="shadow-3d-${svgId}" x="-20%" y="-20%" width="140%" height="140%">
                <feDropShadow dx="2" dy="3" stdDeviation="2.5" flood-opacity="0.25"/>
            </filter>
        `;
        svg.appendChild(defs);
    }

    values.forEach((val, i) => {
        const x = marginL + i * spacing;
        const color = colors[i % colors.length];
        const minH = 20, maxH = floorY - 55;
        const scaleVal = maxVal > 1 ? Math.sqrt(val) / Math.sqrt(maxVal) : 1;
        const H = minH + (maxH - minH) * scaleVal;
        const startDelay = (i * 80) + 'ms';
        const dur = '0.65s';

        const g = document.createElementNS("http://www.w3.org/2000/svg","g");

        let body, head, dashed, pill, tVal;

        if (style === 'glow') {
            // ─── النمط نحيف متوهج ───
            body = document.createElementNS("http://www.w3.org/2000/svg", "line");
            body.setAttribute('x1', x);
            body.setAttribute('y1', floorY);
            body.setAttribute('x2', x);
            body.setAttribute('y2', floorY - H);
            body.setAttribute('stroke', color);
            body.setAttribute('stroke-width', '4');
            body.setAttribute('stroke-linecap', 'round');
            body.style.filter = `drop-shadow(0 0 4px ${color}80)`;
            body.style.transformOrigin = `${x}px ${floorY}px`;
            body.style.transform = 'scaleY(0)';
            body.style.transition = `transform ${dur} cubic-bezier(0.16, 1, 0.3, 1) ${startDelay}`;
            g.appendChild(body);

            head = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
            head.setAttribute('points', `${x-6},${floorY-H} ${x+6},${floorY-H} ${x},${floorY-H-8}`);
            head.setAttribute('fill', color);
            head.style.opacity = '0';
            head.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(head);

            const valStr = val.toLocaleString();
            const r = Math.max(12, valStr.length * 4.5 + 4);
            pill = document.createElementNS("http://www.w3.org/2000/svg", "circle");
            pill.setAttribute('cx', x);
            pill.setAttribute('cy', floorY - H - 22);
            pill.setAttribute('r', r);
            pill.setAttribute('fill', '#1e293b');
            pill.setAttribute('stroke', color);
            pill.setAttribute('stroke-width', '2');
            pill.style.filter = `drop-shadow(0 0 2px ${color})`;
            pill.style.opacity = '0';
            pill.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(pill);

            tVal = document.createElementNS("http://www.w3.org/2000/svg", "text");
            tVal.setAttribute('x', x);
            tVal.setAttribute('y', floorY - H - 18);
            tVal.setAttribute('font-family', 'Outfit');
            tVal.setAttribute('font-size', '10px');
            tVal.setAttribute('font-weight', 'black');
            tVal.setAttribute('fill', '#ffffff');
            tVal.setAttribute('text-anchor', 'middle');
            tVal.textContent = valStr;
            tVal.style.opacity = '0';
            tVal.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(tVal);

        } else if (style === '3d') {
            // ─── النمط ثلاثي الأبعاد ───
            const gradId = `grad-3d-${svgId}-${i}`;
            const defs = svg.querySelector('defs') || document.createElementNS("http://www.w3.org/2000/svg", "defs");
            if (!svg.querySelector('defs')) svg.appendChild(defs);
            
            const grad = document.createElementNS("http://www.w3.org/2000/svg", "linearGradient");
            grad.setAttribute('id', gradId);
            grad.setAttribute('x1', '0%');
            grad.setAttribute('y1', '0%');
            grad.setAttribute('x2', '100%');
            grad.setAttribute('y2', '0%');
            grad.innerHTML = `
                <stop offset="0%" stop-color="${color}"/>
                <stop offset="35%" stop-color="#ffffff" stop-opacity="0.45"/>
                <stop offset="70%" stop-color="${color}"/>
                <stop offset="100%" stop-color="${adjustBrightness(color, -20)}"/>
            `;
            defs.appendChild(grad);

            body = document.createElementNS("http://www.w3.org/2000/svg", "rect");
            body.setAttribute('x', x - 9);
            body.setAttribute('y', floorY - H);
            body.setAttribute('width', '18');
            body.setAttribute('height', H);
            body.setAttribute('fill', `url(#${gradId})`);
            body.setAttribute('filter', `url(#shadow-3d-${svgId})`);
            body.style.transformOrigin = `${x}px ${floorY}px`;
            body.style.transform = 'scaleY(0)';
            body.style.transition = `transform ${dur} cubic-bezier(0.16, 1, 0.3, 1) ${startDelay}`;
            g.appendChild(body);

            const side = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
            side.setAttribute('points', `${x+9},${floorY} ${x+13},${floorY-4} ${x+13},${floorY-H-4} ${x+9},${floorY-H}`);
            side.setAttribute('fill', adjustBrightness(color, -35));
            side.style.transformOrigin = `${x}px ${floorY}px`;
            side.style.transform = 'scaleY(0)';
            side.style.transition = `transform ${dur} cubic-bezier(0.16, 1, 0.3, 1) ${startDelay}`;
            g.appendChild(side);

            head = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
            head.setAttribute('points', `${x-14},${floorY-H} ${x+14},${floorY-H} ${x},${floorY-H-12}`);
            head.setAttribute('fill', color);
            head.setAttribute('filter', `url(#shadow-3d-${svgId})`);
            head.style.opacity = '0';
            head.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(head);

            const sideHead = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
            sideHead.setAttribute('points', `${x+14},${floorY-H} ${x},${floorY-H-12} ${x+4},${floorY-H-14} ${x+18},${floorY-H-2}`);
            sideHead.setAttribute('fill', adjustBrightness(color, -35));
            sideHead.style.opacity = '0';
            sideHead.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(sideHead);

            dashed = document.createElementNS("http://www.w3.org/2000/svg", "line");
            dashed.setAttribute('x1', x);
            dashed.setAttribute('y1', floorY - H - 14);
            dashed.setAttribute('x2', x);
            dashed.setAttribute('y2', floorY - H - 28);
            dashed.setAttribute('stroke', color);
            dashed.setAttribute('stroke-width', '1.5');
            dashed.setAttribute('stroke-dasharray', '2 2');
            dashed.style.opacity = '0';
            dashed.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(dashed);

            const valStr = val.toLocaleString();
            const pillW = Math.max(34, valStr.length * 8.5 + 12);
            pill = document.createElementNS("http://www.w3.org/2000/svg", "rect");
            pill.setAttribute('x', x - pillW / 2);
            pill.setAttribute('y', floorY - H - 50);
            pill.setAttribute('width', pillW);
            pill.setAttribute('height', '22');
            pill.setAttribute('rx', '6');
            pill.setAttribute('fill', color);
            pill.setAttribute('filter', `url(#shadow-3d-${svgId})`);
            pill.style.opacity = '0';
            pill.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(pill);

            tVal = document.createElementNS("http://www.w3.org/2000/svg", "text");
            tVal.setAttribute('x', x);
            tVal.setAttribute('y', floorY - H - 34.5);
            tVal.setAttribute('font-family', 'Outfit');
            tVal.setAttribute('font-size', '13px');
            tVal.setAttribute('font-weight', 'bold');
            tVal.setAttribute('fill', '#ffffff');
            tVal.setAttribute('text-anchor', 'middle');
            tVal.textContent = valStr;
            tVal.style.opacity = '0';
            tVal.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(tVal);

            requestAnimationFrame(() => requestAnimationFrame(() => {
                side.style.transform = 'scaleY(1)';
                sideHead.style.opacity = '1';
            }));

        } else {
            // ─── النمط الافتراضي المسطح ───
            body = document.createElementNS("http://www.w3.org/2000/svg","rect");
            body.setAttribute('x',x-8); body.setAttribute('y',floorY-H);
            body.setAttribute('width','16'); body.setAttribute('height',H);
            body.setAttribute('fill',color); body.setAttribute('rx','1');
            body.style.transformOrigin = `${x}px ${floorY}px`;
            body.style.transform = 'scaleY(0)';
            body.style.transition = `transform ${dur} cubic-bezier(0.25,0.46,0.45,0.94) ${startDelay}`;
            g.appendChild(body);

            head = document.createElementNS("http://www.w3.org/2000/svg","polygon");
            head.setAttribute('points',`${x-12},${floorY-H} ${x+12},${floorY-H} ${x},${floorY-H-10}`);
            head.setAttribute('fill',color);
            head.style.opacity = '0';
            head.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(head);

            dashed = document.createElementNS("http://www.w3.org/2000/svg","line");
            dashed.setAttribute('x1',x); dashed.setAttribute('y1',floorY-H-12);
            dashed.setAttribute('x2',x); dashed.setAttribute('y2',floorY-H-26);
            dashed.setAttribute('stroke',color); dashed.setAttribute('stroke-width','1');
            dashed.setAttribute('stroke-dasharray','2 2');
            dashed.style.opacity = '0';
            dashed.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(dashed);

            const valStr = val.toLocaleString();
            const pillW = Math.max(32, valStr.length * 8.5 + 12);
            pill = document.createElementNS("http://www.w3.org/2000/svg","rect");
            pill.setAttribute('x',x-pillW/2); pill.setAttribute('y',floorY-H-48);
            pill.setAttribute('width',pillW); pill.setAttribute('height',22);
            pill.setAttribute('rx','11'); pill.setAttribute('fill',color);
            pill.style.opacity = '0';
            pill.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(pill);

            tVal = document.createElementNS("http://www.w3.org/2000/svg","text");
            tVal.setAttribute('x',x); tVal.setAttribute('y',floorY-H-32.5);
            tVal.setAttribute('font-family','Outfit'); tVal.setAttribute('font-size','13px');
            tVal.setAttribute('font-weight','bold'); tVal.setAttribute('fill','#ffffff');
            tVal.setAttribute('text-anchor','middle'); tVal.textContent = valStr;
            tVal.style.opacity = '0';
            tVal.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(tVal);
        }

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
                if (dashed) dashed.style.opacity = '1';
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

    const prefix = svgId.replace(/-[ab]$/, ''); // e.g. "cmp-svg-4"
    const style = localStorage.getItem('arrow_style_' + prefix) || 'flat';

    const n = values.length;
    const spacing = 58, marginT = 16, marginB = 20;
    const dynamicHeight = marginT + marginB + (n-1)*spacing + 32;
    svg.setAttribute('viewBox', `0 0 450 ${dynamicHeight}`);
    svg.style.height = `${dynamicHeight}px`;

    const maxVal = Math.max(...values, 1);
    const startX = 435, chartStartX = 10;
    const maxL = startX - chartStartX - 45;

    if (style === '3d') {
        const defs = document.createElementNS("http://www.w3.org/2000/svg", "defs");
        defs.innerHTML = `
            <filter id="shadow-3d-h-${svgId}" x="-20%" y="-20%" width="140%" height="140%">
                <feDropShadow dx="-2" dy="2" stdDeviation="2" flood-opacity="0.25"/>
            </filter>
        `;
        svg.appendChild(defs);
    }

    values.forEach((val, i) => {
        const labelY = marginT + i*spacing;
        const barY = labelY + 24;
        const color = colors[i % colors.length];
        const L = 15 + maxL * (val / maxVal);
        const endX = startX - L;
        const startDelay = (i * 80) + 'ms';
        const dur = '0.65s';

        const g = document.createElementNS("http://www.w3.org/2000/svg","g");

        // Label
        const label = document.createElementNS("http://www.w3.org/2000/svg","text");
        label.setAttribute('x',startX); label.setAttribute('y',labelY+6);
        label.setAttribute('font-family','Tajawal'); label.setAttribute('font-size','12px');
        label.setAttribute('font-weight','bold'); label.setAttribute('fill','#475569');
        label.setAttribute('text-anchor','start');
        label.setAttribute('direction', 'rtl');
        label.setAttribute('unicode-bidi', 'embed');
        
        let labelText = labels[i] || '';
        if (labelText.length > 45) labelText = labelText.substring(0, 42) + '..';
        label.textContent = labelText;
        g.appendChild(label);

        let body, pill, tVal;

        if (style === 'glow') {
            // ─── النمط نحيف متوهج أفقي ───
            body = document.createElementNS("http://www.w3.org/2000/svg", "line");
            body.setAttribute('x1', startX);
            body.setAttribute('y1', barY);
            body.setAttribute('x2', endX);
            body.setAttribute('y2', barY);
            body.setAttribute('stroke', color);
            body.setAttribute('stroke-width', '4');
            body.setAttribute('stroke-linecap', 'round');
            body.style.filter = `drop-shadow(0 0 3px ${color}80)`;
            body.style.transformOrigin = `${startX}px ${barY}px`;
            body.style.transform = 'scaleX(0)';
            body.style.transition = `transform ${dur} cubic-bezier(0.16, 1, 0.3, 1) ${startDelay}`;
            g.appendChild(body);

            const head = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
            head.setAttribute('points', `${endX},${barY} ${endX+6},${barY-4} ${endX+6},${barY+4}`);
            head.setAttribute('fill', color);
            g.appendChild(head);

            const valStr = val.toLocaleString();
            const r = Math.max(12, valStr.length * 4.5 + 4);
            pill = document.createElementNS("http://www.w3.org/2000/svg", "circle");
            pill.setAttribute('cx', endX - r - 4);
            pill.setAttribute('cy', barY);
            pill.setAttribute('r', r);
            pill.setAttribute('fill', '#1e293b');
            pill.setAttribute('stroke', color);
            pill.setAttribute('stroke-width', '2');
            pill.style.filter = `drop-shadow(0 0 2px ${color})`;
            pill.style.opacity = '0';
            pill.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(pill);

            tVal = document.createElementNS("http://www.w3.org/2000/svg", "text");
            tVal.setAttribute('x', endX - r - 4);
            tVal.setAttribute('y', barY + 3.5);
            tVal.setAttribute('font-family', 'Outfit');
            tVal.setAttribute('font-size', '10px');
            tVal.setAttribute('font-weight', 'black');
            tVal.setAttribute('fill', '#ffffff');
            tVal.setAttribute('text-anchor', 'middle');
            tVal.textContent = valStr;
            tVal.style.opacity = '0';
            tVal.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(tVal);

        } else if (style === '3d') {
            // ─── النمط ثلاثي الأبعاد أفقي ───
            const gradId = `grad-3d-h-${svgId}-${i}`;
            const defs = svg.querySelector('defs') || document.createElementNS("http://www.w3.org/2000/svg", "defs");
            if (!svg.querySelector('defs')) svg.appendChild(defs);

            const grad = document.createElementNS("http://www.w3.org/2000/svg", "linearGradient");
            grad.setAttribute('id', gradId);
            grad.setAttribute('x1', '0%');
            grad.setAttribute('y1', '0%');
            grad.setAttribute('x2', '0%');
            grad.setAttribute('y2', '100%');
            grad.innerHTML = `
                <stop offset="0%" stop-color="${color}"/>
                <stop offset="35%" stop-color="#ffffff" stop-opacity="0.4"/>
                <stop offset="70%" stop-color="${color}"/>
                <stop offset="100%" stop-color="${adjustBrightness(color, -25)}"/>
            `;
            defs.appendChild(grad);

            body = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
            body.setAttribute('points', `${startX},${barY-7} ${endX+7},${barY-7} ${endX},${barY} ${endX+7},${barY+7} ${startX},${barY+7}`);
            body.setAttribute('fill', `url(#${gradId})`);
            body.setAttribute('filter', `url(#shadow-3d-h-${svgId})`);
            body.style.transformOrigin = `${startX}px ${barY}px`;
            body.style.transform = 'scaleX(0)';
            body.style.transition = `transform ${dur} cubic-bezier(0.16, 1, 0.3, 1) ${startDelay}`;
            g.appendChild(body);

            const side = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
            side.setAttribute('points', `${startX},${barY+7} ${endX+7},${barY+7} ${endX},${barY} ${endX+4},${barY+3} ${endX+10},${barY+10} ${startX},${barY+10}`);
            side.setAttribute('fill', adjustBrightness(color, -35));
            side.style.transformOrigin = `${startX}px ${barY}px`;
            side.style.transform = 'scaleX(0)';
            side.style.transition = `transform ${dur} cubic-bezier(0.16, 1, 0.3, 1) ${startDelay}`;
            g.appendChild(side);

            const valStr = val.toLocaleString();
            const pillW = Math.max(30, valStr.length * 8.5 + 12);
            pill = document.createElementNS("http://www.w3.org/2000/svg", "rect");
            pill.setAttribute('x', endX - pillW - 8);
            pill.setAttribute('y', barY - 11);
            pill.setAttribute('width', pillW);
            pill.setAttribute('height', '22');
            pill.setAttribute('rx', '6');
            pill.setAttribute('fill', color);
            pill.setAttribute('filter', `url(#shadow-3d-h-${svgId})`);
            pill.style.opacity = '0';
            pill.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(pill);

            tVal = document.createElementNS("http://www.w3.org/2000/svg", "text");
            tVal.setAttribute('x', endX - pillW / 2 - 8);
            tVal.setAttribute('y', barY + 5.5);
            tVal.setAttribute('font-family', 'Outfit');
            tVal.setAttribute('font-size', '13px');
            tVal.setAttribute('font-weight', 'bold');
            tVal.setAttribute('fill', '#ffffff');
            tVal.setAttribute('text-anchor', 'middle');
            tVal.textContent = valStr;
            tVal.style.opacity = '0';
            tVal.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(tVal);

            requestAnimationFrame(() => requestAnimationFrame(() => {
                side.style.transform = 'scaleX(1)';
            }));

        } else {
            // ─── النمط الافتراضي المسطح ───
            body = document.createElementNS("http://www.w3.org/2000/svg","polygon");
            body.setAttribute('points',`${startX},${barY-6} ${endX+6},${barY-6} ${endX},${barY} ${endX+6},${barY+6} ${startX},${barY+6}`);
            body.setAttribute('fill',color);
            body.style.transformOrigin = `${startX}px ${barY}px`;
            body.style.transform = 'scaleX(0)';
            body.style.transition = `transform ${dur} cubic-bezier(0.25,0.46,0.45,0.94) ${startDelay}`;
            g.appendChild(body);

            const valStr = val.toLocaleString();
            const pillW = Math.max(30, valStr.length * 8.5 + 12);
            pill = document.createElementNS("http://www.w3.org/2000/svg","rect");
            pill.setAttribute('x',endX-pillW-6); pill.setAttribute('y',barY-11);
            pill.setAttribute('width',pillW); pill.setAttribute('height',22);
            pill.setAttribute('rx','11'); pill.setAttribute('fill',color);
            pill.style.opacity = '0';
            pill.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(pill);

            tVal = document.createElementNS("http://www.w3.org/2000/svg","text");
            tVal.setAttribute('x',endX-pillW/2-6); tVal.setAttribute('y',barY+5.5);
            tVal.setAttribute('font-family','Outfit'); tVal.setAttribute('font-size','13px');
            tVal.setAttribute('font-weight','bold'); tVal.setAttribute('fill','#ffffff');
            tVal.setAttribute('text-anchor','middle'); tVal.textContent = valStr;
            tVal.style.opacity = '0';
            tVal.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(tVal);
        }

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

        const textStr = `${govArabicName} ${val}`;
        const chipW   = textStr.length * 7.2 + 14;
        const chipY   = val > 0 ? -(3 + (val / maxVal) * 2.5) - 22 : -22;

        const chip = document.createElementNS('http://www.w3.org/2000/svg', 'rect');
        chip.setAttribute('x', -chipW / 2);
        chip.setAttribute('y', chipY - 16);
        chip.setAttribute('width', chipW);
        chip.setAttribute('height', '20');
        chip.setAttribute('rx', '5');
        chip.setAttribute('fill', val > 0 ? (colorTheme || '#0ea5e9') : '#64748b');
        chip.setAttribute('opacity', val > 0 ? '0.95' : '0.6');
        g.appendChild(chip);

        const lbl = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        lbl.setAttribute('x', '0');
        lbl.setAttribute('y', chipY - 2);
        lbl.setAttribute('font-family', 'Tajawal, sans-serif');
        lbl.setAttribute('font-size', '12');
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
    const opAId  = document.getElementById('cmp-op-a').value;
    const fromA  = document.getElementById('cmp-from-a').value;
    const toA    = document.getElementById('cmp-to-a').value;
    
    const docBId = document.getElementById('cmp-doc-b').value;
    const opBId  = document.getElementById('cmp-op-b').value;
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

    const opSelA = document.getElementById('cmp-op-a');
    const opSelB = document.getElementById('cmp-op-b');
    const opNameA = opSelA.options[opSelA.selectedIndex].text;
    const opNameB = opSelB.options[opSelB.selectedIndex].text;

    let labelA = docNameA;
    if (opAId) {
        labelA += ` [${opNameA}]`;
    }
    labelA += ` (${fromA} : ${toA})`;

    let labelB = docNameB;
    if (opBId) {
        labelB += ` [${opNameB}]`;
    }
    labelB += ` (${fromB} : ${toB})`;

    document.getElementById('cmp-loading').classList.remove('hidden');
    document.getElementById('cmp-results').classList.add('hidden');
    document.getElementById('cmp-run-btn').disabled = true;

    try {
        const params = new URLSearchParams({
            doctor_id_a: docAId, op_name_id_a: opAId, start_date_a: fromA, end_date_a: toA,
            doctor_id_b: docBId, op_name_id_b: opBId, start_date_b: fromB, end_date_b: toB,
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

    document.getElementById('kpi-s-a').textContent = Number(A.total_surgeries || 0).toLocaleString();
    document.getElementById('kpi-s-b').textContent = Number(B.total_surgeries || 0).toLocaleString();
    cmpDiff('kpi-s-diff', A.total_surgeries, B.total_surgeries);

    // تهيئة قيم المنسدلات المحفوظة في localStorage
    document.querySelectorAll('.arrow-style-select').forEach(sel => {
        const svgId = sel.dataset.svgId;
        if (svgId) {
            const savedVal = localStorage.getItem('arrow_style_' + svgId) || 'flat';
            sel.value = savedVal;
        }
    });

    // ─ جدول 1: الاستشاريات ─
    const consA = A.consultations || [];
    const consB = B.consultations || [];
    cmpWatchChart('cmp-svg-1-a', () => drawComparisonToggleChart('cmp-svg-1-a', 'donut', () => cmpDrawBranching('cmp-svg-1-a', consA, A.total_visits, CMP_COLORS_A), consA.map(r => r.total), consA.map(r => r.unit), 'الاستشاريات', CMP_COLORS_A));
    cmpWatchChart('cmp-svg-1-b', () => drawComparisonToggleChart('cmp-svg-1-b', 'donut', () => cmpDrawBranching('cmp-svg-1-b', consB, B.total_visits, CMP_COLORS_B), consB.map(r => r.total), consB.map(r => r.unit), 'الاستشاريات', CMP_COLORS_B));
    cmpRenderTable('cmp-tbl-1-a', consA.map((r,i) => `<tr class="table-row"><td>${r.unit}</td><td class="text-center font-bold">${r.total.toLocaleString()}</td></tr>`).join('') + (consA.length ? `<tr class="table-row font-extrabold text-theme-pink"><td class="text-center">الإجمالي</td><td class="text-center">${A.total_visits.toLocaleString()}</td></tr>` : ''), 2, 'لا بيانات');
    cmpRenderTable('cmp-tbl-1-b', consB.map((r,i) => `<tr class="table-row"><td>${r.unit}</td><td class="text-center font-bold">${r.total.toLocaleString()}</td></tr>`).join('') + (consB.length ? `<tr class="table-row font-extrabold text-theme-pink"><td class="text-center">الإجمالي</td><td class="text-center">${B.total_visits.toLocaleString()}</td></tr>` : ''), 2, 'لا بيانات');

    // ─ جدول 2: مراجعو كل طبيب ─
    const vdA = A.visits_by_doctor || [];
    const vdB = B.visits_by_doctor || [];
    cmpWatchChart('cmp-svg-2-a', () => drawComparisonToggleChart('cmp-svg-2-a', 'bar', () => cmpDrawVertical('cmp-svg-2-a', vdA.map(r => r.total), vdA.map(r => r.doctor.replace('د. ','')), CMP_COLORS_A), vdA.map(r => r.total), vdA.map(r => r.doctor.replace('د. ','')), 'المرضى', CMP_COLORS_A));
    cmpWatchChart('cmp-svg-2-b', () => drawComparisonToggleChart('cmp-svg-2-b', 'bar', () => cmpDrawVertical('cmp-svg-2-b', vdB.map(r => r.total), vdB.map(r => r.doctor.replace('د. ','')), CMP_COLORS_B), vdB.map(r => r.total), vdB.map(r => r.doctor.replace('د. ','')), 'المرضى', CMP_COLORS_B));

    // ─ جدول 3: داخل العراق ─
    const gvA = A.visits_by_gov || [];
    const gvB = B.visits_by_gov || [];
    cmpWatchChart('cmp-svg-3-a', () => cmpDrawIraqMap('cmp-svg-3-a', gvA.map(r => r.total), gvA.map(r => r.gov), '#3b82f6'));
    cmpWatchChart('cmp-svg-3-b', () => cmpDrawIraqMap('cmp-svg-3-b', gvB.map(r => r.total), gvB.map(r => r.gov), '#f43f5e'));

    // ─ جدول 4: خارج العراق ─
    const cvA = A.visits_by_country || [];
    const cvB = B.visits_by_country || [];
    cmpWatchChart('cmp-svg-4-a', () => drawComparisonToggleChart('cmp-svg-4-a', 'bar-h', () => cmpDrawChevrons('cmp-svg-4-a', cvA.map(r => r.total), cvA.map(r => r.country), CMP_COLORS_A), cvA.map(r => r.total), cvA.map(r => r.country), 'الدول', CMP_COLORS_A));
    cmpWatchChart('cmp-svg-4-b', () => drawComparisonToggleChart('cmp-svg-4-b', 'bar-h', () => cmpDrawChevrons('cmp-svg-4-b', cvB.map(r => r.total), cvB.map(r => r.country), CMP_COLORS_B), cvB.map(r => r.total), cvB.map(r => r.country), 'الدول', CMP_COLORS_B));

    // ─ جدول 8: داخل العراق (عمليات) ─
    const sgA = A.surgeries_by_gov || [];
    const sgB = B.surgeries_by_gov || [];
    cmpWatchChart('cmp-svg-8-a', () => cmpDrawIraqMap('cmp-svg-8-a', sgA.map(r => r.total), sgA.map(r => r.gov), '#3b82f6'));
    cmpWatchChart('cmp-svg-8-b', () => cmpDrawIraqMap('cmp-svg-8-b', sgB.map(r => r.total), sgB.map(r => r.gov), '#f43f5e'));

    // ─ جدول 9: خارج العراق (عمليات) ─
    const scgA = A.surgeries_by_country || [];
    const scgB = B.surgeries_by_country || [];
    cmpWatchChart('cmp-svg-9-a', () => drawComparisonToggleChart('cmp-svg-9-a', 'bar-h', () => cmpDrawChevrons('cmp-svg-9-a', scgA.map(r => r.total), scgA.map(r => r.country), CMP_COLORS_A), scgA.map(r => r.total), scgA.map(r => r.country), 'الدول', CMP_COLORS_A));
    cmpWatchChart('cmp-svg-9-b', () => drawComparisonToggleChart('cmp-svg-9-b', 'bar-h', () => cmpDrawChevrons('cmp-svg-9-b', scgB.map(r => r.total), scgB.map(r => r.country), CMP_COLORS_B), scgB.map(r => r.total), scgB.map(r => r.country), 'الدول', CMP_COLORS_B));

    // ─ جدول 5: الفحوصات البصرية والساندة (مستقل — حسب الفترة فقط) ─
    const etA = A.eye_tests_by_type || [];
    const etB = B.eye_tests_by_type || [];
    cmpWatchChart('cmp-svg-5-a', () => drawComparisonToggleChart('cmp-svg-5-a', 'bar-h', () => cmpDrawChevrons('cmp-svg-5-a', etA.map(r => r.total), etA.map(r => r.type), ['#f97316','#ea580c','#c2410c','#9a3412','#7c2d12']), etA.map(r => r.total), etA.map(r => r.type), 'الفحوصات', ['#f97316','#ea580c','#c2410c','#9a3412','#7c2d12']));
    cmpWatchChart('cmp-svg-5-b', () => drawComparisonToggleChart('cmp-svg-5-b', 'bar-h', () => cmpDrawChevrons('cmp-svg-5-b', etB.map(r => r.total), etB.map(r => r.type), ['#e11d48','#be123c','#9f1239','#881337','#4c0519']), etB.map(r => r.total), etB.map(r => r.type), 'الفحوصات', ['#e11d48','#be123c','#9f1239','#881337','#4c0519']));

    // ─ جدول 7: تصنيف العمليات ─
    const scA = A.surgeries_by_cat || [];
    const scB = B.surgeries_by_cat || [];
    const catOrder = @json($filterClassifications->pluck('name'));
    const catColors = ['#0ea5e9','#db2777','#d97706','#475569','#6d28d9','#e11d48','#3b82f6','#10b981','#f59e0b'];
    const scAOrdered = catOrder.map(c => scA.find(r => r.classification === c)?.total || 0);
    const scBOrdered = catOrder.map(c => scB.find(r => r.classification === c)?.total || 0);
    cmpWatchChart('cmp-svg-7-a', () => drawComparisonToggleChart('cmp-svg-7-a', 'donut', () => cmpDrawVertical('cmp-svg-7-a', scAOrdered, catOrder, catColors), scAOrdered, catOrder, 'العمليات', catColors));
    cmpWatchChart('cmp-svg-7-b', () => drawComparisonToggleChart('cmp-svg-7-b', 'donut', () => cmpDrawVertical('cmp-svg-7-b', scBOrdered, catOrder, catColors), scBOrdered, catOrder, 'العمليات', catColors));
    cmpRenderTable('cmp-tbl-7-a', scA.map(r => `<tr class="table-row"><td>${r.classification}</td><td class="text-center font-bold text-rose-600">${r.total.toLocaleString()}</td></tr>`).join(''), 2, 'لا عمليات');
    cmpRenderTable('cmp-tbl-7-b', scB.map(r => `<tr class="table-row"><td>${r.classification}</td><td class="text-center font-bold text-rose-600">${r.total.toLocaleString()}</td></tr>`).join(''), 2, 'لا عمليات');

    // ─ جدول 10: عمليات كل طبيب (إجمالي) ─
    const sdA = A.surgs_by_doctor || [];
    const sdB = B.surgs_by_doctor || [];
    cmpWatchChart('cmp-svg-10-a', () => drawComparisonToggleChart('cmp-svg-10-a', 'bar', () => cmpDrawVertical('cmp-svg-10-a', sdA.map(r => r.total), sdA.map(r => r.doctor.replace('د. ','')), CMP_COLORS_A), sdA.map(r => r.total), sdA.map(r => r.doctor.replace('د. ','')), 'العمليات', CMP_COLORS_A));
    cmpWatchChart('cmp-svg-10-b', () => drawComparisonToggleChart('cmp-svg-10-b', 'bar', () => cmpDrawVertical('cmp-svg-10-b', sdB.map(r => r.total), sdB.map(r => r.doctor.replace('د. ','')), CMP_COLORS_B), sdB.map(r => r.total), sdB.map(r => r.doctor.replace('د. ','')), 'العمليات', CMP_COLORS_B));

    // ─ التفصيلي (combined_ops) ─
    const coA = A.combined_ops || [];
    const coB = B.combined_ops || [];
    cmpWatchChart('cmp-svg-detail-a', () => drawComparisonToggleChart('cmp-svg-detail-a', 'bar-h', () => cmpDrawChevrons('cmp-svg-detail-a', coA.map(r => r.total), coA.map(r => r.op), CMP_COLORS_A), coA.map(r => r.total), coA.map(r => r.op), 'العمليات', CMP_COLORS_A));
    cmpWatchChart('cmp-svg-detail-b', () => drawComparisonToggleChart('cmp-svg-detail-b', 'bar-h', () => cmpDrawChevrons('cmp-svg-detail-b', coB.map(r => r.total), coB.map(r => r.op), CMP_COLORS_B), coB.map(r => r.total), coB.map(r => r.op), 'العمليات', CMP_COLORS_B));

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

    // ─ تحديث شارات المجاميع في عناوين الجداول ─
    const cmpSetTotal = (id, a, b) => {
        const el = document.getElementById(id);
        if (!el) return;
        const total = Number(a || 0) + Number(b || 0);
        el.textContent = 'المجموع الكلي: ' + total.toLocaleString();
        el.classList.remove('hidden');
    };
    cmpSetTotal('cmp-total-1',  A.total_visits,    B.total_visits);
    cmpSetTotal('cmp-total-2',  A.total_visits,    B.total_visits);
    cmpSetTotal('cmp-total-3',  (A.visits_by_gov    || []).reduce((s,r)=>s+r.total,0), (B.visits_by_gov    || []).reduce((s,r)=>s+r.total,0));
    cmpSetTotal('cmp-total-4',  (A.visits_by_country|| []).reduce((s,r)=>s+r.total,0), (B.visits_by_country|| []).reduce((s,r)=>s+r.total,0));
    cmpSetTotal('cmp-total-5',  A.total_eye_tests,  B.total_eye_tests);

    cmpSetTotal('cmp-total-7',  A.total_surgeries,  B.total_surgeries);
    cmpSetTotal('cmp-total-8',  (A.surgeries_by_gov    || []).reduce((s,r)=>s+r.total,0), (B.surgeries_by_gov    || []).reduce((s,r)=>s+r.total,0));
    cmpSetTotal('cmp-total-9',  (A.surgeries_by_country|| []).reduce((s,r)=>s+r.total,0), (B.surgeries_by_country|| []).reduce((s,r)=>s+r.total,0));
    cmpSetTotal('cmp-total-10', A.total_surgeries,  B.total_surgeries);
    cmpSetTotal('cmp-total-detail', A.total_surgeries, B.total_surgeries);

    // ─ Show results ─
    document.getElementById('cmp-results').classList.remove('hidden');
    setTimeout(() => { if (window.lucide) lucide.createIcons(); }, 100);
}

function resetComparisonFilters() {
    // تصفير القيم في فلاتر المقارنة
    document.getElementById('cmp-doc-a').value = '';
    document.getElementById('cmp-doc-b').value = '';
    document.getElementById('cmp-op-a').value = '';
    document.getElementById('cmp-op-b').value = '';
    
    const defaultStart = '2026-05';
    const defaultEnd = '2026-05';
    
    document.getElementById('cmp-from-a').value = defaultStart;
    document.getElementById('cmp-to-a').value = defaultEnd;
    document.getElementById('cmp-from-b').value = defaultStart;
    document.getElementById('cmp-to-b').value = defaultEnd;
    
    // إخفاء النتائج
    document.getElementById('cmp-results').classList.add('hidden');
    
    if (typeof showToast === 'function') {
        showToast('تم تصفير فلاتر المقارنة بنجاح', 'info');
    }
}

// Page init hook
window.initComparisonPage = function() {
    setTimeout(() => { if (window.lucide) lucide.createIcons(); }, 100);
};
</script>
