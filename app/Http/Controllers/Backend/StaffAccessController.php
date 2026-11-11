<?php

namespace App\Http\Controllers\Backend;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class StaffAccessController extends Controller
{
    public function index(Request $request): View
    {
        $activeTab = $this->allowedTab($request, [
            'users' => 'users.view',
            'roles' => 'roles.view',
            'permissions' => 'permissions.view',
        ], 'users');
        $actor = $request->user();

        $users = ! $actor->allows('users.view')
            ? $this->emptyPage()
            : User::with('roles')
            ->when($request->filled('q'), function ($q) use ($request) {
                $term = '%' . $request->q . '%';
                $q->where(function ($inner) use ($term) {
                    $inner->where('name', 'like', $term)
                        ->orWhere('email', 'like', $term)
                        ->orWhere('phone', 'like', $term);
                });
            })
            ->when($request->get('type') === 'staff', function ($q) {
                $q->whereHas('roles', fn ($role) => $role->whereIn('slug', [
                    'super_admin', 'admin', 'receptionist', 'finance', 'housekeeping',
                ]));
            })
            ->latest()
            ->paginate(10);

        $roles = $actor->allows('roles.view')
            ? Role::with('permissions')->withCount('permissions', 'users')->latest()->paginate(10, ['*'], 'roles_page')->withQueryString()
            : $this->emptyPage();
        $permissions = $actor->allows('permissions.view')
            ? Permission::latest()->paginate(10)
            : $this->emptyPage();

        return view('backend.staff-access.index', compact('activeTab', 'users', 'roles', 'permissions'));
    }

    // Users
    public function storeUser(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30', 'unique:users,phone'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'is_active' => ['nullable', 'boolean'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['integer', 'exists:roles,id'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
            'is_active' => $request->boolean('is_active', true),
        ]);

        $user->roles()->sync($data['roles'] ?? []);

        return redirect()
            ->route('backend.staff-access.index', ['tab' => 'users'])
            ->with('success', 'User berhasil dibuat.');
    }

    public function updateUser(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:30', Rule::unique('users', 'phone')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'is_active' => ['nullable', 'boolean'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['integer', 'exists:roles,id'],
        ]);

        $roleIds = $data['roles'] ?? [];
        $active = $request->boolean('is_active', true);
        $keepsStaffRole = Role::query()
            ->whereIn('id', $roleIds)
            ->whereIn('slug', User::STAFF_ROLES)
            ->exists();

        if ($user->id === $request->user()->id && (! $active || ! $keepsStaffRole)) {
            return back()->with('error', 'Akun yang sedang dipakai harus tetap aktif dan memiliki role staf.');
        }

        $isLastSuperAdmin = $user->roles()->where('slug', 'super_admin')->exists()
            && ! User::query()
                ->whereKeyNot($user->id)
                ->where('is_active', true)
                ->whereHas('roles', fn ($query) => $query->where('slug', 'super_admin'))
                ->exists();
        $keepsSuperAdmin = Role::query()->whereIn('id', $roleIds)->where('slug', 'super_admin')->exists();

        if ($isLastSuperAdmin && (! $active || ! $keepsSuperAdmin)) {
            return back()->with('error', 'Super Admin terakhir tidak dapat dinonaktifkan atau dilepas rolenya.');
        }

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'is_active' => $active,
        ]);

        if (! empty($data['password'])) {
            $user->update(['password' => $data['password']]);
        }

        $user->roles()->sync($roleIds);

        return redirect()
            ->route('backend.staff-access.index', ['tab' => 'users'])
            ->with('success', 'User berhasil diperbarui.');
    }

    public function destroyUser(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun yang sedang login.');
        }

        $user->delete();

        return redirect()
            ->route('backend.staff-access.index', ['tab' => 'users'])
            ->with('success', 'User berhasil dihapus.');
    }

    // Roles
    public function storeRole(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:roles,slug'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['integer', 'exists:permissions,id'],
        ]);

        $role = Role::create([
            'name' => $data['name'],
            'slug' => $this->roleSlug($data['slug'] ?? null, $data['name']),
            'description' => $data['description'] ?? null,
            'is_active' => $request->boolean('is_active', true),
        ]);

        $role->permissions()->sync($data['permissions'] ?? []);

        return redirect()
            ->route('backend.staff-access.index', ['tab' => 'roles'])
            ->with('success', 'Role berhasil dibuat.');
    }

    public function updateRole(Request $request, Role $role): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('roles', 'slug')->ignore($role->id)],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
            'permissions' => ['nullable', 'array'],
            'permissions.*' => ['integer', 'exists:permissions,id'],
        ]);

        $role->update([
            'name' => $data['name'],
            'slug' => $this->roleSlug($data['slug'] ?? null, $data['name'], $role->id),
            'description' => $data['description'] ?? null,
            'is_active' => $request->boolean('is_active', true),
        ]);

        $role->permissions()->sync($data['permissions'] ?? []);

        return redirect()
            ->route('backend.staff-access.index', ['tab' => 'roles'])
            ->with('success', 'Role berhasil diperbarui.');
    }

    public function destroyRole(Role $role): RedirectResponse
    {
        if ($role->slug === 'super_admin') {
            return back()->with('error', 'Role Super Admin tidak dapat dihapus.');
        }

        $role->permissions()->detach();
        $role->users()->detach();
        $role->delete();

        return redirect()
            ->route('backend.staff-access.index', ['tab' => 'roles'])
            ->with('success', 'Role berhasil dihapus.');
    }

    // Permissions
    public function storePermission(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:permissions,slug'],
            'module' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
        ]);

        Permission::create([
            'name' => $data['name'],
            'slug' => $this->permissionSlug($data['slug'] ?? null, $data['name']),
            'module' => $data['module'] ?? null,
            'description' => $data['description'] ?? null,
        ]);

        return redirect()
            ->route('backend.staff-access.index', ['tab' => 'permissions'])
            ->with('success', 'Permission berhasil dibuat.');
    }

    public function updatePermission(Request $request, Permission $permission): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('permissions', 'slug')->ignore($permission->id)],
            'module' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
        ]);

        $permission->update([
            'name' => $data['name'],
            'slug' => $this->permissionSlug($data['slug'] ?? null, $data['name'], $permission->id),
            'module' => $data['module'] ?? null,
            'description' => $data['description'] ?? null,
        ]);

        return redirect()
            ->route('backend.staff-access.index', ['tab' => 'permissions'])
            ->with('success', 'Permission berhasil diperbarui.');
    }

    public function destroyPermission(Permission $permission): RedirectResponse
    {
        $permission->roles()->detach();
        $permission->delete();

        return redirect()
            ->route('backend.staff-access.index', ['tab' => 'permissions'])
            ->with('success', 'Permission berhasil dihapus.');
    }

    private function roleSlug(?string $slug, string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug((string) $slug);
        if ($slug === '') {
            return $this->uniqueSlug($name, Role::class, $ignoreId);
        }

        $taken = Role::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
            ->exists();

        if ($taken) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'slug' => 'Slug role sudah digunakan.',
            ]);
        }

        return $slug;
    }

    private function permissionSlug(?string $slug, string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug((string) ($slug ?: $name), '.');
        if ($slug === '') {
            $slug = 'permission';
        }

        $base = $slug;
        $suffix = 2;
        while (Permission::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
            ->exists()) {
            $slug = $base.'.'.$suffix;
            $suffix++;
        }

        return $slug;
    }
}
