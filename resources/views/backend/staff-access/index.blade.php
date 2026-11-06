@extends('backend.layouts.app')

@section('title', 'Staff & Access')

@section('breadcrumb')
    <a href="{{ route('backend.dashboard') }}" class="hover:text-primary">Dashboard</a>
    <span class="mx-2 text-outline-variant">/</span>
    <span class="font-medium text-primary">Staff & Access</span>
@endsection

@push('styles')
<style>
    .tab-btn.active {
        background-color: #1b2a32;
        color: white;
    }
    .tab-content {
        display: none;
    }
    .tab-content.active {
        display: block;
    }
</style>
@endpush

@section('content')
<div class="space-y-6">
    @include('backend.components.page-header', [
        'title' => 'Staff & Access',
        'subtitle' => 'Kelola pengguna, role, dan permission dalam satu halaman terpadu.',
    ])

    <!-- Tabs Navigation -->
    <div class="flex flex-wrap gap-2 border-b border-outline-variant/40 pb-1">
        @allows('users.view')
        <button onclick="switchTab('users')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'users' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">people</span>
            Users
        </button>
        @endallows
        @allows('roles.view')
        <button onclick="switchTab('roles')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'roles' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">admin_panel_settings</span>
            Roles
        </button>
        @endallows
        @allows('permissions.view')
        <button onclick="switchTab('permissions')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'permissions' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">key</span>
            Permissions
        </button>
        @endallows
    </div>

    <!-- Users Tab -->
    <div id="tab-users" class="tab-content {{ $activeTab === 'users' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Users</h3>
                <div class="flex gap-3">
                    <form method="GET" action="{{ route('backend.staff-access.index') }}" class="flex items-center gap-2">
                        <input type="hidden" name="tab" value="users">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama, email..." class="rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface placeholder:text-on-surface-variant/50 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        <button type="submit" class="rounded-lg bg-primary-container px-4 py-2 text-sm font-semibold text-on-primary hover:bg-primary">Cari</button>
                    </form>
                    <button type="button" data-fi-create data-modal="user-modal" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">
                        <span class="material-symbols-outlined text-[18px]">add</span>
                        Tambah User
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Nama</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Email</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Roles</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Status</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($users as $user)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3 font-medium text-on-surface">{{ $user->name }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $user->email }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex flex-wrap gap-1">
                                        @foreach($user->roles as $role)
                                            <span class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-2 py-0.5 text-xs font-semibold text-blue-800">{{ $role->name }}</span>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    @if($user->is_active)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-800">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-surface-container px-2.5 py-1 text-xs font-semibold text-on-surface-variant">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button type="button" data-fi-edit data-modal="user-modal" data-action="{{ route('backend.staff-access.update-user', $user) }}" data-title="Edit User" data-record='{!! json_encode(["name" => $user->name, "email" => $user->email, "phone" => $user->phone, "is_active" => (bool) $user->is_active, "roles" => $user->roles->pluck("id")], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        <form method="POST" action="{{ route('backend.staff-access.destroy-user', $user) }}" data-confirm="User akan dihapus permanen." data-confirm-title="Hapus user?" data-confirm-text="Hapus" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-lg p-2 text-error hover:bg-error-container">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-on-surface-variant">Belum ada user.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="mt-4 flex justify-center">{{ $users->links() }}</div>
            @endif
        </div>
    </div>

    <!-- Roles Tab -->
    <div id="tab-roles" class="tab-content {{ $activeTab === 'roles' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Roles</h3>
                <button type="button" data-fi-create data-modal="role-modal" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Tambah Role
                </button>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Nama</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Slug</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Permissions</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Users</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($roles as $role)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3 font-medium text-on-surface">{{ $role->name }}</td>
                                <td class="px-4 py-3 text-on-surface-variant font-mono text-xs">{{ $role->slug }}</td>
                                <td class="px-4 py-3 text-on-surface">{{ $role->permissions_count }}</td>
                                <td class="px-4 py-3 text-on-surface">{{ $role->users_count }}</td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button type="button" data-fi-edit data-modal="role-modal" data-action="{{ route('backend.staff-access.update-role', $role) }}" data-title="Edit Role" data-record='{!! json_encode(["name" => $role->name, "slug" => $role->slug, "description" => $role->description, "is_active" => (bool) $role->is_active, "permissions" => $role->permissions->pluck("id")], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        @if($role->slug !== 'super_admin')
                                            <form method="POST" action="{{ route('backend.staff-access.destroy-role', $role) }}" data-confirm="Role akan dihapus permanen." data-confirm-title="Hapus role?" data-confirm-text="Hapus" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-lg p-2 text-error hover:bg-error-container">
                                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-on-surface-variant">Belum ada role.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($roles->hasPages())
                <div class="mt-4 flex justify-center">{{ $roles->links() }}</div>
            @endif
        </div>
    </div>

    <!-- Permissions Tab -->
    <div id="tab-permissions" class="tab-content {{ $activeTab === 'permissions' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Permissions</h3>
                <button type="button" data-fi-create data-modal="permission-modal" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Tambah Permission
                </button>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Nama</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Slug</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Module</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($permissions as $permission)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3 font-medium text-on-surface">{{ $permission->name }}</td>
                                <td class="px-4 py-3 text-on-surface-variant font-mono text-xs">{{ $permission->slug }}</td>
                                <td class="px-4 py-3">
                                    @if($permission->module)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-purple-100 px-2.5 py-1 text-xs font-semibold text-purple-800">{{ $permission->module }}</span>
                                    @else
                                        <span class="text-on-surface-variant">-</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button type="button" data-fi-edit data-modal="permission-modal" data-action="{{ route('backend.staff-access.update-permission', $permission) }}" data-title="Edit Permission" data-record='{!! json_encode(["name" => $permission->name, "slug" => $permission->slug, "module" => $permission->module, "description" => $permission->description], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        <form method="POST" action="{{ route('backend.staff-access.destroy-permission', $permission) }}" data-confirm="Permission akan dihapus permanen." data-confirm-title="Hapus permission?" data-confirm-text="Hapus" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-lg p-2 text-error hover:bg-error-container">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-on-surface-variant">Belum ada permission.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($permissions->hasPages())
                <div class="mt-4 flex justify-center">{{ $permissions->links() }}</div>
            @endif
        </div>
    </div>
</div>

<!-- User Modal -->
<div id="user-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="m-4 max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-2xl bg-surface-container-lowest p-6 shadow-card">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah User</h3>
            <button onclick="document.getElementById('user-modal').classList.add('hidden')" class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form method="POST" action="{{ route('backend.staff-access.store-user') }}" data-loading>
            @csrf
            <div class="space-y-4">
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Nama <span class="text-error">*</span></label>
                    <input type="text" name="name" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Email <span class="text-error">*</span></label>
                    <input type="email" name="email" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Telepon</label>
                    <input type="text" name="phone" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Password <span class="text-error">*</span></label>
                    <input type="password" name="password" data-required-on-create required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Konfirmasi Password <span class="text-error">*</span></label>
                    <input type="password" name="password_confirmation" data-required-on-create required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Roles</label>
                    <select name="roles[]" multiple class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        @foreach(\App\Models\Role::where('is_active', true)->orderBy('name')->get() as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="user_is_active" checked class="rounded border-outline-variant text-primary focus:ring-primary">
                    <label for="user_is_active" class="text-sm font-medium text-on-surface">Aktif</label>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('user-modal').classList.add('hidden')" class="rounded-xl border border-outline-variant px-5 py-2.5 text-sm font-semibold text-on-surface-variant hover:bg-surface-container-low">Batal</button>
                <button type="submit" class="rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">Simpan</button>
            </div>
        </form>
    </div>
</div>

@allows('roles.view')
<!-- Role Modal -->
<div id="role-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="m-4 max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-2xl bg-surface-container-lowest p-6 shadow-card">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Role</h3>
            <button onclick="document.getElementById('role-modal').classList.add('hidden')" class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form method="POST" action="{{ route('backend.staff-access.store-role') }}" data-loading>
            @csrf
            <div class="space-y-4">
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Nama <span class="text-error">*</span></label>
                    <input type="text" name="name" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Slug</label>
                    <input type="text" name="slug" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface lowercase focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Deskripsi</label>
                    <textarea name="description" rows="2" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary"></textarea>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Permissions</label>
                    <select name="permissions[]" multiple class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        @foreach(\App\Models\Permission::orderBy('module')->orderBy('name')->get() as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->name }} ({{ $permission->module ?? 'General' }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="role_is_active" checked class="rounded border-outline-variant text-primary focus:ring-primary">
                    <label for="role_is_active" class="text-sm font-medium text-on-surface">Aktif</label>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('role-modal').classList.add('hidden')" class="rounded-xl border border-outline-variant px-5 py-2.5 text-sm font-semibold text-on-surface-variant hover:bg-surface-container-low">Batal</button>
                <button type="submit" class="rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endallows

@allows('permissions.view')
<!-- Permission Modal -->
<div id="permission-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="m-4 max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-2xl bg-surface-container-lowest p-6 shadow-card">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Permission</h3>
            <button onclick="document.getElementById('permission-modal').classList.add('hidden')" class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form method="POST" action="{{ route('backend.staff-access.store-permission') }}" data-loading>
            @csrf
            <div class="space-y-4">
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Nama <span class="text-error">*</span></label>
                    <input type="text" name="name" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Slug</label>
                    <input type="text" name="slug" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface lowercase focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Module</label>
                    <input type="text" name="module" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary" placeholder="e.g., bookings, rooms">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Deskripsi</label>
                    <textarea name="description" rows="2" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary"></textarea>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('permission-modal').classList.add('hidden')" class="rounded-xl border border-outline-variant px-5 py-2.5 text-sm font-semibold text-on-surface-variant hover:bg-surface-container-low">Batal</button>
                <button type="submit" class="rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endallows

@push('scripts')
<script>
function switchTab(tabName) {
    document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
        btn.classList.add('text-on-surface-variant', 'hover:bg-surface-container-low');
    });
    
    document.getElementById('tab-' + tabName).classList.add('active');
    const activeBtn = document.querySelector(`button[onclick="switchTab('${tabName}')"]`);
    if (activeBtn) {
        activeBtn.classList.add('active');
        activeBtn.classList.remove('text-on-surface-variant', 'hover:bg-surface-container-low');
    }
    
    const url = new URL(window.location);
    url.searchParams.set('tab', tabName);
    window.history.replaceState({}, '', url);
}
</script>
@endpush
@endsection
