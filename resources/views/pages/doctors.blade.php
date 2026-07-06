{{-- PAGE: DOCTORS MANAGEMENT --}}
<section id="page-doctors" class="page-section space-y-6 hidden">
    <div class="custom-card p-6 rounded-2xl">
        <div class="flex flex-col sm:flex-row gap-3">
            <input id="inp-doc-name" type="text" placeholder="اسم الطبيب" class="flex-1 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
            <input id="inp-doc-order" type="number" placeholder="تسلسل العرض" value="0" class="w-32 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
            <button onclick="addDoctor()" class="py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-violet-500 to-violet-400 hover-press flex items-center gap-2">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i> إضافة
            </button>
        </div>
    </div>

    <div class="custom-card p-6 rounded-2xl">
        <div class="overflow-x-auto"><table class="custom-table text-xs" id="tbl-doctors">
            <thead><tr><th class="w-8">ت</th><th>اسم الطبيب</th><th class="text-center w-24">تسلسل العرض</th><th class="text-center w-20">تعديل</th><th class="text-center w-20">حذف</th></tr></thead>
            <tbody id="tbody-doctors"></tbody>
        </table></div>
    </div>
</section>

<script>
async function loadDoctors() {
    const data = await apiFetch('/api/doctors');
    const tb = document.getElementById('tbody-doctors');
    if(!tb) return;
    if(!data?.length) { tb.innerHTML = `<tr><td colspan="5" class="text-center py-6 text-text-main opacity-40 text-xs">لا توجد بيانات بعد</td></tr>`; return; }
    tb.innerHTML = data.map((d,i)=>`<tr class="table-row">
        <td class="text-center">${i+1}</td>
        <td class="font-bold">
            <input type="text" id="doc-name-${d.id}" value="${d.name}" disabled
                class="w-full bg-transparent border-b border-transparent focus:border-violet-500 focus:outline-none px-2 py-1 text-text-main font-bold disabled:opacity-90 disabled:cursor-not-allowed">
        </td>
        <td class="text-center">
            <input type="number" id="doc-order-${d.id}" value="${d.display_order || 0}" disabled
                class="w-16 text-center custom-inset border-none focus:outline-none rounded-lg py-1 px-1.5 font-bold text-text-main disabled:opacity-90 disabled:cursor-not-allowed" >
        </td>
        <td class="text-center">
            <button onclick="toggleEditDoc(${d.id})" id="btn-edit-doc-${d.id}" class="w-7 h-7 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center mx-auto hover-press">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
            </button>
        </td>
        <td class="text-center">
            <button onclick="deleteDoc(${d.id})" class="w-7 h-7 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center mx-auto hover-press">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </td>
    </tr>`).join('');
}

function toggleEditDoc(id) {
    const inputName = document.getElementById(`doc-name-${id}`);
    const inputOrder = document.getElementById(`doc-order-${id}`);
    const btn = document.getElementById(`btn-edit-doc-${id}`);
    if (!inputName || !btn) return;

    if (inputName.hasAttribute('disabled')) {
        inputName.removeAttribute('disabled');
        if (inputOrder) inputOrder.removeAttribute('disabled');
        inputName.focus();
        btn.classList.remove('bg-amber-100', 'text-amber-600');
        btn.classList.add('bg-emerald-100', 'text-emerald-600');
        btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>`;
    } else {
        const name = inputName.value.trim();
        const order = inputOrder ? parseInt(inputOrder.value) || 0 : 0;
        if (!name) {
            showToast('الرجاء كتابة اسم الطبيب', 'error');
            return;
        }
        updateDoctorFields(id, name, order);
        inputName.setAttribute('disabled', 'true');
        if (inputOrder) inputOrder.setAttribute('disabled', 'true');
        btn.classList.remove('bg-emerald-100', 'text-emerald-600');
        btn.classList.add('bg-amber-100', 'text-amber-600');
        btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>`;
    }
}

async function updateDoctorFields(id, name, order) {
    try {
        await apiFetch(`/api/doctors/${id}`, 'PUT', {
            name: name,
            display_order: parseInt(order) || 0
        });
        showToast('تم تحديث بيانات الطبيب بنجاح');
    } catch (e) {
        showToast('فشل تحديث البيانات', 'error');
    }
}

async function addDoctor() {
    const name = document.getElementById('inp-doc-name').value.trim();
    const order = document.getElementById('inp-doc-order').value || 0;
    if(!name) return showToast('الرجاء كتابة اسم الطبيب','error');
    await apiFetch('/api/doctors','POST',{name, display_order: parseInt(order) || 0});
    document.getElementById('inp-doc-name').value='';
    document.getElementById('inp-doc-order').value='0';
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
