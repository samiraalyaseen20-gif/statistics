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
        <button onclick="switchEntryTab('surgery-cls')" id="tab-btn-surgery-cls"
            class="entry-tab-btn py-2 px-5 rounded-xl text-xs font-bold text-text-main flex items-center gap-2 hover-press">
            <i data-lucide="layout-grid" class="w-4 h-4"></i>
            <span>تصنيف العمليات (القطاعات)</span>
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

    {{-- ══ TAB 1: VISITS BY DOCTORS ══ --}}
    <div id="entry-tab-content-visit" class="entry-tab-panel space-y-6">
        <div class="custom-card p-5 rounded-2xl space-y-4">

            {{-- Header row --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-slate-100/5 pb-4">
                <div>
                    <h3 class="text-sm font-black text-text-main flex items-center gap-2">
                        <i data-lucide="stethoscope" class="w-5 h-5 text-pink-500"></i>
                        <span>جدول إدخال أعداد مرضى الأطباء</span>
                    </h3>
                    <p class="text-[10px] text-slate-400 mt-1 font-bold">يرجى اختيار الاستشارية ثم إدخال عدد مرضى كل طبيب</p>
                </div>
                <div class="flex flex-wrap items-center gap-2">
                    {{-- Clinic Unit Dropdown --}}
                    <div class="flex items-center gap-1.5">
                        <i data-lucide="hospital" class="w-4 h-4 text-indigo-400"></i>
                        <select id="select-visit-unit"
                            onchange="rebuildVisitsDoctorsTable()"
                            class="custom-inset border-none focus:outline-none rounded-xl py-1.5 px-3 text-xs font-bold text-text-main font-['Tajawal'] min-w-52">
                            <option value="">— اختر الاستشارية —</option>
                        </select>
                    </div>
                    {{-- Month --}}
                    <label class="text-[9px] font-bold text-slate-400">الشهر والسنّة:</label>
                    <input type="month" id="date-visit-doctors" required
                        class="custom-inset border-none focus:outline-none rounded-xl py-1.5 px-2 text-xs font-bold text-text-main custom-date-input">
                    {{-- Buttons --}}
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

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="custom-table text-center" style="font-size:11px">
                    <thead>
                        <tr id="thead-visits-doctors">
                            <th class="w-10">ت</th>
                            <th class="text-right pr-2">اسم الطبيب الاستشاري</th>
                            <th class="bg-indigo-400/20" id="thead-unit-name">عدد المرضى</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-visits-doctors" class="text-[11px] font-bold text-text-main">
                        <tr>
                            <td colspan="3" class="py-8 text-slate-400 text-xs">
                                <i data-lucide="mouse-pointer-click" class="w-5 h-5 mx-auto mb-2 text-indigo-400"></i>
                                اختر استشارية من القائمة أعلاه لعرض الأطباء
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="border-t-2 border-slate-300/20" id="tfoot-visits-doctors" style="display:none">
                            <td class="py-3" colspan="2">
                                <span class="text-pink-600 font-extrabold">المجموع الكلي</span>
                            </td>
                            <td class="py-3 bg-indigo-400/20">
                                <span id="visits-docs-grand-total" class="inline-block px-3 py-1 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-lg font-black text-xs min-w-12">0</span>
                            </td>
                        </tr>
                    </tfoot>
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
                <table class="custom-table text-center" style="font-size:11px">
                    <thead>
                        <tr>
                            <th class="w-10">ت</th>
                            <th class="text-right pr-2">اسم العملية</th>
                            <th class="bg-violet-400/20">تصنيف العملية</th>
                            <th class="bg-yellow-400/20 w-32">العدد</th>
                            <th class="bg-emerald-400/20 w-32">النسبة %</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-surg-ops" class="text-[11px] font-bold text-text-main">
                        {{-- Populated dynamically --}}
                    </tbody>
                    <tfoot>
                        <tr class="border-t-2 border-slate-300/20">
                            <td class="py-3"></td>
                            <td class="py-3 text-right pr-2 text-pink-600 font-extrabold text-xs">المجموع الكلي</td>
                            <td class="py-3"></td>
                            <td class="py-3 bg-yellow-400/20">
                                <span id="surg-ops-total-qty" class="inline-block px-3 py-1 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-lg font-black text-xs min-w-16 text-center">0</span>
                            </td>
                            <td class="py-3 bg-emerald-400/20 text-emerald-600 font-black">100%</td>
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
                <table class="custom-table text-center" style="font-size:11px">
                    <thead>
                        <tr>
                            <th class="w-10 text-center">ت</th>
                            <th class="text-right pr-2">الطبيب الاستشاري</th>
                            <th class="bg-yellow-400/20">صغرى</th>
                            <th class="bg-blue-400/20">وسطى</th>
                            <th class="bg-orange-400/20">كبرى</th>
                            <th class="bg-rose-400/20">فوق الكبرى</th>
                            <th class="bg-purple-400/20">خاصة</th>
                            <th class="text-pink-600 font-extrabold">المجموع</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-surg-docs" class="text-[11px] font-bold text-text-main">
                        {{-- Populated dynamically --}}
                    </tbody>
                    <tfoot>
                        <tr class="border-t-2 border-slate-300/20">
                            <td class="py-3" colspan="2">
                                <span class="text-pink-600 font-extrabold">المجموع الكلي</span>
                            </td>
                            <td class="py-3 bg-yellow-400/20" id="surg-docs-total-small">0</td>
                            <td class="py-3 bg-blue-400/20" id="surg-docs-total-mid">0</td>
                            <td class="py-3 bg-orange-400/20" id="surg-docs-total-major">0</td>
                            <td class="py-3 bg-rose-400/20" id="surg-docs-total-super">0</td>
                            <td class="py-3 bg-purple-400/20" id="surg-docs-total-special">0</td>
                            <td class="py-3">
                                <span id="surg-docs-grand-total" class="inline-block px-3 py-1 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-lg font-black text-xs min-w-12">0</span>
                            </td>
                        </tr>
                    </tfoot>
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

    {{-- ══════════════════ TAB: SURGERY CLASSIFICATION × SECTORS ══════════════════ --}}
    <div id="entry-tab-content-surgery-cls" class="entry-tab-panel space-y-6 hidden">
        <div class="custom-card p-6 rounded-2xl space-y-6">

            {{-- Header --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-slate-100/5 pb-4">
                <div>
                    <h3 class="text-sm font-black text-text-main flex items-center gap-2">
                        <i data-lucide="layout-grid" class="w-5 h-5 text-rose-500"></i>
                        <span>تصنيف العمليات الجراحية حسب القطاعات</span>
                    </h3>
                    <p class="text-[10px] text-slate-400 mt-1 font-bold">أدخل عدد العمليات لكل تصنيف ولكل قطاع — تُحسب الإجماليات والنسب تلقائياً</p>
                </div>
                <div class="flex flex-wrap items-center gap-2">
                    <label class="text-[9px] font-bold text-slate-400">الشهر والسنّة:</label>
                    <input type="month" id="date-surg-cls" required
                        class="custom-inset border-none focus:outline-none rounded-xl py-1.5 px-3 text-xs font-bold text-text-main custom-date-input">
                    <button onclick="toggleEditSurgCls()" id="btn-edit-surg-cls"
                        class="py-1.5 px-3 rounded-lg text-xs font-bold text-teal-600 bg-teal-50 border border-teal-200 hover-press flex items-center gap-1.5">
                        <i data-lucide="edit" class="w-3.5 h-3.5"></i>
                        <span>تعديل</span>
                    </button>
                    <button onclick="saveSurgCls()"
                        class="py-1.5 px-5 rounded-lg text-xs font-bold text-white bg-gradient-to-r from-rose-500 to-pink-500 hover-press shadow-md shadow-rose-500/20 flex items-center gap-1.5">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        <span>حفظ الجدول</span>
                    </button>
                </div>
            </div>

            {{-- Classification × Sectors Table --}}
            <div class="overflow-x-auto">
                <table class="custom-table text-center" style="font-size:11px; min-width:700px" id="table-surg-cls">
                    <thead>
                        <tr>
                            <th class="text-right pr-3 w-52">تصنيف العمليات الجراحية</th>
                            <th class="bg-sky-400/20 w-32">قطاع الصحة</th>
                            <th class="bg-orange-400/20 w-32">عتبة الخاص</th>
                            <th class="bg-emerald-400/20 w-32">عتبة العام</th>
                            <th class="text-pink-600 font-extrabold w-28">المجموع</th>
                            <th class="bg-violet-400/20 w-28">النسبة المئوية</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-surg-cls">
                        {{-- Rows built dynamically by JS --}}
                    </tbody>
                    <tfoot id="tfoot-surg-cls">
                        <tr class="border-t-2 border-slate-300/20 font-extrabold">
                            <td class="py-3 text-right pr-3 text-pink-600">المجموع</td>
                            <td class="py-3 bg-sky-400/20"    id="cls-col-total-0">0</td>
                            <td class="py-3 bg-orange-400/20" id="cls-col-total-1">0</td>
                            <td class="py-3 bg-emerald-400/20" id="cls-col-total-2">0</td>
                            <td class="py-3">
                                <span id="cls-grand-total"
                                    class="inline-block px-3 py-1 bg-gradient-to-r from-pink-500 to-rose-500 text-white rounded-lg font-black text-sm">0</span>
                            </td>
                            <td class="py-3 bg-violet-400/20 text-violet-600 font-black">%</td>
                        </tr>
                        <tr class="border-t border-slate-200/10">
                            <td class="py-2 text-right pr-3 text-emerald-600 font-bold text-[10px]">النسبة %</td>
                            <td class="py-2 bg-sky-400/10 text-sky-600 font-bold text-[10px]" id="cls-col-pct-0">—</td>
                            <td class="py-2 bg-orange-400/10 text-orange-600 font-bold text-[10px]" id="cls-col-pct-1">—</td>
                            <td class="py-2 bg-emerald-400/10 text-emerald-600 font-bold text-[10px]" id="cls-col-pct-2">—</td>
                            <td class="py-2" colspan="2"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>

</section>

<script>
// ══════════════ SURGERY CLASSIFICATION × SECTORS TAB ══════════════

// جلب التصنيفات ديناميكياً من إدارة تصنيفات العمليات بقاعدة البيانات
function getDynamicClsRows() {
    const dbClasses = entryLookups?.classifications || [];
    const clsBgMap = {
        'صغرى':        'bg-yellow-400/5',
        'وسطى':        'bg-blue-400/5',
        'وسطى (حقن)': 'bg-blue-400/5',
        'وسطى (ليزر)':'bg-sky-400/5',
        'كبرى':        'bg-orange-400/5',
        'فوق الكبرى':  'bg-rose-400/5',
        'خاصة':        'bg-purple-400/5',
    };
    
    if (dbClasses.length > 0) {
        return dbClasses.map(c => {
            // نتحقق إن كان الاسم يحتوي على كلمة "العمليات" لمنع التكرار في التسمية
            const name = c.name;
            const label = name.includes('العمليات') ? name : 'العمليات ' + name;
            return {
                key: name,
                label: label,
                rowBg: clsBgMap[name] || 'bg-slate-400/5'
            };
        });
    }
    
    // Fallback في حال عدم توفر بيانات
    return [
        { key: 'صغرى',       label: 'العمليات الصغرى',              rowBg: 'bg-yellow-400/5'  },
        { key: 'وسطى (حقن)', label: 'العمليات الوسطى (حقن العين)',  rowBg: 'bg-blue-400/5'    },
        { key: 'وسطى (ليزر)',label: 'العمليات الوسطى (الليزر)',     rowBg: 'bg-sky-400/5'     },
        { key: 'كبرى',       label: 'العمليات الكبرى',              rowBg: 'bg-orange-400/5'  },
        { key: 'فوق الكبرى', label: 'العمليات فوق الكبرى',          rowBg: 'bg-rose-400/5'    },
        { key: 'خاصة',       label: 'العمليات الخاصة',              rowBg: 'bg-purple-400/5'  },
    ];
}

// القطاعات بنفس ترتيب الأعمدة (الأسماء في قاعدة البيانات)
const CLS_SECTORS = ['قطاع الصحة', 'عتبة الخاص', 'عتبة العام'];
const CLS_SECTOR_BG = ['bg-sky-400/10', 'bg-orange-400/10', 'bg-emerald-400/10'];

function buildSurgClsTable() {
    const tbody = document.getElementById('tbody-surg-cls');
    if (!tbody) return;
    tbody.innerHTML = '';
    const dynamicRows = getDynamicClsRows();

    dynamicRows.forEach((row, ri) => {
        let cells = `<td class="py-2.5 text-right pr-3 font-bold ${row.rowBg}">${row.label}</td>`;
        CLS_SECTORS.forEach((sec, si) => {
            cells += `
                <td class="py-2.5 ${CLS_SECTOR_BG[si]}">
                    <input type="number" min="0" value="0"
                        data-cls="${row.key}" data-sec="${sec}" data-si="${si}"
                        oninput="recalcSurgCls()"
                        class="w-24 text-center custom-inset border-none focus:outline-none rounded-lg py-1 px-1 text-xs font-bold text-text-main surg-cls-inp">
                </td>`;
        });
        // Row total
        cells += `<td class="py-2.5 font-extrabold text-pink-600 row-cls-total" id="cls-row-total-${ri}">0</td>`;
        // Row percentage
        cells += `<td class="py-2.5 bg-violet-400/10 text-violet-600 font-bold text-xs row-cls-pct" id="cls-row-pct-${ri}">0.00%</td>`;
        tbody.innerHTML += `<tr class="table-row" data-ri="${ri}">${cells}</tr>`;
    });

    recalcSurgCls();
}

function recalcSurgCls() {
    const grand = { total: 0 };
    const colTotals = [0, 0, 0];
    const dynamicRows = getDynamicClsRows();
    const rowTotals = Array(dynamicRows.length).fill(0);

    document.querySelectorAll('#tbody-surg-cls .surg-cls-inp').forEach(inp => {
        const val  = parseInt(inp.value) || 0;
        const ri   = parseInt(inp.closest('tr').dataset.ri);
        const si   = parseInt(inp.dataset.si);
        if (ri < rowTotals.length) {
            rowTotals[ri] += val;
        }
        colTotals[si]  += val;
        grand.total    += val;
    });

    // Update row totals & percentages
    dynamicRows.forEach((_, ri) => {
        const rt  = document.getElementById(`cls-row-total-${ri}`);
        const rp  = document.getElementById(`cls-row-pct-${ri}`);
        if (rt) rt.textContent = rowTotals[ri] || 0;
        if (rp) rp.textContent = grand.total > 0
            ? (((rowTotals[ri] || 0) / grand.total) * 100).toFixed(0) + '%'
            : '0%';
    });

    // Update column totals & percentages
    CLS_SECTORS.forEach((_, si) => {
        const ct = document.getElementById(`cls-col-total-${si}`);
        const cp = document.getElementById(`cls-col-pct-${si}`);
        if (ct) ct.textContent = colTotals[si];
        if (cp) cp.textContent = grand.total > 0
            ? '%' + ((colTotals[si] / grand.total) * 100).toFixed(0)
            : '—';
    });

    // Grand total
    const gt = document.getElementById('cls-grand-total');
    if (gt) gt.textContent = grand.total;
}

// ── Load existing data for editing ──
async function toggleEditSurgCls() {
    const type = 'surgeries_cls';
    if (editStates[type] && editStates[type].active) {
        editStates[type].active = false;
        editStates[type].date   = '';
        const btn = document.getElementById('btn-edit-surg-cls');
        if (btn) {
            btn.innerHTML = '<i data-lucide="edit" class="w-3.5 h-3.5"></i><span>تعديل</span>';
            btn.className = 'py-1.5 px-3 rounded-lg text-xs font-bold text-teal-600 bg-teal-50 border border-teal-200 hover-press flex items-center gap-1.5';
        }
        buildSurgClsTable(); // reset inputs
        showToast('تم إلغاء وضع التعديل', 'info');
        if (window.lucide) lucide.createIcons();
        return;
    }

    const monthVal = document.getElementById('date-surg-cls').value;
    if (!monthVal) { showToast('يرجى تحديد الشهر أولاً', 'error'); return; }
    const date = monthVal + '-01';

    try {
        const res  = await fetch(`/api/surgeries?start_date=${date}&end_date=${date}&per_page=2000&type=surgeries_cls`);
        const data = await res.json();
        const items = data.data || data;

        // Reset inputs first
        document.querySelectorAll('#tbody-surg-cls .surg-cls-inp').forEach(inp => inp.value = 0);

        let found = 0;
        items.forEach(item => {
            const clsKey = item.classification || '';
            const secName = item.sector_name || item.sector || '';
            const inp = document.querySelector(
                `#tbody-surg-cls input[data-cls="${clsKey}"][data-sec="${secName}"]`
            );
            if (inp) {
                inp.value = (parseInt(inp.value) || 0) + (parseInt(item.quantity) || 1);
                found++;
            }
        });

        recalcSurgCls();

        if (!editStates[type]) editStates[type] = { active: false, date: '' };
        if (found > 0) {
            editStates[type].active = true;
            editStates[type].date   = monthVal;
            const btn = document.getElementById('btn-edit-surg-cls');
            if (btn) {
                btn.innerHTML = '<span>إلغاء التعديل</span>';
                btn.className = 'py-1.5 px-3 rounded-lg text-xs font-bold text-rose-600 bg-rose-50 border border-rose-200 hover-press flex items-center gap-1.5';
            }
            showToast('تم تحميل البيانات السابقة للتعديل', 'success');
        } else {
            showToast('لا توجد بيانات مسجلة في هذا الشهر', 'warning');
        }
    } catch(e) {
        showToast('فشل جلب البيانات السابقة', 'error');
    }
}

// ── Save ──
async function saveSurgCls() {
    const monthVal = document.getElementById('date-surg-cls').value;
    if (!monthVal) { showToast('حدد الشهر والسنّة', 'error'); return; }
    const date = monthVal + '-01';

    // Clear old data if editing
    if (editStates['surgeries_cls'] && editStates['surgeries_cls'].active) {
        showToast('جاري تحديث البيانات القديمة...', 'info');
        const cleared = await clearDatabaseForEdit('surgeries_cls', editStates['surgeries_cls'].date + '-01');
        if (!cleared) { showToast('فشل حذف البيانات القديمة', 'error'); return; }
    }

    const promises = [];
    const sectors  = entryLookups?.sectors || [];
    const defaultOp = entryLookups?.operationNames?.[0]?.id || 1;
    const defaultDoc = entryLookups?.doctors?.[0]?.id || 1;

    document.querySelectorAll('#tbody-surg-cls .surg-cls-inp').forEach(inp => {
        const qty  = parseInt(inp.value) || 0;
        if (qty <= 0) return;
        const cls  = inp.dataset.cls;
        const secName = inp.dataset.sec;
        const sector = sectors.find(s => s.name === secName);
        if (!sector) return;

        promises.push(
            fetch('/api/surgeries', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    doctor_id:          defaultDoc,
                    operation_name_id:  defaultOp,
                    sector_id:          sector.id,
                    op_date:            date,
                    quantity:           qty,
                    classification:     cls
                })
            })
        );
    });

    if (promises.length === 0 && !(editStates['surgeries_cls']?.active)) {
        showToast('لا توجد أعداد مدخلة لحفظها', 'error'); return;
    }

    showToast('جاري حفظ تصنيف العمليات...', 'info');
    try {
        if (promises.length > 0) {
            const results = await Promise.all(promises);
            if (results.every(r => r.ok)) {
                showToast('✅ تم حفظ جدول تصنيف العمليات بنجاح وربطه بالتقارير', 'success');
            } else {
                showToast('فشل حفظ بعض القيود', 'error');
            }
        } else {
            showToast('تم تحديث البيانات بنجاح', 'success');
        }

        if (editStates['surgeries_cls']?.active) {
            editStates['surgeries_cls'].active = false;
            const btn = document.getElementById('btn-edit-surg-cls');
            if (btn) {
                btn.innerHTML = '<i data-lucide="edit" class="w-3.5 h-3.5"></i><span>تعديل</span>';
                btn.className = 'py-1.5 px-3 rounded-lg text-xs font-bold text-teal-600 bg-teal-50 border border-teal-200 hover-press flex items-center gap-1.5';
                if (window.lucide) lucide.createIcons();
            }
        }
        lastUsedDate = monthVal;
    } catch(e) {
        showToast('خطأ في الاتصال بالشبكة', 'error');
    }
}
</script>

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

function updateRowClassColor(selectEl) {
    const clsColorMap = {
        'صغرى':        'bg-yellow-400/10',
        'وسطى':        'bg-blue-400/10',
        'وسطى (حقن)': 'bg-blue-400/10',
        'وسطى (ليزر)':'bg-sky-400/10',
        'كبرى':        'bg-orange-400/10',
        'فوق الكبرى':  'bg-rose-400/10',
        'خاصة':        'bg-purple-400/10',
    };
    const td = selectEl.closest('td');
    if (!td) return;
    // Remove old cls bg
    Object.values(clsColorMap).forEach(cls => td.classList.remove(cls));
    td.classList.add(clsColorMap[selectEl.value] || 'bg-slate-400/10');
}

function updateSurgDocsTotals() {
    const tbody = document.getElementById('tbody-surg-docs');
    if (!tbody) return;
    const clsCols = ['صغرى', 'وسطى', 'كبرى', 'فوق الكبرى', 'خاصة'];
    const footerIds = ['surg-docs-total-small', 'surg-docs-total-mid', 'surg-docs-total-major', 'surg-docs-total-super', 'surg-docs-total-special'];
    const colTotals = [0, 0, 0, 0, 0];
    let grandTotal = 0;

    tbody.querySelectorAll('tr.table-row').forEach(tr => {
        let rowTotal = 0;
        clsCols.forEach((cls, ci) => {
            const inp = tr.querySelector(`input[data-cls="${cls}"]`);
            const val = parseInt(inp?.value) || 0;
            colTotals[ci] += val;
            rowTotal += val;
        });
        grandTotal += rowTotal;
        const rowTotalCell = tr.querySelector('.row-doc-total');
        if (rowTotalCell) rowTotalCell.textContent = rowTotal;
    });

    footerIds.forEach((id, i) => {
        const el = document.getElementById(id);
        if (el) el.textContent = colTotals[i];
    });
    const grand = document.getElementById('surg-docs-grand-total');
    if (grand) grand.textContent = grandTotal;
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

    // Build surgery-cls table on first visit
    if (tabName === 'surgery-cls') {
        buildSurgClsTable();
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
        'date-surg-cls',
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
        'date-surg-cls',
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
        const dbClasses = entryLookups.classifications || [];

        // Color map per classification
        const clsColorMap = {
            'صغرى':        { bg: 'bg-yellow-400/10',  text: 'text-yellow-700'  },
            'وسطى':        { bg: 'bg-blue-400/10',    text: 'text-blue-700'    },
            'وسطى (حقن)': { bg: 'bg-blue-400/10',    text: 'text-blue-700'    },
            'وسطى (ليزر)':{ bg: 'bg-sky-400/10',     text: 'text-sky-700'     },
            'كبرى':        { bg: 'bg-orange-400/10',  text: 'text-orange-700'  },
            'فوق الكبرى':  { bg: 'bg-rose-400/10',    text: 'text-rose-700'    },
            'خاصة':        { bg: 'bg-purple-400/10',  text: 'text-purple-700'  },
        };

        surgeryTypeOrder.forEach((opId, index) => {
            const dbOp = dbOps.find(o => o.id === opId);
            if (dbOp) {
                const defaultClass = dbOp.classification || (dbClasses[0] ? dbClasses[0].name : '');
                const clsColor = clsColorMap[defaultClass] || { bg: 'bg-slate-400/10', text: 'text-slate-600' };
                tbodySurgOps.innerHTML += `
                    <tr class="table-row" data-op-id="${dbOp.id}">
                        <td class="py-2.5 text-center text-slate-400 font-bold">${index + 1}</td>
                        <td class="py-2.5 text-right pr-2 font-bold">${dbOp.name}</td>
                        <td class="py-2.5 text-center ${clsColor.bg}">
                            <select class="surg-class-select custom-inset border-none focus:outline-none rounded-lg py-1 px-1.5 font-bold text-text-main text-[11px] font-['Tajawal'] w-32" onchange="updateRowClassColor(this)">
                                ${dbClasses.map(c => `<option value="${c.name}" ${c.name === defaultClass ? 'selected' : ''}>${c.name}</option>`).join('')}
                            </select>
                        </td>
                        <td class="py-2.5 text-center bg-yellow-400/10">
                            <input type="number" min="0" value="0" oninput="updateSurgOpsPercentages()"
                                class="w-24 text-center custom-inset border-none focus:outline-none rounded-lg py-1 px-2 text-xs font-bold text-text-main surg-qty-input">
                        </td>
                        <td class="py-2.5 text-center bg-emerald-400/10 text-emerald-600 font-bold text-xs row-percentage">0.00%</td>
                    </tr>
                `;
            }
        });
        updateSurgOpsPercentages();
    }

    // 5. Surgery Doctors Table — 6 classification columns matching Report Table 10
    const tbodySurgDocs = document.getElementById('tbody-surg-docs');
    if (tbodySurgDocs && doctors.length) {
        tbodySurgDocs.innerHTML = '';
        const clsCols = ['صغرى', 'وسطى', 'كبرى', 'فوق الكبرى', 'خاصة'];
        const clsBg   = ['bg-yellow-400/10', 'bg-blue-400/10', 'bg-orange-400/10', 'bg-rose-400/10', 'bg-purple-400/10'];

        doctors.forEach((doc, idx) => {
            let cells = `<td class="py-2.5 text-center text-slate-400 font-bold">${idx + 1}</td>
                         <td class="py-2.5 text-right pr-2 font-bold">${doc.name}</td>`;
            clsCols.forEach((cls, ci) => {
                cells += `
                    <td class="py-2.5 ${clsBg[ci]}">
                        <input type="number" min="0" value="0"
                            data-cls="${cls}"
                            oninput="updateSurgDocsTotals()"
                            class="w-20 text-center custom-inset border-none focus:outline-none rounded-lg py-1 px-1 text-xs font-bold text-text-main">
                    </td>`;
            });
            // Row total cell
            cells += `<td class="py-2.5 font-extrabold text-pink-600 row-doc-total">0</td>`;
            tbodySurgDocs.innerHTML += `<tr class="table-row" data-doctor-id="${doc.id}">${cells}</tr>`;
        });
        updateSurgDocsTotals();
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
    visits_doctors:  { active: false, date: '' },
    visits_govs:     { active: false, date: '' },
    visits_countries:{ active: false, date: '' },
    surgeries_cls:   { active: false, date: '' },
    surgeries_ops:   { active: false, date: '' },
    surgeries_docs:  { active: false, date: '' },
    eye_tests:       { active: false, date: '' },
    lab_tests:       { active: false, date: '' }
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
                }
                const select = tr.querySelector('select.surg-class-select');
                if (select && s.classification) {
                    select.value = s.classification;
                }
                found++;
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
        const clsVal = tr.querySelector('select.surg-class-select').value;

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
                        quantity: count,
                        classification: clsVal
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

// 5. Save Surgeries by Doctors — saves each classification column separately
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
    const clsCols = ['صغرى', 'وسطى', 'كبرى', 'فوق الكبرى', 'خاصة'];
    const defaultOp = entryLookups?.operationNames?.[0]?.id || 1;
    const defaultSector = entryLookups?.sectors?.[0]?.id || 1;

    rows.forEach(tr => {
        const docId = tr.getAttribute('data-doctor-id');
        clsCols.forEach(cls => {
            const inp = tr.querySelector(`input[data-cls="${cls}"]`);
            const count = parseInt(inp?.value) || 0;
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
                            quantity: count,
                            classification: cls
                        })
                    })
                );
            }
        });
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
