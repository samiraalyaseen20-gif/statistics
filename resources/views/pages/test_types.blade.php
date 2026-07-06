{{-- PAGE: TEST TYPES MANAGEMENT --}}
<section id="page-test_types" class="page-section space-y-6 hidden">
    <div class="custom-card p-6 rounded-2xl">
        <div class="flex gap-3">
            <input id="inp-test-name" type="text" placeholder="نوع الفحص" class="flex-1 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
            <button onclick="addTestType()" class="py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-orange-500 to-orange-400 hover-press flex items-center gap-2">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i> إضافة
            </button>
        </div>
    </div>

    <div class="custom-card p-6 rounded-2xl">
        <div class="overflow-x-auto"><table class="custom-table text-xs" id="tbl-test-types">
            <thead><tr><th class="w-8">ت</th><th>نوع الفحص البصري</th><th class="text-center w-20">تعديل</th><th class="text-center w-20">حذف</th></tr></thead>
            <tbody id="tbody-test-types"></tbody>
        </table></div>
    </div>
</section>

<script>
async function loadTestTypes() {
    const data = await apiFetch('/api/test-types');
    const tb = document.getElementById('tbody-test-types');
    if(!tb) return;
    if(!data?.length) { tb.innerHTML = `<tr><td colspan="4" class="text-center py-6 text-text-main opacity-40 text-xs">لا توجد بيانات بعد</td></tr>`; return; }
    tb.innerHTML = data.map((d,i)=>`<tr class="table-row">
        <td class="text-center">${i+1}</td>
        <td class="font-bold">
            <input type="text" id="test-name-${d.id}" value="${d.name}" disabled
                class="w-full bg-transparent border-b border-transparent focus:border-violet-500 focus:outline-none px-2 py-1 text-text-main font-bold disabled:opacity-90 disabled:cursor-not-allowed">
        </td>
        <td class="text-center">
            <button onclick="toggleEditTestType(${d.id})" id="btn-edit-test-${d.id}" class="w-7 h-7 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center mx-auto hover-press">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
            </button>
        </td>
        <td class="text-center">
            <button onclick="deleteTestType(${d.id})" class="w-7 h-7 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center mx-auto hover-press">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </td>
    </tr>`).join('');
}

function toggleEditTestType(id) {
    const inputName = document.getElementById(`test-name-${id}`);
    const btn = document.getElementById(`btn-edit-test-${id}`);
    if (!inputName || !btn) return;

    if (inputName.hasAttribute('disabled')) {
        inputName.removeAttribute('disabled');
        inputName.focus();
        btn.classList.remove('bg-amber-100', 'text-amber-600');
        btn.classList.add('bg-emerald-100', 'text-emerald-600');
        btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>`;
    } else {
        const name = inputName.value.trim();
        if (!name) {
            showToast('الرجاء كتابة اسم الفحص', 'error');
            return;
        }
        updateTestType(id, name);
        inputName.setAttribute('disabled', 'true');
        btn.classList.remove('bg-emerald-100', 'text-emerald-600');
        btn.classList.add('bg-amber-100', 'text-amber-600');
        btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>`;
    }
}

async function updateTestType(id, name) {
    try {
        await apiFetch(`/api/test-types/${id}`, 'PUT', { name });
        showToast('تم تحديث اسم الفحص بنجاح');
    } catch (e) {
        showToast('فشل تحديث اسم الفحص', 'error');
    }
}

async function addTestType() {
    const name = document.getElementById('inp-test-name').value.trim();
    if(!name) return showToast('الرجاء كتابة اسم الفحص','error');
    await apiFetch('/api/test-types','POST',{name});
    document.getElementById('inp-test-name').value='';
    loadTestTypes();
    showToast('تمت إضافة نوع الفحص بنجاح ✅');
}

async function deleteTestType(id) {
    await apiFetch(`/api/test-types/${id}`,'DELETE');
    loadTestTypes();
    showToast('تم الحذف');
}

window.initTestTypesPage = function() {
    loadTestTypes();
};
</script>
