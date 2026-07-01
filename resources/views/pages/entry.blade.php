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
        <button onclick="switchEntryTab('surgery')" id="tab-btn-surgery"
            class="entry-tab-btn py-2 px-5 rounded-xl text-xs font-bold text-text-main flex items-center gap-2 hover-press">
            <i data-lucide="scissors" class="w-4 h-4"></i>
            <span>العمليات الجراحية</span>
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
            <div class="flex flex-wrap items-center justify-between gap-3">
                <h3 class="text-xs font-black text-text-main flex items-center gap-2">
                    <i data-lucide="stethoscope" class="w-4 h-4 text-pink-500"></i>
                    <span>جدول إدخال أعداد مراجعي الأطباء والاستشاريات</span>
                </h3>
                <div class="flex items-center gap-2">
                    <label class="text-[10px] font-bold text-slate-400">تاريخ الإدخال:</label>
                    <input type="date" id="date-visit-doctors" required
                        class="custom-inset border-none focus:outline-none rounded-xl py-1.5 px-3 text-xs font-bold text-text-main custom-date-input">
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
                        <tr class="border-b border-slate-200/10 text-[10px] font-bold text-slate-400">
                            <th class="pb-2">اسم الطبيب الاستشاري</th>
                            <th class="pb-2 text-center bg-blue-500/5 rounded-t-lg">العيون العامة (مدفوع)</th>
                            <th class="pb-2 text-center bg-blue-500/5">العيون العامة (غير مدفوع)</th>
                            <th class="pb-2 text-center bg-purple-500/5 rounded-t-lg">التخصصات الدقيقة (مدفوع)</th>
                            <th class="pb-2 text-center bg-purple-500/5">التخصصات الدقيقة (غير مدفوع)</th>
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
                <div class="flex items-center justify-between">
                    <h3 class="text-xs font-black text-text-main flex items-center gap-2">
                        <i data-lucide="map-pin" class="w-4 h-4 text-emerald-500"></i>
                        <span>مراجعو المحافظات (داخل العراق)</span>
                    </h3>
                    <div class="flex items-center gap-2">
                        <input type="date" id="date-geo-gov" required
                            class="custom-inset border-none focus:outline-none rounded-xl py-1 px-2 text-xs font-bold text-text-main custom-date-input">
                        <button onclick="saveGovsVisits()"
                            class="py-1 px-3 rounded-lg text-[10px] font-bold text-white bg-emerald-500 hover-press">حفظ المحافظات</button>
                    </div>
                </div>
                <div class="overflow-y-auto max-h-[450px]">
                    <table class="w-full text-right border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200/10 text-[9px] font-bold text-slate-400">
                                <th class="pb-1">المحافظة</th>
                                <th class="pb-1">عدد المراجعين</th>
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
                <div class="flex items-center justify-between">
                    <h3 class="text-xs font-black text-text-main flex items-center gap-2">
                        <i data-lucide="globe" class="w-4 h-4 text-sky-500"></i>
                        <span>مراجعو الدول (خارج العراق)</span>
                    </h3>
                    <div class="flex items-center gap-2">
                        <input type="date" id="date-geo-country" required
                            class="custom-inset border-none focus:outline-none rounded-xl py-1 px-2 text-xs font-bold text-text-main custom-date-input">
                        <button onclick="saveCountriesVisits()"
                            class="py-1 px-3 rounded-lg text-[10px] font-bold text-white bg-sky-500 hover-press">حفظ الدول</button>
                    </div>
                </div>
                <div class="overflow-y-auto max-h-[450px]">
                    <table class="w-full text-right border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200/10 text-[9px] font-bold text-slate-400">
                                <th class="pb-1">الدولة</th>
                                <th class="pb-1">عدد المراجعين</th>
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

    {{-- ══════════════════ TAB 3: SURGERIES BY OPERATIONS & DOCTORS ══════════════════ --}}
    <div id="entry-tab-content-surgery" class="entry-tab-panel space-y-6 hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Operations Types Table --}}
            <div class="custom-card p-5 rounded-2xl space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xs font-black text-text-main flex items-center gap-2">
                        <i data-lucide="scissors" class="w-4 h-4 text-purple-500"></i>
                        <span>أعداد العمليات الجراحية المنفذة (حسب النوع)</span>
                    </h3>
                    <div class="flex items-center gap-2">
                        <input type="date" id="date-surg-op" required
                            class="custom-inset border-none focus:outline-none rounded-xl py-1 px-2 text-xs font-bold text-text-main custom-date-input">
                        <button onclick="saveSurgeriesOps()"
                            class="py-1 px-3 rounded-lg text-[10px] font-bold text-white bg-purple-500 hover-press">حفظ العمليات</button>
                    </div>
                </div>
                <div class="overflow-y-auto max-h-[450px]">
                    <table class="w-full text-right border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200/10 text-[9px] font-bold text-slate-400">
                                <th class="pb-1">نوع العملية الجراحية</th>
                                <th class="pb-1">القطاع الافتراضي</th>
                                <th class="pb-1">العدد</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-surg-ops" class="divide-y divide-slate-200/5 text-[10px] font-bold text-text-main">
                            {{-- Populated dynamically --}}
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Doctors Surgeries Table --}}
            <div class="custom-card p-5 rounded-2xl space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xs font-black text-text-main flex items-center gap-2">
                        <i data-lucide="stethoscope" class="w-4 h-4 text-indigo-500"></i>
                        <span>إجمالي العمليات المنفذة لكل طبيب</span>
                    </h3>
                    <div class="flex items-center gap-2">
                        <input type="date" id="date-surg-doc" required
                            class="custom-inset border-none focus:outline-none rounded-xl py-1 px-2 text-xs font-bold text-text-main custom-date-input">
                        <button onclick="saveSurgeriesDocs()"
                            class="py-1 px-3 rounded-lg text-[10px] font-bold text-white bg-indigo-500 hover-press">حفظ الأطباء</button>
                    </div>
                </div>
                <div class="overflow-y-auto max-h-[450px]">
                    <table class="w-full text-right border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200/10 text-[9px] font-bold text-slate-400">
                                <th class="pb-1">الطبيب الاستشاري</th>
                                <th class="pb-1">عدد العمليات الإجمالي</th>
                            </tr>
                        </thead>
                        <tbody id="tbody-surg-docs" class="divide-y divide-slate-200/5 text-[10px] font-bold text-text-main">
                            {{-- Populated dynamically --}}
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {{-- ══════════════════ TAB 4: EYE TESTS & LAB TESTS ══════════════════ --}}
    <div id="entry-tab-content-tests" class="entry-tab-panel space-y-6 hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            {{-- Eye Tests --}}
            <div class="custom-card p-5 rounded-2xl space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xs font-black text-text-main flex items-center gap-2">
                        <i data-lucide="eye" class="w-4 h-4 text-orange-500"></i>
                        <span>الفحوصات البصرية اليومية</span>
                    </h3>
                    <div class="flex items-center gap-2">
                        <input type="date" id="date-tests-eye" required
                            class="custom-inset border-none focus:outline-none rounded-xl py-1 px-2 text-xs font-bold text-text-main custom-date-input">
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
                <div class="flex items-center justify-between">
                    <h3 class="text-xs font-black text-text-main flex items-center gap-2">
                        <i data-lucide="test-tube" class="w-4 h-4 text-purple-500"></i>
                        <span>التحاليل المختبرية اليومية</span>
                    </h3>
                    <div class="flex items-center gap-2">
                        <input type="date" id="date-tests-lab" required
                            class="custom-inset border-none focus:outline-none rounded-xl py-1 px-2 text-xs font-bold text-text-main custom-date-input">
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

// Global Memory
let entryLookups = null;
let lastUsedDate = new Date().toISOString().substring(0, 10);

function setupFormDates() {
    document.getElementById('date-visit-doctors').value = lastUsedDate;
    document.getElementById('date-geo-gov').value = lastUsedDate;
    document.getElementById('date-geo-country').value = lastUsedDate;
    document.getElementById('date-surg-op').value = lastUsedDate;
    document.getElementById('date-surg-doc').value = lastUsedDate;
    document.getElementById('date-tests-eye').value = lastUsedDate;
    document.getElementById('date-tests-lab').value = lastUsedDate;
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
    if (tbodyVisits && doctors.length && units.length) {
        tbodyVisits.innerHTML = '';
        const unitGeneral = units.find(u => u.name.includes('العامة')) || units[0];
        const unitSpecial = units.find(u => u.name.includes('التخصصات')) || units[1] || units[0];

        doctors.forEach(doc => {
            tbodyVisits.innerHTML += `
                <tr class="table-row" data-doctor-id="${doc.id}">
                    <td class="font-bold py-3">${doc.name}</td>
                    <td class="bg-blue-500/5 text-center">
                        <input type="number" min="0" value="0" data-unit-id="${unitGeneral ? unitGeneral.id : 1}" data-status="مدفوع"
                            class="w-16 text-center custom-inset border-none focus:outline-none rounded-lg py-1 px-1.5 text-xs font-bold text-text-main">
                    </td>
                    <td class="bg-blue-500/5 text-center">
                        <input type="number" min="0" value="0" data-unit-id="${unitGeneral ? unitGeneral.id : 1}" data-status="غير مدفوع"
                            class="w-16 text-center custom-inset border-none focus:outline-none rounded-lg py-1 px-1.5 text-xs font-bold text-text-main">
                    </td>
                    <td class="bg-purple-500/5 text-center">
                        <input type="number" min="0" value="0" data-unit-id="${unitSpecial ? unitSpecial.id : 2}" data-status="مدفوع"
                            class="w-16 text-center custom-inset border-none focus:outline-none rounded-lg py-1 px-1.5 text-xs font-bold text-text-main">
                    </td>
                    <td class="bg-purple-500/5 text-center">
                        <input type="number" min="0" value="0" data-unit-id="${unitSpecial ? unitSpecial.id : 2}" data-status="غير مدفوع"
                            class="w-16 text-center custom-inset border-none focus:outline-none rounded-lg py-1 px-1.5 text-xs font-bold text-text-main">
                    </td>
                </tr>
            `;
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
    if (tbodySurgOps && operationNames.length && sectors.length) {
        tbodySurgOps.innerHTML = '';
        const sectorGov = sectors.find(s => s.name.includes('حكومي')) || sectors[0];
        const sectorOptions = sectors.map(s => `<option value="${s.id}" ${sectorGov && sectorGov.id === s.id ? 'selected' : ''}>${s.name}</option>`).join('');

        operationNames.forEach(o => {
            tbodySurgOps.innerHTML += `
                <tr class="table-row" data-op-id="${o.id}">
                    <td class="py-2 font-bold">${o.name} <span class="text-[9px] text-slate-400 font-normal">(${o.classification})</span></td>
                    <td>
                        <select class="custom-inset border-none focus:outline-none rounded-lg py-1 px-1.5 text-[10px] font-bold text-text-main font-['Tajawal']">
                            ${sectorOptions}
                        </select>
                    </td>
                    <td>
                        <input type="number" min="0" value="0"
                            class="w-20 text-center custom-inset border-none focus:outline-none rounded-lg py-1 px-2 text-xs font-bold text-text-main">
                    </td>
                </tr>
            `;
        });
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

// ── SAVE BULK ACTIONS ──

// 1. Save Doctors Visits
async function saveVisitsDoctors() {
    const date = document.getElementById('date-visit-doctors').value;
    if (!date) { showToast('حدد تاريخ مراجعين الأطباء', 'error'); return; }

    const promises = [];
    const rows = document.querySelectorAll('#tbody-visits-doctors tr');

    rows.forEach(tr => {
        const docId = tr.getAttribute('data-doctor-id');
        const inputs = tr.querySelectorAll('input[type="number"]');

        inputs.forEach(input => {
            const count = parseInt(input.value) || 0;
            if (count > 0) {
                const unitId = input.getAttribute('data-unit-id');
                const status = input.getAttribute('data-status');

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
                            status: status,
                            visit_date: date,
                            quantity: count
                        })
                    })
                );
            }
        });
    });

    if (promises.length === 0) { showToast('لا توجد أعداد مدخلة لحفظها', 'error'); return; }

    showToast('جاري حفظ أعداد الأطباء...', 'info');
    try {
        const results = await Promise.all(promises);
        if (results.every(r => r.ok)) {
            showToast('تم حفظ مراجعين الأطباء الإحصائية بنجاح', 'success');
            lastUsedDate = date;
            loadEntryLookups();
        } else {
            showToast('فشل حفظ بعض القيود', 'error');
        }
    } catch(e) {
        showToast('خطأ في الاتصال بالشبكة', 'error');
    }
}

// 2. Save Governorates Visits
async function saveGovsVisits() {
    const date = document.getElementById('date-geo-gov').value;
    if (!date) { showToast('حدد التاريخ', 'error'); return; }

    const promises = [];
    const rows = document.querySelectorAll('#tbody-geo-govs tr');
    
    // We bind default doctor & unit to bypass constraints
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

    if (promises.length === 0) { showToast('لا توجد أعداد مدخلة لحفظها', 'error'); return; }

    showToast('جاري حفظ أعداد المحافظات...', 'info');
    try {
        const results = await Promise.all(promises);
        if (results.every(r => r.ok)) {
            showToast('تم حفظ أعداد مراجعي المحافظات بنجاح', 'success');
            lastUsedDate = date;
            loadEntryLookups();
        }
    } catch(e) {
        showToast('خطأ في الاتصال بالشبكة', 'error');
    }
}

// 3. Save Countries Visits
async function saveCountriesVisits() {
    const date = document.getElementById('date-geo-country').value;
    if (!date) { showToast('حدد التاريخ', 'error'); return; }

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

    if (promises.length === 0) { showToast('لا توجد أعداد مدخلة لحفظها', 'error'); return; }

    showToast('جاري حفظ أعداد الدول...', 'info');
    try {
        const results = await Promise.all(promises);
        if (results.every(r => r.ok)) {
            showToast('تم حفظ أعداد مراجعي الدول بنجاح', 'success');
            lastUsedDate = date;
            loadEntryLookups();
        }
    } catch(e) {
        showToast('خطأ في الاتصال بالشبكة', 'error');
    }
}

// 4. Save Surgeries by Operation Names
async function saveSurgeriesOps() {
    const date = document.getElementById('date-surg-op').value;
    if (!date) { showToast('حدد التاريخ', 'error'); return; }

    const promises = [];
    const rows = document.querySelectorAll('#tbody-surg-ops tr');

    const defaultDoc = entryLookups?.doctors[0]?.id || 1;

    rows.forEach(tr => {
        const opId = tr.getAttribute('data-op-id');
        const sectorId = tr.querySelector('select').value;
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

    if (promises.length === 0) { showToast('لا توجد أعداد مدخلة لحفظها', 'error'); return; }

    showToast('جاري حفظ أعداد العمليات...', 'info');
    try {
        const results = await Promise.all(promises);
        if (results.every(r => r.ok)) {
            showToast('تم حفظ أعداد العمليات بنجاح', 'success');
            lastUsedDate = date;
            loadEntryLookups();
        }
    } catch(e) {
        showToast('خطأ في الاتصال بالشبكة', 'error');
    }
}

// 5. Save Surgeries by Doctors
async function saveSurgeriesDocs() {
    const date = document.getElementById('date-surg-doc').value;
    if (!date) { showToast('حدد التاريخ', 'error'); return; }

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

    if (promises.length === 0) { showToast('لا توجد أعداد مدخلة لحفظها', 'error'); return; }

    showToast('جاري الحفظ...', 'info');
    try {
        const results = await Promise.all(promises);
        if (results.every(r => r.ok)) {
            showToast('تم حفظ إجمالي العمليات للأطباء بنجاح', 'success');
            lastUsedDate = date;
            loadEntryLookups();
        }
    } catch(e) {
        showToast('خطأ في الاتصال بالشبكة', 'error');
    }
}

// 6. Save Eye Tests
async function saveEyeTestsGrid() {
    const date = document.getElementById('date-tests-eye').value;
    if (!date) { showToast('حدد التاريخ', 'error'); return; }

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

    if (promises.length === 0) { showToast('لا توجد أعداد مدخلة لحفظها', 'error'); return; }

    showToast('جاري حفظ الفحوصات...', 'info');
    try {
        const results = await Promise.all(promises);
        if (results.every(r => r.ok)) {
            showToast('تم حفظ الفحوصات البصرية بنجاح', 'success');
            lastUsedDate = date;
            loadEntryLookups();
        }
    } catch(e) {
        showToast('خطأ بالشبكة', 'error');
    }
}

// 7. Save Lab Tests
async function saveLabTestsGrid() {
    const date = document.getElementById('date-tests-lab').value;
    if (!date) { showToast('حدد التاريخ', 'error'); return; }

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

    if (promises.length === 0) { showToast('لا توجد أعداد مدخلة لحفظها', 'error'); return; }

    showToast('جاري حفظ التحاليل...', 'info');
    try {
        const results = await Promise.all(promises);
        if (results.every(r => r.ok)) {
            showToast('تم حفظ التحاليل المختبرية بنجاح', 'success');
            lastUsedDate = date;
            loadEntryLookups();
        }
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
