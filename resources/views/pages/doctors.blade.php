{{-- PAGE: DOCTORS MANAGEMENT --}}
<section id="page-doctors" class="page-section space-y-6 hidden">
    <div class="custom-card p-5 rounded-2xl flex flex-col sm:flex-row gap-4 items-center justify-between">
        <div>
            <h2 class="text-base font-bold text-text-main flex items-center gap-2">
                <i data-lucide="stethoscope" class="w-5 h-5 text-violet-500"></i>
                إدارة الأطباء
            </h2>
            <p class="text-[11px] text-text-main opacity-60 mt-0.5">تسجيل الأطباء الاختصاص وتحديد سعر كشفية كل طبيب</p>
        </div>
    </div>

    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-sm font-bold text-text-main flex items-center gap-2 mb-4"><i data-lucide="plus" class="w-4 h-4 text-violet-500"></i> إضافة طبيب جديد</h3>
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
</section>

<script>
async function loadDoctors() {
    const data = await apiFetch('/api/doctors');
    const tb = document.getElementById('tbody-doctors');
    if(!tb) return;
    if(!data?.length) { tb.innerHTML = `<tr><td colspan="4" class="text-center py-6 text-text-main opacity-40 text-xs">لا توجد بيانات بعد</td></tr>`; return; }
    tb.innerHTML = data.map((d,i)=>`<tr class="table-row">
        <td class="text-center">${i+1}</td>
        <td class="font-bold">${d.name}</td>
        <td class="text-center text-emerald-600 font-bold">${Number(d.fee).toLocaleString()} د.ع</td>
        <td class="text-center">
            <button onclick="deleteDoc(${d.id})" class="w-7 h-7 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center mx-auto hover-press">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </td>
    </tr>`).join('');
}

async function addDoctor() {
    const name = document.getElementById('inp-doc-name').value.trim();
    const fee  = document.getElementById('inp-doc-fee').value.trim();
    if(!name) return showToast('الرجاء كتابة اسم الطبيب','error');
    await apiFetch('/api/doctors','POST',{name,fee:fee||0});
    document.getElementById('inp-doc-name').value='';
    document.getElementById('inp-doc-fee').value='';
    loadDoctors();
    showToast('تمت إضافة الطبيب بنجاح ✅');
}

async function deleteDoc(id) {
    await apiFetch(`/api/doctors/${id}`,'DELETE');
    loadDoctors();
    showToast('تم الحذف');
}

window.initDoctorsPage = function() {
    loadDoctors();
};
</script>
