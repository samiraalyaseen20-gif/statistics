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
                <h2 class="text-xs font-bold text-text-main">الإحصاءات والتقارير الطبية</h2>
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
                <button onclick="window.print()" class="py-2 px-4 rounded-xl text-xs font-bold bg-slate-200/20 text-slate-400 hover:bg-slate-200/40 hover-press">
                    <i data-lucide="printer" class="w-3.5 h-3.5"></i>
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
        <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
            <i data-lucide="stethoscope" class="w-4 h-4 text-pink-500"></i>
            جدول (1): أعداد المرضى في الاستشاريات
            <span id="cmp-total-1" class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع: {{ number_format($totalVisits) }}</span>
        </h3>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
            <!-- Branching/Split Arrow Infographic -->
            <div class="flex justify-center">
                <svg id="svg-report-1" viewBox="0 0 520 220" class="w-full max-w-[480px] h-[220px] overflow-visible"></svg>
            </div>
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
        <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
            <i data-lucide="users" class="w-4 h-4 text-emerald-500"></i>
            جدول (2): أعداد مرضى كل طبيب اختصاص
            <span id="cmp-total-2" class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع: {{ number_format($totalVisits) }}</span>
        </h3>
        <div class="w-full overflow-x-auto py-2">
            <svg id="svg-report-2" viewBox="0 0 900 240" class="w-full min-w-[850px] h-[240px] overflow-visible"></svg>
        </div>
    </div>

    <!-- 3. التوزيع الديمغرافي لمراجعي الاستشاريات (جدول 3 و 4) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Inside Iraq (Vertical Columns) -->
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="flag" class="w-4 h-4 text-sky-500"></i>
                جدول (3): التوزيع الجغرافي داخل العراق
                <span class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع: {{ number_format($visitsByGov->sum('total')) }}</span>
            </h3>
            <div class="w-full overflow-x-auto py-2">
                <svg id="svg-report-3" viewBox="0 0 584 594" class="w-full max-w-[480px] h-[480px] overflow-visible mx-auto">
                    <g id="svg-report-3-paths" fill="rgba(14, 165, 233, 0.03)" stroke="#cbd5e1" stroke-width="1.2">
                        {!! $pathsHtml !!}
                    </g>
                    <g id="svg-report-3-nodes"></g>
                </svg>
            </div>
        </div>
        <!-- Outside Iraq (Horizontal Chevrons) -->
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="globe" class="w-4 h-4 text-pink-500"></i>
                جدول (4): المرضى من خارج العراق
                <span id="cmp-total-4" class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع: {{ number_format($visitsByCountry->sum('total')) }}</span>
            </h3>
            <div class="w-full overflow-x-auto py-2">
                <svg id="svg-report-4" viewBox="0 0 450 180" class="w-full min-w-[400px] h-auto overflow-visible"></svg>
            </div>
        </div>
    </div>

    <!-- 4. الفحوصات البصرية والتحاليل المختبرية (جدول 5 و 6) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Visual Tests (Horizontal Chevrons) -->
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="eye" class="w-4 h-4 text-orange-500"></i>
                جدول (5): البصرية والساندة
                <span class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع: {{ number_format($totalEyeTests) }}</span>
            </h3>
            <div class="w-full overflow-x-auto py-2">
                <svg id="svg-report-5" viewBox="0 0 450 200" class="w-full min-w-[420px] h-auto overflow-visible"></svg>
            </div>
        </div>
        <!-- Lab Tests (Flat Arrow Columns) -->
        <div class="custom-card p-6 rounded-2xl flex flex-col justify-between">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="test-tube" class="w-4 h-4 text-purple-500"></i>
                جدول (6): التحاليل المختبرية المنجزة
                <span class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع: {{ number_format($labTestsByType->sum('total')) }}</span>
            </h3>
            <div class="w-full overflow-x-auto py-2">
                <svg id="svg-report-6" viewBox="0 0 450 180" class="w-full min-w-[420px] h-[180px] overflow-visible"></svg>
            </div>
        </div>
    </div>


    <!-- 5. تصنيف العمليات الجراحية (جدول 7) -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
            <i data-lucide="scissors" class="w-4 h-4 text-rose-500"></i>
            جدول (7): أعداد وتصنيف العمليات الجراحية للعيون حسب القطاعات
            <span class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع الكلي للعمليات: {{ number_format($totalSurgeries) }}</span>
        </h3>
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 items-center">
            <!-- 2D Arrow Columns -->
            <div class="xl:col-span-1 flex justify-center">
                <svg id="svg-report-7" viewBox="0 0 520 220" class="w-full max-w-[420px] h-[220px] overflow-visible"></svg>
            </div>
            <!-- Dynamic Table from database metadata, filled via AJAX -->
            <div class="xl:col-span-2">
                <div id="table7-loading" class="text-center text-xs text-slate-400 py-6">
                    <i data-lucide="loader" class="w-4 h-4 inline animate-spin mr-1"></i> جاري تحميل بيانات التصنيف...
                </div>
                <table id="table7-content" class="custom-table text-center text-[11px] hidden" style="min-width:100%">
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
                            @foreach($filterSectors as $idx => $s)
                                @php
                                    $colorClass = $headerColors[$idx % count($headerColors)];
                                    $displaySecName = $s->name;
                                    if ($s->name === 'عتبة الخاص') $displaySecName = 'قطاع العتبة الخاص';
                                    if ($s->name === 'عتبة العام') $displaySecName = 'قطاع العتبة العام';
                                @endphp
                                <th class="{{ $colorClass }} font-bold">{{ $displaySecName }}</th>
                            @endforeach
                            <th class="text-pink-600 font-extrabold">المجموع</th>
                            <th class="bg-violet-400/20 font-bold text-violet-800 dark:text-violet-300">النسبة المئوية</th>
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
                                @foreach($filterSectors as $s)
                                    <td class="font-bold table7-cell opacity-30" data-cls="{{ $c->name }}" data-sec="{{ $s->name }}">0</td>
                                @endforeach
                                <td class="font-extrabold text-pink-600 text-xs table7-row-total">0</td>
                                <td class="bg-violet-400/10 text-violet-700 font-extrabold text-xs table7-row-pct">0%</td>
                            </tr>
                        @endforeach
                        
                        <!-- Totals Row -->
                        <tr class="table-row font-extrabold text-rose-600 text-xs" id="table7-totals-row">
                            <td class="text-right pr-3 text-sm">المجموع</td>
                            @foreach($filterSectors as $s)
                                <td class="bg-slate-100/5 table7-col-total" data-sec="{{ $s->name }}">0</td>
                            @endforeach
                            <td class="text-sm font-black text-pink-600" id="table7-grand-total">0</td>
                            <td class="bg-violet-400/15"></td>
                        </tr>
                        
                        <!-- Percentages Row -->
                        <tr class="table-row font-extrabold text-emerald-600 text-[10px]" id="table7-pct-row">
                            <td class="text-right pr-3 font-bold text-[9px]">النسبة %</td>
                            @foreach($filterSectors as $s)
                                <td class="bg-emerald-400/5 font-bold table7-col-pct" data-sec="{{ $s->name }}">0%</td>
                            @endforeach
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    <!-- التوزيع الجغرافي للعمليات الجراحية (جدول 8 و 9) -->

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Inside Iraq (Vertical Columns) -->
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="flag" class="w-4 h-4 text-rose-500"></i>
                جدول (8): التوزيع الجغرافي للعمليات الجراحية داخل العراق
                <span class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع: {{ number_format($surgeriesByGov->sum('total')) }}</span>
            </h3>
            <div class="w-full overflow-x-auto py-2">
                <svg id="svg-report-8" viewBox="0 0 584 594" class="w-full max-w-[480px] h-[480px] overflow-visible mx-auto">
                    <g id="svg-report-8-paths" fill="rgba(244, 63, 94, 0.03)" stroke="#cbd5e1" stroke-width="1.2">
                        {!! $pathsHtml !!}
                    </g>
                    <g id="svg-report-8-nodes"></g>
                </svg>
            </div>
        </div>
        <!-- Outside Iraq (Horizontal Chevrons) -->
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="globe" class="w-4 h-4 text-pink-500"></i>
                جدول (9): العمليات الجراحية للمرضى من خارج العراق
                <span class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع: {{ number_format($surgeriesByCountry->sum('total')) }}</span>
            </h3>
            <div class="w-full overflow-x-auto py-2">
                <svg id="svg-report-9" viewBox="0 0 450 180" class="w-full min-w-[400px] h-auto overflow-visible"></svg>
            </div>
        </div>
    </div>

    <!-- 6. العمليات الجراحية لكل طبيب اختصاص (جدول 10) -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
            <i data-lucide="award" class="w-4 h-4 text-violet-500"></i>
            جدول (10): إجمالي العمليات الجراحية المنجزة لكل طبيب اختصاص (بيانات حقيقية)
            <span class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع: {{ number_format($totalSurgeries) }}</span>
        </h3>
        <div class="w-full overflow-x-auto py-2 mb-4">
            <svg id="svg-report-10" viewBox="0 0 900 240" class="w-full min-w-[850px] h-[240px] overflow-visible"></svg>
        </div>
        <div class="overflow-x-auto">
            <table class="custom-table text-center" style="font-size:10px; min-width:850px">
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
                    $sectorsList = ['قطاع الصحة', 'عتبة الخاص', 'عتبة العام'];
                    
                    // 1. تجميع البيانات لكل طبيب ديناميكياً
                    $dynamicD10 = $filterDoctors->map(function($doc, $index) use ($surgeriesByDoctorCatSector, $classifications, $sectorsList) {
                        $docSurgeries = $surgeriesByDoctorCatSector->where('doctor', $doc->name);
                        
                        $vals = [];
                        $total = 0;
                        
                        foreach ($classifications as $cls) {
                            foreach ($sectorsList as $sec) {
                                $match = $docSurgeries->filter(function($item) use ($cls, $sec) {
                                    if ($cls === 'وسطى') {
                                        return (str_contains($item->classification, 'وسطى') || str_contains($item->classification, 'حقن') || str_contains($item->classification, 'ليزر')) 
                                               && $item->sector === $sec;
                                    }
                                    return $item->classification === $cls && $item->sector === $sec;
                                })->sum('total');
                                
                                $vals[] = $match;
                                $total += $match;
                            }
                        }
                        
                        return [
                            'name' => $doc->name,
                            'vals' => $vals,
                            'total' => $total
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
                    <tr class="table-row">
                        <td>{{ $num + 1 }}</td>
                        <td class="text-right pr-2 font-bold whitespace-nowrap">{{ $doc['name'] }}</td>
                        @foreach($doc['vals'] as $v)
                        <td class="{{ $v == 0 ? 'opacity-20' : '' }}">{{ $v }}</td>
                        @endforeach
                        <td class="font-extrabold text-theme-pink text-xs">{{ $doc['total'] }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="18" class="text-center py-4 text-slate-400 font-bold">لا توجد عمليات جراحية مسجلة لهذه الفترة</td>
                    </tr>
                    @endforelse

                    @if($dynamicD10->count() > 0)
                    <tr class="table-row font-extrabold text-rose-600 text-xs">
                        <td colspan="2" class="text-right pr-2">المجموع</td>
                        @foreach($columnTotals as $total)
                        <td>{{ $total }}</td>
                        @endforeach
                        <td class="text-sm font-black">{{ number_format($grandTotal) }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <p class="text-[8px] text-slate-400 mt-2">ص = قطاع الصحة (حكومي) &nbsp;|&nbsp; خ = عتبة الخاص &nbsp;|&nbsp; ع = عتبة العام</p>
    </div>

    <!-- 7. الإحصائية التفصيلية لكل طبيب -->
    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
            <i data-lucide="user-cog" class="w-4 h-4 text-violet-500"></i>
            الإحصائية التفصيلية للعمليات الجراحية لكل طبيب
            <span class="inline-flex items-center bg-pink-500/10 text-pink-600 dark:text-pink-400 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">المجموع: {{ number_format($totalSurgeries) }}</span>
        </h3>
        
        @php
        // Prepare combined operations list for "All Doctors"
        $allOps = collect();
        foreach($surgeryDetailByDoctor as $docName => $docOps) {
            foreach($docOps as $op) {
                $allOps->push($op);
            }
        }
        $combinedOps = $allOps->groupBy('op')->map(fn($group) => (object)[
            'op' => $group->first()->op,
            'classification' => $group->first()->classification,
            'total' => $group->sum('total')
        ])->sortByDesc('total')->values();
        @endphp

        <div class="flex items-center gap-3 mb-6 bg-slate-200/20 p-3 rounded-xl">
            <span class="text-xs font-bold text-slate-500">اختيار الطبيب:</span>
            <select id="doc-active-selector" onchange="showDocStats(this.value)" class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-3 text-xs font-bold text-text-main font-['Tajawal']">
                @if(!isset($doctor_id) || empty($doctor_id))
                <option value="all">كل الأطباء ({{ $totalSurgeries }} عملية)</option>
                @endif
                @foreach($filterDoctors as $doc)
                    @php
                    $docOps = $surgeryDetailByDoctor->get($doc->name) ?? collect();
                    $docTotal = $docOps->sum('total');
                    $isDocActive = (isset($doctor_id) && $doctor_id == $doc->id);
                    @endphp
                    @if(!isset($doctor_id) || empty($doctor_id) || $doctor_id == $doc->id)
                    <option value="{{ $doc->id }}" {{ $isDocActive ? 'selected' : '' }}>{{ $doc->name }} ({{ $docTotal }} عملية)</option>
                    @endif
                @endforeach
            </select>
        </div>

        <!-- Details Panel -->
        @php
        $bc = [
            'خاصة' => 'bg-purple-100 text-purple-700',
            'فوق الكبرى' => 'bg-rose-100 text-rose-700',
            'كبرى' => 'bg-orange-100 text-orange-700',
            'وسطى (حقن)' => 'bg-blue-100 text-blue-700',
            'وسطى (ليزر)' => 'bg-blue-100 text-blue-700',
            'وسطى' => 'bg-blue-100 text-blue-700',
            'صغرى' => 'bg-yellow-100 text-yellow-700'
        ];
        @endphp

        <!-- Combined Panel for All Doctors -->
        <div id="stats-panel-all" class="stats-panel {{ (isset($doctor_id) && !empty($doctor_id)) ? 'hidden' : '' }} transition-opacity duration-300">
            <div class="flex items-center justify-between gap-3 mb-4">
                <h4 class="text-xs font-bold text-slate-800">كل الأطباء - إجمالي العمليات</h4>
                <span class="text-xs font-bold text-white bg-violet-500 px-4 py-1 rounded-full">{{ $totalSurgeries }} عملية</span>
            </div>
            <div class="flex flex-col lg:flex-row gap-6 items-start">
                <div class="w-full lg:w-2/5 flex-shrink-0">
                    <svg id="svg-doc-all" viewBox="0 0 450 200" class="w-full h-auto overflow-visible"></svg>
                </div>
                <div class="w-full lg:w-3/5">
                    <table class="custom-table text-xs">
                        <thead><tr><th>ت</th><th>اسم العملية</th><th>التصنيف</th><th class="text-center font-bold">العدد</th></tr></thead>
                        <tbody>
                            @forelse($combinedOps as $i => $op)
                            <tr class="table-row">
                                <td class="w-8 text-center">{{ $i + 1 }}</td>
                                <td>{{ $op->op }}</td>
                                <td><span class="text-[9px] font-bold px-2 py-0.5 rounded-full {{ $bc[$op->classification] ?? '' }}">{{ $op->classification }}</span></td>
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

        <!-- Individual Doctor Panels -->
        @foreach($filterDoctors as $doc)
        @php
        $docOps = $surgeryDetailByDoctor->get($doc->name) ?? collect();
        $docTotal = $docOps->sum('total');
        $isDocActive = (isset($doctor_id) && $doctor_id == $doc->id);
        @endphp
        <div id="stats-panel-{{ $doc->id }}" class="stats-panel {{ $isDocActive ? '' : 'hidden' }} transition-opacity duration-300">
            <div class="flex items-center justify-between gap-3 mb-4">
                <h4 class="text-xs font-bold text-slate-800">{{ $doc->name }}</h4>
                <span class="text-xs font-bold text-white bg-violet-500 px-4 py-1 rounded-full">{{ $docTotal }} عملية</span>
            </div>
            <div class="flex flex-col lg:flex-row gap-6 items-start">
                <div class="w-full lg:w-2/5 flex-shrink-0">
                    <svg id="svg-doc-{{ $doc->id }}" viewBox="0 0 450 200" class="w-full h-auto overflow-visible"></svg>
                </div>
                <div class="w-full lg:w-3/5">
                    <table class="custom-table text-xs">
                        <thead><tr><th>ت</th><th>اسم العملية</th><th>التصنيف</th><th class="text-center font-bold">العدد</th></tr></thead>
                        <tbody>
                            @forelse($docOps as $i => $op)
                            <tr class="table-row">
                                <td class="w-8 text-center">{{ $i + 1 }}</td>
                                <td>{{ $op->op }}</td>
                                <td><span class="text-[9px] font-bold px-2 py-0.5 rounded-full {{ $bc[$op->classification] ?? '' }}">{{ $op->classification }}</span></td>
                                <td class="text-center font-bold text-violet-600 text-xs">{{ $op->total }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-slate-400 py-4">لا توجد عمليات مسجلة لهذا الطبيب في هذه الفترة</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endforeach
    </div>


    {{-- ── جدول (10): العمليات التفصيلية لكل طبيب (من الجدول المستقل) ── --}}
    @php
    // استخدم $doctorOpStatsByDoctor إذا توفر، وإلا ارجع لـ $surgeryDetailByDoctor
    $detailSource = isset($doctorOpStatsByDoctor) && $doctorOpStatsByDoctor && $doctorOpStatsByDoctor->count() > 0
        ? $doctorOpStatsByDoctor
        : $surgeryDetailByDoctor;

    $usingNewTable = isset($doctorOpStatsByDoctor) && $doctorOpStatsByDoctor && $doctorOpStatsByDoctor->count() > 0;

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
            جدول (10): العمليات التفصيلية لكل طبيب حسب النوع
            @if($usingNewTable)
            <span class="inline-flex items-center bg-violet-500/10 text-violet-600 font-bold px-2 py-0.5 rounded-lg text-[10px] mr-2">
                بيانات محدّثة
            </span>
            @endif
        </h3>

        @if($detailSource && $detailSource->count() > 0)
        <div class="space-y-4">
            @foreach($filterDoctors as $doc)
            @php
            $docOps = $detailSource->get($doc->name) ?? collect();
            $docTotal = $usingNewTable
                ? $docOps->sum('total')
                : $docOps->sum('total');
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
                    <table class="custom-table text-xs w-full">
                        <thead>
                            <tr>
                                <th class="w-8">ت</th>
                                <th class="text-right pr-3">اسم العملية</th>
                                <th class="w-36 bg-violet-400/10">التصنيف</th>
                                <th class="w-24 text-center font-bold">العدد</th>
                                <th class="w-24 text-center bg-emerald-400/10">النسبة</th>
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
                                <td class="text-center text-emerald-600 font-bold bg-emerald-400/5">
                                    {{ $docTotal > 0 ? number_format(($op->total / $docTotal) * 100, 1) . '%' : '—' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t-2 border-slate-300/20 font-extrabold">
                                <td colspan="3" class="py-2 text-right pr-3 text-pink-600 text-[10px]">المجموع</td>
                                <td class="py-2 text-center text-violet-600">{{ number_format($docTotal) }}</td>
                                <td class="py-2 text-center text-emerald-600 bg-emerald-400/5">100%</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
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

<!-- Custom Styles for Print and 2D Arrow effects -->
<style>
@media print {
    #sidebar, header, .custom-card:first-child, select, button { display: none !important; }
    #page-reports { display: block !important; overflow: visible !important; }
    .custom-card { border: none !important; box-shadow: none !important; page-break-inside: avoid !important; }
}

/* Arrow Growth Animation */
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
// ── Scroll-triggered chart animation registry ──────────────────
const _svgDrawFns = new Map();
const _svgScrollObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const fn = _svgDrawFns.get(entry.target.id);
            if (fn) fn();
        }
    });
}, { threshold: 0.15 });

function watchChart(svgId, drawFn) {
    _svgDrawFns.set(svgId, drawFn);
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
    
    const cx = 260;
    const cy = 200;

    // Draw left branch
    const leftPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
    leftPath.setAttribute('d', `M ${cx-15} ${cy} L ${cx-15} ${cy-50} C ${cx-15} ${cy-80} ${cx-50} ${cy-90} ${cx-70} ${cy-105} L ${cx-80} ${cy-97} L ${cx-65} ${cy-125} L ${cx-37} ${cy-107} L ${cx-47} ${cy-112} C ${cx-35} ${cy-100} ${cx-5} ${cy-90} ${cx-5} ${cy-50} L ${cx-5} ${cy} Z`);
    leftPath.setAttribute('fill', '#0284c7');
    svg.appendChild(leftPath);

    // Draw right branch
    const rightPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
    rightPath.setAttribute('d', `M ${cx-15} ${cy} L ${cx-15} ${cy-50} C ${cx-15} ${cy-80} ${cx-50} ${cy-90} ${cx-70} ${cy-105} L ${cx-80} ${cy-97} L ${cx-65} ${cy-125} L ${cx-37} ${cy-107} L ${cx-47} ${cy-112} C ${cx-35} ${cy-100} ${cx-5} ${cy-90} ${cx-5} ${cy-50} L ${cx-5} ${cy} Z`);
    rightPath.setAttribute('fill', '#db2777');
    rightPath.setAttribute('transform', `translate(${cx}, 0) scale(-1, 1) translate(-${cx}, 0)`);
    svg.appendChild(rightPath);

    // Total pill at trunk base
    const totalValStr = totalVal.toLocaleString();
    const totalPillW = Math.max(36, totalValStr.length * 6.5 + 10);
    const totalPillH = 16;
    const totalPill = document.createElementNS("http://www.w3.org/2000/svg", "rect");
    totalPill.setAttribute('x', cx - totalPillW / 2);
    totalPill.setAttribute('y', cy - 12);
    totalPill.setAttribute('width', totalPillW);
    totalPill.setAttribute('height', totalPillH);
    totalPill.setAttribute('rx', '8');
    totalPill.setAttribute('fill', '#334155');
    svg.appendChild(totalPill);

    const tTotal = document.createElementNS("http://www.w3.org/2000/svg", "text");
    tTotal.setAttribute('x', cx);
    tTotal.setAttribute('y', cy - 0.5);
    tTotal.setAttribute('font-family', 'Outfit');
    tTotal.setAttribute('font-size', '10px');
    tTotal.setAttribute('font-weight', 'black');
    tTotal.setAttribute('fill', '#ffffff');
    tTotal.setAttribute('text-anchor', 'middle');
    tTotal.textContent = totalValStr;
    svg.appendChild(tTotal);

    // Left branch badge
    const label1Text = `${label1}: ${val1.toLocaleString()}`;
    const badge1W = label1Text.length * 6.5 + 14;
    const badge1H = 18;
    const badge1 = document.createElementNS("http://www.w3.org/2000/svg", "rect");
    badge1.setAttribute('x', cx - 80 - badge1W / 2);
    badge1.setAttribute('y', cy - 145);
    badge1.setAttribute('width', badge1W);
    badge1.setAttribute('height', badge1H);
    badge1.setAttribute('rx', '9');
    badge1.setAttribute('fill', '#0284c7');
    svg.appendChild(badge1);

    const tVal1 = document.createElementNS("http://www.w3.org/2000/svg", "text");
    tVal1.setAttribute('x', cx - 80);
    tVal1.setAttribute('y', cy - 133);
    tVal1.setAttribute('font-family', 'Tajawal');
    tVal1.setAttribute('font-size', '9px');
    tVal1.setAttribute('font-weight', 'bold');
    tVal1.setAttribute('fill', '#ffffff');
    tVal1.setAttribute('text-anchor', 'middle');
    tVal1.textContent = label1Text;
    svg.appendChild(tVal1);

    // Right branch badge
    const label2Text = `${label2}: ${val2.toLocaleString()}`;
    const badge2W = label2Text.length * 6.5 + 14;
    const badge2H = 18;
    const badge2 = document.createElementNS("http://www.w3.org/2000/svg", "rect");
    badge2.setAttribute('x', cx + 80 - badge2W / 2);
    badge2.setAttribute('y', cy - 145);
    badge2.setAttribute('width', badge2W);
    badge2.setAttribute('height', badge2H);
    badge2.setAttribute('rx', '9');
    badge2.setAttribute('fill', '#db2777');
    svg.appendChild(badge2);

    const tVal2 = document.createElementNS("http://www.w3.org/2000/svg", "text");
    tVal2.setAttribute('x', cx + 80);
    tVal2.setAttribute('y', cy - 133);
    tVal2.setAttribute('font-family', 'Tajawal');
    tVal2.setAttribute('font-size', '9px');
    tVal2.setAttribute('font-weight', 'bold');
    tVal2.setAttribute('fill', '#ffffff');
    tVal2.setAttribute('text-anchor', 'middle');
    tVal2.textContent = label2Text;
    svg.appendChild(tVal2);
}

// 2. Vertical Flat Arrow Columns (With Rotation Support for Large Data)
function draw2DFlatVerticalArrows(svgId, values, labels, presetColors = null) {
    const svg = document.getElementById(svgId);
    if (!svg) return;
    svg.innerHTML = '';
    const maxVal = Math.max(...values, 1);
    const n = values.length;
    const viewBoxStr = svg.getAttribute('viewBox') || "0 0 900 240";
    const width = parseInt(viewBoxStr.split(' ')[2]);
    const height = parseInt(viewBoxStr.split(' ')[3]);
    const marginL = 40;
    const marginR = 40;
    const availableW = width - marginL - marginR;
    const spacing = n > 1 ? availableW / (n - 1) : availableW;

    // Dynamic floor to allow more space for rotated labels when items count is large
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

    const colors = presetColors || ['#3b82f6','#ec4899','#f59e0b','#10b981','#8b5cf6','#06b6d4','#f97316','#64748b','#ec4899','#84cc16','#0ea5e9','#6366f1','#d946ef','#14b8a6','#f43f5e','#a78bfa'];

    values.forEach((val, i) => {
        const x = marginL + i * spacing;
        const color = colors[i % colors.length];

        const minH = 20;
        const maxH = floorY - 55;
        const scaleVal = maxVal > 1 ? Math.sqrt(val) / Math.sqrt(maxVal) : 1;
        const H = minH + (maxH - minH) * scaleVal;

        // stagger delay per bar
        const startDelay = (i * 80) + 'ms';
        const dur = '0.65s';

        const g = document.createElementNS("http://www.w3.org/2000/svg", "g");

        // ── Arrow Body (grows from floorY upwards) ──
        const body = document.createElementNS("http://www.w3.org/2000/svg", "rect");
        body.setAttribute('x', x - 8);
        body.setAttribute('y', floorY - H);
        body.setAttribute('width', '16');
        body.setAttribute('height', H);
        body.setAttribute('fill', color);
        body.setAttribute('rx', '1');

        // scaleY from 0→1 anchored at bottom (floorY)
        const animBody = document.createElementNS("http://www.w3.org/2000/svg", "animateTransform");
        animBody.setAttribute('attributeName', 'transform');
        animBody.setAttribute('type', 'scale');
        animBody.setAttribute('additive', 'sum');
        animBody.setAttribute('from', `1 0`);
        animBody.setAttribute('to', `1 1`);
        animBody.setAttribute('dur', dur);
        animBody.setAttribute('begin', startDelay);
        animBody.setAttribute('fill', 'freeze');
        animBody.setAttribute('calcMode', 'spline');
        animBody.setAttribute('keySplines', '0.25 0.46 0.45 0.94');
        body.appendChild(animBody);

        // anchor transform-origin at bottom of the bar
        body.setAttribute('transform', `translate(0, ${floorY}) scale(1, 0) translate(0, ${-floorY})`);
        const animOrigin = document.createElementNS("http://www.w3.org/2000/svg", "animateTransform");
        animOrigin.setAttribute('attributeName', 'transform');
        animOrigin.setAttribute('type', 'translate');
        animOrigin.setAttribute('from', `0 0`);
        animOrigin.setAttribute('to', `0 0`);
        animOrigin.setAttribute('dur', dur);
        animOrigin.setAttribute('begin', startDelay);
        animOrigin.setAttribute('fill', 'freeze');
        body.setAttribute('transform-origin', `${x} ${floorY}`);
        body.style.transformOrigin = `${x}px ${floorY}px`;
        body.style.transform = 'scaleY(0)';
        body.style.transition = `transform ${dur} cubic-bezier(0.25,0.46,0.45,0.94) ${startDelay}`;
        g.appendChild(body);

        // ── Arrow Head ──
        const head = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
        head.setAttribute('points', `${x-12},${floorY-H} ${x+12},${floorY-H} ${x},${floorY-H-10}`);
        head.setAttribute('fill', color);
        head.style.opacity = '0';
        head.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
        g.appendChild(head);

        // ── Dashed Connector ──
        const dashed = document.createElementNS("http://www.w3.org/2000/svg", "line");
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

        // ── Value Pill ──
        const valStr = val.toLocaleString();
        const pillW = Math.max(20, valStr.length * 6 + 6);
        const pillH = 14;

        const pill = document.createElementNS("http://www.w3.org/2000/svg", "rect");
        pill.setAttribute('x', x - pillW / 2);
        pill.setAttribute('y', floorY - H - 36);
        pill.setAttribute('width', pillW);
        pill.setAttribute('height', pillH);
        pill.setAttribute('rx', '7');
        pill.setAttribute('fill', color);
        pill.style.opacity = '0';
        pill.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
        g.appendChild(pill);

        const tVal = document.createElementNS("http://www.w3.org/2000/svg", "text");
        tVal.setAttribute('x', x);
        tVal.setAttribute('y', floorY - H - 25.5);
        tVal.setAttribute('font-family', 'Outfit');
        tVal.setAttribute('font-size', '8.5px');
        tVal.setAttribute('font-weight', 'bold');
        tVal.setAttribute('fill', '#ffffff');
        tVal.setAttribute('text-anchor', 'middle');
        tVal.textContent = valStr;
        tVal.style.opacity = '0';
        tVal.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
        g.appendChild(tVal);

        // ── Label ──
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

        // trigger CSS animation on next paint
        requestAnimationFrame(() => requestAnimationFrame(() => {
            body.style.transform = 'scaleY(1)';
            head.style.opacity  = '1';
            dashed.style.opacity = '1';
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

    // Spacious vertical layout: 42px per item (label + bar + gap)
    const spacing = 42;
    const marginT = 16;
    const marginB = 16;
    const dynamicHeight = marginT + marginB + (n - 1) * spacing + 22;
    
    svg.setAttribute('viewBox', `0 0 450 ${dynamicHeight}`);
    svg.style.height = `${dynamicHeight}px`;

    const maxVal = Math.max(...values, 1);
    const colors = presetColors || ['#db2777', '#d97706', '#10b981', '#475569', '#3b82f6', '#8b5cf6'];
    
    // Width boundaries: chevrons grow from right to left (RTL)
    const startX = 435; // Right baseline
    const chartStartX = 10; // Left-most boundary of chart area
    const maxL = startX - chartStartX - 45; // Max length of chevron, leaving 45px for pill on the left

    values.forEach((val, i) => {
        const labelY = marginT + i * spacing;
        const barY = labelY + 16;
        const color = colors[i % colors.length];

        const scaleVal = maxVal > 0 ? val / maxVal : 0;
        const L = 15 + maxL * scaleVal;
        const endX = startX - L;

        const startDelay = (i * 80) + 'ms';
        const dur = '0.65s';

        const g = document.createElementNS("http://www.w3.org/2000/svg", "g");

        // ── Label ──
        const label = document.createElementNS("http://www.w3.org/2000/svg", "text");
        label.setAttribute('x', startX);
        label.setAttribute('y', labelY + 4);
        label.setAttribute('font-family', 'Tajawal');
        label.setAttribute('font-size', '10.5px');
        label.setAttribute('font-weight', 'bold');
        label.setAttribute('fill', '#475569');
        label.setAttribute('text-anchor', 'end');
        label.textContent = labels[i] || '';
        g.appendChild(label);

        // ── Chevron Body — grows from startX leftwards via scaleX ──
        const body = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
        body.setAttribute('points', `${startX},${barY-6} ${endX+6},${barY-6} ${endX},${barY} ${endX+6},${barY+6} ${startX},${barY+6}`);
        body.setAttribute('fill', color);
        // anchor scale at right edge (startX)
        body.style.transformOrigin = `${startX}px ${barY}px`;
        body.style.transform = 'scaleX(0)';
        body.style.transition = `transform ${dur} cubic-bezier(0.25,0.46,0.45,0.94) ${startDelay}`;
        g.appendChild(body);

        // ── Pill & value ──
        const valStr = val.toLocaleString();
        const pillW = Math.max(18, valStr.length * 6 + 6);
        const pillH = 14;

        const pill = document.createElementNS("http://www.w3.org/2000/svg", "rect");
        pill.setAttribute('x', endX - pillW - 6);
        pill.setAttribute('y', barY - pillH / 2);
        pill.setAttribute('width', pillW);
        pill.setAttribute('height', pillH);
        pill.setAttribute('rx', '7');
        pill.setAttribute('fill', color);
        pill.style.opacity = '0';
        pill.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
        g.appendChild(pill);

        const tVal = document.createElementNS("http://www.w3.org/2000/svg", "text");
        tVal.setAttribute('x', endX - pillW / 2 - 6);
        tVal.setAttribute('y', barY + 4);
        tVal.setAttribute('font-family', 'Outfit');
        tVal.setAttribute('font-size', '8.5px');
        tVal.setAttribute('font-weight', 'bold');
        tVal.setAttribute('fill', '#ffffff');
        tVal.setAttribute('text-anchor', 'middle');
        tVal.textContent = valStr;
        tVal.style.opacity = '0';
        tVal.style.transition = `opacity 0.3s ease calc(${startDelay} + ${dur})`;
        g.appendChild(tVal);

        svg.appendChild(g);

        // trigger on next paint
        requestAnimationFrame(() => requestAnimationFrame(() => {
            body.style.transform = 'scaleX(1)';
            // show pill + value after bar animation completes
            const totalDelay = (parseFloat(startDelay) || 0) + parseFloat(dur) * 1000;
            setTimeout(() => {
                pill.style.opacity = '1';
                tVal.style.opacity = '1';
            }, totalDelay);
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

    // Register each chart with the scroll observer.
    // The draw fn will be called immediately (first view) and replayed on every scroll-into-view.
    watchChart('svg-report-1',  () => draw2DBranchingArrow('svg-report-1', {{ $cGeneral }}, {{ $cSpecial }}, '{{ str_replace("استشارية ", "", $generalLabel) }}', '{{ str_replace("استشارية ", "", $specialLabel) }}', {{ $totalVisits }}));
    watchChart('svg-report-2',  () => draw2DFlatVerticalArrows('svg-report-2', docVisitsData, docVisitsLabels));
    watchChart('svg-report-3',  () => drawIraqMap('svg-report-3', govData, govLabels, '#0284c7'));
    watchChart('svg-report-4',  () => draw2DFlatHorizontalChevrons('svg-report-4', countryData, countryLabels));
    watchChart('svg-report-8',  () => drawIraqMap('svg-report-8', surgGovData, surgGovLabels, '#f43f5e'));
    watchChart('svg-report-9',  () => draw2DFlatHorizontalChevrons('svg-report-9', surgCountryData, surgCountryLabels, ['#f43f5e','#ec4899','#db2777','#f43f5e','#ec4899','#db2777']));
    watchChart('svg-report-5',  () => draw2DFlatHorizontalChevrons('svg-report-5', visualData, visualLabels, ['#f97316','#ea580c','#c2410c','#ea580c','#f97316','#c2410c']));
    watchChart('svg-report-6',  () => draw2DFlatVerticalArrows('svg-report-6', labTestData, labTestLabels, ['#8b5cf6','#a855f7','#c084fc','#d8b4fe','#f3e8ff']));
    watchChart('svg-report-7',  () => {
        const surgClassLabels = [];
        const surgClassData = [];
        document.querySelectorAll('.table7-data-row').forEach(row => {
            const label = row.querySelector('td').textContent.trim();
            const total = parseInt(row.querySelector('.table7-row-total').textContent) || 0;
            surgClassLabels.push(label);
            surgClassData.push(total);
        });
        draw2DFlatVerticalArrows('svg-report-7', surgClassData, surgClassLabels, ['#10b981', '#f43f5e', '#ec4899', '#f59e0b', '#8b5cf6', '#64748b']);
    });
    watchChart('svg-report-10', () => draw2DFlatVerticalArrows('svg-report-10', docSurgData, docSurgLabels));

    // Initialize switcher single doctor stats
    const selector = document.getElementById('doc-active-selector');
    if (selector) renderSingleDocChart(selector.value);
}

// switcher individual doctor operations details -> Horizontal Chevrons
const docOpsData = {
    "all": @json($combinedOps->pluck('total')),
    @foreach($surgeryDetailByDoctor as $docName => $ops)
        @php
        $docModel = $filterDoctors->firstWhere('name', $docName);
        $docId = $docModel ? $docModel->id : 0;
        @endphp
        @if($docId)
        "{{ $docId }}": @json($ops->pluck('total')),
        @endif
    @endforeach
};
const docNamesData = {
    "all": @json($combinedOps->pluck('op')),
    @foreach($surgeryDetailByDoctor as $docName => $ops)
        @php
        $docModel = $filterDoctors->firstWhere('name', $docName);
        $docId = $docModel ? $docModel->id : 0;
        @endphp
        @if($docId)
        "{{ $docId }}": @json($ops->pluck('op')),
        @endif
    @endforeach
};

function renderSingleDocChart(id) {
    const values = docOpsData[id] || [];
    const labels = docNamesData[id] || [];
    if (values.length === 0) {
        const svg = document.getElementById('svg-doc-' + id);
        if (svg) svg.innerHTML = '<text x="225" y="100" font-family="Tajawal" font-size="11" font-weight="bold" fill="#94a3b8" text-anchor="middle">لا توجد عمليات مسجلة لهذا الطبيب</text>';
        return;
    }
    draw2DFlatHorizontalChevrons('svg-doc-' + id, values, labels);
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
        setTimeout(() => {
            renderAll2DArrowCharts();
            loadTable7();
        }, 150);
    }
};

// ── جدول (7): جلب بيانات التصنيف من نفس API التي يستخدمها زر "تعديل" ──
async function loadTable7() {
    // 1. Reset all table values to 0
    document.querySelectorAll('.table7-cell').forEach(c => {
        c.textContent = '0';
        c.classList.add('opacity-30');
    });
    document.querySelectorAll('.table7-row-total').forEach(c => c.textContent = '0');
    document.querySelectorAll('.table7-row-pct').forEach(c => c.textContent = '0%');
    document.querySelectorAll('.table7-col-total').forEach(c => c.textContent = '0');
    document.querySelectorAll('.table7-col-pct').forEach(c => c.textContent = '0%');
    const grandTotalEl = document.getElementById('table7-grand-total');
    if (grandTotalEl) grandTotalEl.textContent = '0';

    // 2. Fetch data
    const fromVal = document.getElementById('report-date-from')?.value || '{{ substr($start_date ?? date("Y-m"), 0, 7) }}';
    const toVal   = document.getElementById('report-date-to')?.value   || '{{ substr($end_date   ?? date("Y-m"), 0, 7) }}';

    const startDate = fromVal.length === 7 ? fromVal + '-01' : fromVal;
    const endDate   = toVal.length   === 7 ? toVal   + '-01' : toVal;

    try {
        const res  = await fetch(`/api/surgeries?start_date=${startDate}&end_date=${endDate}&per_page=2000&type=surgeries_cls`);
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

        // 5. Calculate row percentages
        document.querySelectorAll('.table7-data-row').forEach(row => {
            const rowTotal = parseInt(row.querySelector('.table7-row-total').textContent) || 0;
            const pct = grandTotal > 0 ? Math.round((rowTotal / grandTotal) * 100) : 0;
            row.querySelector('.table7-row-pct').textContent = pct + '%';
        });

        // 6. Calculate column totals and percentages
        document.querySelectorAll('.table7-col-total').forEach(colTotalCell => {
            const sec = colTotalCell.dataset.sec;
            let colTotal = 0;
            document.querySelectorAll(`.table7-cell[data-sec="${sec}"]`).forEach(cell => {
                colTotal += parseInt(cell.textContent) || 0;
            });
            colTotalCell.textContent = colTotal;

            const pctCell = document.querySelector(`.table7-col-pct[data-sec="${sec}"]`);
            if (pctCell) {
                const colPct = grandTotal > 0 ? Math.round((colTotal / grandTotal) * 100) : 0;
                pctCell.textContent = colPct + '%';
            }
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

</script>
