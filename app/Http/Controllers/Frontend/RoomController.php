<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\View\View;
use App\Models\RoomCategory;
use App\Models\RoomFacility;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function index(): View
    {
        $roomTypes = RoomType::with([
            'images',
            'facilities',
            'category'
        ])
            ->where('is_active', true)
            ->get();

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
            'featuredRoomType'
        ));
    }
}
