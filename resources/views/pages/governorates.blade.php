{{-- PAGE: GOVERNORATES MANAGEMENT --}}
<section id="page-governorates" class="page-section space-y-6 hidden">
    <div class="custom-card p-6 rounded-2xl">
        <div class="flex gap-3">
            <input id="inp-gov-name" type="text" placeholder="اسم المحافظة" class="flex-1 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
            <button onclick="addGov()" class="py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-emerald-500 to-emerald-400 hover-press flex items-center gap-2">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i> إضافة
            </button>
        </div>
    </div>

    <div class="custom-card p-6 rounded-2xl">
        <div class="overflow-x-auto"><table class="custom-table text-xs" id="tbl-governorates">
            <thead><tr><th class="w-8">ت</th><th>اسم المحافظة</th><th class="text-center w-20">تعديل</th><th class="text-center w-20">حذف</th></tr></thead>
            <tbody id="tbody-governorates"></tbody>
        </table></div>
    </div>
</section>

<script>
async function loadGovs() {
    const data = await apiFetch('/api/governorates');
    const tb = document.getElementById('tbody-governorates');
    if(!tb) return;
    if(!data?.length) { tb.innerHTML = `<tr><td colspan="4" class="text-center py-6 text-text-main opacity-40 text-xs">لا توجد بيانات بعد</td></tr>`; return; }
    tb.innerHTML = data.map((d,i)=>`<tr class="table-row">
        <td class="text-center">${i+1}</td>
        <td class="font-bold">
            <input type="text" id="gov-name-${d.id}" value="${d.name}" disabled
                class="w-full bg-transparent border-b border-transparent focus:border-violet-500 focus:outline-none px-2 py-1 text-text-main font-bold disabled:opacity-90 disabled:cursor-not-allowed">
        </td>
        <td class="text-center">
            <button onclick="toggleEditGov(${d.id})" id="btn-edit-gov-${d.id}" class="w-7 h-7 rounded-lg bg-amber-100 text-amber-600 flex items-center justify-center mx-auto hover-press">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
            </button>
        </td>
        <td class="text-center">
            <button onclick="deleteGov(${d.id})" class="w-7 h-7 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center mx-auto hover-press">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </td>
    </tr>`).join('');
}

function toggleEditGov(id) {
    const inputName = document.getElementById(`gov-name-${id}`);
    const btn = document.getElementById(`btn-edit-gov-${id}`);
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
            showToast('الرجاء كتابة اسم المحافظة', 'error');
            return;
        }
        updateGov(id, name);
        inputName.setAttribute('disabled', 'true');
        btn.classList.remove('bg-emerald-100', 'text-emerald-600');
        btn.classList.add('bg-amber-100', 'text-amber-600');
        btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>`;
    }
}

async function updateGov(id, name) {
    try {
        await apiFetch(`/api/governorates/${id}`, 'PUT', { name });
        showToast('تم تحديث اسم المحافظة بنجاح');
    } catch (e) {
        showToast('فشل تحديث اسم المحافظة', 'error');
    }
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
