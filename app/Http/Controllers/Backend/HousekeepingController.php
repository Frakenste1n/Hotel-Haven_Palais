<?php

namespace App\Http\Controllers\Backend;

use App\Models\HousekeepingTask;
use App\Models\Reservation;
use App\Models\ReservationDetail;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class HousekeepingController extends Controller
{
    public function index(Request $request): View
    {
        $activeTab = $request->get('tab', 'tasks');
        
        $tasks = HousekeepingTask::with(['room.roomType', 'assignee', 'reservation'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->when($request->filled('priority'), fn ($q) => $q->where('priority', $request->priority))
            ->latest()
            ->paginate(10);

        $staff = User::whereHas('roles', fn ($q) => $q->whereIn('slug', ['housekeeping', 'admin', 'super_admin']))
            ->with('roles')
            ->latest()
            ->paginate(10);

        return view('backend.housekeeping.index', compact('activeTab', 'tasks', 'staff'));
    }

    // Tasks
    public function storeTask(Request $request): RedirectResponse
    {
        $data = $this->validatedTask($request);

        HousekeepingTask::create([
            ...$data,
            'scheduled_at' => $data['scheduled_at'] ?? now(),
        ]);

        return redirect()
            ->route('backend.housekeeping.index', ['tab' => 'tasks'])
            ->with('success', 'Tugas housekeeping berhasil dibuat.');
    }

    public function updateTask(Request $request, HousekeepingTask $housekeepingTask): RedirectResponse
    {
        $data = $this->validatedTask($request);

        if ($data['status'] === 'in_progress' && ! $housekeepingTask->started_at) {
            $data['started_at'] = now();
        }

        if ($data['status'] === 'completed' && ! $housekeepingTask->completed_at) {
            $data['completed_at'] = now();
        }

        if ($data['status'] === 'verified') {
            $data['verified_by'] = auth()->id();
            $data['verified_at'] = now();
            $data['completed_at'] = $housekeepingTask->completed_at ?? now();

            $guestStillInRoom = $housekeepingTask->room_id
                && ReservationDetail::query()
                    ->where('room_id', $housekeepingTask->room_id)
                    ->whereHas('reservation', fn ($query) => $query->where('status', 'checked_in'))
                    ->exists();

            if ($housekeepingTask->room && ! $guestStillInRoom && in_array($data['task_type'], ['cleaning', 'inspection', 'turnover'], true)) {
                $housekeepingTask->room->update(['status' => 'available']);
            }
        }

        $housekeepingTask->update($data);

        return redirect()
            ->route('backend.housekeeping.index', ['tab' => 'tasks'])
            ->with('success', 'Tugas housekeeping berhasil diperbarui.');
    }

    public function destroyTask(HousekeepingTask $housekeepingTask): RedirectResponse
    {
        $housekeepingTask->delete();

        return redirect()
            ->route('backend.housekeeping.index', ['tab' => 'tasks'])
            ->with('success', 'Tugas housekeeping berhasil dihapus.');
    }

    private function validatedTask(Request $request): array
    {
        return $request->validate([
            'room_id' => ['required', 'exists:rooms,id'],
            'assigned_to' => ['nullable', 'exists:users,id'],
            'reservation_id' => ['nullable', 'exists:reservations,id'],
            'task_type' => ['required', Rule::in(['cleaning', 'inspection', 'maintenance', 'turnover'])],
            'status' => ['required', Rule::in(['pending', 'in_progress', 'completed', 'verified'])],
            'priority' => ['required', Rule::in(['low', 'medium', 'high'])],
            'notes' => ['nullable', 'string'],
            'scheduled_at' => ['nullable', 'date'],
        ]);
    }

    private function formData(): array
    {
        return [
            'rooms' => Room::with('roomType')->orderBy('room_number')->get(),
            'staff' => User::whereHas('roles', fn ($q) => $q->whereIn('slug', ['housekeeping', 'admin', 'super_admin']))
                ->orderBy('name')
                ->get(),
            'reservations' => Reservation::latest()->limit(50)->get(['id', 'booking_code']),
        ];
    }
}
