{{-- PAGE: LAB TEST TYPES MANAGEMENT --}}
<section id="page-lab_test_types" class="page-section space-y-6 hidden">
    <div class="custom-card p-5 rounded-2xl flex flex-col sm:flex-row gap-4 items-center justify-between">
        <div>
            <h2 class="text-base font-bold text-text-main flex items-center gap-2">
                <i data-lucide="test-tube" class="w-5 h-5 text-purple-500"></i>
                إدارة تحاليل المختبر
            </h2>
            <p class="text-[11px] text-text-main opacity-60 mt-0.5">تسجيل أنواع تحاليل المختبر الطبية بالمركز</p>
        </div>
    </div>

    <div class="custom-card p-6 rounded-2xl">
        <h3 class="text-sm font-bold text-text-main flex items-center gap-2 mb-4"><i data-lucide="plus" class="w-4 h-4 text-purple-500"></i> إضافة نوع تحليل جديد</h3>
        <div class="flex gap-3">
            <input id="inp-lab-test-name" type="text" placeholder="مثال: RBS" class="flex-1 custom-inset border-none rounded-xl py-2.5 px-4 text-xs font-medium focus:outline-none text-text-main">
            <button onclick="addLabTestType()" class="py-2.5 px-6 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-purple-500 to-purple-400 hover-press flex items-center gap-2">
                <i data-lucide="plus" class="w-3.5 h-3.5"></i> إضافة
            </button>
        </div>
    </div>

    <div class="custom-card p-6 rounded-2xl">
        <div class="overflow-x-auto"><table class="custom-table text-xs" id="tbl-lab-test-types">
            <thead><tr><th class="w-8">ت</th><th>نوع التحليل المختبري</th><th class="text-center w-20">حذف</th></tr></thead>
            <tbody id="tbody-lab-test-types"></tbody>
        </table></div>
    </div>
</section>

<script>
async function loadLabTestTypes() {
    const data = await apiFetch('/api/lab-test-types');
    const tb = document.getElementById('tbody-lab-test-types');
    if(!tb) return;
    if(!data?.length) { tb.innerHTML = `<tr><td colspan="3" class="text-center py-6 text-text-main opacity-40 text-xs">لا توجد بيانات بعد</td></tr>`; return; }
    tb.innerHTML = data.map((d,i)=>`<tr class="table-row">
        <td class="text-center">${i+1}</td>
        <td class="font-bold">${d.name}</td>
        <td class="text-center">
            <button onclick="deleteLabTestType(${d.id})" class="w-7 h-7 rounded-lg bg-rose-100 text-rose-600 flex items-center justify-center mx-auto hover-press">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </td>
    </tr>`).join('');
}

async function addLabTestType() {
    const name = document.getElementById('inp-lab-test-name').value.trim();
    if(!name) return showToast('الرجاء كتابة اسم التحليل','error');
    await apiFetch('/api/lab-test-types','POST',{name});
    document.getElementById('inp-lab-test-name').value='';
    loadLabTestTypes();
    showToast('تمت إضافة نوع التحليل بنجاح ✅');
}

async function deleteLabTestType(id) {
    await apiFetch(`/api/lab-test-types/${id}`,'DELETE');
    loadLabTestTypes();
    showToast('تم الحذف');
}

window.initLabTestTypesPage = function() {
    loadLabTestTypes();
};
</script>
