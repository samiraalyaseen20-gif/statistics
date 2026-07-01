<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // عرض كل المستخدمين (للأدمن فقط)
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'غير مصرح لك بالوصول'], 403);
        }

        $users = User::orderBy('id', 'desc')->get();
        return response()->json($users);
    }

    // إضافة مستخدم جديد (للأدمن فقط)
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'غير مصرح لك بالوصول'], 403);
        }

        $request->validate([
            'name'     => 'required|string|max:255',
            'username' => 'required|string|unique:users,username|max:255',
            'password' => 'required|string|min:4',
            'role'     => 'required|in:admin,employee,visitor',
        ]);

        // المستخدم الجديد (خاصة الموظف) يبدأ بصلاحيات مقفلة بالكامل افتراضياً
        $user = User::create([
            'name'               => $request->name,
            'username'           => $request->username,
            'password'           => Hash::make($request->password),
            'role'               => $request->role,
            'can_view_reports'   => false,
            'can_enter_data'     => false,
            'can_manage_lookups' => false,
            'can_manage_users'   => false,
        ]);

        return response()->json($user, 201);
    }

    // تعديل صلاحيات الموظف (للأدمن فقط)
    public function updatePermissions(Request $request, User $user)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'غير مصرح لك بالوصول'], 403);
        }

        // لا يمكن تعديل صلاحيات الآدمن نفسه لأن له صلاحية كاملة دائماً
        if ($user->role === 'admin') {
            return response()->json(['error' => 'لا يمكن تعديل صلاحيات المدير العام'], 400);
        }

        $request->validate([
            'can_view_reports'   => 'required|boolean',
            'can_enter_data'     => 'required|boolean',
            'can_manage_lookups' => 'required|boolean',
            'can_manage_users'   => 'required|boolean',
        ]);

        $user->update([
            'can_view_reports'   => $request->can_view_reports,
            'can_enter_data'     => $request->can_enter_data,
            'can_manage_lookups' => $request->can_manage_lookups,
            'can_manage_users'   => $request->can_manage_users,
        ]);

        return response()->json($user);
    }

    // حذف مستخدم (للأدمن فقط)
    public function destroy(User $user)
    {
        if (Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'غير مصرح لك بالوصول'], 403);
        }

        // منع حذف الحساب الحالي الذي يسجل منه الأدمن
        if ($user->id === Auth::id()) {
            return response()->json(['error' => 'لا يمكنك حذف حسابك الحالي'], 400);
        }

        $user->delete();
        return response()->json(['ok' => true]);
    }
}
