{{-- PAGE 3: MANAGEMENT PAGE — 8 Lookup Tabs + 4 Entry Forms --}}
<section id="page-doctors" class="page-section space-y-6 hidden">

    {{-- Page Header --}}
    <div class="custom-card p-5 rounded-2xl flex flex-col sm:flex-row gap-4 items-center justify-between">
        <div>
            <h2 class="text-base font-bold text-text-main flex items-center gap-2">
                <i data-lucide="database" class="w-5 h-5 text-emerald-500"></i>
                إدارة المدخلات الأساسية
            </h2>
            <p class="text-[11px] text-text-main opacity-60 mt-0.5">قواميس النظام — تُضاف مرة واحدة وتُستخدم في كل عملية إدخال</p>
        </div>
    </div>

    {{-- TAB NAVIGATION --}}
    <div class="custom-card p-3 rounded-2xl">
        <div class="flex flex-wrap gap-2" id="mgmt-tabs">
            @php
            $tabs = [
                ['id'=>'tab-doctors',     'label'=>'الأطباء',           'icon'=>'stethoscope',  'color'=>'text-violet-600'],
                ['id'=>'tab-countries',   'label'=>'الدول',              'icon'=>'globe',         'color'=>'text-sky-600'],
                ['id'=>'tab-govs',        'label'=>'المحافظات',          'icon'=>'map-pin',       'color'=>'text-emerald-600'],
                ['id'=>'tab-tests',       'label'=>'الفحوصات البصرية',  'icon'=>'eye',           'color'=>'text-orange-600'],
                ['id'=>'tab-ops',         'label'=>'أسماء العمليات',    'icon'=>'scissors',      'color'=>'text-rose-600'],
                ['id'=>'tab-sectors',     'label'=>'القطاعات',           'icon'=>'building-2',    'color'=>'text-amber-600'],
                ['id'=>'tab-units',       'label'=>'وحدات الاستشارية', 'icon'=>'layout-list',   'color'=>'text-indigo-600'],
                ['id'=>'tab-labtests',    'label'=>'تحاليل المختبر',    'icon'=>'test-tube',     'color'=>'text-purple-600'],
            ];
            @endphp
            @foreach($tabs as $i => $tab)
            <button onclick="showMgmtTab('{{ $tab['id'] }}')" id="{{ $tab['id'] }}-btn"
                class="mgmt-tab-btn custom-inset py-2 px-4 rounded-xl text-[11px] font-bold text-text-main hover-press transition-all flex items-center gap-1.5
                    {{ $i === 0 ? 'ring-2 ring-violet-400 bg-violet-50/50 text-violet-700' : '' }}">
                <i data-lucide="{{ $tab['icon'] }}" class="w-3.5 h-3.5 {{ $tab['color'] }}"></i>
                {{ $tab['label'] }}
            </button>
            @endforeach
        </div>
    </div>

    {{-- TAB PANELS --}}

    {{-- 1. DOCTORS --}}
    <div id="tab-doctors" class="mgmt-panel space-y-4">
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-sm font-bold text-text-main flex items-center gap-2 mb-4"><i data-lucide="stethoscope" class="w-4 h-4 text-violet-500"></i> إضافة طبيب جديد</h3>
            <div class="flex flex-col sm:flex-row gap-3">
                <input id="inp-doc-name" type="text" placeholder="اسم الطبيب (مثال: د. أحمد علي)" class="flex-1 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
                <input id="inp-doc-fee" type="number" placeholder="سعر الكشفية (دينار)" class="w-40 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
                <button onclick="addDoctor()" class="py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-violet-500 to-violet-400 hover-press flex items-center gap-2">
                    <i data-lucide="plus" class="w-3.5 h-3.5"></i> إضافة
                </button>
            </div>
        </div>
        <div class="custom-card p-6 rounded-2xl">
            <div class="overflow-x-auto"><table class="custom-table text-xs" id="tbl-doctors">
                <thead><tr><th class="w-8">ت</th><th>اسم الطبيب</th><th class="text-center w-36">سعر الكشفية</th><th class="text-center w-20">حذف</th></tr></thead>
                <tbody id="tbody-doctors"></tbody>
            </table></div>
        </div>
    </div>

    {{-- 2. COUNTRIES --}}
    <div id="tab-countries" class="mgmt-panel hidden space-y-4">
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-sm font-bold text-text-main flex items-center gap-2 mb-4"><i data-lucide="globe" class="w-4 h-4 text-sky-500"></i> إضافة دولة جديدة</h3>
            <div class="flex gap-3">
                <input id="inp-country" type="text" placeholder="اسم الدولة" class="flex-1 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
                <button onclick="addLookup('countries','inp-country','tbody-countries','name')" class="py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-sky-500 to-sky-400 hover-press flex items-center gap-2">
                    <i data-lucide="plus" class="w-3.5 h-3.5"></i> إضافة
                </button>
            </div>
        </div>
        <div class="custom-card p-6 rounded-2xl"><div class="overflow-x-auto"><table class="custom-table text-xs">
            <thead><tr><th class="w-8">ت</th><th>اسم الدولة</th><th class="text-center w-20">حذف</th></tr></thead>
            <tbody id="tbody-countries"></tbody>
        </table></div></div>
    </div>

    {{-- 3. GOVERNORATES --}}
    <div id="tab-govs" class="mgmt-panel hidden space-y-4">
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-sm font-bold text-text-main flex items-center gap-2 mb-4"><i data-lucide="map-pin" class="w-4 h-4 text-emerald-500"></i> إضافة محافظة</h3>
            <div class="flex gap-3">
                <input id="inp-gov" type="text" placeholder="اسم المحافظة" class="flex-1 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
                <button onclick="addLookup('governorates','inp-gov','tbody-govs','name')" class="py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-emerald-500 to-emerald-400 hover-press flex items-center gap-2">
                    <i data-lucide="plus" class="w-3.5 h-3.5"></i> إضافة
                </button>
            </div>
        </div>
        <div class="custom-card p-6 rounded-2xl"><div class="overflow-x-auto"><table class="custom-table text-xs">
            <thead><tr><th class="w-8">ت</th><th>اسم المحافظة</th><th class="text-center w-20">حذف</th></tr></thead>
            <tbody id="tbody-govs"></tbody>
        </table></div></div>
    </div>

    {{-- 4. TEST TYPES --}}
    <div id="tab-tests" class="mgmt-panel hidden space-y-4">
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-sm font-bold text-text-main flex items-center gap-2 mb-4"><i data-lucide="eye" class="w-4 h-4 text-orange-500"></i> إضافة نوع فحص بصري</h3>
            <div class="flex gap-3">
                <input id="inp-test" type="text" placeholder="مثال: فحص الشبكية OCT" class="flex-1 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
                <button onclick="addLookup('test-types','inp-test','tbody-tests','name')" class="py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-orange-500 to-orange-400 hover-press flex items-center gap-2">
                    <i data-lucide="plus" class="w-3.5 h-3.5"></i> إضافة
                </button>
            </div>
        </div>
        <div class="custom-card p-6 rounded-2xl"><div class="overflow-x-auto"><table class="custom-table text-xs">
            <thead><tr><th class="w-8">ت</th><th>نوع الفحص البصري</th><th class="text-center w-20">حذف</th></tr></thead>
            <tbody id="tbody-tests"></tbody>
        </table></div></div>
    </div>

    {{-- 5. OPERATION NAMES --}}
    <div id="tab-ops" class="mgmt-panel hidden space-y-4">
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-sm font-bold text-text-main flex items-center gap-2 mb-4"><i data-lucide="scissors" class="w-4 h-4 text-rose-500"></i> إضافة اسم عملية جراحية</h3>
            <div class="flex flex-col sm:flex-row gap-3">
                <input id="inp-op-name" type="text" placeholder="اسم العملية" class="flex-1 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
                <select id="inp-op-class" class="custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
                    <option value="صغرى">صغرى</option>
                    <option value="وسطى (حقن)">وسطى (حقن)</option>
                    <option value="وسطى (ليزر)">وسطى (ليزر)</option>
                    <option value="كبرى">كبرى</option>
                    <option value="فوق الكبرى">فوق الكبرى</option>
                    <option value="خاصة">خاصة</option>
                </select>
                <button onclick="addOperationName()" class="py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-rose-500 to-rose-400 hover-press flex items-center gap-2">
                    <i data-lucide="plus" class="w-3.5 h-3.5"></i> إضافة
                </button>
            </div>
        </div>
        <div class="custom-card p-6 rounded-2xl"><div class="overflow-x-auto"><table class="custom-table text-xs">
            <thead><tr><th class="w-8">ت</th><th>اسم العملية</th><th class="text-center min-w-[120px]">التصنيف</th><th class="text-center w-20">حذف</th></tr></thead>
            <tbody id="tbody-ops"></tbody>
        </table></div></div>
    </div>

    {{-- 6. SECTORS --}}
    <div id="tab-sectors" class="mgmt-panel hidden space-y-4">
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-sm font-bold text-text-main flex items-center gap-2 mb-4"><i data-lucide="building-2" class="w-4 h-4 text-amber-500"></i> إضافة قطاع</h3>
            <div class="flex gap-3">
                <input id="inp-sector" type="text" placeholder="مثال: قطاع الصحة" class="flex-1 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
                <button onclick="addLookup('sectors','inp-sector','tbody-sectors','name')" class="py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-amber-500 to-amber-400 hover-press flex items-center gap-2">
                    <i data-lucide="plus" class="w-3.5 h-3.5"></i> إضافة
                </button>
            </div>
        </div>
        <div class="custom-card p-6 rounded-2xl"><div class="overflow-x-auto"><table class="custom-table text-xs">
            <thead><tr><th class="w-8">ت</th><th>اسم القطاع</th><th class="text-center w-20">حذف</th></tr></thead>
            <tbody id="tbody-sectors"></tbody>
        </table></div></div>
    </div>

    {{-- 7. CLINIC UNITS --}}
    <div id="tab-units" class="mgmt-panel hidden space-y-4">
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-sm font-bold text-text-main flex items-center gap-2 mb-4"><i data-lucide="layout-list" class="w-4 h-4 text-indigo-500"></i> إضافة وحدة استشارية</h3>
            <div class="flex gap-3">
                <input id="inp-unit" type="text" placeholder="مثال: استشارية العيون العامة" class="flex-1 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
                <button onclick="addLookup('clinic-units','inp-unit','tbody-units','name')" class="py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-indigo-500 to-indigo-400 hover-press flex items-center gap-2">
                    <i data-lucide="plus" class="w-3.5 h-3.5"></i> إضافة
                </button>
            </div>
        </div>
        <div class="custom-card p-6 rounded-2xl"><div class="overflow-x-auto"><table class="custom-table text-xs">
            <thead><tr><th class="w-8">ت</th><th>اسم الوحدة الاستشارية</th><th class="text-center w-20">حذف</th></tr></thead>
            <tbody id="tbody-units"></tbody>
        </table></div></div>
    </div>

    {{-- 8. LAB TEST TYPES --}}
    <div id="tab-labtests" class="mgmt-panel hidden space-y-4">
        <div class="custom-card p-6 rounded-2xl">
            <h3 class="text-sm font-bold text-text-main flex items-center gap-2 mb-4"><i data-lucide="test-tube" class="w-4 h-4 text-purple-500"></i> إضافة نوع تحليل مختبري</h3>
            <div class="flex gap-3">
                <input id="inp-labtest" type="text" placeholder="مثال: RBS" class="flex-1 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
                <button onclick="addLookup('lab-test-types','inp-labtest','tbody-labtests','name')" class="py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-purple-500 to-purple-400 hover-press flex items-center gap-2">
                    <i data-lucide="plus" class="w-3.5 h-3.5"></i> إضافة
                </button>
            </div>
        </div>
        <div class="custom-card p-6 rounded-2xl"><div class="overflow-x-auto"><table class="custom-table text-xs">
            <thead><tr><th class="w-8">ت</th><th>نوع التحليل المختبري</th><th class="text-center w-20">حذف</th></tr></thead>
            <tbody id="tbody-labtests"></tbody>
        </table></div></div>
    </div>

</section>

<script>
// ── Tab Switcher ──────────────────────────────────────────────────────────────
const MGMT_TABS = ['tab-doctors','tab-countries','tab-govs','tab-tests','tab-ops','tab-sectors','tab-units','tab-labtests'];
function showMgmtTab(id) {
    MGMT_TABS.forEach(t => {
        document.getElementById(t)?.classList.add('hidden');
        const btn = document.getElementById(t+'-btn');
        if(btn) btn.className = btn.className.replace(/ring-2 ring-\S+ bg-\S+\/50 text-\S+-700/g,'').trim();
    });
    document.getElementById(id)?.classList.remove('hidden');
    const activeColors = {
        'tab-doctors':'ring-violet-400 bg-violet-50/50 text-violet-700',
        'tab-countries':'ring-sky-400 bg-sky-50/50 text-sky-700',
        'tab-govs':'ring-emerald-400 bg-emerald-50/50 text-emerald-700',
        'tab-tests':'ring-orange-400 bg-orange-50/50 text-orange-700',
        'tab-ops':'ring-rose-400 bg-rose-50/50 text-rose-700',
        'tab-sectors':'ring-amber-400 bg-amber-50/50 text-amber-700',
        'tab-units':'ring-indigo-400 bg-indigo-50/50 text-indigo-700',
        'tab-labtests':'ring-purple-400 bg-purple-50/50 text-purple-700',
    };
    const btn = document.getElementById(id+'-btn');
    if(btn && activeColors[id]) btn.classList.add('ring-2',...activeColors[id].split(' '));
    loadTab(id);
}

// ── CSRF Token ────────────────────────────────────────────────────────────────
const CSRF = document.querySelector('meta[name="csrf-token"]')?.content;

// ── Generic Fetch Helpers ─────────────────────────────────────────────────────
async function apiFetch(url, method='GET', body=null) {
    const opts = { method, headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF,'Accept':'application/json'} };
    if(body) opts.body = JSON.stringify(body);
    const res = await fetch(url, opts);
    if(!res.ok) { const e = await res.json().catch(()=>({})); showToast(e.message||'حدث خطأ!','error'); throw e; }
    return res.status===204 ? null : res.json();
}

function showToast(msg, type='success') {
    const c = document.createElement('div');
    c.className = `fixed bottom-6 left-1/2 -translate-x-1/2 z-[999] px-5 py-3 rounded-2xl text-xs font-bold text-white shadow-xl transition-all
        ${type==='error'?'bg-rose-500':'bg-emerald-500'}`;
    c.textContent = msg;
    document.body.appendChild(c);
    setTimeout(()=>c.remove(), 3000);
}

// ── Row Builders ──────────────────────────────────────────────────────────────
function simpleRow(item, i, endpoint, tbodyId, extra='') {
    return `<tr class="table-row">
        <td class="text-center">${i}</td>
        <td>${item.name}${extra}</td>
        <td class="text-center">
            <button onclick="deleteLookup('${endpoint}',${item.id},'${tbodyId}')"
                class="w-7 h-7 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center mx-auto hover-press">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </td>
    </tr>`;
}

// ── Load Tables ───────────────────────────────────────────────────────────────
const TAB_CONFIG = {
    'tab-doctors':   { endpoint:'doctors',         tbody:'tbody-doctors',   custom: renderDoctors  },
    'tab-countries': { endpoint:'countries',        tbody:'tbody-countries', custom: null },
    'tab-govs':      { endpoint:'governorates',     tbody:'tbody-govs',      custom: null },
    'tab-tests':     { endpoint:'test-types',       tbody:'tbody-tests',     custom: null },
    'tab-ops':       { endpoint:'operation-names',  tbody:'tbody-ops',       custom: renderOps },
    'tab-sectors':   { endpoint:'sectors',          tbody:'tbody-sectors',   custom: null },
    'tab-units':     { endpoint:'clinic-units',     tbody:'tbody-units',     custom: null },
    'tab-labtests':  { endpoint:'lab-test-types',   tbody:'tbody-labtests',  custom: null },
};
const loadedTabs = {};

async function loadTab(tabId) {
    if(loadedTabs[tabId]) return;
    const cfg = TAB_CONFIG[tabId];
    if(!cfg) return;
    const data = await apiFetch(`/api/${cfg.endpoint}`);
    renderTable(cfg.endpoint, cfg.tbody, data, cfg.custom);
    loadedTabs[tabId] = true;
}

function renderTable(endpoint, tbodyId, data, customFn) {
    const tb = document.getElementById(tbodyId);
    if(!tb) return;
    if(!data?.length) { tb.innerHTML = `<tr><td colspan="10" class="text-center py-6 text-text-main opacity-40 text-xs">لا توجد بيانات بعد</td></tr>`; return; }
    tb.innerHTML = customFn ? customFn(data) : data.map((item,i)=>simpleRow(item,i+1,endpoint,tbodyId)).join('');
}

function renderDoctors(data) {
    return data.map((d,i)=>`<tr class="table-row">
        <td class="text-center">${i+1}</td>
        <td class="font-bold">${d.name}</td>
        <td class="text-center text-emerald-600 font-bold">${Number(d.fee).toLocaleString()} د.ع</td>
        <td class="text-center">
            <button onclick="deleteDoc(${d.id})"
                class="w-7 h-7 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center mx-auto hover-press">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </td>
    </tr>`).join('');
}

const classColors = {'خاصة':'bg-purple-100 text-purple-700','فوق الكبرى':'bg-rose-100 text-rose-700','كبرى':'bg-orange-100 text-orange-700','وسطى (حقن)':'bg-blue-100 text-blue-700','وسطى (ليزر)':'bg-cyan-100 text-cyan-700','صغرى':'bg-yellow-100 text-yellow-700'};
function renderOps(data) {
    return data.map((d,i)=>`<tr class="table-row">
        <td class="text-center">${i+1}</td>
        <td>${d.name}</td>
        <td class="text-center"><span class="text-[9px] font-bold px-2 py-0.5 rounded-full ${classColors[d.classification]||''}">${d.classification}</span></td>
        <td class="text-center">
            <button onclick="deleteLookup('operation-names',${d.id},'tbody-ops')"
                class="w-7 h-7 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center mx-auto hover-press">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </td>
    </tr>`).join('');
}

// ── Actions ───────────────────────────────────────────────────────────────────
async function addDoctor() {
    const name = document.getElementById('inp-doc-name').value.trim();
    const fee  = document.getElementById('inp-doc-fee').value.trim();
    if(!name) return showToast('الرجاء كتابة اسم الطبيب','error');
    await apiFetch('/api/doctors','POST',{name,fee:fee||0});
    document.getElementById('inp-doc-name').value='';
    document.getElementById('inp-doc-fee').value='';
    loadedTabs['tab-doctors']=false;
    loadTab('tab-doctors');
    showToast('تمت إضافة الطبيب بنجاح ✅');
}

async function deleteDoc(id) {
    await apiFetch(`/api/doctors/${id}`,'DELETE');
    loadedTabs['tab-doctors']=false;
    loadTab('tab-doctors');
    showToast('تم الحذف');
}

async function addLookup(endpoint, inputId, tbodyId, ...fields) {
    const vals = {};
    fields.forEach(f => { vals[f] = document.getElementById(`inp-${f==='name'?inputId.replace('inp-',''):f}`)?.value?.trim(); });
    // simpler: just get the one input
    const v = document.getElementById(inputId).value.trim();
    if(!v) return showToast('الرجاء ملء الحقل','error');
    await apiFetch(`/api/${endpoint}`,'POST',{name:v});
    document.getElementById(inputId).value='';
    // reload tab
    const tabId = Object.entries(TAB_CONFIG).find(([k,cfg])=>cfg.tbody===tbodyId)?.[0];
    if(tabId){ loadedTabs[tabId]=false; loadTab(tabId); }
    showToast('تمت الإضافة بنجاح ✅');
}

async function deleteLookup(endpoint, id, tbodyId) {
    await apiFetch(`/api/${endpoint}/${id}`,'DELETE');
    const tabId = Object.entries(TAB_CONFIG).find(([k,cfg])=>cfg.tbody===tbodyId)?.[0];
    if(tabId){ loadedTabs[tabId]=false; loadTab(tabId); }
    showToast('تم الحذف');
}

async function addOperationName() {
    const name = document.getElementById('inp-op-name').value.trim();
    const cls  = document.getElementById('inp-op-class').value;
    if(!name) return showToast('الرجاء كتابة اسم العملية','error');
    await apiFetch('/api/operation-names','POST',{name,classification:cls});
    document.getElementById('inp-op-name').value='';
    loadedTabs['tab-ops']=false;
    loadTab('tab-ops');
    showToast('تمت إضافة العملية بنجاح ✅');
}

// Auto-load first tab when management page is opened
document.addEventListener('DOMContentLoaded', ()=>{
    // Will be triggered via navigateToPage hook
});

window.initManagementPage = function() {
    if(!loadedTabs['tab-doctors']) loadTab('tab-doctors');
};
</script>
