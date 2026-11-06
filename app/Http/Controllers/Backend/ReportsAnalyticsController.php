<?php

namespace App\Http\Controllers\Backend;

use App\Models\ActivityLog;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReportsAnalyticsController extends Controller
{
    public function index(Request $request): View
    {
        $activeTab = $this->allowedTab($request, [
            'overview' => 'reports.view',
            'reservations' => 'reservations.view',
            'revenue' => 'reports.view',
            'occupancy' => 'rooms.view',
            'payments' => 'payments.view',
            'activity' => 'activity_logs.view',
        ], 'overview');
        $user = $request->user();

        $summary = ! $user->allows('reports.view') ? [
            'total_reservations' => 0,
            'confirmed_reservations' => 0,
            'total_revenue' => 0,
            'pending_verification' => 0,
            'occupancy_rate' => 0,
        ] : [
            'total_reservations' => Reservation::count(),
            'confirmed_reservations' => Reservation::where('status', 'confirmed')->count(),
            'total_revenue' => Payment::where('status', 'paid')->sum('amount'),
            'pending_verification' => Payment::where('status', 'waiting_verification')->count(),
            'occupancy_rate' => $this->occupancyRate(),
        ];

        $reservations = ! $user->allows('reservations.view')
            ? $this->emptyPage()
            : Reservation::with(['user', 'guest'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->when($request->filled('from'), fn ($q) => $q->whereDate('check_in', '>=', $request->from))
            ->when($request->filled('to'), fn ($q) => $q->whereDate('check_out', '<=', $request->to))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $revenues = ! $user->allows('reports.view')
            ? $this->emptyPage()
            : Payment::query()
            ->select(
                DB::raw('DATE(paid_at) as date'),
                DB::raw('SUM(amount) as total')
            )
            ->where('status', 'paid')
            ->when($request->filled('from'), fn ($q) => $q->whereDate('paid_at', '>=', $request->from))
            ->when($request->filled('to'), fn ($q) => $q->whereDate('paid_at', '<=', $request->to))
            ->groupBy(DB::raw('DATE(paid_at)'))
            ->orderBy('date', 'desc')
            ->paginate(10)
            ->withQueryString();

        $totalRevenue = $user->allows('reports.view')
            ? Payment::where('status', 'paid')
                ->when($request->filled('from'), fn ($q) => $q->whereDate('paid_at', '>=', $request->from))
                ->when($request->filled('to'), fn ($q) => $q->whereDate('paid_at', '<=', $request->to))
                ->sum('amount')
            : 0;

        $rooms = $user->allows('rooms.view')
            ? Room::with('roomType')
                ->select('id', 'room_type_id', 'room_number', 'status', 'is_active')
                ->orderBy('room_number')
                ->get()
            : collect();

        $occupancyStats = [
            'total' => $rooms->count(),
            'available' => $rooms->where('status', 'available')->count(),
            'occupied' => $rooms->where('status', 'occupied')->count(),
            'cleaning' => $rooms->where('status', 'cleaning')->count(),
            'maintenance' => $rooms->whereIn('status', ['maintenance', 'out_of_order'])->count(),
            'rate' => $user->allows('rooms.view') ? $this->occupancyRate() : 0,
        ];

        $payments = ! $user->allows('payments.view')
            ? $this->emptyPage()
            : Payment::with(['reservation', 'paymentMethod'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $activityLogs = $user->allows('activity_logs.view')
            ? ActivityLog::with('user')->latest()->paginate(10)
            : $this->emptyPage();

        return view('backend.reports-analytics.index', compact(
            'activeTab', 'summary', 'reservations', 'revenues', 'totalRevenue', 'rooms', 'occupancyStats', 'payments', 'activityLogs'
        ));
    }

    public function showActivityLog(ActivityLog $activityLog): View
    {
        $activityLog->load(['user', 'subject']);

        return view('backend.reports-analytics.show-log', compact('activityLog'));
    }

    private function occupancyRate(): float
    {
        $total = Room::where('is_active', true)->count();

        if ($total === 0) {
            return 0;
        }

        $occupied = Room::where('status', 'occupied')->count();

        return round(($occupied / $total) * 100, 2);
    }
}
