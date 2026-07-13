@php
$cGeneral = $consultations->firstWhere('unit', 'استشارية العيون العامة')['total'] ?? ($consultations[0]['total'] ?? 0);
$cSpecial = $consultations->firstWhere('unit', 'استشارية التخصصات الدقيقة')['total'] ?? ($consultations[1]['total'] ?? 0);
$generalLabel = $consultations->firstWhere('unit', 'استشارية العيون العامة')['unit'] ?? ($consultations[0]['unit'] ?? 'العامة');
$specialLabel = $consultations->firstWhere('unit', 'استشارية التخصصات الدقيقة')['unit'] ?? ($consultations[1]['unit'] ?? 'التخصصات');
$pathsHtml = '';
if (file_exists(base_path('iraq.svg'))) {
    $svgContent = file_get_contents(base_path('iraq.svg'));
    if (preg_match_all('/<path[^>]+>/i', $svgContent, $matches)) {
        $pathsHtml = implode("\n", $matches[0]);
    }
}
@endphp
<!-- PAGE 2: REPORTS PAGE SECTION (Unified Scrollable Dashboard with Flat Arrow Infographics) -->
<section id="page-reports" class="page-section space-y-6 hidden">

    <!-- Filter & Action Bar -->
    <div class="custom-card p-4 rounded-2xl space-y-4">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-pink-500/10 flex items-center justify-center text-pink-500">
                    <i data-lucide="file-bar-chart-2" class="w-4 h-4"></i>
                </div>
                <div>
                    <h2 class="text-xs font-bold text-text-main">الإحصاءات والتقارير الطبية</h2>
                    <p class="text-[9px] text-slate-400 font-bold mt-0.5">
                        الفترة:
                        <span class="text-pink-500 font-black">
                            {{ \Carbon\Carbon::parse($start_date)->translatedFormat('M Y') }}
                            @if(substr($start_date,0,7) !== substr($end_date,0,7))
                                — {{ \Carbon\Carbon::parse($end_date)->translatedFormat('M Y') }}
                            @endif
                        </span>
                        @if($doctor_id)
                            &nbsp;|&nbsp; <span class="text-violet-500">{{ $filterDoctors->firstWhere('id',$doctor_id)?->name ?? '' }}</span>
                        @endif
                        @if($sector_id)
                            &nbsp;|&nbsp; <span class="text-sky-500">{{ $filterSectors->firstWhere('id',$sector_id)?->name ?? '' }}</span>
                        @endif
                    </p>
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <!-- Date range pickers -->
                <div class="flex items-center gap-1.5 bg-slate-200/20 px-3 py-1.5 rounded-xl border border-slate-200/10">
                    <span class="text-[9px] font-bold text-slate-400">من:</span>
                    <input type="month" id="report-date-from" value="{{ substr($start_date ?? '2026-05-01', 0, 7) }}" class="bg-transparent border-none focus:outline-none text-[10px] font-bold text-text-main custom-date-input">
                    <span class="text-[9px] font-bold text-slate-400">إلى:</span>
                    <input type="month" id="report-date-to" value="{{ substr($end_date ?? '2026-05-31', 0, 7) }}" class="bg-transparent border-none focus:outline-none text-[10px] font-bold text-text-main custom-date-input">
                </div>
                <!-- Advanced Toggle button -->
                <button onclick="toggleAdvancedFilters()" class="py-2 px-4 rounded-xl text-xs font-bold text-text-main bg-slate-200/20 hover:bg-slate-200/40 border border-slate-200/10 hover-press flex items-center gap-1.5">
                    <i data-lucide="sliders-horizontal" class="w-3.5 h-3.5 text-pink-500"></i>
                    <span>تصفية متقدمة</span>
                    <i data-lucide="chevron-down" id="adv-filters-chevron" class="w-3 h-3 transition-transform"></i>
                </button>
                <button onclick="applyDateRangeFilter()" class="py-2 px-5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-pink-500 to-pink-400 hover-press flex items-center gap-2">
                    <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i><span>تطبيق التصفية</span>
                </button>
                <button onclick="resetAllFilters()" class="py-2 px-4 rounded-xl text-xs font-bold bg-slate-200/20 text-slate-400 hover:bg-slate-200/40 hover-press flex items-center gap-1.5">
                    <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i><span>تصفير الفلتر</span>
                </button>
                <button onclick="printReportWindow()" class="py-2 px-4 rounded-xl text-xs font-bold bg-violet-500/10 text-violet-600 hover:bg-violet-500/20 hover-press flex items-center gap-1.5 border border-violet-300/20">
                    <i data-lucide="printer" class="w-3.5 h-3.5"></i>
                    <span>طباعة التقرير</span>
                </button>
            </div>
        </div>

        <!-- Collapsible Advanced Filters Drawer -->
        <div id="advanced-filters-panel" class="hidden border-t border-slate-200/10 pt-4 transition-all duration-300">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-3">
                <!-- 1. Doctor Select -->
                <div class="flex flex-col gap-1">
                    <label class="text-[9px] font-bold text-slate-400 font-['Tajawal']">الطبيب الاختصاص:</label>
                    <select id="filter-doctor-id" class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-3 text-xs font-bold text-text-main font-['Tajawal']">
                        <option value="">كل الأطباء</option>
                        @foreach($filterDoctors as $doc)
                        <option value="{{ $doc->id }}" {{ isset($doctor_id) && $doctor_id == $doc->id ? 'selected' : '' }}>{{ $doc->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- 2. Clinic Unit Select -->
                <div class="flex flex-col gap-1">
                    <label class="text-[9px] font-bold text-slate-400 font-['Tajawal']">الاستشارية:</label>
                    <select id="filter-clinic-unit-id" class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-3 text-xs font-bold text-text-main font-['Tajawal']">
                        <option value="">كل الاستشاريات</option>
                        @foreach($filterClinicUnits as $unit)
                        <option value="{{ $unit->id }}" {{ isset($clinic_unit_id) && $clinic_unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- 3. Governorate Select -->
                <div class="flex flex-col gap-1">
                    <label class="text-[9px] font-bold text-slate-400 font-['Tajawal']">المحافظة:</label>
                    <select id="filter-governorate-id" class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-3 text-xs font-bold text-text-main font-['Tajawal']">
                        <option value="">كل المحافظات</option>
                        @foreach($filterGovernorates as $gov)
                        <option value="{{ $gov->id }}" {{ isset($governorate_id) && $governorate_id == $gov->id ? 'selected' : '' }}>{{ $gov->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- 4. Country Select -->
                <div class="flex flex-col gap-1">
                    <label class="text-[9px] font-bold text-slate-400 font-['Tajawal']">الدولة:</label>
                    <select id="filter-country-id" class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-3 text-xs font-bold text-text-main font-['Tajawal']">
                        <option value="">كل الدول</option>
                        @foreach($filterCountries as $c)
                        <option value="{{ $c->id }}" {{ isset($country_id) && $country_id == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- 5. Sector Select -->
                <div class="flex flex-col gap-1">
                    <label class="text-[9px] font-bold text-slate-400 font-['Tajawal']">القطاع:</label>
                    <select id="filter-sector-id" class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-3 text-xs font-bold text-text-main font-['Tajawal']">
                        <option value="">كل القطاعات</option>
                        @foreach($filterSectors as $sec)
                        <option value="{{ $sec->id }}" {{ isset($sector_id) && $sector_id == $sec->id ? 'selected' : '' }}>{{ $sec->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Action buttons -->
            <div class="flex justify-end gap-2 mt-4">
                <button onclick="resetAllFilters()" class="py-1.5 px-4 rounded-xl text-[10px] font-bold bg-slate-200/40 text-slate-500 hover:bg-slate-200/60 hover-press">إعادة تعيين</button>
            </div>
        </div>
    </div>

    <!-- 1. الاستشاريات العامة والتخصصية (جدول 1) -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-xs font-bold text-text-main flex items-center justify-between pb-3 mb-4 border-b border-slate-200/20">
            <div class="flex items-center gap-2">
                <i data-lucide="stethoscope" class="w-4 h-4 text-pink-500"></i>
                أعداد المرضى في الاستشاريات
                <span id="cmp-total-1" class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع: {{ number_format($totalVisits) }}</span>
            </div>
        </h3>
        <div class="grid grid-cols-1 gap-8">
            <!-- Data Table -->
            <div>
                <table class="custom-table text-xs">
                    <thead><tr><th class="w-12 text-center">ت</th><th>الوحدة الطبية</th><th class="text-center font-bold">المجموع</th></tr></thead>
                    <tbody>
                        @foreach($consultations as $index => $c)
                        <tr class="table-row">
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $c['unit'] }}</td>
                            <td class="text-center font-bold">{{ number_format($c['total']) }}</td>
                        </tr>
                        @endforeach
                        <tr class="table-row font-extrabold text-theme-pink">
                            <td colspan="2" class="text-center">المجموع الكلي</td>
                            <td class="text-center text-sm font-extrabold">{{ number_format($consultations->sum('total')) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- 2. مراجعو كل طبيب اختصاص (جدول 2) -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-xs font-bold text-text-main flex items-center justify-between pb-3 mb-4 border-b border-slate-200/20">
            <div class="flex items-center gap-2">
                <i data-lucide="users" class="w-4 h-4 text-emerald-500"></i>
                أعداد مرضى كل طبيب اختصاص
                <span id="cmp-total-2" class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع: {{ number_format($totalVisits) }}</span>
            </div>
            <div class="flex items-center gap-1.5 no-print">
                <span class="text-[9px] font-bold text-slate-400 font-['Tajawal']">شكل السهم:</span>
                <select id="select-svg-report-2" data-svg-id="svg-report-2" onchange="changeReportChartStyle('svg-report-2', this.value)" class="arrow-style-select bg-slate-200/20 text-slate-500 dark:text-slate-400 border border-slate-200/10 rounded-lg px-2 py-0.5 text-[9px] font-bold focus:outline-none cursor-pointer font-['Tajawal']">
                    <option value="flat">أسهم مسطحة</option>
                    <option value="glow">أسهم متوهجة</option>
                    <option value="bar">أعمدة رأسية (جارت)</option>
                    <option value="bar-h">أعمدة أفقية (جارت)</option>
                    <option value="donut">شكل دائري (جارت)</option>
                    <option value="area">مخطط مساحي (جارت)</option>
                </select>
            </div>
        </h3>
        <div class="w-full overflow-x-auto py-2">
            <svg id="svg-report-2" viewBox="0 0 900 240" class="w-full min-w-[850px] h-[240px] overflow-visible"></svg>
        </div>
    </div>

    <!-- 3. التوزيع الديمغرافي لمراجعي الاستشاريات (جدول 3 و 4) -->
    <div class="grid grid-cols-1 gap-6">
        <!-- Inside Iraq (Vertical Columns) -->
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="flag" class="w-4 h-4 text-sky-500"></i>
                التوزيع الجغرافي داخل العراق
                <span class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع: {{ number_format($visitsByGov->sum('total')) }}</span>
            </h3>
            <div class="w-full overflow-x-auto py-2">
                <svg id="svg-report-3" viewBox="0 0 584 594" class="w-full max-w-[580px] h-auto md:h-[580px] overflow-visible mx-auto">
                    <g id="svg-report-3-paths" fill="rgba(14, 165, 233, 0.03)" stroke="#cbd5e1" stroke-width="1.2">
                        {!! $pathsHtml !!}
                    </g>
                    <g id="svg-report-3-nodes"></g>
                </svg>
            </div>
        </div>
        <!-- Outside Iraq (Horizontal Chevrons) -->
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center justify-between pb-3 mb-4 border-b border-slate-200/20">
                <div class="flex items-center gap-2">
                    <i data-lucide="globe" class="w-4 h-4 text-pink-500"></i>
                    المرضى من خارج العراق
                    <span id="cmp-total-4" class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع: {{ number_format($visitsByCountry->sum('total')) }}</span>
                </div>
                <div class="flex items-center gap-1.5 no-print">
                    <span class="text-[9px] font-bold text-slate-400 font-['Tajawal']">شكل السهم:</span>
                    <select id="select-svg-report-4" data-svg-id="svg-report-4" onchange="changeReportChartStyle('svg-report-4', this.value)" class="arrow-style-select bg-slate-200/20 text-slate-500 dark:text-slate-400 border border-slate-200/10 rounded-lg px-2 py-0.5 text-[9px] font-bold focus:outline-none cursor-pointer font-['Tajawal']">
                        <option value="flat">أسهم مسطحة</option>
                        <option value="glow">أسهم متوهجة</option>
                        <option value="bar">أعمدة رأسية (جارت)</option>
                        <option value="bar-h">أعمدة أفقية (جارت)</option>
                        <option value="donut">شكل دائري (جارت)</option>
                        <option value="area">مخطط مساحي (جارت)</option>
                    </select>
                </div>
            </h3>
            <div class="w-full overflow-x-auto py-2">
                <svg id="svg-report-4" viewBox="0 0 450 180" class="w-full min-w-[400px] h-auto overflow-visible"></svg>
            </div>
        </div>
    </div>

    <!-- 4. الفحوصات البصرية والتحاليل المختبرية (جدول 5 و 6) -->
    <div class="grid grid-cols-1 gap-6">
        <!-- Visual Tests (Horizontal Chevrons) -->
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center justify-between pb-3 mb-4 border-b border-slate-200/20">
                <div class="flex items-center gap-2">
                    <i data-lucide="eye" class="w-4 h-4 text-orange-500"></i>
                    البصرية والساندة
                    <span class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع: {{ number_format($totalEyeTests) }}</span>
                </div>
                <div class="flex items-center gap-1.5 no-print">
                    <span class="text-[9px] font-bold text-slate-400 font-['Tajawal']">شكل السهم:</span>
                    <select id="select-svg-report-5" data-svg-id="svg-report-5" onchange="changeReportChartStyle('svg-report-5', this.value)" class="arrow-style-select bg-slate-200/20 text-slate-500 dark:text-slate-400 border border-slate-200/10 rounded-lg px-2 py-0.5 text-[9px] font-bold focus:outline-none cursor-pointer font-['Tajawal']">
                        <option value="flat">أسهم مسطحة</option>
                        <option value="glow">أسهم متوهجة</option>
                        <option value="bar">أعمدة رأسية (جارت)</option>
                        <option value="bar-h">أعمدة أفقية (جارت)</option>
                        <option value="donut">شكل دائري (جارت)</option>
                        <option value="area">مخطط مساحي (جارت)</option>
                    </select>
                </div>
            </h3>
            <div class="w-full overflow-x-auto py-2">
                <svg id="svg-report-5" viewBox="0 0 450 200" class="w-full min-w-[420px] h-auto overflow-visible"></svg>
            </div>
        </div>
        <!-- Lab Tests (Flat Arrow Columns) -->
        <div class="custom-card p-6 rounded-2xl flex flex-col justify-between">
            <h3 class="text-xs font-bold text-text-main flex items-center justify-between pb-3 mb-4 border-b border-slate-200/20">
                <div class="flex items-center gap-2">
                    <i data-lucide="test-tube" class="w-4 h-4 text-purple-500"></i>
                    التحاليل المختبرية المنجزة
                    <span class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع: {{ number_format($labTestsByType->sum('total')) }}</span>
                </div>
                <div class="flex items-center gap-1.5 no-print">
                    <span class="text-[9px] font-bold text-slate-400 font-['Tajawal']">شكل السهم:</span>
                    <select id="select-svg-report-6" data-svg-id="svg-report-6" onchange="changeReportChartStyle('svg-report-6', this.value)" class="arrow-style-select bg-slate-200/20 text-slate-500 dark:text-slate-400 border border-slate-200/10 rounded-lg px-2 py-0.5 text-[9px] font-bold focus:outline-none cursor-pointer font-['Tajawal']">
                        <option value="flat">أسهم مسطحة</option>
                        <option value="glow">أسهم متوهجة</option>
                        <option value="bar">أعمدة رأسية (جارت)</option>
                        <option value="bar-h">أعمدة أفقية (جارت)</option>
                        <option value="donut">شكل دائري (جارت)</option>
                        <option value="area">مخطط مساحي (جارت)</option>
                    </select>
                </div>
            </h3>
            <div class="w-full overflow-x-auto py-2">
                <svg id="svg-report-6" viewBox="0 0 450 180" class="w-full min-w-[420px] h-[180px] overflow-visible"></svg>
            </div>
        </div>
    </div>


    <!-- 5. تصنيف العمليات الجراحية (جدول 7) -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-xs font-bold text-text-main flex items-center justify-between pb-3 mb-4 border-b border-slate-200/20">
            <div class="flex items-center gap-2">
                <i data-lucide="scissors" class="w-4 h-4 text-rose-500"></i>
                أعداد وتصنيف العمليات الجراحية للعيون حسب القطاعات
                <span class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع الكلي للعمليات: {{ number_format($totalSurgeries) }}</span>
            </div>
            <div class="flex items-center gap-1.5 no-print">
                <span class="text-[9px] font-bold text-slate-400 font-['Tajawal']">شكل السهم:</span>
                <select id="select-svg-report-7" data-svg-id="svg-report-7" onchange="changeReportChartStyle('svg-report-7', this.value)" class="arrow-style-select bg-slate-200/20 text-slate-500 dark:text-slate-400 border border-slate-200/10 rounded-lg px-2 py-0.5 text-[9px] font-bold focus:outline-none cursor-pointer font-['Tajawal']">
                    <option value="flat">أسهم مسطحة</option>
                    <option value="glow">أسهم متوهجة</option>
                    <option value="bar">أعمدة رأسية (جارت)</option>
                    <option value="bar-h">أعمدة أفقية (جارت)</option>
                    <option value="donut">شكل دائري (جارت)</option>
                    <option value="area">مخطط مساحي (جارت)</option>
                </select>
            </div>
        </h3>
        <div class="grid grid-cols-1 gap-8">
            <!-- 2D Arrow Columns -->
            <div class="w-full flex justify-center">
                <svg id="svg-report-7" viewBox="0 0 520 220" class="w-full max-w-[420px] h-[220px] overflow-visible"></svg>
            </div>
            <!-- Dynamic Table from database metadata, filled via AJAX -->
            <div class="w-full">
                <div id="table7-loading" class="text-center text-xs text-slate-400 py-6">
                    <i data-lucide="loader" class="w-4 h-4 inline animate-spin mr-1"></i> جاري تحميل بيانات التصنيف...
                </div>
                <table id="table7-content" class="custom-table text-center text-[11px] hidden" style="min-width:100%">
                    @php
                        // ترتيب القطاعات: قطاع الصحة، قطاع العتبة الخاص، قطاع العتبة العام
                        $orderedSectors7 = collect();
                        
                        $health = $filterSectors->first(fn($s) => str_contains($s->name, 'الصحة') || str_contains($s->name, 'صحة'));
                        if ($health) $orderedSectors7->push($health);
                        
                        $private = $filterSectors->first(fn($s) => str_contains($s->name, 'الخاص') || str_contains($s->name, 'خاص'));
                        if ($private) $orderedSectors7->push($private);
                        
                        $public = $filterSectors->first(fn($s) => str_contains($s->name, 'العام') || str_contains($s->name, 'عام'));
                        if ($public) $orderedSectors7->push($public);
                        
                        foreach($filterSectors as $s) {
                            if (!$orderedSectors7->contains('id', $s->id)) {
                                $orderedSectors7->push($s);
                            }
                        }
                    @endphp
                    <thead>
                        <tr class="text-[10px] font-bold text-slate-400">
                            <th class="text-right pr-3">تصنيف العمليات الجراحية</th>
                            @php
                                $headerColors = [
                                    'bg-sky-400/20 text-sky-800 dark:text-sky-300',
                                    'bg-orange-400/20 text-orange-800 dark:text-orange-300',
                                    'bg-emerald-400/20 text-emerald-800 dark:text-emerald-300',
                                    'bg-yellow-400/20 text-yellow-800 dark:text-yellow-300',
                                    'bg-purple-400/20 text-purple-800 dark:text-purple-300'
                                ];
                            @endphp
                            @foreach($orderedSectors7 as $idx => $s)
                                @php
                                    $colorClass = $headerColors[$idx % count($headerColors)];
                                    $displaySecName = $s->name;
                                    if ($s->name === 'عتبة الخاص' || $s->name === 'قطاع العتبة الخاص') $displaySecName = 'قطاع العتبة الخاص';
                                    elseif ($s->name === 'عتبة العام' || $s->name === 'قطاع العتبة العام') $displaySecName = 'قطاع العتبة العام';
                                    elseif ($s->name === 'قطاع الصحة' || $s->name === 'صحة') $displaySecName = 'قطاع الصحة';
                                @endphp
                                <th class="{{ $colorClass }} font-bold">{{ $displaySecName }}</th>
                            @endforeach
                            <th class="text-pink-600 font-extrabold">المجموع</th>
                        </tr>
                    </thead>
                    <tbody id="table7-tbody">
                        @foreach($filterClassifications as $c)
                            @php
                                $standardLabels = [
                                    'صغرى' => 'العمليات الصغرى',
                                    'وسطى (حقن)' => 'العمليات الوسطى (حقن العين)',
                                    'وسطى (ليزر)' => 'العمليات الوسطى (الليزر)',
                                    'كبرى' => 'العمليات الكبرى',
                                    'فوق الكبرى' => 'العمليات فوق الكبرى',
                                    'خاصة' => 'العمليات الخاصة'
                                ];
                                $label = $standardLabels[$c->name] ?? $c->name;
                            @endphp
                            <tr class="table-row table7-data-row" data-cls="{{ $c->name }}">
                                <td class="text-right pr-3 font-bold">{{ $label }}</td>
                                @foreach($orderedSectors7 as $s)
                                    <td class="font-bold table7-cell opacity-30" data-cls="{{ $c->name }}" data-sec="{{ $s->name }}">0</td>
                                @endforeach
                                <td class="font-extrabold text-pink-600 text-sm table7-row-total">0</td>
                            </tr>
                        @endforeach
                        
                        <!-- Totals Row -->
                        <tr class="table-row font-extrabold text-rose-600 text-sm" id="table7-totals-row">
                            <td class="text-right pr-3 text-sm">المجموع</td>
                            @foreach($orderedSectors7 as $s)
                                <td class="bg-slate-100/5 table7-col-total" data-sec="{{ $s->name }}">0</td>
                            @endforeach
                            <td class="text-base font-black text-pink-600" id="table7-grand-total">0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- التوزيع الجغرافي للعمليات الجراحية (جدول 8 و 9) -->

    <div class="grid grid-cols-1 gap-6">
        <!-- Inside Iraq (Vertical Columns) -->
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="flag" class="w-4 h-4 text-rose-500"></i>
                التوزيع الجغرافي للعمليات الجراحية داخل العراق
                <span class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع: {{ number_format($surgeriesByGov->sum('total')) }}</span>
            </h3>
            <div class="w-full overflow-x-auto py-2">
                <svg id="svg-report-8" viewBox="0 0 584 594" class="w-full max-w-[580px] h-auto md:h-[580px] overflow-visible mx-auto">
                    <g id="svg-report-8-paths" fill="rgba(244, 63, 94, 0.03)" stroke="#cbd5e1" stroke-width="1.2">
                        {!! $pathsHtml !!}
                    </g>
                    <g id="svg-report-8-nodes"></g>
                </svg>
            </div>
        </div>
        <!-- Outside Iraq (Horizontal Chevrons) -->
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center justify-between pb-3 mb-4 border-b border-slate-200/20">
                <div class="flex items-center gap-2">
                    <i data-lucide="globe" class="w-4 h-4 text-pink-500"></i>
                    العمليات الجراحية للمرضى من خارج العراق
                    <span class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع: {{ number_format($surgeriesByCountry->sum('total')) }}</span>
                </div>
                <div class="flex items-center gap-1.5 no-print">
                    <span class="text-[9px] font-bold text-slate-400 font-['Tajawal']">شكل السهم:</span>
                    <select id="select-svg-report-9" data-svg-id="svg-report-9" onchange="changeReportChartStyle('svg-report-9', this.value)" class="arrow-style-select bg-slate-200/20 text-slate-500 dark:text-slate-400 border border-slate-200/10 rounded-lg px-2 py-0.5 text-[9px] font-bold focus:outline-none cursor-pointer font-['Tajawal']">
                        <option value="flat">أسهم مسطحة</option>
                        <option value="glow">أسهم متوهجة</option>
                        <option value="bar">أعمدة رأسية (جارت)</option>
                        <option value="bar-h">أعمدة أفقية (جارت)</option>
                        <option value="donut">شكل دائري (جارت)</option>
                        <option value="area">مخطط مساحي (جارت)</option>
                    </select>
                </div>
            </h3>
            <div class="w-full overflow-x-auto py-2">
                <svg id="svg-report-9" viewBox="0 0 450 180" class="w-full min-w-[400px] h-auto overflow-visible"></svg>
            </div>
        </div>
    </div>

    <!-- 6. العمليات الجراحية لكل طبيب اختصاص (جدول 10) -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-xs font-bold text-text-main flex items-center justify-between pb-3 mb-4 border-b border-slate-200/20">
            <div class="flex items-center gap-2">
                <i data-lucide="award" class="w-4 h-4 text-violet-500"></i>
                إجمالي العمليات الجراحية المنجزة لكل طبيب اختصاص (بيانات حقيقية)
                <span class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع: {{ number_format($totalSurgeries) }}</span>
            </div>
            <div class="flex items-center gap-1.5 no-print">
                <span class="text-[9px] font-bold text-slate-400 font-['Tajawal']">شكل السهم:</span>
                <select id="select-svg-report-10" data-svg-id="svg-report-10" onchange="changeReportChartStyle('svg-report-10', this.value)" class="arrow-style-select bg-slate-200/20 text-slate-500 dark:text-slate-400 border border-slate-200/10 rounded-lg px-2 py-0.5 text-[9px] font-bold focus:outline-none cursor-pointer font-['Tajawal']">
                    <option value="flat">أسهم مسطحة</option>
                    <option value="glow">أسهم متوهجة</option>
                    <option value="bar">أعمدة رأسية (جارت)</option>
                    <option value="bar-h">أعمدة أفقية (جارت)</option>
                    <option value="donut">شكل دائري (جارت)</option>
                    <option value="area">مخطط مساحي (جارت)</option>
                </select>
            </div>
        </h3>
        <div class="w-full overflow-x-auto py-2 mb-4">
            <svg id="svg-report-10" viewBox="0 0 900 240" class="w-full min-w-[850px] h-[240px] overflow-visible"></svg>
        </div>
        <div class="overflow-x-auto">
            <table class="custom-table text-center text-xs" style="min-width:850px">
                <thead>
                    <tr>
                        <th rowspan="2" class="w-6">ت</th>
                        <th rowspan="2" class="text-right pr-2 font-['Tajawal']">اسم الطبيب</th>
                        <th colspan="3" class="bg-yellow-400/20">صغرى</th>
                        <th colspan="3" class="bg-blue-400/20">وسطى</th>
                        <th colspan="3" class="bg-orange-400/20">كبرى</th>
                        <th colspan="3" class="bg-rose-400/20">فوق الكبرى</th>
                        <th colspan="3" class="bg-purple-400/20">خاصة</th>
                        <th rowspan="2" class="text-theme-pink font-extrabold">المجموع</th>
                    </tr>
                    <tr>
                        <th>صحة</th><th>عتبة خاص</th><th>عتبة عام</th>
                        <th>صحة</th><th>عتبة خاص</th><th>عتبة عام</th>
                        <th>صحة</th><th>عتبة خاص</th><th>عتبة عام</th>
                        <th>صحة</th><th>عتبة خاص</th><th>عتبة عام</th>
                        <th>صحة</th><th>عتبة خاص</th><th>عتبة عام</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $classifications = ['صغرى', 'وسطى', 'كبرى', 'فوق الكبرى', 'خاصة'];
                    $sectorsList = ['صحة', 'عتبة خاص', 'عتبة عام'];
                    
                    // 1. تجميع البيانات لكل طبيب ديناميكياً
                    $dynamicD10 = $filterDoctors->map(function($doc, $index) use ($surgeriesByDoctorCatSector, $doctorOpStatsByDoctor, $classifications, $sectorsList) {
                        $docSurgeries = $surgeriesByDoctorCatSector->where('doctor', $doc->name);
                        
                        $vals = [];
                        $total = 0;
                        
                        foreach ($classifications as $cls) {
                            foreach ($sectorsList as $sec) {
                                $match = $docSurgeries->filter(function($item) use ($cls, $sec) {
                                    return $item->classification === $cls && $item->sector === $sec;
                                })->sum('total');
                                
                                $vals[] = $match;
                                $total += $match;
                            }
                        }
                        
                        // إذا لم توجد بيانات تفصيلية بالقطاع، استخدم doctor_operation_stats كبديل
                        // (يوزع التصنيف في عمود قطاع الصحة فقط لأن القطاع غير متاح)
                        $isFallback = false;
                        if ($total == 0 && isset($doctorOpStatsByDoctor[$doc->name])) {
                            $docStats = $doctorOpStatsByDoctor[$doc->name];
                            $fallbackVals = array_fill(0, 15, 0);
                            $fallbackTotal = 0;
                            
                            foreach ($docStats as $stat) {
                                $cls = $stat->classification ?? '';
                                // تحديد موضع التصنيف (كل تصنيف 3 خانات: صحة/خاص/عام — نضع الكل في خانة الصحة)
                                if (str_contains($cls, 'فوق الكبرى'))      $colBase = 9;
                                elseif (str_contains($cls, 'كبرى'))         $colBase = 6;
                                elseif (str_contains($cls, 'وسطى') || str_contains($cls, 'حقن') || str_contains($cls, 'ليزر')) $colBase = 3;
                                elseif (str_contains($cls, 'صغرى'))         $colBase = 0;
                                elseif (str_contains($cls, 'خاصة'))         $colBase = 12;
                                else $colBase = null;
                                
                                if ($colBase !== null) {
                                    $fallbackVals[$colBase] += $stat->total;
                                    $fallbackTotal += $stat->total;
                                }
                            }
                            
                            if ($fallbackTotal > 0) {
                                $vals = $fallbackVals;
                                $total = $fallbackTotal;
                                $isFallback = true;
                            }
                        }
                        
                        return [
                            'name'       => $doc->name,
                            'vals'       => $vals,
                            'total'      => $total,
                            'isFallback' => $isFallback,
                        ];
                    })->filter(fn($d) => $d['total'] > 0)->values();

                    // حساب مجاميع الأعمدة الفرعية للأسفل
                    $columnTotals = array_fill(0, 15, 0);
                    foreach ($dynamicD10 as $doc) {
                        foreach ($doc['vals'] as $idx => $val) {
                            $columnTotals[$idx] += $val;
                        }
                    }
                    $grandTotal = array_sum($columnTotals);
                    @endphp

                    @forelse($dynamicD10 as $num => $doc)
                    <tr class="table-row {{ $doc['isFallback'] ? 'opacity-80' : '' }}">
                        <td>{{ $num + 1 }}</td>
                        <td class="text-right pr-2 font-bold whitespace-nowrap">
                            {{ $doc['name'] }}
                            @if($doc['isFallback'])
                                <span title="بيانات مستمدة من إحصاءات الطبيب — التفاصيل في الجدول أدناه" class="text-amber-500 text-[9px] mr-1">◈</span>
                            @endif
                        </td>
                        @foreach($doc['vals'] as $v)
                        <td class="{{ $v == 0 ? 'opacity-20' : 'font-bold' }}">{{ $v }}</td>
                        @endforeach
                        <td class="font-black text-theme-pink text-sm">{{ $doc['total'] }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="18" class="text-center py-4 text-slate-400 font-bold">لا توجد عمليات جراحية مسجلة لهذه الفترة</td>
                    </tr>
                    @endforelse

                    @if($dynamicD10->count() > 0)
                    <tr class="table-row font-extrabold text-rose-600 text-sm">
                        <td colspan="2" class="text-right pr-2">المجموع</td>
                        @foreach($columnTotals as $total)
                        <td class="font-bold">{{ $total }}</td>
                        @endforeach
                        <td class="text-base font-black">{{ number_format($grandTotal) }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <p class="text-[8px] text-slate-400 mt-2">ص = قطاع الصحة (حكومي) &nbsp;|&nbsp; خ = عتبة الخاص &nbsp;|&nbsp; ع = عتبة العام</p>
    </div>

    <!-- 7. أعداد العمليات الشهرية الكلية -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
            <i data-lucide="scissors" class="w-4 h-4 text-violet-500"></i>
            أعداد العمليات الجراحية المنفذة لكل نوع للشهر المحدد (أعداد العمليات الشهرية الكلية)
            <span class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع الكلي: {{ number_format($grandDetailTotal) }}</span>
        </h3>
        
        @php
        $bc = [
            'خاصة' => 'bg-purple-100 text-purple-700',
            'فوق الكبرى' => 'bg-rose-100 text-rose-700',
            'كبرى' => 'bg-orange-100 text-orange-700',
            'وسطى (حقن)' => 'bg-blue-100 text-blue-700',
            'وسطى (ليزر)' => 'bg-sky-100 text-sky-700',
            'وسطى' => 'bg-blue-100 text-blue-700',
            'صغرى' => 'bg-yellow-100 text-yellow-700'
        ];
        @endphp

        <!-- Combined Panel for All Doctors -->
        <div id="stats-panel-all" class="stats-panel transition-opacity duration-300">
            <div class="flex items-center justify-between gap-3 mb-4">
                <h4 class="text-xs font-bold text-slate-800">إجمالي أعداد العمليات المنفذة حسب النوع</h4>
                <span class="text-xs font-bold text-white bg-violet-500 px-4 py-1 rounded-full">{{ $grandDetailTotal }} عملية</span>
            </div>
            <div class="flex flex-col gap-8 items-center">
                <div class="w-full flex justify-center">
                    <svg id="svg-doc-all" viewBox="0 0 450 200" class="w-full max-w-[480px] h-auto overflow-visible"></svg>
                </div>
                <div class="w-full">
                    <table class="custom-table text-sm">
                        <thead><tr><th>ت</th><th class="text-right pr-3">اسم العملية</th><th>التصنيف</th><th class="text-center font-bold">العدد</th></tr></thead>
                        <tbody>
                            @forelse($combinedDetailedOps as $i => $op)
                            <tr class="table-row">
                                <td class="w-8 text-center text-slate-400">{{ $i + 1 }}</td>
                                <td class="text-right pr-3 font-bold text-text-main">{{ $op->op }}</td>
                                <td class="text-center"><span class="text-[9px] font-bold px-2 py-0.5 rounded-full {{ $bc[$op->classification] ?? 'bg-slate-100 text-slate-600' }}">{{ $op->classification }}</span></td>
                                <td class="text-center font-bold text-violet-600 text-xs">{{ $op->total }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-slate-400 py-4">لا توجد عمليات مسجلة</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- ── جدول (10): العمليات التفصيلية لكل طبيب (من الجدول المستقل) ── --}}
    @php
    $detailSource = $doctorOpStatsByDoctor ?? collect();
    $grandDetailTotal = 0;
    foreach($detailSource as $docOps) {
        $grandDetailTotal += $docOps->sum('total');
    }

    $bcMap = [
        'خاصة'       => 'bg-purple-100 text-purple-700',
        'فوق الكبرى' => 'bg-rose-100 text-rose-700',
        'كبرى'        => 'bg-orange-100 text-orange-700',
        'وسطى (حقن)' => 'bg-blue-100 text-blue-700',
        'وسطى (ليزر)'=> 'bg-sky-100 text-sky-700',
        'وسطى'        => 'bg-blue-100 text-blue-700',
        'صغرى'        => 'bg-yellow-100 text-yellow-700',
    ];
    @endphp

    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
            <i data-lucide="table-2" class="w-4 h-4 text-violet-500"></i>
            العمليات التفصيلية لكل طبيب حسب النوع
        </h3>

        @if($detailSource && $detailSource->count() > 0)
        <div class="space-y-4">
            @foreach($filterDoctors as $doc)
            @php
            $docOps = $detailSource->get($doc->name) ?? collect();
            // تصفية فقط العمليات التي قيمتها أكبر من 0
            $docOps = $docOps->filter(fn($op) => $op->total > 0)->values();
            $docTotal = $docOps->sum('total');
            @endphp
            @if($docOps->count() > 0)
            <div class="border border-violet-200/20 rounded-xl overflow-hidden">
                <div class="flex items-center justify-between px-4 py-3 bg-violet-500/5 border-b border-violet-200/10">
                    <div class="flex items-center gap-2">
                        <i data-lucide="stethoscope" class="w-4 h-4 text-violet-500"></i>
                        <span class="text-xs font-extrabold text-text-main">{{ $doc->name }}</span>
                    </div>
                    <span class="inline-block px-3 py-0.5 bg-violet-500 text-white rounded-full font-black text-[10px]">{{ number_format($docTotal) }} عملية</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="custom-table text-sm w-full">
                        <thead>
                            <tr>
                                <th class="w-8">ت</th>
                                <th class="text-right pr-3">اسم العملية</th>
                                <th class="w-36 bg-violet-400/10">التصنيف</th>
                                <th class="w-24 text-center font-bold">العدد</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($docOps as $i => $op)
                            <tr class="table-row">
                                <td class="w-8 text-center text-slate-400">{{ $i + 1 }}</td>
                                <td class="text-right pr-3 font-bold">{{ $op->op }}</td>
                                <td class="text-center">
                                    <span class="text-[9px] font-bold px-2 py-0.5 rounded-full {{ $bcMap[$op->classification] ?? 'bg-slate-100 text-slate-600' }}">
                                        {{ $op->classification }}
                                    </span>
                                </td>
                                <td class="text-center font-extrabold text-violet-600">{{ number_format($op->total) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t-2 border-slate-300/20 font-extrabold">
                                <td colspan="3" class="py-2 text-right pr-3 text-pink-600 text-[10px]">المجموع</td>
                                <td class="py-2 text-center text-violet-600">{{ number_format($docTotal) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                @if($showCopyright)
                <div class="px-4 py-2 border-t border-slate-200/10 text-center copyright-print-footer" style="display:block">
                    <p class="text-[9px] text-slate-400 font-medium tracking-wide">
                        جميع الحقوق محفوظة لدى المهندسة سميره علي ياسين
                    </p>
                </div>
                @endif
            </div>
            @endif
            @endforeach
        </div>
        @else
        <div class="text-center py-10 text-slate-400">
            <i data-lucide="table-2" class="w-8 h-8 mx-auto mb-2 opacity-40"></i>
            <p class="text-xs font-bold">لا توجد عمليات تفصيلية مسجلة لهذه الفترة</p>
            <p class="text-[10px] mt-1">يرجى إدخال البيانات من تبويب "عمليات مفصلة (لكل طبيب)" في إدخال البيانات</p>
        </div>
        @endif
    </div>

</section>

<!-- ═══ ترويسة الطباعة (تظهر فقط عند الطباعة) ═══ -->
<div id="print-header" style="display:none">
    <div style="text-align:center; padding-bottom:12pt; border-bottom: 3pt solid #8b5cf6; margin-bottom:16pt;">
        <h1 style="font-size:20pt; font-weight:900; color:#1a1a2e; margin:0 0 4pt 0; letter-spacing:1px;">التقرير الإحصائي الطبي</h1>
        <p id="print-period-label" style="font-size:11pt; color:#6b7280; margin:0; font-weight:600;"></p>
        <p id="print-doctor-label" style="font-size:10pt; color:#8b5cf6; margin:4pt 0 0 0; font-weight:700;"></p>
    </div>
</div>

<!-- ═══ ذيل الطباعة (يظهر فقط عند الطباعة) ═══ -->
<div id="print-footer" style="display:none">
    <div style="text-align:center; border-top:1pt solid #e5e7eb; padding-top:6pt; margin-top:20pt;">
        <p style="font-size:8.5pt; color:#9ca3af; margin:0;">جميع الحقوق محفوظة لدى المهندسة سميره علي ياسين — {{ \Carbon\Carbon::now()->format('Y') }}</p>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════════
     PROFESSIONAL PRINT STYLES — A4
     ═══════════════════════════════════════════════════════════ -->
<style>

/* ════ مقاس الصفحة والهوامش ════ */
@page {
    size: A4 portrait;
    margin: 1.2cm 1.2cm 1.5cm 1.2cm; /* هوامش متزنة للـ Safe Area */
}

/* ════ متغيرات للطباعة ════ */
@media print {

    /* ─── أساسيات الجسم والـ Reset للتصميم الطباعي ─── */
    html, body {
        height: auto !important;
        min-height: auto !important;
        overflow: visible !important;
        position: static !important;
        background: #ffffff !important;
        color: #111827 !important;
        font-family: 'Tajawal', 'Cairo', Arial, sans-serif !important;
        font-size: 8.5pt !important; /* تقليل حجم الخط العام لتوفير المساحة */
        line-height: 1.3 !important;
        direction: rtl !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    /* ─── إخفاء عناصر التنقل والتحكم والتعطيل بالكامل ─── */
    #sidebar,
    #sidebar-backdrop,
    header,
    nav,
    .fixed,
    .sticky,
    .glass-blob,
    .no-print,
    .theme-switcher,
    .arrow-style-select,
    #advanced-filters-panel,
    #page-reports > .custom-card:first-of-type,
    #modal-cancel-btn,
    #modal-submit-btn,
    .add-trans-trigger {
        display: none !important;
    }

    /* ─── فرد وتبسيط الحاويات الأساسية ─── */
    .flex.h-screen,
    .flex-1.flex.flex-col,
    main,
    .page-section,
    #page-reports {
        display: block !important;
        width: 100% !important;
        height: auto !important;
        overflow: visible !important;
        position: static !important;
        padding: 0 !important;
        margin: 0 !important;
        opacity: 1 !important;
        transform: none !important;
        box-sizing: border-box !important;
    }

    /* تأكيد اتجاه النص والـ padding الداخلي */
    main {
        max-width: 100% !important;
    }

    /* ─── ترويسة وذيل الطباعة ─── */
    #print-header {
        display: block !important;
        margin-bottom: 15pt !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    #print-footer {
        display: block !important;
        margin-top: 15pt !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    /* ─── البطاقات (تحويلها إلى تخطيط ملموم وموفر للمساحة) ─── */
    .custom-card {
        background: #ffffff !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
        margin: 0 0 14pt 0 !important;
        page-break-inside: avoid !important;
        break-inside: avoid !important;
        border-radius: 0 !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    /* ─── عنوان كل جدول (h3) ─── */
    .custom-card h3 {
        font-size: 10pt !important;
        font-weight: 700 !important;
        color: #1e1b4b !important;
        border-right: 3.5pt solid #7c3aed !important;
        border-bottom: 0.8pt solid #ddd6fe !important;
        background: #f5f3ff !important;
        padding: 5pt 8pt !important;
        margin: 0 0 6pt 0 !important;
        border-radius: 0 !important;
        display: flex !important;
        align-items: center !important;
        gap: 4pt !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    .custom-card h3 i[data-lucide] {
        display: none !important;
    }

    /* ─── الجداول (ضغط المسافات والـ padding) ─── */
    table {
        width: 100% !important;
        border-collapse: collapse !important;
        font-size: 8pt !important;
        margin: 0 0 4pt 0 !important;
        page-break-inside: auto !important;
        box-sizing: border-box !important;
    }

    thead {
        display: table-header-group !important;
    }

    tfoot {
        display: table-footer-group !important;
    }

    th {
        background: #ede9fe !important;
        color: #3730a3 !important;
        font-weight: 700 !important;
        font-size: 8.5pt !important;
        border: 0.8pt solid #a5b4fc !important;
        padding: 4pt 6pt !important;
        text-align: center !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    td {
        border: 0.6pt solid #d1d5db !important;
        padding: 3.5pt 5pt !important;
        color: #111827 !important;
        background: transparent !important;
        font-size: 8pt !important;
        vertical-align: middle !important;
    }

    tr:nth-child(even) td {
        background: #fafafa !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    tfoot tr td {
        background: #f5f3ff !important;
        font-weight: 700 !important;
        border-top: 1.2pt solid #7c3aed !important;
        color: #4c1d95 !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    /* ─── تحجيم وتصغير مخططات الـ SVG لتناسب الطباعة الموفرة ─── */
    svg {
        max-width: 200px !important; /* تصغير حجم الجارتات لتظهر بشكل مرتب وأنيق */
        max-height: 120px !important;
        display: inline-block !important;
        vertical-align: middle !important;
        margin: 0 auto !important;
        overflow: visible !important;
    }

    /* تعديل تخطيط المخطط مع الجدول ليكون جنباً إلى جنب بشكل أنيق */
    .grid.grid-cols-1.lg\:grid-cols-2,
    .flex.flex-col.lg\:flex-row.gap-6 {
        display: flex !important;
        flex-direction: row-reverse !important; /* الجدول على اليمين والجارت على اليسار */
        align-items: center !important;
        justify-content: space-between !important;
        gap: 15px !important;
        width: 100% !important;
        margin-bottom: 8pt !important;
    }

    /* تقسيم الحجم الداخلي */
    .grid.grid-cols-1.lg\:grid-cols-2 > div:first-child,
    .flex.flex-col.lg\:flex-row.gap-6 > div:first-child {
        width: 35% !important; /* مساحة مناسبة للمخطط الصغير */
        display: flex !important;
        justify-content: center !important;
    }

    .grid.grid-cols-1.lg\:grid-cols-2 > div:last-child,
    .flex.flex-col.lg\:flex-row.gap-6 > div:last-child {
        width: 63% !important; /* مساحة مناسبة للجدول */
    }

    /* إخفاء وتصفيف الـ ApexCharts والـ Canvas */
    .apexcharts-canvas,
    .apexcharts-canvas svg,
    [id^="apexcharts"] {
        max-width: 180px !important;
        max-height: 120px !important;
    }

    /* ─── بطاقات الأطباء في جدول (10) ─── */
    .border.border-violet-200\/20.rounded-xl {
        border: 1pt solid #c4b5fd !important;
        margin-bottom: 10pt !important;
        page-break-inside: avoid !important;
        break-inside: avoid !important;
        border-radius: 3pt !important;
        width: 100% !important;
    }

    .border.border-violet-200\/20.rounded-xl > div:first-child {
        background: #ede9fe !important;
        border-bottom: 0.8pt solid #c4b5fd !important;
        padding: 4pt 8pt !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    /* ─── Badges التصنيف ─── */
    span[class*="rounded-full"],
    span[class*="bg-purple"],
    span[class*="bg-rose"],
    span[class*="bg-orange"],
    span[class*="bg-blue"],
    span[class*="bg-sky"],
    span[class*="bg-yellow"],
    span[class*="bg-slate"] {
        border: 0.5pt solid #9ca3af !important;
        padding: 1pt 4pt !important;
        font-size: 8pt !important;
        border-radius: 4pt !important;
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }

    /* ─── جدول (10) يبدأ صفحة جديدة ─── */
    .custom-card:last-of-type {
        page-break-before: always !important;
        break-before: page !important;
    }

    /* ─── overflow-x ─── */
    .overflow-x-auto {
        overflow: visible !important;
    }

    /* ─── space-y ─── */
    .space-y-4,
    .space-y-6 {
        display: block !important;
    }

    /* ─── إخفاء الـ tabs switcher ─── */
    [id*="stats-panel"]:not(#stats-panel-all) {
        display: none !important;
    }

    /* ─── ملاحظات أسفل الجداول ─── */
    p[class*="text-[8px]"],
    p[class*="text-\[8px\]"] {
        font-size: 8pt !important;
        color: #6b7280 !important;
    }

    /* ─── حقوق الملكية ─── */
    .copyright-print-footer {
        display: block !important;
        text-align: center !important;
        font-size: 8pt !important;
        color: #9ca3af !important;
        padding: 4pt 0 !important;
        border-top: 0.5pt solid #e5e7eb !important;
        font-style: italic !important;
    }

    /* ─── min-width ─── */
    [class*="min-w-"] {
        min-width: 0 !important;
        width: 100% !important;
    }

}

/* ════ Arrow Growth Animation (screen only) ════ */
.arrow-grp {
    opacity: 0;
    transform: scale(0.95);
    transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}
.arrow-grp.show {
    opacity: 1;
    transform: scale(1);
}
</style>



<script>
// ── Arrow Chart Style Controller ─────────────────────────────
const _activeReportApexCharts = new Map();

function changeReportChartStyle(svgId, style) {
    localStorage.setItem('arrow_style_' + svgId, style);
    
    const sel = document.getElementById('select-' + svgId);
    if (sel) sel.value = style;
    
    // إعادة رسم جميع المخططات فوراً لضمان التحديث اللحظي 100%
    if (typeof renderAll2DArrowCharts === 'function') {
        renderAll2DArrowCharts();
    }
}

// دالة التبديل الذكية بين رسومات SVG الخاصة بالأسهم ومخططات ApexCharts التفاعلية لصفحة التقارير
function drawReportToggleChart(svgId, defaultChartType, drawArrowFn, data, labels, title = '', colors = null) {
    const svgEl = document.getElementById(svgId);
    if (!svgEl) return;

    // الحصول على النمط المختار
    const style = localStorage.getItem('arrow_style_' + svgId) || 'flat';
    
    // محو أية مخططات سابقة بنفس المعرف في ApexCharts لمنع التعليق
    if (_activeReportApexCharts.has(svgId)) {
        _activeReportApexCharts.get(svgId).destroy();
        _activeReportApexCharts.delete(svgId);
    }

    let apexDivId = 'apex-' + svgId;
    let apexDiv = document.getElementById(apexDivId);

    // إذا اخترنا أنماط الأسهم الأصلية
    if (style === 'flat' || style === 'glow') {
        if (apexDiv) apexDiv.classList.add('hidden');
        svgEl.classList.remove('hidden');
        
        // استدعاء دالة الرسم الأصلية للأسهم
        if (typeof drawArrowFn === 'function') {
            drawArrowFn();
        }
    } else {
        // إذا اخترنا أحد أنماط ApexCharts
        svgEl.classList.add('hidden');
        
        if (!apexDiv) {
            apexDiv = document.createElement('div');
            apexDiv.id = apexDivId;
            apexDiv.className = 'w-full overflow-visible transition-all duration-300';
            svgEl.parentNode.insertBefore(apexDiv, svgEl.nextSibling);
        }
        apexDiv.classList.remove('hidden');
        apexDiv.innerHTML = ''; // تنظيف الحاوية

        // تحديد نمط الرسم المطلوب
        let chartType = style; // bar, bar-h, donut, area
        let actualType = chartType === 'bar-h' ? 'bar' : chartType;
        let isHorizontal = chartType === 'bar-h';

        const chartColors = colors || ['#3b82f6', '#ec4899', '#f59e0b', '#10b981', '#8b5cf6', '#06b6d4', '#f97316', '#64748b'];

        // إعداد خيارات المخطط
        let options = {
            chart: {
                type: actualType,
                height: 250,
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
        _activeReportApexCharts.set(svgId, chart);
    }
}
// ───────────────────────────────────────────────────────────────

// ── Scroll-triggered chart animation registry ──────────────────
const _reportSvgDrawFns = new Map();
const _svgScrollObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const fn = _reportSvgDrawFns.get(entry.target.id);
            if (fn) fn();
        }
    });
}, { threshold: 0.15 });

function watchChart(svgId, drawFn) {
    _reportSvgDrawFns.set(svgId, drawFn);
    // استدعاء الرسم فوراً لتنفيذ التغيير لحظياً
    if (typeof drawFn === 'function') {
        drawFn();
    }
    const el = document.getElementById(svgId);
    if (el) _svgScrollObserver.observe(el);
}
// ───────────────────────────────────────────────────────────────

// Toggle Stats panel for active doctor
function showDocStats(id) {
    document.querySelectorAll('.stats-panel').forEach(p => p.classList.add('hidden'));
    const activePanel = document.getElementById('stats-panel-' + id);
    if (activePanel) {
        activePanel.classList.remove('hidden');
    }
    renderSingleDocChart(id);
}

// ─── DYNAMIC GRAPHIC ENGINES (FLAT 2D ARROWS) ───

// 1. Branching/Split Arrow Infographic (Table 1)
function draw2DBranchingArrow(svgId, val1, val2, label1, label2, totalVal) {
    const svg = document.getElementById(svgId);
    if (!svg) return;
    svg.innerHTML = '';

    const style = localStorage.getItem('arrow_style_' + svgId) || 'flat';
    
    const cx = 350;
    const cy = 200;

    if (style === 'glow') {
        // ─── النمط نحيف متوهج للتفرع ───
        // رسم الجذع النحيف المتفرع
        const leftBranch = document.createElementNS("http://www.w3.org/2000/svg", "path");
        leftBranch.setAttribute('d', `M ${cx} ${cy} L ${cx} ${cy-50} C ${cx} ${cy-80} ${cx-120} ${cy-90} ${cx-170} ${cy-120}`);
        leftBranch.setAttribute('fill', 'none');
        leftBranch.setAttribute('stroke', '#0284c7');
        leftBranch.setAttribute('stroke-width', '4');
        leftBranch.setAttribute('stroke-linecap', 'round');
        leftBranch.style.filter = 'drop-shadow(0 0 3px #0284c780)';
        svg.appendChild(leftBranch);

        const rightBranch = document.createElementNS("http://www.w3.org/2000/svg", "path");
        rightBranch.setAttribute('d', `M ${cx} ${cy} L ${cx} ${cy-50} C ${cx} ${cy-80} ${cx+120} ${cy-90} ${cx+170} ${cy-120}`);
        rightBranch.setAttribute('fill', 'none');
        rightBranch.setAttribute('stroke', '#db2777');
        rightBranch.setAttribute('stroke-width', '4');
        rightBranch.setAttribute('stroke-linecap', 'round');
        rightBranch.style.filter = 'drop-shadow(0 0 3px #db277780)';
        svg.appendChild(rightBranch);

        // شارات دائرية مضيئة عند الأطراف
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
            lbl.textContent = labelText;
            svg.appendChild(lbl);
        };

        createCircularBadge(cx - 170, cy - 120, val1.toLocaleString(), label1, '#0284c7');
        createCircularBadge(cx + 170, cy - 120, val2.toLocaleString(), label2, '#db2777');

        // شارة المجموع في الأسفل
        const totalValStr = totalVal.toLocaleString();
        const r = Math.max(15, totalValStr.length * 5 + 4);
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
        tTotal.textContent = totalValStr;
        svg.appendChild(tTotal);

    } else if (style === '3d') {
        // ─── النمط ثلاثي الأبعاد للتفرع ───
        const defs = document.createElementNS("http://www.w3.org/2000/svg", "defs");
        defs.innerHTML = `
            <filter id="shadow-branch-${svgId}" x="-20%" y="-20%" width="140%" height="140%">
                <feDropShadow dx="2" dy="4" stdDeviation="3" flood-opacity="0.3"/>
            </filter>
        `;
        svg.appendChild(defs);

        // الفرع الأيسر
        const leftPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
        leftPath.setAttribute('d', `M ${cx-15} ${cy} L ${cx-15} ${cy-50} C ${cx-15} ${cy-80} ${cx-110} ${cy-90} ${cx-160} ${cy-105} L ${cx-170} ${cy-97} L ${cx-155} ${cy-125} L ${cx-127} ${cy-107} L ${cx-137} ${cy-112} C ${cx-80} ${cy-100} ${cx-5} ${cy-90} ${cx-5} ${cy-50} L ${cx-5} ${cy} Z`);
        leftPath.setAttribute('fill', '#0284c7');
        leftPath.setAttribute('filter', `url(#shadow-branch-${svgId})`);
        svg.appendChild(leftPath);

        // واجهة مجسمة للفرع الأيسر
        const leftSide = document.createElementNS("http://www.w3.org/2000/svg", "path");
        leftSide.setAttribute('d', `M ${cx-5} ${cy} L ${cx-5} ${cy-50} C ${cx-5} ${cy-90} ${cx-70} ${cy-100} ${cx-137} ${cy-112} L ${cx-130} ${cy-115} C ${cx-68} ${cy-102} M ${cx} ${cy}`);
        leftSide.setAttribute('fill', '#015f90');
        svg.appendChild(leftSide);

        // الفرع الأيمن
        const rightPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
        rightPath.setAttribute('d', `M ${cx-15} ${cy} L ${cx-15} ${cy-50} C ${cx-15} ${cy-80} ${cx-110} ${cy-90} ${cx-160} ${cy-105} L ${cx-170} ${cy-97} L ${cx-155} ${cy-125} L ${cx-127} ${cy-107} L ${cx-137} ${cy-112} C ${cx-80} ${cy-100} ${cx-5} ${cy-90} ${cx-5} ${cy-50} L ${cx-5} ${cy} Z`);
        rightPath.setAttribute('fill', '#db2777');
        rightPath.setAttribute('transform', `translate(${cx}, 0) scale(-1, 1) translate(-${cx}, 0)`);
        rightPath.setAttribute('filter', `url(#shadow-branch-${svgId})`);
        svg.appendChild(rightPath);

        // شارات وجداول
        const label1Text = `${label1}: ${val1.toLocaleString()}`;
        const badge1W = label1Text.length * 8.5 + 16;
        const badge1 = document.createElementNS("http://www.w3.org/2000/svg", "rect");
        badge1.setAttribute('x', cx - 170 - badge1W / 2);
        badge1.setAttribute('y', cy - 148);
        badge1.setAttribute('width', badge1W);
        badge1.setAttribute('height', '24');
        badge1.setAttribute('rx', '6');
        badge1.setAttribute('fill', '#0284c7');
        badge1.setAttribute('filter', `url(#shadow-branch-${svgId})`);
        svg.appendChild(badge1);

        const tVal1 = document.createElementNS("http://www.w3.org/2000/svg", "text");
        tVal1.setAttribute('x', cx - 170);
        tVal1.setAttribute('y', cy - 131);
        tVal1.setAttribute('font-family', 'Tajawal');
        tVal1.setAttribute('font-size', '13px');
        tVal1.setAttribute('font-weight', 'bold');
        tVal1.setAttribute('fill', '#ffffff');
        tVal1.setAttribute('text-anchor', 'middle');
        tVal1.textContent = label1Text;
        svg.appendChild(tVal1);

        const label2Text = `${label2}: ${val2.toLocaleString()}`;
        const badge2W = label2Text.length * 8.5 + 16;
        const badge2 = document.createElementNS("http://www.w3.org/2000/svg", "rect");
        badge2.setAttribute('x', cx + 170 - badge2W / 2);
        badge2.setAttribute('y', cy - 148);
        badge2.setAttribute('width', badge2W);
        badge2.setAttribute('height', '24');
        badge2.setAttribute('rx', '6');
        badge2.setAttribute('fill', '#db2777');
        badge2.setAttribute('filter', `url(#shadow-branch-${svgId})`);
        svg.appendChild(badge2);

        const tVal2 = document.createElementNS("http://www.w3.org/2000/svg", "text");
        tVal2.setAttribute('x', cx + 170);
        tVal2.setAttribute('y', cy - 131);
        tVal2.setAttribute('font-family', 'Tajawal');
        tVal2.setAttribute('font-size', '13px');
        tVal2.setAttribute('font-weight', 'bold');
        tVal2.setAttribute('fill', '#ffffff');
        tVal2.setAttribute('text-anchor', 'middle');
        tVal2.textContent = label2Text;
        svg.appendChild(tVal2);

        const totalValStr = totalVal.toLocaleString();
        const totalPillW = Math.max(50, totalValStr.length * 9.0 + 14);
        const totalPill = document.createElementNS("http://www.w3.org/2000/svg", "rect");
        totalPill.setAttribute('x', cx - totalPillW / 2);
        totalPill.setAttribute('y', cy - 16);
        totalPill.setAttribute('width', totalPillW);
        totalPill.setAttribute('height', '24');
        totalPill.setAttribute('rx', '6');
        totalPill.setAttribute('fill', '#334155');
        totalPill.setAttribute('filter', `url(#shadow-branch-${svgId})`);
        svg.appendChild(totalPill);

        const tTotal = document.createElementNS("http://www.w3.org/2000/svg", "text");
        tTotal.setAttribute('x', cx);
        tTotal.setAttribute('y', cy + 1.5);
        tTotal.setAttribute('font-family', 'Outfit');
        tTotal.setAttribute('font-size', '14px');
        tTotal.setAttribute('font-weight', 'black');
        tTotal.setAttribute('fill', '#ffffff');
        tTotal.setAttribute('text-anchor', 'middle');
        tTotal.textContent = totalValStr;
        svg.appendChild(tTotal);

    } else {
        // ─── النمط الافتراضي (Classic Split Arrow) ───
        const leftPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
        leftPath.setAttribute('d', `M ${cx-15} ${cy} L ${cx-15} ${cy-50} C ${cx-15} ${cy-80} ${cx-110} ${cy-90} ${cx-160} ${cy-105} L ${cx-170} ${cy-97} L ${cx-155} ${cy-125} L ${cx-127} ${cy-107} L ${cx-137} ${cy-112} C ${cx-80} ${cy-100} ${cx-5} ${cy-90} ${cx-5} ${cy-50} L ${cx-5} ${cy} Z`);
        leftPath.setAttribute('fill', '#0284c7');
        svg.appendChild(leftPath);

        const rightPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
        rightPath.setAttribute('d', `M ${cx-15} ${cy} L ${cx-15} ${cy-50} C ${cx-15} ${cy-80} ${cx-110} ${cy-90} ${cx-160} ${cy-105} L ${cx-170} ${cy-97} L ${cx-155} ${cy-125} L ${cx-127} ${cy-107} L ${cx-137} ${cy-112} C ${cx-80} ${cy-100} ${cx-5} ${cy-90} ${cx-5} ${cy-50} L ${cx-5} ${cy} Z`);
        rightPath.setAttribute('fill', '#db2777');
        rightPath.setAttribute('transform', `translate(${cx}, 0) scale(-1, 1) translate(-${cx}, 0)`);
        svg.appendChild(rightPath);

        const totalValStr = totalVal.toLocaleString();
        const totalPillW = Math.max(50, totalValStr.length * 9.0 + 14);
        const totalPill = document.createElementNS("http://www.w3.org/2000/svg", "rect");
        totalPill.setAttribute('x', cx - totalPillW / 2);
        totalPill.setAttribute('y', cy - 16);
        totalPill.setAttribute('width', totalPillW);
        totalPill.setAttribute('height', '24');
        totalPill.setAttribute('rx', '12');
        totalPill.setAttribute('fill', '#334155');
        svg.appendChild(totalPill);

        const tTotal = document.createElementNS("http://www.w3.org/2000/svg", "text");
        tTotal.setAttribute('x', cx);
        tTotal.setAttribute('y', cy + 1.5);
        tTotal.setAttribute('font-family', 'Outfit');
        tTotal.setAttribute('font-size', '14px');
        tTotal.setAttribute('font-weight', 'black');
        tTotal.setAttribute('fill', '#ffffff');
        tTotal.setAttribute('text-anchor', 'middle');
        tTotal.textContent = totalValStr;
        svg.appendChild(tTotal);

        const label1Text = `${label1}: ${val1.toLocaleString()}`;
        const badge1W = label1Text.length * 8.5 + 16;
        const badge1 = document.createElementNS("http://www.w3.org/2000/svg", "rect");
        badge1.setAttribute('x', cx - 170 - badge1W / 2);
        badge1.setAttribute('y', cy - 148);
        badge1.setAttribute('width', badge1W);
        badge1.setAttribute('height', '24');
        badge1.setAttribute('rx', '12');
        badge1.setAttribute('fill', '#0284c7');
        svg.appendChild(badge1);

        const tVal1 = document.createElementNS("http://www.w3.org/2000/svg", "text");
        tVal1.setAttribute('x', cx - 170);
        tVal1.setAttribute('y', cy - 131);
        tVal1.setAttribute('font-family', 'Tajawal');
        tVal1.setAttribute('font-size', '13px');
        tVal1.setAttribute('font-weight', 'bold');
        tVal1.setAttribute('fill', '#ffffff');
        tVal1.setAttribute('text-anchor', 'middle');
        tVal1.textContent = label1Text;
        svg.appendChild(tVal1);

        const label2Text = `${label2}: ${val2.toLocaleString()}`;
        const badge2W = label2Text.length * 8.5 + 16;
        const badge2 = document.createElementNS("http://www.w3.org/2000/svg", "rect");
        badge2.setAttribute('x', cx + 170 - badge2W / 2);
        badge2.setAttribute('y', cy - 148);
        badge2.setAttribute('width', badge2W);
        badge2.setAttribute('height', '24');
        badge2.setAttribute('rx', '12');
        badge2.setAttribute('fill', '#db2777');
        svg.appendChild(badge2);

        const tVal2 = document.createElementNS("http://www.w3.org/2000/svg", "text");
        tVal2.setAttribute('x', cx + 170);
        tVal2.setAttribute('y', cy - 131);
        tVal2.setAttribute('font-family', 'Tajawal');
        tVal2.setAttribute('font-size', '13px');
        tVal2.setAttribute('font-weight', 'bold');
        tVal2.setAttribute('fill', '#ffffff');
        tVal2.setAttribute('text-anchor', 'middle');
        tVal2.textContent = label2Text;
        svg.appendChild(tVal2);
    }
}

// 2. Vertical Flat Arrow Columns (With Rotation Support for Large Data)
function draw2DFlatVerticalArrows(svgId, values, labels, presetColors = null) {
    const svg = document.getElementById(svgId);
    if (!svg) return;
    svg.innerHTML = '';
    
    // الحصول على النمط المحدد لهذا الجارت
    const style = localStorage.getItem('arrow_style_' + svgId) || 'flat';
    
    const maxVal = Math.max(...values, 1);
    const n = values.length;
    const viewBoxStr = svg.getAttribute('viewBox') || "0 0 900 240";
    const width = parseInt(viewBoxStr.split(' ')[2]);
    const height = parseInt(viewBoxStr.split(' ')[3]);
    const marginL = 40;
    const marginR = 40;
    const availableW = width - marginL - marginR;
    const spacing = n > 1 ? availableW / (n - 1) : availableW;

    // Dynamic floor
    const floorY = n > 6 ? height - 50 : height - 30;

    // Baseline
    const line = document.createElementNS("http://www.w3.org/2000/svg", "line");
    line.setAttribute('x1', marginL - 15);
    line.setAttribute('y1', floorY);
    line.setAttribute('x2', width - marginR + 15);
    line.setAttribute('y2', floorY);
    line.setAttribute('stroke', '#cbd5e1');
    line.setAttribute('stroke-width', '1.5');
    svg.appendChild(line);

    // إضافة فلتر الظل لنمط الـ 3D
    if (style === '3d') {
        const defs = document.createElementNS("http://www.w3.org/2000/svg", "defs");
        defs.innerHTML = `
            <filter id="shadow-3d-${svgId}" x="-20%" y="-20%" width="140%" height="140%">
                <feDropShadow dx="2" dy="3" stdDeviation="2.5" flood-opacity="0.25"/>
            </filter>
        `;
        svg.appendChild(defs);
    }

    const colors = presetColors || ['#3b82f6','#ec4899','#f59e0b','#10b981','#8b5cf6','#06b6d4','#f97316','#64748b','#ec4899','#84cc16','#0ea5e9','#6366f1','#d946ef','#14b8a6','#f43f5e','#a78bfa'];

    values.forEach((val, i) => {
        const x = marginL + i * spacing;
        const color = colors[i % colors.length];

        const minH = 20;
        const maxH = floorY - 55;
        const scaleVal = maxVal > 1 ? Math.sqrt(val) / Math.sqrt(maxVal) : 1;
        const H = minH + (maxH - minH) * scaleVal;

        const startDelay = (i * 80) + 'ms';
        const dur = '0.65s';

        const g = document.createElementNS("http://www.w3.org/2000/svg", "g");

        let body, head, dashed, pill, tVal;

        if (style === 'glow') {
            // ─── النمط نحيف متوهج (Glow Arrow) ───
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

            // رأس السهم المضيء
            head = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
            head.setAttribute('points', `${x-6},${floorY-H} ${x+6},${floorY-H} ${x},${floorY-H-8}`);
            head.setAttribute('fill', color);
            head.style.opacity = '0';
            head.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(head);

            // شارة دائرية مضيئة تحتوي على القيمة عند قمة العمود
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
            // ─── النمط ثلاثي الأبعاد (3D Arrow) ───
            // تدرج لوني عمودي لامع
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

            // مضلع الواجهة الأمامية الأساسية
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

            // واجهة جانبية لتأثير الـ 3D (3D Side Face)
            const side = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
            side.setAttribute('points', `${x+9},${floorY} ${x+13},${floorY-4} ${x+13},${floorY-H-4} ${x+9},${floorY-H}`);
            side.setAttribute('fill', adjustBrightness(color, -35));
            side.style.transformOrigin = `${x}px ${floorY}px`;
            side.style.transform = 'scaleY(0)';
            side.style.transition = `transform ${dur} cubic-bezier(0.16, 1, 0.3, 1) ${startDelay}`;
            g.appendChild(side);

            // رأس السهم ثلاثي الأبعاد
            head = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
            head.setAttribute('points', `${x-14},${floorY-H} ${x+14},${floorY-H} ${x},${floorY-H-12}`);
            head.setAttribute('fill', color);
            head.setAttribute('filter', `url(#shadow-3d-${svgId})`);
            head.style.opacity = '0';
            head.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(head);

            // واجهة جانبية لرأس السهم ثلاثي الأبعاد
            const sideHead = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
            sideHead.setAttribute('points', `${x+14},${floorY-H} ${x},${floorY-H-12} ${x+4},${floorY-H-14} ${x+18},${floorY-H-2}`);
            sideHead.setAttribute('fill', adjustBrightness(color, -35));
            sideHead.style.opacity = '0';
            sideHead.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(sideHead);

            // خط التوصيل
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

            // قيمة السهم
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

            // تشغيل الأنيميشن للواجهة الجانبية أيضاً
            requestAnimationFrame(() => requestAnimationFrame(() => {
                side.style.transform = 'scaleY(1)';
                sideHead.style.opacity = '1';
            }));

        } else {
            // ─── النمط الافتراضي المسطح (Flat Arrow) ───
            body = document.createElementNS("http://www.w3.org/2000/svg", "rect");
            body.setAttribute('x', x - 8);
            body.setAttribute('y', floorY - H);
            body.setAttribute('width', '16');
            body.setAttribute('height', H);
            body.setAttribute('fill', color);
            body.setAttribute('rx', '1');
            body.style.transformOrigin = `${x}px ${floorY}px`;
            body.style.transform = 'scaleY(0)';
            body.style.transition = `transform ${dur} cubic-bezier(0.25,0.46,0.45,0.94) ${startDelay}`;
            g.appendChild(body);

            head = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
            head.setAttribute('points', `${x-12},${floorY-H} ${x+12},${floorY-H} ${x},${floorY-H-10}`);
            head.setAttribute('fill', color);
            head.style.opacity = '0';
            head.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(head);

            dashed = document.createElementNS("http://www.w3.org/2000/svg", "line");
            dashed.setAttribute('x1', x);
            dashed.setAttribute('y1', floorY - H - 12);
            dashed.setAttribute('x2', x);
            dashed.setAttribute('y2', floorY - H - 26);
            dashed.setAttribute('stroke', color);
            dashed.setAttribute('stroke-width', '1');
            dashed.setAttribute('stroke-dasharray', '2 2');
            dashed.style.opacity = '0';
            dashed.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(dashed);

            const valStr = val.toLocaleString();
            const pillW = Math.max(32, valStr.length * 8.5 + 12);
            pill = document.createElementNS("http://www.w3.org/2000/svg", "rect");
            pill.setAttribute('x', x - pillW / 2);
            pill.setAttribute('y', floorY - H - 48);
            pill.setAttribute('width', pillW);
            pill.setAttribute('height', '22');
            pill.setAttribute('rx', '11');
            pill.setAttribute('fill', color);
            pill.style.opacity = '0';
            pill.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(pill);

            tVal = document.createElementNS("http://www.w3.org/2000/svg", "text");
            tVal.setAttribute('x', x);
            tVal.setAttribute('y', floorY - H - 32.5);
            tVal.setAttribute('font-family', 'Outfit');
            tVal.setAttribute('font-size', '13px');
            tVal.setAttribute('font-weight', 'bold');
            tVal.setAttribute('fill', '#ffffff');
            tVal.setAttribute('text-anchor', 'middle');
            tVal.textContent = valStr;
            tVal.style.opacity = '0';
            tVal.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(tVal);
        }

        // اسم المحور (العنوان)
        const label = document.createElementNS("http://www.w3.org/2000/svg", "text");
        label.setAttribute('x', x - 4);
        label.setAttribute('font-family', 'Tajawal');
        label.setAttribute('font-weight', 'bold');
        label.setAttribute('fill', '#64748b');

        let labelText = labels[i] || '';
        if (n > 6) {
            label.setAttribute('y', floorY + 10);
            label.setAttribute('font-size', '8.5px');
            label.setAttribute('text-anchor', 'end');
            label.setAttribute('transform', `rotate(28, ${x - 4}, ${floorY + 10})`);
            if (labelText.length > 25) labelText = labelText.substring(0, 23) + '..';
        } else {
            label.setAttribute('x', x);
            label.setAttribute('y', floorY + 16);
            label.setAttribute('font-size', '9.5px');
            label.setAttribute('text-anchor', 'middle');
            if (labelText.length > 30) labelText = labelText.substring(0, 27) + '..';
        }
        label.textContent = labelText;
        g.appendChild(label);

        svg.appendChild(g);

        // تشغيل الأنيميشن
        requestAnimationFrame(() => requestAnimationFrame(() => {
            body.style.transform = 'scaleY(1)';
            head.style.opacity  = '1';
            if (dashed) dashed.style.opacity = '1';
            pill.style.opacity  = '1';
            tVal.style.opacity  = '1';
        }));
    });
}


// 3. Horizontal Flat Chevron Lists (Premium Labels-Above-Bars Layout)
function draw2DFlatHorizontalChevrons(svgId, values, labels, presetColors = null) {
    const svg = document.getElementById(svgId);
    if (!svg) return;
    svg.innerHTML = '';
    
    const n = values.length;
    if (n === 0) return;

    // الحصول على النمط المحدد
    const style = localStorage.getItem('arrow_style_' + svgId) || 'flat';

    const spacing = 58;
    const marginT = 16;
    const marginB = 20;
    const dynamicHeight = marginT + marginB + (n - 1) * spacing + 32;
    
    svg.setAttribute('viewBox', `0 0 450 ${dynamicHeight}`);
    svg.style.height = `${dynamicHeight}px`;

    const maxVal = Math.max(...values, 1);
    const colors = presetColors || ['#db2777', '#d97706', '#10b981', '#475569', '#3b82f6', '#8b5cf6'];
    
    const startX = 435; // Right baseline
    const chartStartX = 10;
    const maxL = startX - chartStartX - 45;

    // إضافة فلتر الظل لنمط الـ 3D
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
        const labelY = marginT + i * spacing;
        const barY = labelY + 24;
        const color = colors[i % colors.length];

        const scaleVal = maxVal > 0 ? val / maxVal : 0;
        const L = 15 + maxL * scaleVal;
        const endX = startX - L;

        const startDelay = (i * 80) + 'ms';
        const dur = '0.65s';

        const g = document.createElementNS("http://www.w3.org/2000/svg", "g");

        // Label
        const label = document.createElementNS("http://www.w3.org/2000/svg", "text");
        label.setAttribute('x', startX);
        label.setAttribute('y', labelY + 6);
        label.setAttribute('font-family', 'Tajawal');
        label.setAttribute('font-size', '12px');
        label.setAttribute('font-weight', 'bold');
        label.setAttribute('fill', '#475569');
        label.setAttribute('text-anchor', 'start');
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

            // رأس السهم
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

            // واجهة جانبية سفلى للعمق (3D Bottom Face)
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
            // ─── النمط الافتراضي (Classic Chevron) ───
            body = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
            body.setAttribute('points', `${startX},${barY-6} ${endX+6},${barY-6} ${endX},${barY} ${endX+6},${barY+6} ${startX},${barY+6}`);
            body.setAttribute('fill', color);
            body.style.transformOrigin = `${startX}px ${barY}px`;
            body.style.transform = 'scaleX(0)';
            body.style.transition = `transform ${dur} cubic-bezier(0.25,0.46,0.45,0.94) ${startDelay}`;
            g.appendChild(body);

            const valStr = val.toLocaleString();
            const pillW = Math.max(30, valStr.length * 8.5 + 12);
            pill = document.createElementNS("http://www.w3.org/2000/svg", "rect");
            pill.setAttribute('x', endX - pillW - 6);
            pill.setAttribute('y', barY - 11);
            pill.setAttribute('width', pillW);
            pill.setAttribute('height', '22');
            pill.setAttribute('rx', '11');
            pill.setAttribute('fill', color);
            pill.style.opacity = '0';
            pill.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
            g.appendChild(pill);

            tVal = document.createElementNS("http://www.w3.org/2000/svg", "text");
            tVal.setAttribute('x', endX - pillW / 2 - 6);
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
        }

        svg.appendChild(g);

        requestAnimationFrame(() => requestAnimationFrame(() => {
            body.style.transform = 'scaleX(1)';
            pill.style.opacity = '1';
            tVal.style.opacity = '1';
        }));
    });
}


// ── Draw Interactive Iraq Governorates Map ───────────────────
const GOV_TITLE_MAP = {
    'Babil': 'بابل',
    'Al-Anbar': 'الأنبار',
    'Diyala': 'ديالى',
    'As-Sulaymaniyah': 'السليمانية',
    'Wasit': 'واسط',
    'Maysan': 'ميسان',
    'Dhi-Qar': 'ذي قار',
    'Al-Qadisiyah': 'القادسية',
    'Al-Muthannia': 'المثنى',
    'Al-Basrah': 'البصرة',
    'Baghdad': 'بغداد',
    'Karbala': 'كربلاء',
    'An-Najaf': 'النجف',
    'Sala ad-Din': 'صلاح الدين',
    'Ninawa': 'نينوى',
    'Arbil': 'أربيل',
    'Kirkuk': 'كركوك',
    'Dohuk': 'دهوك'
};

const GOV_COORDS = {
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

function drawIraqMap(svgId, values, labels, colorTheme) {
    const svg = document.getElementById(svgId);
    if (!svg) return;

    const pathsGroup = document.getElementById(svgId + '-paths');
    const nodesGroup = document.getElementById(svgId + '-nodes');
    if (!pathsGroup || !nodesGroup) return;

    nodesGroup.innerHTML = '';

    const dataMap = {};
    labels.forEach((label, idx) => { dataMap[label] = values[idx] || 0; });
    const maxVal = Math.max(...Object.values(dataMap), 1);

    // ── Step 1: colour each path using getAttribute('id') ──
    // querySelector('#IQ-DA') fails silently because '-' has special meaning in CSS selectors
    pathsGroup.querySelectorAll('path').forEach(path => {
        const pid = path.getAttribute('id');          // e.g. 'IQ-DA'
        const govName = Object.keys(GOV_COORDS).find(n => GOV_COORDS[n].pathId === pid);
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

    // ── Step 2: draw labels at fixed calibrated coordinates ──
    Object.keys(GOV_COORDS).forEach((govArabicName, i) => {
        const info = GOV_COORDS[govArabicName];
        const val  = dataMap[govArabicName] || 0;
        const delay = i * 55; // stagger delay ms

        const g = document.createElementNS('http://www.w3.org/2000/svg', 'g');
        // Start below final position — CSS transform drives the animation
        g.style.opacity    = '0';
        g.style.transform  = `translate(${info.x}px, ${info.y + 35}px)`;
        g.style.transition = `opacity 0.5s ease ${delay}ms, transform 0.55s cubic-bezier(0.34,1.56,0.64,1) ${delay}ms`;

        if (val > 0) {
            // pulsing halo
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
            // solid dot
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

        // label chip
        const textStr = `${govArabicName} ${val}`;
        const chipW   = textStr.length * 10 + 18;
        const chipY   = val > 0 ? -(3 + (val / maxVal) * 2.5) - 22 : -22;

        const chip = document.createElementNS('http://www.w3.org/2000/svg', 'rect');
        chip.setAttribute('x', -chipW / 2);
        chip.setAttribute('y', chipY - 22.5);
        chip.setAttribute('width', chipW);
        chip.setAttribute('height', '30');
        chip.setAttribute('rx', '6');
        chip.setAttribute('fill', val > 0 ? (colorTheme || '#0ea5e9') : '#64748b');
        chip.setAttribute('opacity', val > 0 ? '0.95' : '0.6');
        g.appendChild(chip);

        const lbl = document.createElementNS('http://www.w3.org/2000/svg', 'text');
        lbl.setAttribute('x', '0');
        lbl.setAttribute('y', chipY - 7.5);
        lbl.setAttribute('font-family', 'Tajawal, sans-serif');
        lbl.setAttribute('font-size', '18');
        lbl.setAttribute('font-weight', 'bold');
        lbl.setAttribute('fill', '#fff');
        lbl.setAttribute('text-anchor', 'middle');
        lbl.setAttribute('dominant-baseline', 'central');
        lbl.textContent = textStr;
        g.appendChild(lbl);

        nodesGroup.appendChild(g);

        // trigger entrance animation on next frame
        requestAnimationFrame(() => requestAnimationFrame(() => {
            g.style.opacity   = '1';
            g.style.transform = `translate(${info.x}px, ${info.y}px)`;
        }));
    });
}




// Global page initialization hook triggers drawing of all elements
function renderAll2DArrowCharts() {
    // Pre-compute all PHP-rendered data once
    @php
    $cGeneral = $consultations->firstWhere('unit', 'استشارية العيون العامة')['total'] ?? 0;
    $cSpecial = $consultations->firstWhere('unit', 'استشارية التخصصات الدقيقة')['total'] ?? 0;
    $docSurgs = $surgeriesByDoctorCatSector->groupBy('doctor')->map(fn($group) => $group->sum('total'));
    @endphp

    const docVisitsData   = @json($visitsByDoctor->pluck('total'));
    const docVisitsLabels = @json($visitsByDoctor->pluck('doctor')->map(fn($n) => str_replace('د. ', '', $n)));
    const govData         = @json($visitsByGov->pluck('total'));
    const govLabels       = @json($visitsByGov->pluck('gov'));
    const countryData     = @json($visitsByCountry->pluck('total'));
    const countryLabels   = @json($visitsByCountry->pluck('country'));
    const surgGovData         = @json($surgeriesByGov->pluck('total'));
    const surgGovLabels       = @json($surgeriesByGov->pluck('gov'));
    const surgCountryData     = @json($surgeriesByCountry->pluck('total'));
    const surgCountryLabels   = @json($surgeriesByCountry->pluck('country'));
    const visualData      = @json($eyeTestsByType->pluck('total'));
    const visualLabels    = @json($eyeTestsByType->pluck('type'));
    const labTestData     = @json($labTestsByType->pluck('total'));
    const labTestLabels   = @json($labTestsByType->pluck('type'));
    const docSurgData     = @json($docSurgs->values());
    const docSurgLabels   = @json($docSurgs->keys()->map(fn($n) => str_replace('د. ', '', $n)));

    // تهيئة قيم المنسدلات المحفوظة في localStorage
    document.querySelectorAll('.arrow-style-select').forEach(sel => {
        const svgId = sel.dataset.svgId;
        if (svgId) {
            const savedVal = localStorage.getItem('arrow_style_' + svgId) || 'flat';
            sel.value = savedVal;
        }
    });

    watchChart('svg-report-2',  () => drawReportToggleChart('svg-report-2', 'bar', () => draw2DFlatVerticalArrows('svg-report-2', docVisitsData, docVisitsLabels), docVisitsData, docVisitsLabels, 'المرضى'));
    watchChart('svg-report-3',  () => drawIraqMap('svg-report-3', govData, govLabels, '#0284c7')); // الخريطة لا تحتاج تحويل
    watchChart('svg-report-4',  () => drawReportToggleChart('svg-report-4', 'bar-h', () => draw2DFlatHorizontalChevrons('svg-report-4', countryData, countryLabels), countryData, countryLabels, 'الدول'));
    watchChart('svg-report-8',  () => drawIraqMap('svg-report-8', surgGovData, surgGovLabels, '#f43f5e')); // الخريطة لا تحتاج تحويل
    watchChart('svg-report-9',  () => drawReportToggleChart('svg-report-9', 'bar-h', () => draw2DFlatHorizontalChevrons('svg-report-9', surgCountryData, surgCountryLabels, ['#f43f5e','#ec4899','#db2777','#f43f5e','#ec4899','#db2777']), surgCountryData, surgCountryLabels, 'الدول'));
    watchChart('svg-report-5',  () => drawReportToggleChart('svg-report-5', 'bar-h', () => draw2DFlatHorizontalChevrons('svg-report-5', visualData, visualLabels, ['#f97316','#ea580c','#c2410c','#ea580c','#f97316','#c2410c']), visualData, visualLabels, 'الفحوصات'));
    watchChart('svg-report-6',  () => drawReportToggleChart('svg-report-6', 'bar', () => draw2DFlatVerticalArrows('svg-report-6', labTestData, labTestLabels, ['#8b5cf6','#a855f7','#c084fc','#d8b4fe','#f3e8ff']), labTestData, labTestLabels, 'التحاليل'));
    watchChart('svg-report-7',  () => {
        const surgClassLabels = [];
        const surgClassData = [];
        document.querySelectorAll('.table7-data-row').forEach(row => {
            const label = row.querySelector('td').textContent.trim();
            const total = parseInt(row.querySelector('.table7-row-total').textContent) || 0;
            surgClassLabels.push(label);
            surgClassData.push(total);
        });
        drawReportToggleChart('svg-report-7', 'donut', () => draw2DFlatVerticalArrows('svg-report-7', surgClassData, surgClassLabels, ['#10b981', '#f43f5e', '#ec4899', '#f59e0b', '#8b5cf6', '#64748b']), surgClassData, surgClassLabels, 'العمليات');
    });
    watchChart('svg-report-10', () => drawReportToggleChart('svg-report-10', 'bar', () => draw2DFlatVerticalArrows('svg-report-10', docSurgData, docSurgLabels), docSurgData, docSurgLabels, 'العمليات'));

    // Initialize combined detailed doctor stats chart
    watchChart('svg-doc-all', () => renderSingleDocChart('all'));
}

// switcher individual doctor operations details -> Horizontal Chevrons
const docOpsData = {
    "all": @json($combinedDetailedOps->pluck('total'))
};
const docNamesData = {
    "all": @json($combinedDetailedOps->pluck('op'))
};

function renderSingleDocChart(id) {
    const values = docOpsData[id] || [];
    const labels = docNamesData[id] || [];
    if (values.length === 0) {
        const svg = document.getElementById('svg-doc-' + id);
        if (svg) svg.innerHTML = '<text x="225" y="100" font-family="Tajawal" font-size="11" font-weight="bold" fill="#94a3b8" text-anchor="middle">لا توجد عمليات مسجلة لهذا الطبيب</text>';
        return;
    }
    drawReportToggleChart('svg-doc-' + id, 'bar-h', () => draw2DFlatHorizontalChevrons('svg-doc-' + id, values, labels), values, labels, 'العمليات');
}

function toggleAdvancedFilters() {
    const panel = document.getElementById('advanced-filters-panel');
    const chevron = document.getElementById('adv-filters-chevron');
    if (panel) {
        panel.classList.toggle('hidden');
        if (chevron) {
            chevron.style.transform = panel.classList.contains('hidden') ? '' : 'rotate(180deg)';
        }
    }
}

function applyDateRangeFilter() {
    const fromVal = document.getElementById('report-date-from').value;
    const toVal = document.getElementById('report-date-to').value;
    if (!fromVal || !toVal) return;
    
    const docId = document.getElementById('filter-doctor-id').value;
    const unitId = document.getElementById('filter-clinic-unit-id').value;
    const govId = document.getElementById('filter-governorate-id').value;
    const countryId = document.getElementById('filter-country-id').value;
    const sectorId = document.getElementById('filter-sector-id').value;
    
    let url = `/?start_date=${fromVal}&end_date=${toVal}`;
    if (docId) url += `&doctor_id=${docId}`;
    if (unitId) url += `&clinic_unit_id=${unitId}`;
    if (govId) url += `&governorate_id=${govId}`;
    if (countryId) url += `&country_id=${countryId}`;
    if (sectorId) url += `&sector_id=${sectorId}`;
    
    window.location.href = url + '#reports';
}

function resetAllFilters() {
    window.location.href = '/#reports';
}

// Global page initialization hook
let _chartsInitialized = false;
window.initReportsPage = function() {
    if (!_chartsInitialized) {
        _chartsInitialized = true;
    }
    // Always re-render charts and reload table7 on each page visit
    setTimeout(() => {
        renderAll2DArrowCharts();
        loadTable7();
    }, 150);
};

// ── جدول (7): جلب بيانات التصنيف من نفس API التي يستخدمها زر "تعديل" ──
async function loadTable7() {
    // 1. Reset all table values to 0
    document.querySelectorAll('.table7-cell').forEach(c => {
        c.textContent = '0';
        c.classList.add('opacity-30');
    });
    document.querySelectorAll('.table7-row-total').forEach(c => c.textContent = '0');
    document.querySelectorAll('.table7-col-total').forEach(c => c.textContent = '0');
    const grandTotalEl = document.getElementById('table7-grand-total');
    if (grandTotalEl) grandTotalEl.textContent = '0';

    // 2. Fetch data
    const fromVal = document.getElementById('report-date-from')?.value || '{{ substr($start_date ?? date("Y-m"), 0, 7) }}';
    const toVal   = document.getElementById('report-date-to')?.value   || '{{ substr($end_date   ?? date("Y-m"), 0, 7) }}';

    const startDate = fromVal.length === 7 ? fromVal + '-01' : fromVal;
    let endDate = toVal;
    if (toVal.length === 7) {
        const parts = toVal.split('-');
        const year = parseInt(parts[0]);
        const month = parseInt(parts[1]);
        const lastDay = new Date(year, month, 0).getDate();
        endDate = `${year}-${String(month).padStart(2, '0')}-${String(lastDay).padStart(2, '0')}`;
    }

    const docId = document.getElementById('filter-doctor-id')?.value;
    const govId = document.getElementById('filter-governorate-id')?.value;
    const countryId = document.getElementById('filter-country-id')?.value;
    const sectorId = document.getElementById('filter-sector-id')?.value;

    let apiUrl = `/api/surgeries?start_date=${startDate}&end_date=${endDate}&per_page=2000&type=surgeries_cls`;
    if (docId) apiUrl += `&doctor_id=${docId}`;
    if (govId) apiUrl += `&governorate_id=${govId}`;
    if (countryId) apiUrl += `&country_id=${countryId}`;
    if (sectorId) apiUrl += `&sector_id=${sectorId}`;

    try {
        const res  = await fetch(apiUrl);
        const data = await res.json();
        const items = data.data || data; // [{classification, sector_name, quantity}]

        // 3. Populate cells
        items.forEach(item => {
            const cls = item.classification || '';
            const sec = item.sector_name || item.sector || '';
            const qty = parseInt(item.quantity) || 1;

            const cell = document.querySelector(`.table7-cell[data-cls="${cls}"][data-sec="${sec}"]`);
            if (cell) {
                const currentVal = parseInt(cell.textContent) || 0;
                const newVal = currentVal + qty;
                cell.textContent = newVal;
                if (newVal > 0) {
                    cell.classList.remove('opacity-30');
                } else {
                    cell.classList.add('opacity-30');
                }
            }
        });

        // 4. Calculate row totals and grand total
        let grandTotal = 0;
        document.querySelectorAll('.table7-data-row').forEach(row => {
            let rowTotal = 0;
            row.querySelectorAll('.table7-cell').forEach(cell => {
                rowTotal += parseInt(cell.textContent) || 0;
            });
            row.querySelector('.table7-row-total').textContent = rowTotal;
            grandTotal += rowTotal;
        });

        if (grandTotalEl) grandTotalEl.textContent = grandTotal;

        // 5. Calculate column totals
        document.querySelectorAll('.table7-col-total').forEach(colTotalCell => {
            const sec = colTotalCell.dataset.sec;
            let colTotal = 0;
            document.querySelectorAll(`.table7-cell[data-sec="${sec}"]`).forEach(cell => {
                colTotal += parseInt(cell.textContent) || 0;
            });
            colTotalCell.textContent = colTotal;
        });

        // 7. Hide loading and show table
        document.getElementById('table7-loading')?.classList.add('hidden');
        document.getElementById('table7-content')?.classList.remove('hidden');

        // 8. Re-render SVG chart dynamically based on newly computed DOM totals
        const surgClassLabels = [];
        const surgClassData = [];
        document.querySelectorAll('.table7-data-row').forEach(row => {
            const label = row.querySelector('td').textContent.trim();
            const total = parseInt(row.querySelector('.table7-row-total').textContent) || 0;
            surgClassLabels.push(label);
            surgClassData.push(total);
        });
        
        // Redraw svg-report-7 directly
        draw2DFlatVerticalArrows('svg-report-7', surgClassData, surgClassLabels, ['#10b981', '#f43f5e', '#ec4899', '#f59e0b', '#8b5cf6', '#64748b']);

    } catch(e) {
        console.error(e);
        const loading = document.getElementById('table7-loading');
        if (loading) loading.innerHTML = '<span class="text-rose-400">تعذّر تحميل بيانات التصنيف</span>';
    }
}

// ── Print Preparation ──────────────────────────────────────
window.addEventListener('beforeprint', function () {
    // تعبئة معلومات الفترة في الترويسة
    const fromVal = document.getElementById('report-date-from')?.value || '';
    const toVal   = document.getElementById('report-date-to')?.value || '';

    const formatMonth = (ym) => {
        if (!ym) return '';
        const [y, m] = ym.split('-');
        const months = ['يناير','فبراير','مارس','أبريل','مايو','يونيو','يوليو','أغسطس','سبتمبر','أكتوبر','نوفمبر','ديسمبر'];
        return (months[parseInt(m) - 1] || m) + ' ' + y;
    };

    let periodText = 'الفترة: ' + formatMonth(fromVal);
    if (fromVal && toVal && fromVal !== toVal) {
        periodText += ' — ' + formatMonth(toVal);
    }

    const periodEl = document.getElementById('print-period-label');
    if (periodEl) periodEl.textContent = periodText;

    // اسم الطبيب إن وُجد
    const doctorSel = document.getElementById('filter-doctor-id');
    const doctorEl  = document.getElementById('print-doctor-label');
    if (doctorSel && doctorEl) {
        const selOpt = doctorSel.options[doctorSel.selectedIndex];
        doctorEl.textContent = selOpt && selOpt.value ? 'الطبيب: ' + selOpt.text : '';
    }
});

function printReportWindow() {
    const fromVal = document.getElementById('report-date-from')?.value || '';
    const toVal   = document.getElementById('report-date-to')?.value || '';
    const docId   = document.getElementById('filter-doctor-id')?.value || '';
    const unitId  = document.getElementById('filter-clinic-unit-id')?.value || '';
    const govId   = document.getElementById('filter-governorate-id')?.value || '';
    const countryId = document.getElementById('filter-country-id')?.value || '';

    let url = '/?print=1';
    if (fromVal) url += '&start_date=' + fromVal;
    if (toVal)   url += '&end_date=' + toVal;
    if (docId)   url += '&doctor_id=' + docId;
    if (unitId)  url += '&clinic_unit_id=' + unitId;
    if (govId)   url += '&governorate_id=' + govId;
    if (countryId) url += '&country_id=' + countryId;

    // فتح صفحة الطباعة المخصصة في نافذة جديدة
    const w = window.open(url, '_blank');
    if (w) w.focus();
}

</script>
