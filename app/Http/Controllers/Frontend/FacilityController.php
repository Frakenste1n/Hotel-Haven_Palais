<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ResortFacility;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = ResortFacility::with([
            'category',
            'images' => function ($query) {
                $query->where('is_primary', true)
                    ->orderBy('sort_order');
            },
        ])
            ->where('is_active', true)
            ->whereHas('category', function ($query) {
                $query->where('is_active', true);
            })
            ->orderBy('sort_order')
            ->get();

        return view('frontend.fasilitas.fasilitas', compact('facilities'));
    }
}
