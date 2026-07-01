{{-- PAGE: USER MANAGEMENT (إدارة المستخدمين والصلاحيات) --}}
<section id="page-users" class="page-section space-y-6 hidden">

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        
        {{-- Column 1: Add New User Form --}}
        <div class="custom-card p-5 rounded-2xl space-y-4 h-fit">
            <h3 class="text-xs font-black text-text-main flex items-center gap-2 pb-2 border-b border-slate-200/10">
                <i data-lucide="user-plus" class="w-4 h-4 text-pink-500"></i>
                <span>إضافة مستخدم جديد</span>
            </h3>

            <form id="form-add-user" onsubmit="createUser(event)" class="space-y-3">
                <div class="flex flex-col gap-1">
                    <label class="text-[10px] font-bold text-slate-400">الاسم الكامل:</label>
                    <input type="text" id="user-new-name" required placeholder="مثال: أحمد علي"
                        class="custom-inset border-none focus:outline-none rounded-xl py-2 px-3 text-xs font-bold text-text-main">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-[10px] font-bold text-slate-400">اسم المستخدم (Username):</label>
                    <input type="text" id="user-new-username" required placeholder="مثال: ahmed_ali"
                        class="custom-inset border-none focus:outline-none rounded-xl py-2 px-3 text-xs font-bold text-text-main">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-[10px] font-bold text-slate-400">كلمة المرور:</label>
                    <input type="password" id="user-new-password" required placeholder="••••••"
                        class="custom-inset border-none focus:outline-none rounded-xl py-2 px-3 text-xs font-bold text-text-main">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-[10px] font-bold text-slate-400">الدور الوظيفي:</label>
                    <select id="user-new-role" required onchange="onRoleChange()"
                        class="custom-inset border-none focus:outline-none rounded-xl py-2 px-3 text-xs font-bold text-text-main font-['Tajawal']">
                        <option value="employee">موظف (افتراضي مقفل)</option>
                        <option value="visitor">زائر (قراءة فقط للتقارير)</option>
                        <option value="admin">مدير نظام (صلاحيات كاملة)</option>
                    </select>
                </div>

                <div id="new-user-lock-notice" class="p-3 bg-rose-500/5 rounded-xl border border-rose-500/10 text-[9px] font-bold text-rose-500 flex items-center gap-1.5 mt-2">
                    <i data-lucide="shield-alert" class="w-4 h-4 shrink-0"></i>
                    <span>ملاحظة: الموظف الجديد ينشأ بدون أي صلاحيات تلقائياً (مقفل). يمكنك منحه الصلاحيات بعد الحفظ.</span>
                </div>

                <button type="submit"
                    class="w-full py-2 rounded-xl text-xs font-bold text-white bg-gradient-to-r from-pink-500 to-rose-500 hover-press flex items-center justify-center gap-1.5 shadow-md mt-4">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    <span>إنشاء الحساب</span>
                </button>
            </form>
        </div>

        {{-- Column 2: Users List & Permissions --}}
        <div class="custom-card p-5 rounded-2xl space-y-4 xl:col-span-2">
            <div class="flex items-center justify-between">
                <h3 class="text-xs font-black text-text-main flex items-center gap-2">
                    <i data-lucide="users" class="w-4 h-4 text-violet-500"></i>
                    <span>قائمة مستخدمي النظام والصلاحيات</span>
                </h3>
                <button onclick="loadUsersList()"
                    class="py-1 px-2.5 rounded-lg text-[10px] font-bold bg-slate-200/20 text-text-main hover-press flex items-center gap-1">
                    <i data-lucide="refresh-cw" class="w-3.5 h-3.5"></i>
                    <span>تحديث</span>
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200/10 text-[9px] font-bold text-slate-400">
                            <th class="pb-2">المستخدم</th>
                            <th class="pb-2">الدور</th>
                            <th class="pb-2 text-center">رؤية التقارير</th>
                            <th class="pb-2 text-center">إدخال البيانات</th>
                            <th class="pb-2 text-center">إدارة التعريفات</th>
                            <th class="pb-2 text-center">إدارة المستخدمين</th>
                            <th class="pb-2 text-center">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-users-list" class="divide-y divide-slate-200/5 text-[10px] font-bold text-text-main">
                        {{-- Populated dynamically via AJAX --}}
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</section>

<script>
function onRoleChange() {
    const role = document.getElementById('user-new-role').value;
    const notice = document.getElementById('new-user-lock-notice');
    if (role === 'employee') {
        notice.classList.remove('hidden');
    } else {
        notice.classList.add('hidden');
    }
}

// Load Users
async function loadUsersList() {
    try {
        const response = await fetch('/api/users');
        if (!response.ok) return;
        const users = await response.json();
        renderUsersTable(users);
    } catch(e) {
        console.error("Failed to load users", e);
    }
}

function renderUsersTable(users) {
    const tbody = document.getElementById('tbody-users-list');
    if (!tbody) return;
    tbody.innerHTML = '';

    const currentUserId = {{ auth()->id() }};

    users.forEach(u => {
        let roleBadge = '';
        if (u.role === 'admin') {
            roleBadge = '<span class="px-2 py-0.5 rounded-full bg-rose-500/10 text-rose-500 text-[8px]">مدير عام</span>';
        } else if (u.role === 'visitor') {
            roleBadge = '<span class="px-2 py-0.5 rounded-full bg-sky-500/10 text-sky-500 text-[8px]">زائر</span>';
        } else {
            roleBadge = '<span class="px-2 py-0.5 rounded-full bg-violet-500/10 text-violet-500 text-[8px]">موظف</span>';
        }

        const isEmp = u.role === 'employee';
        const disabledAttr = isEmp ? '' : 'disabled';
        const opacityClass = isEmp ? '' : 'opacity-40';

        tbody.innerHTML += `
            <tr class="table-row">
                <td class="py-3">
                    <div class="font-bold text-text-main">${u.name}</div>
                    <div class="text-[9px] text-slate-400 font-normal">@${u.username}</div>
                </td>
                <td>${roleBadge}</td>
                
                <!-- Permissions Toggles -->
                <td class="text-center">
                    <input type="checkbox" ${u.can_view_reports ? 'checked' : ''} ${disabledAttr}
                        onchange="toggleUserPermission(${u.id}, 'can_view_reports', this.checked)"
                        class="w-4 h-4 accent-pink-500 cursor-pointer ${opacityClass}">
                </td>
                <td class="text-center">
                    <input type="checkbox" ${u.can_enter_data ? 'checked' : ''} ${disabledAttr}
                        onchange="toggleUserPermission(${u.id}, 'can_enter_data', this.checked)"
                        class="w-4 h-4 accent-pink-500 cursor-pointer ${opacityClass}">
                </td>
                <td class="text-center">
                    <input type="checkbox" ${u.can_manage_lookups ? 'checked' : ''} ${disabledAttr}
                        onchange="toggleUserPermission(${u.id}, 'can_manage_lookups', this.checked)"
                        class="w-4 h-4 accent-pink-500 cursor-pointer ${opacityClass}">
                </td>
                <td class="text-center">
                    <input type="checkbox" ${u.can_manage_users ? 'checked' : ''} ${disabledAttr}
                        onchange="toggleUserPermission(${u.id}, 'can_manage_users', this.checked)"
                        class="w-4 h-4 accent-pink-500 cursor-pointer ${opacityClass}">
                </td>

                <td class="text-center">
                    ${u.id === currentUserId 
                        ? '<span class="text-[9px] text-slate-400">حسابك الحالي</span>' 
                        : `<button onclick="deleteUser(${u.id})" class="text-rose-500 hover:text-rose-700 hover-press p-1"><i data-lucide="trash-2" class="w-4 h-4"></i></button>`
                    }
                </td>
            </tr>
        `;
    });

    if (window.lucide) lucide.createIcons();
}

// Create User
async function createUser(e) {
    e.preventDefault();
    const name = document.getElementById('user-new-name').value;
    const username = document.getElementById('user-new-username').value;
    const password = document.getElementById('user-new-password').value;
    const role = document.getElementById('user-new-role').value;

    try {
        const response = await fetch('/api/users', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ name, username, password, role })
        });

        if (response.ok) {
            showToast('تم إنشاء مستخدم جديد بنجاح', 'success');
            document.getElementById('form-add-user').reset();
            onRoleChange();
            loadUsersList();
        } else {
            const err = await response.json();
            showToast(err.error || 'اسم المستخدم مستخدم بالفعل أو البيانات خاطئة', 'error');
        }
    } catch(e) {
        showToast('خطأ بالشبكة', 'error');
    }
}

// Toggle Employee Permissions (AJAX PUT)
async function toggleUserPermission(userId, permissionField, isChecked) {
    // 1. Get current checkbox states
    const row = event.target.closest('tr');
    const canView = row.querySelector('input[onchange*="can_view_reports"]').checked;
    const canEnter = row.querySelector('input[onchange*="can_enter_data"]').checked;
    const canLookups = row.querySelector('input[onchange*="can_manage_lookups"]').checked;
    const canUsers = row.querySelector('input[onchange*="can_manage_users"]').checked;

    try {
        const response = await fetch(`/api/users/${userId}/permissions`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                can_view_reports: canView,
                can_enter_data: canEnter,
                can_manage_lookups: canLookups,
                can_manage_users: canUsers
            })
        });

        if (response.ok) {
            showToast('تم تحديث صلاحية الموظف بنجاح', 'success');
        } else {
            showToast('فشل تحديث الصلاحيات', 'error');
            loadUsersList(); // rollback values
        }
    } catch(e) {
        showToast('خطأ بالاتصال', 'error');
        loadUsersList();
    }
}

// Delete User
async function deleteUser(userId) {
    if (!confirm('هل أنت متأكد من حذف هذا المستخدم؟ لا يمكن التراجع عن هذا الإجراء.')) return;

    try {
        const response = await fetch(`/api/users/${userId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });

        if (response.ok) {
            showToast('تم حذف المستخدم بنجاح', 'success');
            loadUsersList();
        } else {
            showToast('فشل حذف المستخدم', 'error');
        }
    } catch(e) {
        showToast('خطأ بالاتصال', 'error');
    }
}

// Global page initialization hook
window.initUsersPage = function() {
    loadUsersList();
}
</script>
