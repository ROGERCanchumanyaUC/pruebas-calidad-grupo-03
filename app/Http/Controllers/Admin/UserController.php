<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Services\AuditService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::with('roles')->latest()->paginate(20);
        return view('admin.users', compact('users'));
    }

    public function edit(User $user): View
    {
        $roles = Role::orderBy('display_name')->get();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'roles' => ['nullable', 'array'],
            'roles.*' => ['exists:roles,id'],
        ]);

        $adminRole = Role::where('name', 'admin')->first();
        $adminRoleId = $adminRole ? $adminRole->id : null;
        
        $rolesInput = $request->input('roles', []);
        $isAdminSelected = $adminRoleId && in_array($adminRoleId, $rolesInput);

        $oldRoles = $user->roles->pluck('name')->toArray();
        $oldIsAdmin = $user->is_admin;

        // Sync roles in database
        $user->roles()->sync($rolesInput);
        
        // Update is_admin legacy field
        $user->update(['is_admin' => $isAdminSelected]);

        // Audit Log
        AuditService::log(
            'update_user_roles',
            User::class,
            $user->id,
            ['roles' => $oldRoles, 'is_admin' => $oldIsAdmin],
            ['roles' => $user->fresh()->roles->pluck('name')->toArray(), 'is_admin' => $isAdminSelected]
        );

        // Invalidate dashboard stats since role distribution might have changed
        \Illuminate\Support\Facades\Cache::forget('admin_dashboard_stats');

        return redirect()->route('admin.users')
            ->with('status', "Roles de {$user->name} actualizados correctamente.");
    }

    public function toggleAdmin(User $user): RedirectResponse
    {
        // Keep for routes compatibility, but redirect to edit roles
        return redirect()->route('admin.users.edit', $user);
    }
}
