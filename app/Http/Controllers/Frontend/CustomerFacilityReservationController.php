<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\FacilityReservation;
use App\Models\ResortFacility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerFacilityReservationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'resort_facility_id' => [
                'required',
                'exists:resort_facilities,id',
            ],
            'guest_name' => ['required', 'string', 'max:255'],
            'guest_email' => ['required', 'email', 'max:255'],
            'guest_phone' => ['required', 'string', 'max:30'],
            'reservation_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
            'session' => [
                'required',
                'in:Pagi (08:00 - 11:00),Siang (12:00 - 15:00),Sunset (16:30 - 19:00),Malam (19:30 - 22:00)',
            ],
            'guest_type' => [
                'required',
                'in:villa,day_guest',
            ],
            'special_requests' => ['nullable', 'string'],
        ]);

        $facility = ResortFacility::where('is_active', true)
            ->findOrFail($validated['resort_facility_id']);

        $reservation = FacilityReservation::create([
            ...$validated,
            'user_id' => Auth::id(),
            'status' => 'pending',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Permintaan reservasi fasilitas berhasil dikirim.');
    }
}
