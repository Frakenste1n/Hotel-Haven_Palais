@extends('backend.layouts.app')

@section('title', 'Housekeeping')

@section('breadcrumb')
    <a href="{{ route('backend.dashboard') }}" class="hover:text-primary">Dashboard</a>
    <span class="mx-2 text-outline-variant">/</span>
    <span class="font-medium text-primary">Housekeeping</span>
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
        'title' => 'Housekeeping',
        'subtitle' => 'Kelola tugas housekeeping dan staf kebersihan dalam satu halaman terpadu.',
    ])

    <!-- Tabs Navigation -->
    <div class="flex flex-wrap gap-2 border-b border-outline-variant/40 pb-1">
        <button onclick="switchTab('tasks')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'tasks' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">cleaning_services</span>
            Tasks
        </button>
        <button onclick="switchTab('staff')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'staff' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">people</span>
            Staff
        </button>
    </div>

    <!-- Tasks Tab -->
    <div id="tab-tasks" class="tab-content {{ $activeTab === 'tasks' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Housekeeping Tasks</h3>
                <button type="button" data-fi-create data-modal="task-modal" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Tambah Tugas
                </button>
            </div>

            <div class="mb-4 flex flex-wrap gap-3">
                <select onchange="window.location.href='{{ route('backend.housekeeping.index') }}?tab=tasks&status='+this.value" class="rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="verified" {{ request('status') === 'verified' ? 'selected' : '' }}>Verified</option>
                </select>
                <select onchange="window.location.href='{{ route('backend.housekeeping.index') }}?tab=tasks&priority='+this.value" class="rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    <option value="">Semua Prioritas</option>
                    <option value="high" {{ request('priority') === 'high' ? 'selected' : '' }}>High</option>
                    <option value="medium" {{ request('priority') === 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="low" {{ request('priority') === 'low' ? 'selected' : '' }}>Low</option>
                </select>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Kamar</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Tipe Tugas</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Petugas</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Prioritas</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Status</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($tasks as $task)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3 font-medium text-on-surface">{{ $task->room->room_number ?? '-' }} ({{ $task->room->roomType->name ?? '-' }})</td>
                                <td class="px-4 py-3">
                                    @php
                                        $typeLabels = [
                                            'cleaning' => 'Cleaning',
                                            'inspection' => 'Inspection',
                                            'maintenance' => 'Maintenance',
                                            'turnover' => 'Turnover',
                                        ];
                                    @endphp
                                    <span class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-800">{{ $typeLabels[$task->task_type] ?? $task->task_type }}</span>
                                </td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $task->assignee->name ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    @if($task->priority === 'high')
                                        <span class="inline-flex items-center gap-1 rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-800">High</span>
                                    @elseif($task->priority === 'medium')
                                        <span class="inline-flex items-center gap-1 rounded-full bg-yellow-100 px-2.5 py-1 text-xs font-semibold text-yellow-800">Medium</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-800">Low</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-gray-100 text-gray-800',
                                            'in_progress' => 'bg-blue-100 text-blue-800',
                                            'completed' => 'bg-yellow-100 text-yellow-800',
                                            'verified' => 'bg-green-100 text-green-800',
                                        ];
                                        $statusLabel = [
                                            'pending' => 'Pending',
                                            'in_progress' => 'In Progress',
                                            'completed' => 'Completed',
                                            'verified' => 'Verified',
                                        ];
                                    @endphp
                                    <span class="inline-flex items-center gap-1 rounded-full {{ $statusColors[$task->status] ?? 'bg-gray-100 text-gray-800' }} px-2.5 py-1 text-xs font-semibold">
                                        {{ $statusLabel[$task->status] ?? $task->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button type="button" data-fi-edit data-modal="task-modal" data-action="{{ route('backend.housekeeping.update-task', $task) }}" data-title="Edit Tugas" data-record='{!! json_encode(["room_id" => $task->room_id, "task_type" => $task->task_type, "assigned_to" => $task->assigned_to, "reservation_id" => $task->reservation_id, "priority" => $task->priority, "status" => $task->status, "scheduled_at" => optional($task->scheduled_at)->format("Y-m-d"), "notes" => $task->notes], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary"><span class="material-symbols-outlined text-[18px]">edit</span></button>
                                        <form method="POST" action="{{ route('backend.housekeeping.destroy-task', $task) }}" data-confirm="Tugas akan dihapus permanen." data-confirm-title="Hapus tugas?" data-confirm-text="Hapus" class="inline">
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
                                <td colspan="6" class="px-4 py-8 text-center text-on-surface-variant">Belum ada tugas housekeeping.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($tasks->hasPages())
                <div class="mt-4 flex justify-center">{{ $tasks->links() }}</div>
            @endif
        </div>
    </div>

    <!-- Staff Tab -->
    <div id="tab-staff" class="tab-content {{ $activeTab === 'staff' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Housekeeping Staff</h3>
                <a href="{{ route('backend.staff-access.index', ['tab' => 'users']) }}" class="inline-flex items-center gap-2 rounded-xl bg-primary px-4 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">
                    <span class="material-symbols-outlined text-[18px]">add</span>
                    Kelola di Staff & Access
                </a>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Nama</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Email</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Role</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Status</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($staff as $member)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3 font-medium text-on-surface">{{ $member->name }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $member->email }}</td>
                                <td class="px-4 py-3 text-on-surface">{{ $member->roles->pluck('name')->join(', ') }}</td>
                                <td class="px-4 py-3">
                                    @if($member->is_active)
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-800">Aktif</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-surface-container px-2.5 py-1 text-xs font-semibold text-on-surface-variant">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('backend.staff-access.index', ['tab' => 'users', 'q' => $member->email]) }}" class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary">
                                            <span class="material-symbols-outlined text-[18px]">edit</span>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-on-surface-variant">Belum ada staf housekeeping.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($staff->hasPages())
                <div class="mt-4 flex justify-center">{{ $staff->links() }}</div>
            @endif
        </div>
    </div>
</div>

<!-- Task Modal -->
<div id="task-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="m-4 max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-2xl bg-surface-container-lowest p-6 shadow-card">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Tambah Tugas Housekeeping</h3>
            <button onclick="document.getElementById('task-modal').classList.add('hidden')" class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <form method="POST" action="{{ route('backend.housekeeping.store-task') }}" data-loading>
            @csrf
            <div class="space-y-4">
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Kamar <span class="text-error">*</span></label>
                    <select name="room_id" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="">Pilih kamar</option>
                        @foreach(\App\Models\Room::with('roomType')->orderBy('room_number')->get() as $room)
                            <option value="{{ $room->id }}">{{ $room->room_number }} - {{ $room->roomType->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Tipe Tugas <span class="text-error">*</span></label>
                    <select name="task_type" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="cleaning">Cleaning</option>
                        <option value="inspection">Inspection</option>
                        <option value="maintenance">Maintenance</option>
                        <option value="turnover">Turnover</option>
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Petugas</label>
                    <select name="assigned_to" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="">Pilih petugas</option>
                        @foreach(\App\Models\User::whereHas('roles', fn ($q) => $q->whereIn('slug', ['housekeeping', 'admin', 'super_admin']))->orderBy('name')->get() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Reservasi</label>
                    <select name="reservation_id" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="">Pilih reservasi (opsional)</option>
                        @foreach(\App\Models\Reservation::latest()->limit(50)->get() as $reservation)
                            <option value="{{ $reservation->id }}">{{ $reservation->booking_code }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Prioritas <span class="text-error">*</span></label>
                        <select name="priority" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-sm font-medium text-on-surface">Status <span class="text-error">*</span></label>
                        <select name="status" required class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="verified">Verified</option>
                        </select>
                    </div>
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Jadwal</label>
                    <input type="date" name="scheduled_at" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-on-surface">Catatan</label>
                    <textarea name="notes" rows="2" class="w-full rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary"></textarea>
                </div>
            </div>
            <div class="mt-6 flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('task-modal').classList.add('hidden')" class="rounded-xl border border-outline-variant px-5 py-2.5 text-sm font-semibold text-on-surface-variant hover:bg-surface-container-low">Batal</button>
                <button type="submit" class="rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white hover:bg-primary-container">Simpan</button>
            </div>
        </form>
    </div>
</div>

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
