{{-- PAGE: CLINICAL COMPARISON DASHBOARD (لوحة المفاضلة السريرية) --}}
<section id="page-comparison" class="page-section space-y-6 hidden">

    {{-- ══ Header Bar ══ --}}
    <div class="custom-card p-4 rounded-2xl">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-violet-500/10 flex items-center justify-center text-violet-500">
                    <i data-lucide="git-compare" class="w-4 h-4"></i>
                </div>
                <div>
                    <h2 class="text-xs font-bold text-text-main">لوحة المفاضلة السريرية</h2>
                    <p class="text-[9px] text-slate-400 mt-0.5">مقارنة تفاعلية ثنائية بين طبيبين أو فترتين زمنيتين مختلفتين</p>
                </div>
            </div>
            <button onclick="runComparison()" id="cmp-run-btn"
                class="py-2 px-5 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-violet-500 to-purple-500 hover-press flex items-center gap-2 shadow-md">
                <i data-lucide="zap" class="w-3.5 h-3.5"></i>
                <span>تنفيذ المقارنة</span>
            </button>
        </div>
    </div>

    {{-- ══ Side-by-Side Filter Cards ══ --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

        {{-- Side A --}}
        <div class="custom-card p-5 rounded-2xl border-2 border-blue-400/30">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-5 h-5 rounded-full bg-blue-500 flex items-center justify-center text-white text-[9px] font-black">أ</div>
                <h3 class="text-xs font-bold text-blue-600">الجهة الأولى (أ)</h3>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div class="flex flex-col gap-1">
                    <label class="text-[9px] font-bold text-slate-400">الطبيب:</label>
                    <select id="cmp-doc-a" class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-3 text-xs font-bold text-text-main font-['Tajawal']">
                        <option value="">كل الأطباء</option>
                        @foreach($filterDoctors as $doc)
                        <option value="{{ $doc->id }}">{{ $doc->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-[9px] font-bold text-slate-400">من تاريخ:</label>
                    <input type="date" id="cmp-from-a" value="{{ $start_date ?? '2026-05-01' }}"
                        class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-3 text-xs font-bold text-text-main custom-date-input">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-[9px] font-bold text-slate-400">إلى تاريخ:</label>
                    <input type="date" id="cmp-to-a" value="{{ $end_date ?? '2026-05-31' }}"
                        class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-3 text-xs font-bold text-text-main custom-date-input">
                </div>
            </div>
        </div>

        {{-- Side B --}}
        <div class="custom-card p-5 rounded-2xl border-2 border-rose-400/30">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-5 h-5 rounded-full bg-rose-500 flex items-center justify-center text-white text-[9px] font-black">ب</div>
                <h3 class="text-xs font-bold text-rose-600">الجهة الثانية (ب)</h3>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div class="flex flex-col gap-1">
                    <label class="text-[9px] font-bold text-slate-400">الطبيب:</label>
                    <select id="cmp-doc-b" class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-3 text-xs font-bold text-text-main font-['Tajawal']">
                        <option value="">كل الأطباء</option>
                        @foreach($filterDoctors as $doc)
                        <option value="{{ $doc->id }}">{{ $doc->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-[9px] font-bold text-slate-400">من تاريخ:</label>
                    <input type="date" id="cmp-from-b" value="{{ $start_date ?? '2026-05-01' }}"
                        class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-3 text-xs font-bold text-text-main custom-date-input">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-[9px] font-bold text-slate-400">إلى تاريخ:</label>
                    <input type="date" id="cmp-to-b" value="{{ $end_date ?? '2026-05-31' }}"
                        class="custom-inset border-none focus:outline-none rounded-lg py-1.5 px-3 text-xs font-bold text-text-main custom-date-input">
                </div>
            </div>
        </div>
    </div>

    {{-- ══ Loading Spinner ══ --}}
    <div id="cmp-loading" class="hidden flex items-center justify-center py-16">
        <div class="flex flex-col items-center gap-3">
            <div class="w-10 h-10 border-4 border-violet-500/30 border-t-violet-500 rounded-full animate-spin"></div>
            <p class="text-xs text-slate-400 font-bold">جاري تحليل البيانات...</p>
        </div>
    </div>

    {{-- ══ Results Area (hidden until first comparison) ══ --}}
    <div id="cmp-results" class="hidden space-y-6">

        {{-- 1. KPI Summary Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            {{-- Visits --}}
            <div class="custom-card p-5 rounded-2xl space-y-3">
                <div class="flex items-center gap-2">
                    <i data-lucide="users" class="w-4 h-4 text-emerald-500"></i>
                    <span class="text-xs font-bold text-text-main">إجمالي الزيارات</span>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div class="bg-blue-50 rounded-xl p-3 text-center">
                        <div class="text-[9px] font-bold text-blue-400 mb-1">الجهة (أ)</div>
                        <div id="kpi-visits-a" class="text-xl font-black text-blue-600">—</div>
                    </div>
                    <div class="bg-rose-50 rounded-xl p-3 text-center">
                        <div class="text-[9px] font-bold text-rose-400 mb-1">الجهة (ب)</div>
                        <div id="kpi-visits-b" class="text-xl font-black text-rose-600">—</div>
                    </div>
                </div>
                <div id="kpi-visits-diff" class="text-center text-[10px] font-bold text-slate-400">—</div>
            </div>
            {{-- Eye Tests --}}
            <div class="custom-card p-5 rounded-2xl space-y-3">
                <div class="flex items-center gap-2">
                    <i data-lucide="eye" class="w-4 h-4 text-orange-500"></i>
                    <span class="text-xs font-bold text-text-main">إجمالي الفحوصات البصرية</span>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div class="bg-blue-50 rounded-xl p-3 text-center">
                        <div class="text-[9px] font-bold text-blue-400 mb-1">الجهة (أ)</div>
                        <div id="kpi-tests-a" class="text-xl font-black text-blue-600">—</div>
                    </div>
                    <div class="bg-rose-50 rounded-xl p-3 text-center">
                        <div class="text-[9px] font-bold text-rose-400 mb-1">الجهة (ب)</div>
                        <div id="kpi-tests-b" class="text-xl font-black text-rose-600">—</div>
                    </div>
                </div>
                <div id="kpi-tests-diff" class="text-center text-[10px] font-bold text-slate-400">—</div>
            </div>
            {{-- Surgeries --}}
            <div class="custom-card p-5 rounded-2xl space-y-3">
                <div class="flex items-center gap-2">
                    <i data-lucide="scissors" class="w-4 h-4 text-rose-500"></i>
                    <span class="text-xs font-bold text-text-main">إجمالي العمليات الجراحية</span>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div class="bg-blue-50 rounded-xl p-3 text-center">
                        <div class="text-[9px] font-bold text-blue-400 mb-1">الجهة (أ)</div>
                        <div id="kpi-surgs-a" class="text-xl font-black text-blue-600">—</div>
                    </div>
                    <div class="bg-rose-50 rounded-xl p-3 text-center">
                        <div class="text-[9px] font-bold text-rose-400 mb-1">الجهة (ب)</div>
                        <div id="kpi-surgs-b" class="text-xl font-black text-rose-600">—</div>
                    </div>
                </div>
                <div id="kpi-surgs-diff" class="text-center text-[10px] font-bold text-slate-400">—</div>
            </div>
        </div>

        {{-- 2. Surgical Operations Detail Side-by-Side Charts --}}
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="bar-chart-horizontal" class="w-4 h-4 text-violet-500"></i>
                مقارنة تفصيلية للعمليات الجراحية (الجهة أ مقابل الجهة ب)
            </h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                        <span id="cmp-label-a" class="text-[10px] font-bold text-blue-600">الجهة (أ)</span>
                    </div>
                    <div class="w-full overflow-x-auto">
                        <svg id="cmp-svg-surgs-a" viewBox="0 0 450 50" class="w-full h-auto overflow-visible"></svg>
                    </div>
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-3 h-3 rounded-full bg-rose-500"></div>
                        <span id="cmp-label-b" class="text-[10px] font-bold text-rose-600">الجهة (ب)</span>
                    </div>
                    <div class="w-full overflow-x-auto">
                        <svg id="cmp-svg-surgs-b" viewBox="0 0 450 50" class="w-full h-auto overflow-visible"></svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. Eye Tests Detail Side-by-Side Charts --}}
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-xs font-bold text-text-main flex items-center gap-2 pb-3 mb-4 border-b border-slate-200/20">
                <i data-lucide="eye" class="w-4 h-4 text-orange-500"></i>
                مقارنة تفصيلية للفحوصات البصرية (الجهة أ مقابل الجهة ب)
            </h3>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                        <span class="text-[10px] font-bold text-blue-600">الجهة (أ)</span>
                    </div>
                    <div class="w-full overflow-x-auto">
                        <svg id="cmp-svg-tests-a" viewBox="0 0 450 50" class="w-full h-auto overflow-visible"></svg>
                    </div>
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-3">
                        <div class="w-3 h-3 rounded-full bg-rose-500"></div>
                        <span class="text-[10px] font-bold text-rose-600">الجهة (ب)</span>
                    </div>
                    <div class="w-full overflow-x-auto">
                        <svg id="cmp-svg-tests-b" viewBox="0 0 450 50" class="w-full h-auto overflow-visible"></svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. Side-by-Side Data Tables --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            {{-- Table A --}}
            <div class="custom-card p-5 rounded-2xl">
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-4 h-4 rounded-full bg-blue-500 flex items-center justify-center text-white text-[8px] font-black">أ</div>
                    <span id="tbl-label-a" class="text-xs font-bold text-blue-600">الجهة (أ) — العمليات التفصيلية</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="custom-table text-xs w-full">
                        <thead><tr><th>ت</th><th>اسم العملية</th><th>التصنيف</th><th class="text-center">العدد</th></tr></thead>
                        <tbody id="cmp-tbl-surgs-a">
                            <tr><td colspan="4" class="text-center text-slate-300 py-6 text-[10px]">لم يتم تنفيذ المقارنة بعد</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- Table B --}}
            <div class="custom-card p-5 rounded-2xl">
                <div class="flex items-center gap-2 mb-3">
                    <div class="w-4 h-4 rounded-full bg-rose-500 flex items-center justify-center text-white text-[8px] font-black">ب</div>
                    <span id="tbl-label-b" class="text-xs font-bold text-rose-600">الجهة (ب) — العمليات التفصيلية</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="custom-table text-xs w-full">
                        <thead><tr><th>ت</th><th>اسم العملية</th><th>التصنيف</th><th class="text-center">العدد</th></tr></thead>
                        <tbody id="cmp-tbl-surgs-b">
                            <tr><td colspan="4" class="text-center text-slate-300 py-6 text-[10px]">لم يتم تنفيذ المقارنة بعد</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- 5. Footer Signature --}}
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

<script>
// ═══════════════════════════════════════════════════
//  COMPARISON PAGE ENGINE
// ═══════════════════════════════════════════════════

const CMP_COLORS_A = ['#3b82f6','#0ea5e9','#06b6d4','#38bdf8','#93c5fd','#bfdbfe'];
const CMP_COLORS_B = ['#f43f5e','#e11d48','#fb7185','#fda4af','#fecdd3','#ffe4e6'];

const CMP_BADGE_CLASSES = {
    'خاصة':       'bg-purple-100 text-purple-700',
    'فوق الكبرى': 'bg-rose-100 text-rose-700',
    'كبرى':       'bg-orange-100 text-orange-700',
    'وسطى (حقن)': 'bg-blue-100 text-blue-700',
    'وسطى (ليزر)':'bg-blue-100 text-blue-700',
    'وسطى':       'bg-blue-100 text-blue-700',
    'صغرى':       'bg-yellow-100 text-yellow-700',
    'ليزر':       'bg-cyan-100 text-cyan-700',
};

function buildSideLabel(docId, fromDate, toDate) {
    const docSelect = docId
        ? document.getElementById('cmp-doc-a')  // placeholder, resolved below
        : null;
    return `${fromDate} → ${toDate}`;
}

async function runComparison() {
    const docAId    = document.getElementById('cmp-doc-a').value;
    const fromA     = document.getElementById('cmp-from-a').value;
    const toA       = document.getElementById('cmp-to-a').value;
    const docBId    = document.getElementById('cmp-doc-b').value;
    const fromB     = document.getElementById('cmp-from-b').value;
    const toB       = document.getElementById('cmp-to-b').value;

    if (!fromA || !toA || !fromB || !toB) {
        showToast('يرجى تحديد تواريخ المقارنة لكلتا الجهتين', 'error');
        return;
    }

    // Build human labels for A & B
    const selectA = document.getElementById('cmp-doc-a');
    const selectB = document.getElementById('cmp-doc-b');
    const docNameA = selectA.options[selectA.selectedIndex].text;
    const docNameB = selectB.options[selectB.selectedIndex].text;
    const labelA = `${docNameA} (${fromA} : ${toA})`;
    const labelB = `${docNameB} (${fromB} : ${toB})`;

    // Show loading
    document.getElementById('cmp-loading').classList.remove('hidden');
    document.getElementById('cmp-results').classList.add('hidden');
    document.getElementById('cmp-run-btn').disabled = true;

    try {
        const params = new URLSearchParams({
            doctor_id_a: docAId,
            start_date_a: fromA,
            end_date_a: toA,
            doctor_id_b: docBId,
            start_date_b: fromB,
            end_date_b: toB,
        });

        const data = await fetch(`/api/comparison-data?${params}`, {
            headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content }
        }).then(r => r.json());

        renderComparisonResults(data, labelA, labelB);
    } catch(e) {
        showToast('فشل جلب البيانات، يرجى المحاولة مجدداً', 'error');
        console.error(e);
    } finally {
        document.getElementById('cmp-loading').classList.add('hidden');
        document.getElementById('cmp-run-btn').disabled = false;
    }
}

function renderComparisonResults(data, labelA, labelB) {
    const A = data.side_a;
    const B = data.side_b;

    // ─── Update labels ───
    document.getElementById('cmp-label-a').textContent  = labelA;
    document.getElementById('cmp-label-b').textContent  = labelB;
    document.getElementById('tbl-label-a').textContent  = `${labelA} — العمليات التفصيلية`;
    document.getElementById('tbl-label-b').textContent  = `${labelB} — العمليات التفصيلية`;

    // ─── KPI Cards ───
    function setKpiDiff(elId, valA, valB) {
        const el = document.getElementById(elId);
        if (!el) return;
        const diff = valA - valB;
        if (diff === 0) {
            el.textContent = 'متساويان';
            el.className = 'text-center text-[10px] font-bold text-slate-400';
        } else if (diff > 0) {
            el.textContent = `الجهة (أ) أعلى بـ ${Math.abs(diff).toLocaleString()}`;
            el.className = 'text-center text-[10px] font-bold text-blue-500';
        } else {
            el.textContent = `الجهة (ب) أعلى بـ ${Math.abs(diff).toLocaleString()}`;
            el.className = 'text-center text-[10px] font-bold text-rose-500';
        }
    }

    document.getElementById('kpi-visits-a').textContent = (A.total_visits || 0).toLocaleString();
    document.getElementById('kpi-visits-b').textContent = (B.total_visits || 0).toLocaleString();
    setKpiDiff('kpi-visits-diff', A.total_visits, B.total_visits);

    document.getElementById('kpi-tests-a').textContent = (A.total_eye_tests || 0).toLocaleString();
    document.getElementById('kpi-tests-b').textContent = (B.total_eye_tests || 0).toLocaleString();
    setKpiDiff('kpi-tests-diff', A.total_eye_tests, B.total_eye_tests);

    document.getElementById('kpi-surgs-a').textContent = (A.total_surgeries || 0).toLocaleString();
    document.getElementById('kpi-surgs-b').textContent = (B.total_surgeries || 0).toLocaleString();
    setKpiDiff('kpi-surgs-diff', A.total_surgeries, B.total_surgeries);

    // ─── Surgeries Detail Charts ───
    const surgsA = A.surgeries_detail || [];
    const surgsB = B.surgeries_detail || [];

    if (surgsA.length > 0) {
        cmpDrawHorizontalChevrons('cmp-svg-surgs-a', surgsA.map(s => s.total), surgsA.map(s => s.op), CMP_COLORS_A);
    } else {
        cmpDrawEmpty('cmp-svg-surgs-a', 'لا توجد عمليات للجهة (أ)');
    }
    if (surgsB.length > 0) {
        cmpDrawHorizontalChevrons('cmp-svg-surgs-b', surgsB.map(s => s.total), surgsB.map(s => s.op), CMP_COLORS_B);
    } else {
        cmpDrawEmpty('cmp-svg-surgs-b', 'لا توجد عمليات للجهة (ب)');
    }

    // ─── Eye Tests Detail Charts ───
    const testsA = A.eye_tests_detail || [];
    const testsB = B.eye_tests_detail || [];

    if (testsA.length > 0) {
        cmpDrawHorizontalChevrons('cmp-svg-tests-a', testsA.map(t => t.total), testsA.map(t => t.type), CMP_COLORS_A);
    } else {
        cmpDrawEmpty('cmp-svg-tests-a', 'لا توجد فحوصات للجهة (أ)');
    }
    if (testsB.length > 0) {
        cmpDrawHorizontalChevrons('cmp-svg-tests-b', testsB.map(t => t.total), testsB.map(t => t.type), CMP_COLORS_B);
    } else {
        cmpDrawEmpty('cmp-svg-tests-b', 'لا توجد فحوصات للجهة (ب)');
    }

    // ─── Surgeries Tables ───
    cmpRenderSurgTable('cmp-tbl-surgs-a', surgsA);
    cmpRenderSurgTable('cmp-tbl-surgs-b', surgsB);

    // ─── Show results ───
    document.getElementById('cmp-results').classList.remove('hidden');

    // Re-init lucide icons (for newly injected icons)
    setTimeout(() => { if (window.lucide) lucide.createIcons(); }, 100);
}

// Reuse the same draw2DFlatHorizontalChevrons engine from reports page
function cmpDrawHorizontalChevrons(svgId, values, labels, colors) {
    const svg = document.getElementById(svgId);
    if (!svg) return;
    svg.innerHTML = '';

    const n = values.length;
    if (n === 0) return;

    const spacing = 42;
    const marginT = 16;
    const marginB = 16;
    const dynamicHeight = marginT + marginB + (n - 1) * spacing + 22;

    svg.setAttribute('viewBox', `0 0 450 ${dynamicHeight}`);
    svg.style.height = `${dynamicHeight}px`;

    const maxVal = Math.max(...values, 1);
    const startX = 435;
    const chartStartX = 10;
    const maxL = startX - chartStartX - 45;

    values.forEach((val, i) => {
        const labelY = marginT + i * spacing;
        const barY = labelY + 16;
        const color = colors[i % colors.length];

        const scaleVal = maxVal > 0 ? val / maxVal : 0;
        const L = 15 + maxL * scaleVal;
        const endX = startX - L;

        const g = document.createElementNS("http://www.w3.org/2000/svg", "g");
        g.setAttribute('class', 'arrow-grp cursor-pointer');

        // Label above bar
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

        // Chevron body
        const body = document.createElementNS("http://www.w3.org/2000/svg", "polygon");
        body.setAttribute('points', `${startX},${barY-6} ${endX+6},${barY-6} ${endX},${barY} ${endX+6},${barY+6} ${startX},${barY+6}`);
        body.setAttribute('fill', color);
        g.appendChild(body);

        // Value pill
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
        g.appendChild(tVal);

        g.style.transitionDelay = `${i * 25}ms`;
        svg.appendChild(g);
        setTimeout(() => g.classList.add('show'), 50);
    });
}

function cmpDrawEmpty(svgId, message) {
    const svg = document.getElementById(svgId);
    if (!svg) return;
    svg.setAttribute('viewBox', '0 0 450 60');
    svg.style.height = '60px';
    svg.innerHTML = `<text x="225" y="35" font-family="Tajawal" font-size="11" font-weight="bold" fill="#94a3b8" text-anchor="middle">${message}</text>`;
}

function cmpRenderSurgTable(tbodyId, surgeries) {
    const tbody = document.getElementById(tbodyId);
    if (!tbody) return;
    if (!surgeries || surgeries.length === 0) {
        tbody.innerHTML = `<tr><td colspan="4" class="text-center text-slate-300 py-6 text-[10px]">لا توجد عمليات مسجلة في هذه الفترة</td></tr>`;
        return;
    }
    tbody.innerHTML = surgeries.map((op, i) => {
        const cls = CMP_BADGE_CLASSES[op.classification] || 'bg-slate-100 text-slate-600';
        return `<tr class="table-row">
            <td class="w-8 text-center">${i + 1}</td>
            <td>${op.op}</td>
            <td><span class="text-[9px] font-bold px-2 py-0.5 rounded-full ${cls}">${op.classification}</span></td>
            <td class="text-center font-bold text-violet-600 text-xs">${op.total.toLocaleString()}</td>
        </tr>`;
    }).join('');
}

// Page init hook (called by navigateToPage in main_screen)
window.initComparisonPage = function() {
    // Re-init lucide icons when page is shown
    setTimeout(() => { if (window.lucide) lucide.createIcons(); }, 100);
};
</script>
