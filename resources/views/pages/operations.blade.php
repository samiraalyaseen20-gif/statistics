{{-- PAGE: OPERATIONS MANAGEMENT --}}
<section id="page-operations" class="page-section space-y-6 hidden">
    <div class="custom-card p-6 rounded-2xl">
        <div class="flex flex-col sm:flex-row gap-3">
            <input id="inp-op-name" type="text" placeholder="اسم العملية" class="flex-1 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
            <select id="inp-op-class" class="custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main font-['Tajawal']">
                <option value="صغرى">صغرى</option>
                <option value="وسطى (حقن)">وسطى (حقن)</option>
                <option value="وسطى (ليزر)">وسطى (ليزر)</option>
                <option value="كبرى">كبرى</option>
                <option value="فوق الكبرى">فوق الكبرى</option>
                <option value="خاصة">خاصة</option>
            </select>
            <input id="inp-op-order" type="number" placeholder="تسلسل العرض" value="0" class="w-32 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
            <button onclick="addOp()" class="py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-rose-500 to-rose-400 hover-press flex items-center gap-2">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i> إضافة
            </button>
        </div>
    </div>

    <div class="custom-card p-6 rounded-2xl">
        <div class="overflow-x-auto"><table class="custom-table text-xs" id="tbl-operations">
            <thead><tr><th class="w-8">ت</th><th>اسم العملية</th><th class="text-center min-w-[120px]">التصنيف</th><th class="text-center w-24">تسلسل العرض</th><th class="text-center w-20">حذف</th></tr></thead>
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
    if(!data?.length) { tb.innerHTML = `<tr><td colspan="5" class="text-center py-6 text-text-main opacity-40 text-xs">لا توجد بيانات بعد</td></tr>`; return; }
    tb.innerHTML = data.map((d,i)=>`<tr class="table-row" data-op-row-id="${d.id}">
        <td class="text-center">${i+1}</td>
        <td>
            <input type="text" value="${d.name}" 
                class="w-full text-right bg-transparent border-none focus:outline-none focus:ring-1 focus:ring-rose-500 rounded-lg py-1 px-2 font-bold text-text-main"
                onchange="saveOpRow(${d.id})">
        </td>
        <td class="text-center font-['Tajawal']">
            <select class="text-[9px] font-bold px-2.5 py-0.5 rounded-full border-none focus:outline-none cursor-pointer ${opClassColors[d.classification]||''}"
                onchange="saveOpRow(${d.id})">
                <option value="صغرى" ${d.classification === 'صغرى' ? 'selected' : ''}>صغرى</option>
                <option value="وسطى (حقن)" ${d.classification === 'وسطى (حقن)' ? 'selected' : ''}>وسطى (حقن)</option>
                <option value="وسطى (ليزر)" ${d.classification === 'وسطى (ليزر)' ? 'selected' : ''}>وسطى (ليزر)</option>
                <option value="كبرى" ${d.classification === 'كبرى' ? 'selected' : ''}>كبرى</option>
                <option value="فوق الكبرى" ${d.classification === 'فوق الكبرى' ? 'selected' : ''}>فوق الكبرى</option>
                <option value="خاصة" ${d.classification === 'خاصة' ? 'selected' : ''}>خاصة</option>
            </select>
        </td>
        <td class="text-center">
            <input type="number" value="${d.display_order || 0}" 
                class="w-16 text-center custom-inset border-none focus:outline-none rounded-lg py-1 px-1.5 font-bold text-text-main" 
                onchange="saveOpRow(${d.id})">
        </td>
        <td class="text-center">
            <button onclick="deleteOp(${d.id})" class="w-7 h-7 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center mx-auto hover-press">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </td>
    </tr>`).join('');
}

async function saveOpRow(id) {
    const tr = document.querySelector(`tr[data-op-row-id="${id}"]`);
    if (!tr) return;
    const name = tr.querySelector('input[type="text"]').value.trim();
    const classification = tr.querySelector('select').value;
    const order = tr.querySelector('input[type="number"]').value;

    if (!name) {
        showToast('الرجاء كتابة اسم العملية', 'error');
        return;
    }

    try {
        await apiFetch(`/api/operation-names/${id}`, 'PUT', {
            name: name,
            classification: classification,
            display_order: parseInt(order) || 0
        });
        showToast('تم تحديث بيانات العملية بنجاح');
        loadOps(); // Reloads table to refresh classes/colors
    } catch (e) {
        showToast('فشل تحديث بيانات العملية', 'error');
    }
}

async function addOp() {
    const name = document.getElementById('inp-op-name').value.trim();
    const cls  = document.getElementById('inp-op-class').value;
    const order = document.getElementById('inp-op-order').value || 0;
    if(!name) return showToast('الرجاء كتابة اسم العملية','error');
    await apiFetch('/api/operation-names','POST',{name,classification:cls, display_order: parseInt(order) || 0});
    document.getElementById('inp-op-name').value='';
    document.getElementById('inp-op-order').value='0';
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
