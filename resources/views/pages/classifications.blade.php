{{-- PAGE: CLASSIFICATIONS MANAGEMENT --}}
<section id="page-classifications" class="page-section space-y-6 hidden">
    <div class="custom-card p-6 rounded-2xl">
        <div class="flex flex-col sm:flex-row gap-3">
            <input id="inp-class-name" type="text" placeholder="اسم التصنيف (مثال: صغرى، كبرى)" class="flex-1 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
            <input id="inp-class-order" type="number" placeholder="تسلسل العرض" value="0" class="w-32 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
            <button onclick="addClassification()" class="py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-violet-500 to-violet-400 hover-press flex items-center gap-2">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i> إضافة
            </button>
        </div>
    </div>

    <div class="custom-card p-6 rounded-2xl">
        <div class="overflow-x-auto"><table class="custom-table text-xs" id="tbl-classifications">
            <thead><tr><th class="w-8">ت</th><th>اسم التصنيف</th><th class="text-center w-24">تسلسل العرض</th><th class="text-center w-20">حذف</th></tr></thead>
            <tbody id="tbody-classifications"></tbody>
        </table></div>
    </div>
</section>

<script>
async function loadClassifications() {
    const data = await apiFetch('/api/classifications');
    const tb = document.getElementById('tbody-classifications');
    if(!tb) return;
    if(!data?.length) { tb.innerHTML = `<tr><td colspan="4" class="text-center py-6 text-text-main opacity-40 text-xs">لا توجد بيانات بعد</td></tr>`; return; }
    tb.innerHTML = data.map((d,i)=>`<tr class="table-row">
        <td class="text-center">${i+1}</td>
        <td class="font-bold">${d.name}</td>
        <td class="text-center">
            <input type="number" value="${d.display_order || 0}" 
                class="w-16 text-center custom-inset border-none focus:outline-none rounded-lg py-1 px-1.5 font-bold text-text-main" 
                onchange="updateClassificationOrder(${d.id}, '${d.name}', this.value)">
        </td>
        <td class="text-center">
            <button onclick="deleteClassification(${d.id})" class="w-7 h-7 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center mx-auto hover-press">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </td>
    </tr>`).join('');
}

async function updateClassificationOrder(id, name, order) {
    try {
        await apiFetch(`/api/classifications/${id}`, 'PUT', {
            name: name,
            display_order: parseInt(order) || 0
        });
        showToast('تم تحديث تسلسل العرض بنجاح');
    } catch (e) {
        showToast('فشل تحديث تسلسل العرض', 'error');
    }
}

async function addClassification() {
    const name = document.getElementById('inp-class-name').value.trim();
    const order = document.getElementById('inp-class-order').value || 0;
    if(!name) return showToast('الرجاء كتابة اسم التصنيف','error');
    try {
        await apiFetch('/api/classifications','POST',{
            name,
            display_order: parseInt(order) || 0
        });
        document.getElementById('inp-class-name').value='';
        document.getElementById('inp-class-order').value='0';
        loadClassifications();
        showToast('تمت إضافة التصنيف بنجاح ✅');
    } catch (e) {
        showToast('فشل إضافة التصنيف', 'error');
    }
}

async function deleteClassification(id) {
    if(!confirm('هل أنت متأكد من حذف هذا التصنيف؟')) return;
    try {
        await apiFetch(`/api/classifications/${id}`,'DELETE');
        loadClassifications();
        showToast('تم الحذف');
    } catch (e) {
        showToast('فشل الحذف', 'error');
    }
}

window.initClassificationsPage = function() {
    loadClassifications();
};
</script>
