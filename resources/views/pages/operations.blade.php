{{-- PAGE: OPERATIONS MANAGEMENT --}}
<section id="page-operations" class="page-section space-y-6 hidden">
    <div class="custom-card p-5 rounded-2xl flex flex-col sm:flex-row gap-4 items-center justify-between">
        <div>
            <h2 class="text-base font-bold text-text-main flex items-center gap-2">
                <i data-lucide="scissors" class="w-5 h-5 text-rose-500"></i>
                إدارة أسماء العمليات
            </h2>
            <p class="text-[11px] text-text-main opacity-60 mt-0.5">تسجيل أسماء وتصنيفات العمليات الجراحية المنجزة بالمركز</p>
        </div>
    </div>

    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-sm font-bold text-text-main flex items-center gap-2 mb-4"><i data-lucide="plus" class="w-4 h-4 text-rose-500"></i> إضافة عملية جديدة</h3>
        <div class="flex flex-col sm:flex-row gap-3">
            <input id="inp-op-name" type="text" placeholder="اسم العملية (مثال: رفع ساد + زراعة عدسة)" class="flex-1 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
            <select id="inp-op-class" class="custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
                <option value="صغرى">صغرى</option>
                <option value="وسطى (حقن)">وسطى (حقن)</option>
                <option value="وسطى (ليزر)">وسطى (ليزر)</option>
                <option value="كبرى">كبرى</option>
                <option value="فوق الكبرى">فوق الكبرى</option>
                <option value="خاصة">خاصة</option>
            </select>
            <button onclick="addOp()" class="py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-rose-500 to-rose-400 hover-press flex items-center gap-2">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i> إضافة
            </button>
        </div>
    </div>

    <div class="custom-card p-6 rounded-2xl">
        <div class="overflow-x-auto"><table class="custom-table text-xs" id="tbl-operations">
            <thead><tr><th class="w-8">ت</th><th>اسم العملية</th><th class="text-center min-w-[120px]">التصنيف</th><th class="text-center w-20">حذف</th></tr></thead>
            <tbody id="tbody-operations"></tbody>
        </table></div>
    </div>
</section>

<script>
const opClassColors = {
    'خاصة': 'bg-purple-100 text-purple-700',
    'فوق الكبرى': 'bg-rose-100 text-rose-700',
    'كبرى': 'bg-orange-100 text-orange-700',
    'وسطى (حقن)': 'bg-blue-100 text-blue-700',
    'وسطى (ليزر)': 'bg-cyan-100 text-cyan-700',
    'صغرى': 'bg-yellow-100 text-yellow-700'
};

async function loadOps() {
    const data = await apiFetch('/api/operation-names');
    const tb = document.getElementById('tbody-operations');
    if(!tb) return;
    if(!data?.length) { tb.innerHTML = `<tr><td colspan="4" class="text-center py-6 text-text-main opacity-40 text-xs">لا توجد بيانات بعد</td></tr>`; return; }
    tb.innerHTML = data.map((d,i)=>`<tr class="table-row">
        <td class="text-center">${i+1}</td>
        <td class="font-bold">${d.name}</td>
        <td class="text-center"><span class="text-[9px] font-bold px-2.5 py-0.5 rounded-full ${opClassColors[d.classification]||''}">${d.classification}</span></td>
        <td class="text-center">
            <button onclick="deleteOp(${d.id})" class="w-7 h-7 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center mx-auto hover-press">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </td>
    </tr>`).join('');
}

async function addOp() {
    const name = document.getElementById('inp-op-name').value.trim();
    const cls  = document.getElementById('inp-op-class').value;
    if(!name) return showToast('الرجاء كتابة اسم العملية','error');
    await apiFetch('/api/operation-names','POST',{name,classification:cls});
    document.getElementById('inp-op-name').value='';
    loadOps();
    showToast('تمت إضافة العملية بنجاح ✅');
}

async function deleteOp(id) {
    await apiFetch(`/api/operation-names/${id}`,'DELETE');
    loadOps();
    showToast('تم الحذف');
}

window.initOperationsPage = function() {
    loadOps();
};
</script>
