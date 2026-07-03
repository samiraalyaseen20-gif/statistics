{{-- PAGE: DATA ENTRY (إدخال البيانات) --}}
<section id="page-entry" class="page-section space-y-6 hidden">

    {{-- ══ Tabs Header ══ --}}
    <div class="custom-card p-3 rounded-2xl flex flex-wrap gap-2 justify-center sm:justify-start">
        <button onclick="switchEntryTab('visit')" id="tab-btn-visit"
            class="entry-tab-btn py-2 px-5 rounded-xl text-xs font-bold text-text-main flex items-center gap-2 hover-press active text-pink-500 bg-slate-200/10">
            <i data-lucide="stethoscope" class="w-4 h-4"></i>
            <span>إحصائيات الأطباء</span>
        </button>
        <button onclick="switchEntryTab('geo')" id="tab-btn-geo"
            class="entry-tab-btn py-2 px-5 rounded-xl text-xs font-bold text-text-main flex items-center gap-2 hover-press">
            <i data-lucide="map" class="w-4 h-4"></i>
            <span>المحافظات والدول</span>
        </button>
        <button onclick="switchEntryTab('surgery-ops')" id="tab-btn-surgery-ops"
            class="entry-tab-btn py-2 px-5 rounded-xl text-xs font-bold text-text-main flex items-center gap-2 hover-press">
            <i data-lucide="scissors" class="w-4 h-4"></i>
            <span>أعداد العمليات (النوع)</span>
        </button>
        <button onclick="switchEntryTab('surgery-docs')" id="tab-btn-surgery-docs"
            class="entry-tab-btn py-2 px-5 rounded-xl text-xs font-bold text-text-main flex items-center gap-2 hover-press">
            <i data-lucide="user-check" class="w-4 h-4"></i>
            <span>عمليات الأطباء</span>
        </button>
        <button onclick="switchEntryTab('tests')" id="tab-btn-tests"
            class="entry-tab-btn py-2 px-5 rounded-xl text-xs font-bold text-text-main flex items-center gap-2 hover-press">
            <i data-lucide="beaker" class="w-4 h-4"></i>
            <span>الفحوصات والتحاليل</span>
        </button>
    </div>

    {{-- ══════════════════ TAB 1: VISITS BY DOCTORS ══════════════════ --}}
    <div id="entry-tab-content-visit" class="entry-tab-panel space-y-6">
        <div class="custom-card p-5 rounded-2xl space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <h3 class="text-xs font-black text-text-main flex items-center gap-2">
                    <i data-lucide="stethoscope" class="w-4 h-4 text-pink-500"></i>
                    <span>جدول إدخال أعداد مرضى الأطباء والاستشاريات</span>
                </h3>
                <div class="flex flex-wrap items-center gap-2">
                    <label class="text-[9px] font-bold text-slate-400">الشهر والسنّة:</label>
                    <input type="month" id="date-visit-doctors" required
                        class="custom-inset border-none focus:outline-none rounded-xl py-1.5 px-2 text-xs font-bold text-text-main custom-date-input">
                    <button onclick="toggleEditVisitsDoctors()" id="btn-edit-visits-doctors"
                        class="py-1.5 px-3 rounded-xl text-xs font-bold text-teal-600 bg-teal-50 border border-teal-200 hover-press flex items-center gap-1.5">
                        <i data-lucide="edit" class="w-3.5 h-3.5"></i>
                        <span>تعديل</span>
                    </button>
                    <button onclick="saveVisitsDoctors()"
                        class="py-1.5 px-4 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-pink-500 to-rose-500 hover-press flex items-center gap-1.5 shadow-md">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        <span>حفظ الكل</span>
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr id="thead-visits-doctors" class="border-b border-slate-200/10 text-[10px] font-bold text-slate-400">
                            <th class="pb-2">اسم الطبيب الاستشاري</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-visits-doctors" class="divide-y divide-slate-200/5 text-[11px] font-bold text-text-main">
                        {{-- Populated dynamically --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ══════════════════ TAB 2: GEOGRAPHY (GOVS & COUNTRIES) ══════════════════ --}}
    <div id="entry-tab-content-geo" class="entry-tab-panel space-y-6 hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            
            {{-- Governorates Table --}}
            <div class="custom-card p-5 rounded-2xl space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <h3 class="text-xs font-black text-text-main flex items-center gap-2">
                        <i data-lucide="map-pin" class="w-4 h-4 text-emerald-500"></i>
                        <span>مرضى المحافظات (داخل العراق)</span>
                    </h3>
                    <div class="flex flex-wrap items-center gap-2">
                        <label class="text-[9px] font-bold text-slate-400">الشهر والسنّة:</label>
                        <input type="month" id="date-geo-gov" required
                            class="custom-inset border-none focus:outline-none rounded-xl py-1 px-2 text-xs font-bold text-text-main custom-date-input">
                        <button onclick="toggleEditGovsVisits()" id="btn-edit-geo-gov"
                            class="py-1 px-2.5 rounded-lg text-[10px] font-bold text-teal-600 bg-teal-50 border border-teal-200 hover-press">تعديل</button>
                        <button onclick="saveGovsVisits()"
                            class="py-1 px-3 rounded-lg text-[10px] font-bold text-white bg-emerald-500 hover-press">حفظ المحافظات</button>
                    </div>
                </div>
                <div class="overflow-y-auto max-h-[450px]">
                    <table class="w-full text-right border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200/10 text-[9px] font-bold text-slate-400">
                                <th class="pb-1">المحافظة</th>
                                <th class="pb-1">عدد المرضى</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-geo-govs" class="divide-y divide-slate-200/5 text-[10px] font-bold text-text-main">
                            {{-- Populated dynamically --}}
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Countries Table --}}
            <div class="custom-card p-5 rounded-2xl space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <h3 class="text-xs font-black text-text-main flex items-center gap-2">
                        <i data-lucide="globe" class="w-4 h-4 text-sky-500"></i>
                        <span>مرضى الدول (خارج العراق)</span>
                    </h3>
                    <div class="flex flex-wrap items-center gap-2">
                        <label class="text-[9px] font-bold text-slate-400">الشهر والسنّة:</label>
                        <input type="month" id="date-geo-country" required
                            class="custom-inset border-none focus:outline-none rounded-xl py-1 px-2 text-xs font-bold text-text-main custom-date-input">
                        <button onclick="toggleEditCountriesVisits()" id="btn-edit-geo-country"
                            class="py-1 px-2.5 rounded-lg text-[10px] font-bold text-teal-600 bg-teal-50 border border-teal-200 hover-press">تعديل</button>
                        <button onclick="saveCountriesVisits()"
                            class="py-1 px-3 rounded-lg text-[10px] font-bold text-white bg-sky-500 hover-press">حفظ الدول</button>
                    </div>
                </div>
                <div class="overflow-y-auto max-h-[450px]">
                    <table class="w-full text-right border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200/10 text-[9px] font-bold text-slate-400">
                                <th class="pb-1">الدولة</th>
                                <th class="pb-1">عدد المرضى</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-geo-countries" class="divide-y divide-slate-200/5 text-[10px] font-bold text-text-main">
                            {{-- Populated dynamically --}}
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {{-- ══════════════════ TAB 3: SURGERIES BY OPERATIONS TYPES ══════════════════ --}}
    <div id="entry-tab-content-surgery-ops" class="entry-tab-panel space-y-6 hidden">
        <div class="custom-card p-6 rounded-2xl space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-slate-100/5 pb-4">
                <div>
                    <h3 class="text-sm font-black text-text-main flex items-center gap-2">
                        <i data-lucide="scissors" class="w-5 h-5 text-purple-500"></i>
                        <span class="text-sky-500 font-extrabold text-base">اعداد العمليات الشهرية الكلية</span>
                    </h3>
                    <p class="text-[10px] text-slate-400 mt-1 font-bold">يرجى إدخال أعداد العمليات الجراحية المنفذة لكل نوع للشهر المحدد</p>
                </div>
                <div class="flex flex-wrap items-center gap-2">
                    <label class="text-[10px] font-bold text-slate-400">الشهر والسنّة:</label>
                    <input type="month" id="date-surg-op" required
                        class="custom-inset border-none focus:outline-none rounded-xl py-1.5 px-3 text-xs font-bold text-text-main custom-date-input">
                    <button onclick="toggleEditSurgeriesOps()" id="btn-edit-surg-op"
                        class="py-1.5 px-3 rounded-lg text-xs font-bold text-teal-600 bg-teal-50 border border-teal-200 hover-press">تعديل</button>
                    <button onclick="saveSurgeriesOps()"
                        class="py-1.5 px-4 rounded-lg text-xs font-bold text-white bg-gradient-to-r from-purple-500 to-indigo-500 hover-press shadow-md shadow-indigo-500/10">حفظ العمليات</button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200/10 text-xs font-bold text-slate-400">
                            <th class="pb-2 text-center w-12">ت</th>
                            <th class="pb-2">اسم العملية</th>
                            <th class="pb-2 text-center w-32">تصنيف العملية</th>
                            <th class="pb-2 text-center w-36">عددها</th>
                            <th class="pb-2 text-center w-32">النسبة المئوية</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-surg-ops" class="divide-y divide-slate-200/5 text-[11px] font-bold text-text-main">
                        {{-- Populated dynamically --}}
                    </tbody>
                    <tfoot>
                        <tr class="border-t border-slate-200/20 bg-slate-100/5 font-extrabold">
                            <td class="py-3 text-center"></td>
                            <td class="py-3 text-rose-500 font-bold text-xs">المجموع</td>
                            <td class="py-3 text-center"></td>
                            <td class="py-3 text-center">
                                <span id="surg-ops-total-qty" class="inline-block px-3 py-1 bg-yellow-400 text-slate-900 rounded-md font-black text-xs min-w-16 text-center">0</span>
                            </td>
                            <td class="py-3 text-center text-rose-600 text-xs font-black">%</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {{-- ══════════════════ TAB 4: SURGERIES BY DOCTORS ══════════════════ --}}
    <div id="entry-tab-content-surgery-docs" class="entry-tab-panel space-y-6 hidden">
        <div class="custom-card p-6 rounded-2xl space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-slate-100/5 pb-4">
                <div>
                    <h3 class="text-sm font-black text-text-main flex items-center gap-2">
                        <i data-lucide="stethoscope" class="w-5 h-5 text-indigo-500"></i>
                        <span>إجمالي العمليات المنفذة لكل طبيب</span>
                    </h3>
                    <p class="text-[10px] text-slate-400 mt-1 font-bold">يرجى إدخال إجمالي أعداد العمليات الجراحية المنفذة لكل طبيب استشاري</p>
                </div>
                <div class="flex flex-wrap items-center gap-2">
                    <label class="text-[10px] font-bold text-slate-400">الشهر والسنّة:</label>
                    <input type="month" id="date-surg-doc" required
                        class="custom-inset border-none focus:outline-none rounded-xl py-1.5 px-3 text-xs font-bold text-text-main custom-date-input">
                    <button onclick="toggleEditSurgeriesDocs()" id="btn-edit-surg-doc"
                        class="py-1.5 px-3 rounded-lg text-xs font-bold text-teal-600 bg-teal-50 border border-teal-200 hover-press">تعديل</button>
                    <button onclick="saveSurgeriesDocs()"
                        class="py-1.5 px-4 rounded-lg text-xs font-bold text-white bg-gradient-to-r from-indigo-500 to-blue-500 hover-press shadow-md shadow-indigo-500/10">حفظ الأطباء</button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200/10 text-xs font-bold text-slate-400">
                            <th class="pb-2">الطبيب الاستشاري</th>
                            <th class="pb-2 text-center w-48">عدد العمليات الإجمالي</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-surg-docs" class="divide-y divide-slate-200/5 text-[11px] font-bold text-text-main">
                        {{-- Populated dynamically --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ══════════════════ TAB 4: EYE TESTS & LAB TESTS ══════════════════ --}}
    <div id="entry-tab-content-tests" class="entry-tab-panel space-y-6 hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Eye Tests --}}
            <div class="custom-card p-5 rounded-2xl space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <h3 class="text-xs font-black text-text-main flex items-center gap-2">
                        <i data-lucide="eye" class="w-4 h-4 text-orange-500"></i>
                        <span>الفحوصات البصرية اليومية</span>
                    </h3>
                    <div class="flex flex-wrap items-center gap-2">
                        <label class="text-[9px] font-bold text-slate-400">الشهر والسنّة:</label>
                        <input type="month" id="date-tests-eye" required
                            class="custom-inset border-none focus:outline-none rounded-xl py-1 px-2 text-xs font-bold text-text-main custom-date-input">
                        <button onclick="toggleEditEyeTests()" id="btn-edit-tests-eye"
                            class="py-1 px-2.5 rounded-lg text-[10px] font-bold text-teal-600 bg-teal-50 border border-teal-200 hover-press">تعديل</button>
                        <button onclick="saveEyeTestsGrid()"
                            class="py-1 px-3 rounded-lg text-[10px] font-bold text-white bg-orange-500 hover-press">حفظ الفحوصات</button>
                    </div>
                </div>
                <div class="overflow-y-auto max-h-[450px]">
                    <table class="w-full text-right border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200/10 text-[9px] font-bold text-slate-400">
                                <th class="pb-1">نوع الفحص البصري</th>
                                <th class="pb-1">عدد الفحوصات المنجزة</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-tests-eye" class="divide-y divide-slate-200/5 text-[10px] font-bold text-text-main">
                            {{-- Populated dynamically --}}
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Lab Tests --}}
            <div class="custom-card p-5 rounded-2xl space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <h3 class="text-xs font-black text-text-main flex items-center gap-2">
                        <i data-lucide="test-tube" class="w-4 h-4 text-purple-500"></i>
                        <span>التحاليل المختبرية اليومية</span>
                    </h3>
                    <div class="flex flex-wrap items-center gap-2">
                        <label class="text-[9px] font-bold text-slate-400">الشهر والسنّة:</label>
                        <input type="month" id="date-tests-lab" required
                            class="custom-inset border-none focus:outline-none rounded-xl py-1 px-2 text-xs font-bold text-text-main custom-date-input">
                        <button onclick="toggleEditLabTests()" id="btn-edit-tests-lab"
                            class="py-1 px-2.5 rounded-lg text-[10px] font-bold text-teal-600 bg-teal-50 border border-teal-200 hover-press">تعديل</button>
                        <button onclick="saveLabTestsGrid()"
                            class="py-1 px-3 rounded-lg text-[10px] font-bold text-white bg-purple-500 hover-press">حفظ التحاليل</button>
                    </div>
                </div>
                <div class="overflow-y-auto max-h-[450px]">
                    <table class="w-full text-right border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200/10 text-[9px] font-bold text-slate-400">
                                <th class="pb-1">نوع التحليل المختبري</th>
                                <th class="pb-1">عدد التحاليل المنجزة</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-tests-lab" class="divide-y divide-slate-200/5 text-[10px] font-bold text-text-main">
                            {{-- Populated dynamically --}}
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</section>

<script>
const surgeryTypeOrder = [1, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 25, 13, 27, 14, 15, 16, 17, 23, 18, 19, 24, 26];

function updateSurgOpsPercentages() {
    const tbody = document.getElementById('tbody-surg-ops');
    if (!tbody) return;
    const rows = tbody.querySelectorAll('tr.table-row');
    let totalQty = 0;
    
    rows.forEach(tr => {
        const input = tr.querySelector('input[type="number"]');
        if (input) {
            totalQty += parseInt(input.value) || 0;
        }
    });
    
    const totalSpan = document.getElementById('surg-ops-total-qty');
    if (totalSpan) {
        totalSpan.textContent = totalQty;
    }
    
    rows.forEach(tr => {
        const input = tr.querySelector('input[type="number"]');
        const pctSpan = tr.querySelector('.row-percentage');
        if (input && pctSpan) {
            const qty = parseInt(input.value) || 0;
            if (totalQty > 0) {
                const pct = ((qty / totalQty) * 100).toFixed(2);
                pctSpan.textContent = pct + '%';
            } else {
                pctSpan.textContent = '0.00%';
            }
        }
    });
}

// Tab Swapping
function switchEntryTab(tabName) {
    document.querySelectorAll('.entry-tab-panel').forEach(p => p.classList.add('hidden'));
    document.querySelectorAll('.entry-tab-btn').forEach(b => {
        b.classList.remove('text-pink-500', 'bg-slate-200/10');
    });

    const activePanel = document.getElementById('entry-tab-content-' + tabName);
    if (activePanel) activePanel.classList.remove('hidden');

    const activeBtn = document.getElementById('tab-btn-' + tabName);
    if (activeBtn) {
        const theme = document.body.getAttribute('data-theme') || 'soft';
        if (theme === 'soft' || theme === 'glass') {
            activeBtn.classList.add('text-pink-500', 'bg-slate-200/10');
        } else {
            activeBtn.classList.add('bg-slate-200/10');
        }
    }
}

// Global Memory (Year-Month format: YYYY-MM)
let entryLookups = null;
let lastUsedDate = new Date().toISOString().substring(0, 7);

function syncAllFromDates(value) {
    lastUsedDate = value;
    const ids = [
        'date-visit-doctors',
        'date-geo-gov',
        'date-geo-country',
        'date-surg-op',
        'date-surg-doc',
        'date-tests-eye',
        'date-tests-lab'
    ];
    ids.forEach(id => {
        const el = document.getElementById(id);
        if (el && el.value !== value) {
            el.value = value;
        }
    });
}

function setupFormDates() {
    const fromIds = [
        'date-visit-doctors',
        'date-geo-gov',
        'date-geo-country',
        'date-surg-op',
        'date-surg-doc',
        'date-tests-eye',
        'date-tests-lab'
    ];
    fromIds.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.value = lastUsedDate;
            if (!el.dataset.listenerAttached) {
                el.addEventListener('change', (e) => syncAllFromDates(e.target.value));
                el.dataset.listenerAttached = 'true';
            }
        }
    });
}

// Load lookups & build grids
async function loadEntryLookups() {
    try {
        const response = await fetch('/api/form-data');
        entryLookups = await response.json();
        populateDirectGrids();
    } catch (e) {
        console.error("Failed to load lookups", e);
    }
}

function populateDirectGrids() {
    if (!entryLookups) return;

    const govs = entryLookups.governorates || [];
    const countries = entryLookups.countries || [];
    const doctors = entryLookups.doctors || [];
    const units = entryLookups.clinicUnits || entryLookups.clinic_units || [];
    const testTypes = entryLookups.testTypes || entryLookups.test_types || [];
    const labTestTypes = entryLookups.labTestTypes || entryLookups.lab_test_types || [];
    const sectors = entryLookups.sectors || [];
    const operationNames = entryLookups.operationNames || entryLookups.operation_names || [];

    // 1. Visits Doctors Table
    const tbodyVisits = document.getElementById('tbody-visits-doctors');
    const theadVisits = document.getElementById('thead-visits-doctors');
    if (tbodyVisits && theadVisits && doctors.length && units.length) {
        theadVisits.innerHTML = '<th class="pb-2">اسم الطبيب الاستشاري</th>';
        const bgColors = ['bg-blue-500/5', 'bg-purple-500/5', 'bg-emerald-500/5', 'bg-amber-500/5', 'bg-rose-500/5', 'bg-sky-500/5'];
        units.forEach((unit, idx) => {
            const bgClass = bgColors[idx % bgColors.length];
            theadVisits.innerHTML += `<th class="pb-2 text-center ${bgClass} rounded-t-lg">${unit.name}</th>`;
        });

        tbodyVisits.innerHTML = '';
        doctors.forEach(doc => {
            let cells = `<td class="font-bold py-3">${doc.name}</td>`;
            units.forEach((unit, idx) => {
                const bgClass = bgColors[idx % bgColors.length];
                cells += `
                    <td class="${bgClass} text-center">
                        <input type="number" min="0" value="0"
                            data-unit-id="${unit.id}"
                            class="w-20 text-center custom-inset border-none focus:outline-none rounded-lg py-1 px-1.5 text-xs font-bold text-text-main">
                    </td>
                `;
            });
            tbodyVisits.innerHTML += `<tr class="table-row" data-doctor-id="${doc.id}">${cells}</tr>`;
        });
    }

    // 2. Govs Table
    const tbodyGovs = document.getElementById('tbody-geo-govs');
    if (tbodyGovs && govs.length) {
        tbodyGovs.innerHTML = '';
        govs.forEach(g => {
            tbodyGovs.innerHTML += `
                <tr class="table-row" data-gov-id="${g.id}">
                    <td class="py-2 font-bold">${g.name}</td>
                    <td>
                        <input type="number" min="0" value="0"
                            class="w-20 text-center custom-inset border-none focus:outline-none rounded-lg py-1 px-2 text-xs font-bold text-text-main">
                    </td>
                </tr>
            `;
        });
    }

    // 3. Countries Table
    const tbodyCountries = document.getElementById('tbody-geo-countries');
    if (tbodyCountries && countries.length) {
        tbodyCountries.innerHTML = '';
        countries.forEach(c => {
            tbodyCountries.innerHTML += `
                <tr class="table-row" data-country-id="${c.id}">
                    <td class="py-2 font-bold">${c.name}</td>
                    <td>
                        <input type="number" min="0" value="0"
                            class="w-20 text-center custom-inset border-none focus:outline-none rounded-lg py-1 px-2 text-xs font-bold text-text-main">
                    </td>
                </tr>
            `;
        });
    }

    // 4. Surgery Operations Table
    const tbodySurgOps = document.getElementById('tbody-surg-ops');
    if (tbodySurgOps && sectors.length) {
        tbodySurgOps.innerHTML = '';
        const dbOps = entryLookups.operationNames || entryLookups.operation_names || [];
        
        surgeryTypeOrder.forEach((opId, index) => {
            const dbOp = dbOps.find(o => o.id === opId);
            if (dbOp) {
                tbodySurgOps.innerHTML += `
                    <tr class="table-row" data-op-id="${dbOp.id}">
                        <td class="py-2.5 text-center text-slate-400 font-bold">${index + 1}</td>
                        <td class="py-2.5 font-bold">${dbOp.name}</td>
                        <td class="py-2.5 text-center text-slate-400 font-medium">${dbOp.classification}</td>
                        <td class="py-2.5 text-center flex justify-center">
                            <input type="number" min="0" value="0" oninput="updateSurgOpsPercentages()"
                                class="w-24 text-center custom-inset border-none focus:outline-none rounded-lg py-1 px-2 text-xs font-bold text-text-main surg-qty-input">
                        </td>
                        <td class="py-2.5 text-center text-emerald-600 font-bold text-xs row-percentage">0.00%</td>
                    </tr>
                `;
            }
        });
        updateSurgOpsPercentages();
    }

    // 5. Surgery Doctors Table
    const tbodySurgDocs = document.getElementById('tbody-surg-docs');
    if (tbodySurgDocs && doctors.length) {
        tbodySurgDocs.innerHTML = '';
        doctors.forEach(doc => {
            tbodySurgDocs.innerHTML += `
                <tr class="table-row" data-doctor-id="${doc.id}">
                    <td class="py-2 font-bold">${doc.name}</td>
                    <td>
                        <input type="number" min="0" value="0"
                            class="w-20 text-center custom-inset border-none focus:outline-none rounded-lg py-1 px-2 text-xs font-bold text-text-main">
                    </td>
                </tr>
            `;
        });
    }

    // 6. Eye Tests Table
    const tbodyTestsEye = document.getElementById('tbody-tests-eye');
    if (tbodyTestsEye && testTypes.length) {
        tbodyTestsEye.innerHTML = '';
        testTypes.forEach(t => {
            tbodyTestsEye.innerHTML += `
                <tr class="table-row" data-test-type-id="${t.id}">
                    <td class="py-2 font-bold">${t.name}</td>
                    <td>
                        <input type="number" min="0" value="0"
                            class="w-20 text-center custom-inset border-none focus:outline-none rounded-lg py-1 px-2 text-xs font-bold text-text-main">
                    </td>
                </tr>
            `;
        });
    }

    // 7. Lab Tests Table
    const tbodyTestsLab = document.getElementById('tbody-tests-lab');
    if (tbodyTestsLab && labTestTypes.length) {
        tbodyTestsLab.innerHTML = '';
        labTestTypes.forEach(t => {
            tbodyTestsLab.innerHTML += `
                <tr class="table-row" data-lab-test-type-id="${t.id}">
                    <td class="py-2 font-bold">${t.name}</td>
                    <td>
                        <input type="number" min="0" value="0"
                            class="w-20 text-center custom-inset border-none focus:outline-none rounded-lg py-1 px-2 text-xs font-bold text-text-main">
                    </td>
                </tr>
            `;
        });
    }
}

// ── EDIT MODES STATE ──
const editStates = {
    visits_doctors: { active: false, date: '' },
    visits_govs: { active: false, date: '' },
    visits_countries: { active: false, date: '' },
    surgeries_ops: { active: false, date: '' },
    surgeries_docs: { active: false, date: '' },
    eye_tests: { active: false, date: '' },
    lab_tests: { active: false, date: '' }
};

function setEditButtonState(type, active, dateInputId, buttonId) {
    const btn = document.getElementById(buttonId);
    const dateInput = document.getElementById(dateInputId);
    
    if (active) {
        editStates[type].active = true;
        editStates[type].date = dateInput.value;
        btn.innerHTML = '<span>إلغاء التعديل</span>';
        btn.className = "py-1.5 px-3 rounded-xl text-xs font-bold text-rose-600 bg-rose-50 border border-rose-200 hover-press flex items-center gap-1.5";
        if (buttonId !== 'btn-edit-visits-doctors') {
            btn.className = "py-1 px-2.5 rounded-lg text-[10px] font-bold text-rose-600 bg-rose-50 border border-rose-200 hover-press";
        }
    } else {
        editStates[type].active = false;
        editStates[type].date = '';
        btn.innerHTML = '<span>تعديل</span>';
        btn.className = "py-1.5 px-3 rounded-xl text-xs font-bold text-teal-600 bg-teal-50 border border-teal-200 hover-press flex items-center gap-1.5";
        if (buttonId !== 'btn-edit-visits-doctors') {
            btn.className = "py-1 px-2.5 rounded-lg text-[10px] font-bold text-teal-600 bg-teal-50 border border-teal-200 hover-press";
        }
        resetGridInputs(type);
    }
}

function resetGridInputs(type) {
    let selector = '';
    if (type === 'visits_doctors') selector = '#tbody-visits-doctors input';
    else if (type === 'visits_govs') selector = '#tbody-geo-govs input';
    else if (type === 'visits_countries') selector = '#tbody-geo-countries input';
    else if (type === 'surgeries_ops') selector = '#tbody-surg-ops input';
    else if (type === 'surgeries_docs') selector = '#tbody-surg-docs input';
    else if (type === 'eye_tests') selector = '#tbody-tests-eye input';
    else if (type === 'lab_tests') selector = '#tbody-tests-lab input';
    
    document.querySelectorAll(selector).forEach(inp => inp.value = 0);
    
    if (type === 'surgeries_ops') {
        updateSurgOpsPercentages();
    }
}

async function clearDatabaseForEdit(type, date) {
    try {
        const res = await fetch('/api/entry/clear', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                start_date: date,
                end_date: date,
                type: type
            })
        });
        return res.ok;
    } catch(e) {
        console.error(e);
        return false;
    }
}

// ── TOGGLE EDIT FUNCTIONS ──

async function toggleEditVisitsDoctors() {
    const type = 'visits_doctors';
    if (editStates[type].active) {
        setEditButtonState(type, false, 'date-visit-doctors', 'btn-edit-visits-doctors');
        showToast('تم إلغاء وضع التعديل', 'info');
        return;
    }
    const monthVal = document.getElementById('date-visit-doctors').value;
    if (!monthVal) { showToast('يرجى تحديد الشهر أولاً', 'error'); return; }
    const date = monthVal + "-01";
    
    try {
        const res = await fetch('/api/visits?start_date=' + date + '&end_date=' + date + '&per_page=1000&type=visits_doctors');
        const data = await res.json();
        const items = data.data || data;
        
        resetGridInputs(type);
        let found = 0;
        
        items.forEach(v => {
            const tr = document.querySelector('#tbody-visits-doctors tr[data-doctor-id="' + v.doctor_id + '"]');
            if (tr) {
                const inp = tr.querySelector('input[data-unit-id="' + v.clinic_unit_id + '"]');
                if (inp) {
                    inp.value = (parseInt(inp.value) || 0) + 1;
                    found++;
                }
            }
        });
        
        if (found > 0) {
            setEditButtonState(type, true, 'date-visit-doctors', 'btn-edit-visits-doctors');
            showToast('تم تحميل البيانات السابقة بنجاح للتعديل', 'success');
        } else {
            showToast('لا توجد بيانات مسجلة في هذا الشهر', 'warning');
        }
    } catch(e) {
        showToast('فشل جلب البيانات السابقة', 'error');
    }
}

async function toggleEditGovsVisits() {
    const type = 'visits_govs';
    if (editStates[type].active) {
        setEditButtonState(type, false, 'date-geo-gov', 'btn-edit-geo-gov');
        showToast('تم إلغاء وضع التعديل', 'info');
        return;
    }
    const monthVal = document.getElementById('date-geo-gov').value;
    if (!monthVal) { showToast('يرجى تحديد الشهر أولاً', 'error'); return; }
    const date = monthVal + "-01";
    try {
        const res = await fetch('/api/visits?start_date=' + date + '&end_date=' + date + '&per_page=1000&type=visits_govs');
        const data = await res.json();
        const items = data.data || data;
        resetGridInputs(type);
        let found = 0;
        items.forEach(v => {
            if (v.governorate_id) {
                const tr = document.querySelector('#tbody-geo-govs tr[data-gov-id="' + v.governorate_id + '"]');
                if (tr) {
                    const inp = tr.querySelector('input');
                    if (inp) {
                        inp.value = (parseInt(inp.value) || 0) + 1;
                        found++;
                    }
                }
            }
        });
        if (found > 0) {
            setEditButtonState(type, true, 'date-geo-gov', 'btn-edit-geo-gov');
            showToast('تم جلب أعداد المحافظات للتعديل', 'success');
        } else {
            showToast('لا توجد بيانات مسجلة في هذا الشهر', 'warning');
        }
    } catch(e) {
        showToast('فشل جلب البيانات السابقة', 'error');
    }
}

async function toggleEditCountriesVisits() {
    const type = 'visits_countries';
    if (editStates[type].active) {
        setEditButtonState(type, false, 'date-geo-country', 'btn-edit-geo-country');
        showToast('تم إلغاء وضع التعديل', 'info');
        return;
    }
    const monthVal = document.getElementById('date-geo-country').value;
    if (!monthVal) { showToast('يرجى تحديد الشهر أولاً', 'error'); return; }
    const date = monthVal + "-01";
    try {
        const res = await fetch('/api/visits?start_date=' + date + '&end_date=' + date + '&per_page=1000&type=visits_countries');
        const data = await res.json();
        const items = data.data || data;
        resetGridInputs(type);
        let found = 0;
        items.forEach(v => {
            if (v.country_id) {
                const tr = document.querySelector('#tbody-geo-countries tr[data-country-id="' + v.country_id + '"]');
                if (tr) {
                    const inp = tr.querySelector('input');
                    if (inp) {
                        inp.value = (parseInt(inp.value) || 0) + 1;
                        found++;
                    }
                }
            }
        });
        if (found > 0) {
            setEditButtonState(type, true, 'date-geo-country', 'btn-edit-geo-country');
            showToast('تم جلب أعداد الدول للتعديل', 'success');
        } else {
            showToast('لا توجد بيانات مسجلة في هذا الشهر', 'warning');
        }
    } catch(e) {
        showToast('فشل جلب البيانات السابقة', 'error');
    }
}

async function toggleEditSurgeriesOps() {
    const type = 'surgeries_ops';
    if (editStates[type].active) {
        setEditButtonState(type, false, 'date-surg-op', 'btn-edit-surg-op');
        showToast('تم إلغاء وضع التعديل', 'info');
        return;
    }
    const monthVal = document.getElementById('date-surg-op').value;
    if (!monthVal) { showToast('يرجى تحديد الشهر أولاً', 'error'); return; }
    const date = monthVal + "-01";
    try {
        const res = await fetch('/api/surgeries?start_date=' + date + '&end_date=' + date + '&per_page=1000&type=surgeries_ops');
        const data = await res.json();
        const items = data.data || data;
        resetGridInputs(type);
        let found = 0;
        items.forEach(s => {
            const tr = document.querySelector('#tbody-surg-ops tr[data-op-id="' + s.operation_name_id + '"]');
            if (tr) {
                const inp = tr.querySelector('input');
                if (inp) {
                    inp.value = (parseInt(inp.value) || 0) + (s.quantity || 1);
                    found++;
                }
            }
        });
        if (found > 0) {
            updateSurgOpsPercentages();
            setEditButtonState(type, true, 'date-surg-op', 'btn-edit-surg-op');
            showToast('تم جلب أعداد العمليات للتعديل', 'success');
        } else {
            showToast('لا توجد بيانات مسجلة في هذا الشهر', 'warning');
        }
    } catch(e) {
        showToast('فشل جلب البيانات السابقة', 'error');
    }
}

async function toggleEditSurgeriesDocs() {
    const type = 'surgeries_docs';
    if (editStates[type].active) {
        setEditButtonState(type, false, 'date-surg-doc', 'btn-edit-surg-doc');
        showToast('تم إلغاء وضع التعديل', 'info');
        return;
    }
    const monthVal = document.getElementById('date-surg-doc').value;
    if (!monthVal) { showToast('يرجى تحديد الشهر أولاً', 'error'); return; }
    const date = monthVal + "-01";
    try {
        const res = await fetch('/api/surgeries?start_date=' + date + '&end_date=' + date + '&per_page=1000&type=surgeries_docs');
        const data = await res.json();
        const items = data.data || data;
        resetGridInputs(type);
        let found = 0;
        items.forEach(s => {
            const tr = document.querySelector('#tbody-surg-docs tr[data-doctor-id="' + s.doctor_id + '"]');
            if (tr) {
                const inp = tr.querySelector('input');
                if (inp) {
                    inp.value = (parseInt(inp.value) || 0) + 1;
                    found++;
                }
            }
        });
        if (found > 0) {
            setEditButtonState(type, true, 'date-surg-doc', 'btn-edit-surg-doc');
            showToast('تم جلب أعداد العمليات للأطباء للتعديل', 'success');
        } else {
            showToast('لا توجد بيانات مسجلة في هذا الشهر', 'warning');
        }
    } catch(e) {
        showToast('فشل جلب البيانات السابقة', 'error');
    }
}

async function toggleEditEyeTests() {
    const type = 'eye_tests';
    if (editStates[type].active) {
        setEditButtonState(type, false, 'date-tests-eye', 'btn-edit-tests-eye');
        showToast('تم إلغاء وضع التعديل', 'info');
        return;
    }
    const monthVal = document.getElementById('date-tests-eye').value;
    if (!monthVal) { showToast('يرجى تحديد الشهر أولاً', 'error'); return; }
    const date = monthVal + "-01";
    try {
        const res = await fetch('/api/eye-tests?start_date=' + date + '&end_date=' + date + '&per_page=1000');
        const data = await res.json();
        const items = data.data || data;
        resetGridInputs(type);
        let found = 0;
        items.forEach(t => {
            const tr = document.querySelector('#tbody-tests-eye tr[data-test-type-id="' + t.test_type_id + '"]');
            if (tr) {
                const inp = tr.querySelector('input');
                if (inp) {
                    inp.value = (parseInt(inp.value) || 0) + 1;
                    found++;
                }
            }
        });
        if (found > 0) {
            setEditButtonState(type, true, 'date-tests-eye', 'btn-edit-tests-eye');
            showToast('تم جلب أعداد الفحوصات للتعديل', 'success');
        } else {
            showToast('لا توجد بيانات مسجلة في هذا الشهر', 'warning');
        }
    } catch(e) {
        showToast('فشل جلب البيانات السابقة', 'error');
    }
}

async function toggleEditLabTests() {
    const type = 'lab_tests';
    if (editStates[type].active) {
        setEditButtonState(type, false, 'date-tests-lab', 'btn-edit-tests-lab');
        showToast('تم إلغاء وضع التعديل', 'info');
        return;
    }
    const monthVal = document.getElementById('date-tests-lab').value;
    if (!monthVal) { showToast('يرجى تحديد الشهر أولاً', 'error'); return; }
    const date = monthVal + "-01";
    try {
        const res = await fetch('/api/lab-tests?start_date=' + date + '&end_date=' + date + '&per_page=1000');
        const data = await res.json();
        const items = data.data || data;
        resetGridInputs(type);
        let found = 0;
        items.forEach(t => {
            const tr = document.querySelector('#tbody-tests-lab tr[data-lab-test-type-id="' + t.lab_test_type_id + '"]');
            if (tr) {
                const inp = tr.querySelector('input');
                if (inp) {
                    inp.value = (parseInt(inp.value) || 0) + 1;
                    found++;
                }
            }
        });
        if (found > 0) {
            setEditButtonState(type, true, 'date-tests-lab', 'btn-edit-tests-lab');
            showToast('تم جلب أعداد التحاليل للتعديل', 'success');
        } else {
            showToast('لا توجد بيانات مسجلة في هذا الشهر', 'warning');
        }
    } catch(e) {
        showToast('فشل جلب البيانات السابقة', 'error');
    }
}

// ── SAVE BULK ACTIONS ──

// 1. Save Doctors Visits
async function saveVisitsDoctors() {
    const monthVal = document.getElementById('date-visit-doctors').value;
    if (!monthVal) { showToast('حدد الشهر والسنّة', 'error'); return; }
    const date = monthVal + "-01";

    const isEdit = editStates['visits_doctors'].active;
    if (isEdit) {
        showToast('جاري تحديث البيانات القديمة...', 'info');
        const cleared = await clearDatabaseForEdit('visits_doctors', editStates['visits_doctors'].date + "-01");
        if (!cleared) { showToast('فشل تحديث البيانات القديمة', 'error'); return; }
    }

    const promises = [];
    const rows = document.querySelectorAll('#tbody-visits-doctors tr');

    rows.forEach(tr => {
        const docId = tr.getAttribute('data-doctor-id');
        const inputs = tr.querySelectorAll('input[type="number"]');

        inputs.forEach(input => {
            const count = parseInt(input.value) || 0;
            if (count > 0) {
                const unitId = input.getAttribute('data-unit-id');

                promises.push(
                    fetch('/api/visits', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            doctor_id: docId,
                            clinic_unit_id: unitId,
                            visit_date: date,
                            quantity: count
                        })
                    })
                );
            }
        });
    });

    if (promises.length === 0 && !isEdit) { showToast('لا توجد أعداد مدخلة لحفظها', 'error'); return; }

    showToast('جاري حفظ أعداد الأطباء...', 'info');
    try {
        if (promises.length > 0) {
            const results = await Promise.all(promises);
            if (results.every(r => r.ok)) {
                showToast('تم حفظ بيانات الأطباء بنجاح', 'success');
            } else {
                showToast('فشل حفظ بعض القيود', 'error');
            }
        } else {
            showToast('تم تحديث البيانات بنجاح', 'success');
        }
        
        if (isEdit) {
            setEditButtonState('visits_doctors', false, 'date-visit-doctors', 'btn-edit-visits-doctors');
        }
        lastUsedDate = monthVal;
        loadEntryLookups();
    } catch(e) {
        showToast('خطأ في الاتصال بالشبكة', 'error');
    }
}

// 2. Save Governorates Visits
async function saveGovsVisits() {
    const monthVal = document.getElementById('date-geo-gov').value;
    if (!monthVal) { showToast('حدد الشهر والسنّة', 'error'); return; }
    const date = monthVal + "-01";

    const isEdit = editStates['visits_govs'].active;
    if (isEdit) {
        showToast('جاري تحديث البيانات القديمة...', 'info');
        const cleared = await clearDatabaseForEdit('visits_govs', editStates['visits_govs'].date + "-01");
        if (!cleared) { showToast('فشل تحديث البيانات القديمة', 'error'); return; }
    }

    const promises = [];
    const rows = document.querySelectorAll('#tbody-geo-govs tr');
    
    const defaultDoc = entryLookups?.doctors[0]?.id || 1;
    const defaultUnit = entryLookups?.clinicUnits[0]?.id || 1;

    rows.forEach(tr => {
        const govId = tr.getAttribute('data-gov-id');
        const count = parseInt(tr.querySelector('input[type="number"]').value) || 0;

        if (count > 0) {
            promises.push(
                fetch('/api/visits', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        doctor_id: defaultDoc,
                        clinic_unit_id: defaultUnit,
                        governorate_id: govId,
                        status: 'مدفوع',
                        visit_date: date,
                        quantity: count
                    })
                })
            );
        }
    });

    if (promises.length === 0 && !isEdit) { showToast('لا توجد أعداد مدخلة لحفظها', 'error'); return; }

    showToast('جاري حفظ أعداد المحافظات...', 'info');
    try {
        if (promises.length > 0) {
            const results = await Promise.all(promises);
            if (results.every(r => r.ok)) {
                showToast('تم حفظ أعداد مرضى المحافظات بنجاح', 'success');
            } else {
                showToast('فشل حفظ بعض القيود', 'error');
            }
        } else {
            showToast('تم تحديث البيانات بنجاح', 'success');
        }
        
        if (isEdit) {
            setEditButtonState('visits_govs', false, 'date-geo-gov', 'btn-edit-geo-gov');
        }
        lastUsedDate = monthVal;
        loadEntryLookups();
    } catch(e) {
        showToast('خطأ في الاتصال بالشبكة', 'error');
    }
}

// 3. Save Countries Visits
async function saveCountriesVisits() {
    const monthVal = document.getElementById('date-geo-country').value;
    if (!monthVal) { showToast('حدد الشهر والسنّة', 'error'); return; }
    const date = monthVal + "-01";

    const isEdit = editStates['visits_countries'].active;
    if (isEdit) {
        showToast('جاري تحديث البيانات القديمة...', 'info');
        const cleared = await clearDatabaseForEdit('visits_countries', editStates['visits_countries'].date + "-01");
        if (!cleared) { showToast('فشل تحديث البيانات القديمة', 'error'); return; }
    }

    const promises = [];
    const rows = document.querySelectorAll('#tbody-geo-countries tr');

    const defaultDoc = entryLookups?.doctors[0]?.id || 1;
    const defaultUnit = entryLookups?.clinicUnits[0]?.id || 1;

    rows.forEach(tr => {
        const countryId = tr.getAttribute('data-country-id');
        const count = parseInt(tr.querySelector('input[type="number"]').value) || 0;

        if (count > 0) {
            promises.push(
                fetch('/api/visits', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        doctor_id: defaultDoc,
                        clinic_unit_id: defaultUnit,
                        country_id: countryId,
                        status: 'مدفوع',
                        visit_date: date,
                        quantity: count
                    })
                })
            );
        }
    });

    if (promises.length === 0 && !isEdit) { showToast('لا توجد أعداد مدخلة لحفظها', 'error'); return; }

    showToast('جاري حفظ أعداد الدول...', 'info');
    try {
        if (promises.length > 0) {
            const results = await Promise.all(promises);
            if (results.every(r => r.ok)) {
                showToast('تم حفظ أعداد مرضى الدول بنجاح', 'success');
            } else {
                showToast('فشل حفظ بعض القيود', 'error');
            }
        } else {
            showToast('تم تحديث البيانات بنجاح', 'success');
        }
        
        if (isEdit) {
            setEditButtonState('visits_countries', false, 'date-geo-country', 'btn-edit-geo-country');
        }
        lastUsedDate = monthVal;
        loadEntryLookups();
    } catch(e) {
        showToast('خطأ في الاتصال بالشبكة', 'error');
    }
}

// 4. Save Surgeries by Operation Names
async function saveSurgeriesOps() {
    const monthVal = document.getElementById('date-surg-op').value;
    if (!monthVal) { showToast('حدد الشهر والسنّة', 'error'); return; }
    const date = monthVal + "-01";

    const isEdit = editStates['surgeries_ops'].active;
    if (isEdit) {
        showToast('جاري تحديث البيانات القديمة...', 'info');
        const cleared = await clearDatabaseForEdit('surgeries_ops', editStates['surgeries_ops'].date + "-01");
        if (!cleared) { showToast('فشل تحديث البيانات القديمة', 'error'); return; }
    }

    const promises = [];
    const rows = document.querySelectorAll('#tbody-surg-ops tr');

    const defaultDoc = entryLookups?.doctors[0]?.id || 1;
    const sectorGov = entryLookups?.sectors?.find(s => s.name.includes('حكومي')) || entryLookups?.sectors?.[0];
    const sectorId = sectorGov ? sectorGov.id : 1;

    rows.forEach(tr => {
        const opId = tr.getAttribute('data-op-id');
        const count = parseInt(tr.querySelector('input[type="number"]').value) || 0;

        if (count > 0) {
            promises.push(
                fetch('/api/surgeries', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        doctor_id: defaultDoc,
                        operation_name_id: opId,
                        sector_id: sectorId,
                        op_date: date,
                        quantity: count
                    })
                })
            );
        }
    });

    if (promises.length === 0 && !isEdit) { showToast('لا توجد أعداد مدخلة لحفظها', 'error'); return; }

    showToast('جاري حفظ أعداد العمليات...', 'info');
    try {
        if (promises.length > 0) {
            const results = await Promise.all(promises);
            if (results.every(r => r.ok)) {
                showToast('تم حفظ أعداد العمليات بنجاح', 'success');
            } else {
                showToast('فشل حفظ بعض القيود', 'error');
            }
        } else {
            showToast('تم تحديث البيانات بنجاح', 'success');
        }
        
        if (isEdit) {
            setEditButtonState('surgeries_ops', false, 'date-surg-op', 'btn-edit-surg-op');
        }
        lastUsedDate = monthVal;
        loadEntryLookups();
    } catch(e) {
        showToast('خطأ في الاتصال بالشبكة', 'error');
    }
}

// 5. Save Surgeries by Doctors
async function saveSurgeriesDocs() {
    const monthVal = document.getElementById('date-surg-doc').value;
    if (!monthVal) { showToast('حدد الشهر والسنّة', 'error'); return; }
    const date = monthVal + "-01";

    const isEdit = editStates['surgeries_docs'].active;
    if (isEdit) {
        showToast('جاري تحديث البيانات القديمة...', 'info');
        const cleared = await clearDatabaseForEdit('surgeries_docs', editStates['surgeries_docs'].date + "-01");
        if (!cleared) { showToast('فشل تحديث البيانات القديمة', 'error'); return; }
    }

    const promises = [];
    const rows = document.querySelectorAll('#tbody-surg-docs tr');

    const defaultOp = entryLookups?.operationNames[0]?.id || 1;
    const defaultSector = entryLookups?.sectors[0]?.id || 1;

    rows.forEach(tr => {
        const docId = tr.getAttribute('data-doctor-id');
        const count = parseInt(tr.querySelector('input[type="number"]').value) || 0;

        if (count > 0) {
            promises.push(
                fetch('/api/surgeries', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        doctor_id: docId,
                        operation_name_id: defaultOp,
                        sector_id: defaultSector,
                        op_date: date,
                        quantity: count
                    })
                })
            );
        }
    });

    if (promises.length === 0 && !isEdit) { showToast('لا توجد أعداد مدخلة لحفظها', 'error'); return; }

    showToast('جاري الحفظ...', 'info');
    try {
        if (promises.length > 0) {
            const results = await Promise.all(promises);
            if (results.every(r => r.ok)) {
                showToast('تم حفظ إجمالي العمليات للأطباء بنجاح', 'success');
            } else {
                showToast('فشل حفظ بعض القيود', 'error');
            }
        } else {
            showToast('تم تحديث البيانات بنجاح', 'success');
        }
        
        if (isEdit) {
            setEditButtonState('surgeries_docs', false, 'date-surg-doc', 'btn-edit-surg-doc');
        }
        lastUsedDate = monthVal;
        loadEntryLookups();
    } catch(e) {
        showToast('خطأ في الاتصال بالشبكة', 'error');
    }
}

// 6. Save Eye Tests
async function saveEyeTestsGrid() {
    const monthVal = document.getElementById('date-tests-eye').value;
    if (!monthVal) { showToast('حدد الشهر والسنّة', 'error'); return; }
    const date = monthVal + "-01";

    const isEdit = editStates['eye_tests'].active;
    if (isEdit) {
        showToast('جاري تحديث البيانات القديمة...', 'info');
        const cleared = await clearDatabaseForEdit('eye_tests', editStates['eye_tests'].date + "-01");
        if (!cleared) { showToast('فشل تحديث البيانات القديمة', 'error'); return; }
    }

    const promises = [];
    const rows = document.querySelectorAll('#tbody-tests-eye tr');

    rows.forEach(tr => {
        const testTypeId = tr.getAttribute('data-test-type-id');
        const count = parseInt(tr.querySelector('input[type="number"]').value) || 0;

        if (count > 0) {
            promises.push(
                fetch('/api/eye-tests', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        test_type_id: testTypeId,
                        test_date: date,
                        quantity: count
                    })
                })
            );
        }
    });

    if (promises.length === 0 && !isEdit) { showToast('لا توجد أعداد مدخلة لحفظها', 'error'); return; }

    showToast('جاري حفظ الفحوصات...', 'info');
    try {
        if (promises.length > 0) {
            const results = await Promise.all(promises);
            if (results.every(r => r.ok)) {
                showToast('تم حفظ الفحوصات البصرية بنجاح', 'success');
            } else {
                showToast('فشل حفظ بعض القيود', 'error');
            }
        } else {
            showToast('تم تحديث البيانات بنجاح', 'success');
        }
        
        if (isEdit) {
            setEditButtonState('eye_tests', false, 'date-tests-eye', 'btn-edit-tests-eye');
        }
        lastUsedDate = monthVal;
        loadEntryLookups();
    } catch(e) {
        showToast('خطأ بالشبكة', 'error');
    }
}

// 7. Save Lab Tests
async function saveLabTestsGrid() {
    const monthVal = document.getElementById('date-tests-lab').value;
    if (!monthVal) { showToast('حدد الشهر والسنّة', 'error'); return; }
    const date = monthVal + "-01";

    const isEdit = editStates['lab_tests'].active;
    if (isEdit) {
        showToast('جاري تحديث البيانات القديمة...', 'info');
        const cleared = await clearDatabaseForEdit('lab_tests', editStates['lab_tests'].date + "-01");
        if (!cleared) { showToast('فشل تحديث البيانات القديمة', 'error'); return; }
    }

    const promises = [];
    const rows = document.querySelectorAll('#tbody-tests-lab tr');

    rows.forEach(tr => {
        const labTestTypeId = tr.getAttribute('data-lab-test-type-id');
        const count = parseInt(tr.querySelector('input[type="number"]').value) || 0;

        if (count > 0) {
            promises.push(
                fetch('/api/lab-tests', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        lab_test_type_id: labTestTypeId,
                        test_date: date,
                        quantity: count
                    })
                })
            );
        }
    });

    if (promises.length === 0 && !isEdit) { showToast('لا توجد أعداد مدخلة لحفظها', 'error'); return; }

    showToast('جاري حفظ التحاليل...', 'info');
    try {
        if (promises.length > 0) {
            const results = await Promise.all(promises);
            if (results.every(r => r.ok)) {
                showToast('تم حفظ التحاليل المختبرية بنجاح', 'success');
            } else {
                showToast('فشل حفظ بعض القيود', 'error');
            }
        } else {
            showToast('تم تحديث البيانات بنجاح', 'success');
        }
        
        if (isEdit) {
            setEditButtonState('lab_tests', false, 'date-tests-lab', 'btn-edit-tests-lab');
        }
        lastUsedDate = monthVal;
        loadEntryLookups();
    } catch(e) {
        showToast('خطأ بالشبكة', 'error');
    }
}

// Initialize Page Entry Grid hook
window.initEntryPage = function() {
    setupFormDates();
    loadEntryLookups();
}
</script>
