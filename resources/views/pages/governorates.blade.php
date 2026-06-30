{{-- PAGE: GOVERNORATES MANAGEMENT --}}
<section id="page-governorates" class="page-section space-y-6 hidden">
    <div class="custom-card p-5 rounded-2xl flex flex-col sm:flex-row gap-4 items-center justify-between">
        <div>
            <h2 class="text-base font-bold text-text-main flex items-center gap-2">
                <i data-lucide="map-pin" class="w-5 h-5 text-emerald-500"></i>
                إدارة المحافظات
            </h2>
            <p class="text-[11px] text-text-main opacity-60 mt-0.5">تسجيل محافظات العراق الـ 18 لإحصائيات التوزيع الجغرافي للمرضى</p>
        </div>
    </div>

    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-sm font-bold text-text-main flex items-center gap-2 mb-4"><i data-lucide="plus" class="w-4 h-4 text-emerald-500"></i> إضافة محافظة جديدة</h3>
        <div class="flex gap-3">
            <input id="inp-gov-name" type="text" placeholder="اسم المحافظة (مثال: كربلاء)" class="flex-1 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
            <button onclick="addGov()" class="py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-emerald-500 to-emerald-400 hover-press flex items-center gap-2">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i> إضافة
            </button>
        </div>
    </div>

    <div class="custom-card p-6 rounded-2xl">
        <div class="overflow-x-auto"><table class="custom-table text-xs" id="tbl-governorates">
            <thead><tr><th class="w-8">ت</th><th>اسم المحافظة</th><th class="text-center w-20">حذف</th></tr></thead>
            <tbody id="tbody-governorates"></tbody>
        </table></div>
    </div>
</section>

<script>
async function loadGovs() {
    const data = await apiFetch('/api/governorates');
    const tb = document.getElementById('tbody-governorates');
    if(!tb) return;
    if(!data?.length) { tb.innerHTML = `<tr><td colspan="3" class="text-center py-6 text-text-main opacity-40 text-xs">لا توجد بيانات بعد</td></tr>`; return; }
    tb.innerHTML = data.map((d,i)=>`<tr class="table-row">
        <td class="text-center">${i+1}</td>
        <td class="font-bold">${d.name}</td>
        <td class="text-center">
            <button onclick="deleteGov(${d.id})" class="w-7 h-7 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center mx-auto hover-press">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </td>
    </tr>`).join('');
}

async function addGov() {
    const name = document.getElementById('inp-gov-name').value.trim();
    if(!name) return showToast('الرجاء كتابة اسم المحافظة','error');
    await apiFetch('/api/governorates','POST',{name});
    document.getElementById('inp-gov-name').value='';
    loadGovs();
    showToast('تمت إضافة المحافظة بنجاح ✅');
}

async function deleteGov(id) {
    await apiFetch(`/api/governorates/${id}`,'DELETE');
    loadGovs();
    showToast('تم الحذف');
}

window.initGovernoratesPage = function() {
    loadGovs();
};
</script>
