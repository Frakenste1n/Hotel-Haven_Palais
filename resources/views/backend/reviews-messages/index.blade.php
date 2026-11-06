@extends('backend.layouts.app')

@section('title', 'Reviews & Messages')

@section('breadcrumb')
    <a href="{{ route('backend.dashboard') }}" class="hover:text-primary">Dashboard</a>
    <span class="mx-2 text-outline-variant">/</span>
    <span class="font-medium text-primary">Reviews & Messages</span>
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
        'title' => 'Reviews & Messages',
        'subtitle' => 'Kelola ulasan pelanggan dan pesan kontak dalam satu halaman terpadu.',
    ])

    <!-- Tabs Navigation -->
    <div class="flex flex-wrap gap-2 border-b border-outline-variant/40 pb-1">
        @allows('reviews.view')
        <button onclick="switchTab('reviews')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'reviews' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">star</span>
            Reviews
        </button>
        @endallows
        @allows('contact_messages.view')
        <button onclick="switchTab('messages')" class="tab-btn rounded-t-lg px-4 py-2.5 text-sm font-medium transition {{ $activeTab === 'messages' ? 'active' : 'text-on-surface-variant hover:bg-surface-container-low' }}">
            <span class="material-symbols-outlined text-[18px] align-middle mr-1">mail</span>
            Contact Messages
        </button>
        @endallows
    </div>

    <!-- Reviews Tab -->
    <div id="tab-reviews" class="tab-content {{ $activeTab === 'reviews' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Customer Reviews</h3>
                <select onchange="window.location.href='{{ route('backend.reviews-messages.index') }}?tab=reviews&status='+this.value" class="rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Customer</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Rating</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Comment</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Status</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($reviews as $review)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3 font-medium text-on-surface">{{ $review->user->name ?? 'Guest' }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-1">
                                        <span class="text-yellow-500">{{ str_repeat('★', $review->rating) }}</span>
                                        <span class="text-on-surface-variant">({{ $review->rating }}/5)</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-on-surface-variant max-w-xs truncate">{{ $review->comment }}</td>
                                <td class="px-4 py-3">
                                    @if($review->status === 'approved')
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-800">Approved</span>
                                    @elseif($review->status === 'rejected')
                                        <span class="inline-flex items-center gap-1 rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-800">Rejected</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-yellow-100 px-2.5 py-1 text-xs font-semibold text-yellow-800">Pending</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary">
                                            <span class="material-symbols-outlined text-[18px]">visibility</span>
                                        </button>
                                        @if($review->status === 'pending')
                                            <form method="POST" action="{{ route('backend.reviews-messages.moderate-review', $review) }}" class="inline">
                                                @csrf
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="rounded-lg bg-green-600 px-2 py-1 text-xs font-semibold text-white hover:bg-green-700">Approve</button>
                                            </form>
                                            <form method="POST" action="{{ route('backend.reviews-messages.moderate-review', $review) }}" class="inline">
                                                @csrf
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="rounded-lg bg-red-600 px-2 py-1 text-xs font-semibold text-white hover:bg-red-700">Reject</button>
                                            </form>
                                        @endif
                                        <form method="POST" action="{{ route('backend.reviews-messages.destroy-review', $review) }}" data-confirm="Ulasan akan dihapus permanen." data-confirm-title="Hapus ulasan?" data-confirm-text="Hapus" class="inline">
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
                                <td colspan="5" class="px-4 py-8 text-center text-on-surface-variant">Belum ada ulasan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($reviews->hasPages())
                <div class="mt-4 flex justify-center">{{ $reviews->links() }}</div>
            @endif
        </div>
    </div>

    <!-- Messages Tab -->
    <div id="tab-messages" class="tab-content {{ $activeTab === 'messages' ? 'active' : '' }}">
        <div class="rounded-2xl border border-outline-variant/40 bg-surface-container-lowest p-6 shadow-soft">
            <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Contact Messages</h3>
                <div class="flex gap-3">
                    <form method="GET" action="{{ route('backend.reviews-messages.index') }}" class="flex items-center gap-2">
                        <input type="hidden" name="tab" value="messages">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama, email, subject..." class="rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface placeholder:text-on-surface-variant/50 focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        <button type="submit" class="rounded-lg bg-primary-container px-4 py-2 text-sm font-semibold text-on-primary hover:bg-primary">Cari</button>
                    </form>
                    <select onchange="window.location.href='{{ route('backend.reviews-messages.index') }}?tab=messages&status='+this.value" class="rounded-lg border border-outline-variant bg-surface-container-lowest px-3 py-2 text-sm text-on-surface focus:border-primary focus:outline-none focus:ring-1 focus:ring-primary">
                        <option value="">Semua Status</option>
                        <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New</option>
                        <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
                        <option value="followed_up" {{ request('status') === 'followed_up' ? 'selected' : '' }}>Followed Up</option>
                    </select>
                </div>
            </div>

            <div class="overflow-x-auto rounded-xl border border-outline-variant/40">
                <table class="w-full text-sm">
                    <thead class="bg-surface-container">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Nama</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Email</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Subject</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Tanggal</th>
                            <th class="px-4 py-3 text-left font-semibold text-on-surface">Status</th>
                            <th class="px-4 py-3 text-right font-semibold text-on-surface">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline-variant/40">
                        @forelse($contactMessages as $message)
                            <tr class="bg-surface-container-lowest hover:bg-surface-container-low">
                                <td class="px-4 py-3 font-medium text-on-surface">{{ $message->name }}</td>
                                <td class="px-4 py-3 text-on-surface-variant">{{ $message->email }}</td>
                                <td class="px-4 py-3 text-on-surface">{{ $message->subject }}</td>
                                <td class="px-4 py-3 text-on-surface-variant text-xs">{{ $message->created_at->format('d M Y H:i') }}</td>
                                <td class="px-4 py-3">
                                    @if($message->status === 'new')
                                        <span class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-2.5 py-1 text-xs font-semibold text-blue-800">New</span>
                                    @elseif($message->status === 'read')
                                        <span class="inline-flex items-center gap-1 rounded-full bg-yellow-100 px-2.5 py-1 text-xs font-semibold text-yellow-800">Read</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-800">Followed Up</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button type="button" data-fi-edit data-modal="message-modal" data-title="Detail Pesan" data-action="{{ route('backend.reviews-messages.update-message', $message) }}" data-record='{!! json_encode(["subject" => $message->subject, "from" => $message->name." (".$message->email.")", "message" => $message->message, "status" => $message->status, "notes" => $message->notes], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) !!}' class="rounded-lg p-2 text-on-surface-variant hover:bg-surface-container hover:text-primary">
                                            <span class="material-symbols-outlined text-[18px]">visibility</span>
                                        </button>
                                        <form method="POST" action="{{ route('backend.reviews-messages.destroy-message', $message) }}" data-confirm="Pesan akan dihapus permanen." data-confirm-title="Hapus pesan?" data-confirm-text="Hapus" class="inline">
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
                                <td colspan="6" class="px-4 py-8 text-center text-on-surface-variant">Belum ada pesan kontak.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($contactMessages->hasPages())
                <div class="mt-4 flex justify-center">{{ $contactMessages->links() }}</div>
            @endif
        </div>
    </div>
</div>

<div id="message-modal" class="fi-modal fixed inset-0 z-50 hidden items-center justify-center bg-primary/50 p-4">
    <div class="max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-2xl bg-white p-6">
        <div class="mb-4 flex items-center justify-between">
            <h3 data-fi-modal-title class="text-lg font-semibold text-primary">Detail Pesan</h3>
            <button type="button" data-fi-close class="rounded-lg p-2"><span class="material-symbols-outlined">close</span></button>
        </div>
        <form method="POST" action="{{ route('backend.reviews-messages.index') }}" data-loading class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <p class="text-xs font-semibold uppercase text-on-surface-variant">Subjek</p>
                <p data-bind="subject" class="text-sm font-medium text-primary">-</p>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase text-on-surface-variant">Pengirim</p>
                <p data-bind="from" class="text-sm">-</p>
            </div>
            <div>
                <p class="text-xs font-semibold uppercase text-on-surface-variant">Pesan</p>
                <div data-bind="message" class="rounded-lg bg-surface-container-low p-3 text-sm whitespace-pre-wrap">-</div>
            </div>
            <div>
                <label class="fi-label">Status</label>
                <select name="status" class="fi-input">
                    <option value="new">New</option>
                    <option value="read">Read</option>
                    <option value="followed_up">Followed Up</option>
                </select>
            </div>
            <div>
                <label class="fi-label">Catatan</label>
                <textarea name="notes" rows="3" class="fi-input"></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" data-fi-close class="rounded-xl border px-5 py-2.5 text-sm">Tutup</button>
                <button class="rounded-xl bg-primary px-5 py-2.5 text-sm font-semibold text-white">Simpan status</button>
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
