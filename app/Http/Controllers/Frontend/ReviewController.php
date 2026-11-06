<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReviewController extends Controller
{
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        if (! $request->user()) {
            throw ValidationException::withMessages([
                'auth' => 'Silakan masuk sebagai customer untuk mengirim ulasan.',
            ]);
        }

        $data = $request->validate([
            'booking_code' => ['required', 'string', 'max:255'],
            'rating' => ['required', 'integer', 'between:1,5'],
            'comment' => ['nullable', 'string', 'max:2000'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $review = Review::submit(
            $request->user(),
            $data['booking_code'],
            (int) $data['rating'],
            $data['comment'] ?? null,
            $request->file('photo'),
        );

        $message = 'Ulasan berhasil dikirim dan menunggu moderasi.';

        if ($request->expectsJson()) {
            return response()->json([
                'message' => $message,
                'review' => [
                    'id' => $review->id,
                    'reservation_id' => $review->reservation_id,
                    'rating' => $review->rating,
                    'status' => $review->status,
                ],
            ], 201);
        }

        return back()->with('success', $message);
    }
}
