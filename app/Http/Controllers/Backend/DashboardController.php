<?php

namespace App\Http\Controllers\Backend;

use App\Models\ContactMessage;
use App\Models\Payment;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'reservations_today' => Reservation::whereDate('created_at', today())->count(),
            'arrivals_today' => Reservation::whereDate('check_in', today())
                ->whereIn('status', ['confirmed', 'pending_payment'])
                ->count(),
            'in_house' => Reservation::where('status', 'checked_in')->count(),
            'rooms_available' => Room::where('status', 'available')->where('is_active', true)->count(),
            'rooms_occupied' => Room::where('status', 'occupied')->count(),
            'pending_payments' => Payment::where('status', 'waiting_verification')->count(),
            'revenue_today' => Payment::where('status', 'paid')->whereDate('paid_at', today())->sum('amount'),
            'new_messages' => ContactMessage::where('status', 'new')->count(),
            'pending_reviews' => Review::where('status', 'pending')->count(),
        ];

        $revenueChart = collect(range(6, 0))->map(function (int $daysAgo) {
            $date = Carbon::today()->subDays($daysAgo);

            return [
                'label' => $date->format('d M'),
                'total' => (float) Payment::where('status', 'paid')->whereDate('paid_at', $date)->sum('amount'),
            ];
        });

        $reservationChart = collect([
            'pending_payment',
            'confirmed',
            'checked_in',
            'checked_out',
            'cancelled',
        ])->map(fn (string $status) => [
            'label' => str_replace('_', ' ', $status),
            'total' => Reservation::where('status', $status)->count(),
        ]);

        $occupancy = [
            'available' => Room::where('status', 'available')->count(),
            'occupied' => Room::where('status', 'occupied')->count(),
            'cleaning' => Room::where('status', 'cleaning')->count(),
            'maintenance' => Room::whereIn('status', ['maintenance', 'out_of_order'])->count(),
        ];

        $recentReservations = Reservation::with(['user', 'guest'])
            ->latest()
            ->limit(8)
            ->get();

        $recentPayments = Payment::with(['reservation', 'paymentMethod'])
            ->latest()
            ->limit(6)
            ->get();

        $monthlyRevenue = (float) Payment::where('status', 'paid')
            ->whereMonth('paid_at', now()->month)
            ->whereYear('paid_at', now()->year)
            ->sum('amount');

        return view('backend.dashboard.index', compact(
            'stats',
            'revenueChart',
            'reservationChart',
            'occupancy',
            'recentReservations',
            'recentPayments',
            'monthlyRevenue'
        ));
    }
}
