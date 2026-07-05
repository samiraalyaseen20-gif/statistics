{{-- PAGE: OPERATIONS MANAGEMENT --}}
<section id="page-operations" class="page-section space-y-6 hidden">
    <div class="custom-card p-6 rounded-2xl">
        <div class="flex flex-col sm:flex-row gap-3">
            <input id="inp-op-name" type="text" placeholder="اسم العملية" class="flex-1 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
            <input id="inp-op-order" type="number" placeholder="تسلسل العرض" value="0" class="w-32 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
            <button onclick="addOp()" class="py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-rose-500 to-rose-400 hover-press flex items-center gap-2">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i> إضافة
            </button>
        </div>
    </div>

    <div class="custom-card p-6 rounded-2xl">
        <div class="overflow-x-auto"><table class="custom-table text-xs" id="tbl-operations">
            <thead><tr><th class="w-8">ت</th><th>اسم العملية</th><th class="text-center w-24">تسلسل العرض</th><th class="text-center w-20">حذف</th></tr></thead>
            <tbody id="tbody-operations"></tbody>
        </table></div>
    </div>
</section>

<script>
async function loadOps() {
    const data = await apiFetch('/api/operation-names');
    const tb = document.getElementById('tbody-operations');
    if(!tb) return;
    if(!data?.length) { tb.innerHTML = `<tr><td colspan="4" class="text-center py-6 text-text-main opacity-40 text-xs">لا توجد بيانات بعد</td></tr>`; return; }
    tb.innerHTML = data.map((d,i)=>`<tr class="table-row">
        <td class="text-center">${i+1}</td>
        <td class="font-bold">${d.name}</td>
        <td class="text-center">
            <input type="number" value="${d.display_order || 0}" 
                class="w-16 text-center custom-inset border-none focus:outline-none rounded-lg py-1 px-1.5 font-bold text-text-main op-order-input" 
                onchange="updateOp(${d.id}, '${d.name}', this.value)">
        </td>
        <td class="text-center">
            <button onclick="deleteOp(${d.id})" class="w-7 h-7 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center mx-auto hover-press">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </td>
    </tr>`).join('');
}

async function updateOp(id, name, order) {
    try {
        await apiFetch(`/api/operation-names/${id}`, 'PUT', {
            name: name,
            display_order: parseInt(order) || 0
        });
        showToast('تم تحديث العملية بنجاح');
        loadOps();
    } catch (e) {
        showToast('فشل تحديث العملية', 'error');
    }
}

async function addOp() {
    const name = document.getElementById('inp-op-name').value.trim();
    const order = document.getElementById('inp-op-order').value || 0;
    if(!name) return showToast('الرجاء كتابة اسم العملية','error');
    try {
        await apiFetch('/api/operation-names','POST',{
            name,
            display_order: parseInt(order) || 0
        });
        document.getElementById('inp-op-name').value='';
        document.getElementById('inp-op-order').value='0';
        loadOps();
        showToast('تمت إضافة العملية بنجاح ✅');
    } catch (e) {
        showToast('فشل إضافة العملية', 'error');
    }
}

async function deleteOp(id) {
    if(!confirm('هل أنت متأكد من حذف هذه العملية؟')) return;
    try {
        await apiFetch(`/api/operation-names/${id}`,'DELETE');
        loadOps();
        showToast('تم الحذف');
    } catch (e) {
        showToast('فشل الحذف', 'error');
    }
}

window.initOperationsPage = function() {
    loadOps();
};
</script>
