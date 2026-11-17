<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\View\View;
use App\Models\RoomCategory;
use App\Models\RoomFacility;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'check_in' => ['nullable', 'required_with:check_out', 'date', 'after_or_equal:today'],
            'check_out' => ['nullable', 'required_with:check_in', 'date', 'after:check_in'],
            'adults' => ['nullable', 'integer', 'min:1'],
            'children' => ['nullable', 'integer', 'min:0'],
            'room_type_id' => ['nullable', 'integer', 'exists:room_types,id'],
        ]);

        $checkIn = $validated['check_in'] ?? null;
        $checkOut = $validated['check_out'] ?? null;
        $adults = (int) ($validated['adults'] ?? 1);
        $children = (int) ($validated['children'] ?? 0);
        $roomTypeId = $validated['room_type_id'] ?? null;

        $roomTypesQuery = RoomType::with([
            'images',
            'facilities',
            'category'
        ])->where('is_active', true);

        if ($roomTypeId) {
            $roomTypesQuery->where('id', $roomTypeId);
        }

        $roomTypesQuery
            ->where('capacity_adults', '>=', $adults)
            ->where('capacity_children', '>=', $children);

        if ($checkIn && $checkOut) {
            $roomTypesQuery->whereIn('id', function ($query) use ($checkIn, $checkOut) {
                $query->select('rooms.room_type_id')
                    ->from('rooms')
                    ->where('rooms.is_active', true)
                    ->whereNotIn('rooms.status', ['maintenance', 'out_of_order'])
                    ->whereNotExists(function ($subQuery) use ($checkIn, $checkOut) {
                        $subQuery->select(DB::raw(1))
                            ->from('reservation_details')
                            ->join('reservations', 'reservation_details.reservation_id', '=', 'reservations.id')
                            ->whereColumn('reservation_details.room_id', 'rooms.id')
                            ->whereNull('reservations.deleted_at')
                            ->whereNotIn('reservations.status', ['cancelled', 'expired'])
                            ->where('reservations.check_in', '<', $checkOut)
                            ->where('reservations.check_out', '>', $checkIn);
                    });
            });
        }

        $roomTypes = $roomTypesQuery->get();

        $categories = RoomCategory::whereHas('roomTypes', function ($query) {
            $query->where('is_active', true);
        })->get();

        $facilities = RoomFacility::where('is_active', true)
            ->whereHas('roomTypes', function ($query) {
                $query->where('is_active', true);
            })
            ->orderBy('name')
            ->get();

        $reviewLinks = DB::table('reservation_details')
            ->join('reservations', 'reservation_details.reservation_id', '=', 'reservations.id')
            ->join('reviews', 'reservations.id', '=', 'reviews.reservation_id')
            ->whereNull('reservations.deleted_at')
            ->whereNull('reviews.deleted_at')
            ->where('reviews.status', 'approved')
            ->select(
                'reservation_details.room_type_id',
                'reviews.id as review_id',
                'reviews.rating'
            )
            ->distinct();

        $reviewStats = DB::query()
            ->fromSub($reviewLinks, 'review_links')
            ->select('room_type_id')
            ->selectRaw('AVG(rating) as average_rating')
            ->selectRaw('COUNT(review_id) as review_count')
            ->groupBy('room_type_id');

        $featuredRoomType = RoomType::query()
            ->joinSub($reviewStats, 'review_stats', function ($join) {
                $join->on('room_types.id', '=', 'review_stats.room_type_id');
            })
            ->select('room_types.*')
            ->addSelect(
                'review_stats.average_rating',
                'review_stats.review_count'
            )
            ->with(['images', 'facilities', 'category'])
            ->where('room_types.is_active', true)
            ->orderByDesc('review_stats.average_rating')
            ->orderByDesc('review_stats.review_count')
            ->first();

        return view('frontend.kamar.kamar', compact(
            'roomTypes',
            'categories',
            'facilities',
            'featuredRoomType',
            'checkIn',
            'checkOut',
            'adults',
            'children',
            'roomTypeId'
        ));
    }
}
