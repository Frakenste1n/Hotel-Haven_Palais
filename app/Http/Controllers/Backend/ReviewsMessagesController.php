<?php

namespace App\Http\Controllers\Backend;

use App\Models\ContactMessage;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ReviewsMessagesController extends Controller
{
    public function index(Request $request): View
    {
        $activeTab = $this->allowedTab($request, [
            'reviews' => 'reviews.view',
            'messages' => 'contact_messages.view',
        ], 'reviews');
        $user = $request->user();

        $reviews = ! $user->allows('reviews.view')
            ? $this->emptyPage()
            : Review::with(['user', 'reservation'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->latest()
            ->paginate(10);

        $contactMessages = ! $user->allows('contact_messages.view')
            ? $this->emptyPage()
            : ContactMessage::with('handler')
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->when($request->filled('q'), function ($q) use ($request) {
                $term = '%' . $request->q . '%';
                $q->where(function ($inner) use ($term) {
                    $inner->where('name', 'like', $term)
                        ->orWhere('email', 'like', $term)
                        ->orWhere('subject', 'like', $term);
                });
            })
            ->latest()
            ->paginate(10);

        return view('backend.reviews-messages.index', compact('activeTab', 'reviews', 'contactMessages'));
    }

    // Reviews
    public function moderateReview(Request $request, Review $review): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['approved', 'rejected', 'pending'])],
        ]);

        $review->update([
            'status' => $data['status'],
            'moderated_by' => auth()->id(),
            'moderated_at' => now(),
        ]);

        return redirect()
            ->route('backend.reviews-messages.index', ['tab' => 'reviews'])
            ->with('success', 'Status ulasan berhasil diperbarui.');
    }

    public function destroyReview(Review $review): RedirectResponse
    {
        $review->delete();

        return redirect()
            ->route('backend.reviews-messages.index', ['tab' => 'reviews'])
            ->with('success', 'Ulasan berhasil dihapus.');
    }

    // Contact Messages
    public function showContactMessage(ContactMessage $contactMessage): View
    {
        if ($contactMessage->status === 'new') {
            $contactMessage->update([
                'status' => 'read',
                'handled_by' => auth()->id(),
            ]);
        }

        $contactMessage->load('handler');

        return view('backend.reviews-messages.show-message', compact('contactMessage'));
    }

    public function updateContactMessage(Request $request, ContactMessage $contactMessage): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['new', 'read', 'followed_up'])],
            'notes' => ['nullable', 'string'],
        ]);

        $contactMessage->update([
            'status' => $data['status'],
            'notes' => $data['notes'] ?? null,
            'handled_by' => auth()->id(),
            'replied_at' => $data['status'] === 'followed_up' ? now() : $contactMessage->replied_at,
        ]);

        return redirect()
            ->route('backend.reviews-messages.index', ['tab' => 'messages'])
            ->with('success', 'Pesan kontak berhasil diperbarui.');
    }

    public function destroyContactMessage(ContactMessage $contactMessage): RedirectResponse
    {
        $contactMessage->delete();

        return redirect()
            ->route('backend.reviews-messages.index', ['tab' => 'messages'])
            ->with('success', 'Pesan kontak berhasil dihapus.');
    }
}
