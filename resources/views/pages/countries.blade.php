{{-- PAGE: COUNTRIES MANAGEMENT --}}
<section id="page-countries" class="page-section space-y-6 hidden">
    <div class="custom-card p-5 rounded-2xl flex flex-col sm:flex-row gap-4 items-center justify-between">
        <div>
            <h2 class="text-base font-bold text-text-main flex items-center gap-2">
                <i data-lucide="globe" class="w-5 h-5 text-sky-500"></i>
                إدارة الدول
            </h2>
            <p class="text-[11px] text-text-main opacity-60 mt-0.5">تسجيل الدول لمرضى الاستشاريات والعمليات من خارج العراق</p>
        </div>
    </div>

    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-sm font-bold text-text-main flex items-center gap-2 mb-4"><i data-lucide="plus" class="w-4 h-4 text-sky-500"></i> إضافة دولة جديدة</h3>
        <div class="flex gap-3">
            <input id="inp-country-name" type="text" placeholder="اسم الدولة (مثال: ايران)" class="flex-1 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
            <button onclick="addCountry()" class="py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-sky-500 to-sky-400 hover-press flex items-center gap-2">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i> إضافة
            </button>
        </div>
    </div>

    <div class="custom-card p-6 rounded-2xl">
        <div class="overflow-x-auto"><table class="custom-table text-xs" id="tbl-countries">
            <thead><tr><th class="w-8">ت</th><th>اسم الدولة</th><th class="text-center w-20">حذف</th></tr></thead>
            <tbody id="tbody-countries"></tbody>
        </table></div>
    </div>
</section>

<script>
async function loadCountries() {
    const data = await apiFetch('/api/countries');
    const tb = document.getElementById('tbody-countries');
    if(!tb) return;
    if(!data?.length) { tb.innerHTML = `<tr><td colspan="3" class="text-center py-6 text-text-main opacity-40 text-xs">لا توجد بيانات بعد</td></tr>`; return; }
    tb.innerHTML = data.map((d,i)=>`<tr class="table-row">
        <td class="text-center">${i+1}</td>
        <td class="font-bold">${d.name}</td>
        <td class="text-center">
            <button onclick="deleteCountry(${d.id})" class="w-7 h-7 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center mx-auto hover-press">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </td>
    </tr>`).join('');
}

async function addCountry() {
    const name = document.getElementById('inp-country-name').value.trim();
    if(!name) return showToast('الرجاء كتابة اسم الدولة','error');
    await apiFetch('/api/countries','POST',{name});
    document.getElementById('inp-country-name').value='';
    loadCountries();
    showToast('تمت إضافة الدولة بنجاح ✅');
}

async function deleteCountry(id) {
    await apiFetch(`/api/countries/${id}`,'DELETE');
    loadCountries();
    showToast('تم الحذف');
}

window.initCountriesPage = function() {
    loadCountries();
};
</script>
