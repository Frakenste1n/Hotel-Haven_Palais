<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class NotificationsSettingsController extends Controller
{
    public function index(Request $request): View
    {
        $notifications = $request->user()->notifications()->paginate(12)->withQueryString();

        return view('backend.notifications-settings.index', [
            'notifications' => $notifications,
            'user' => $request->user(),
        ]);
    }

    public function markAsRead(Request $request, string $id): RedirectResponse
    {
        $notification = $request->user()->notifications()->where('id', $id)->firstOrFail();
        $notification->markAsRead();

        return redirect()
            ->route('backend.notifications-settings.index')
            ->with('success', 'Notifikasi ditandai sudah dibaca.');
    }

    public function markAllAsRead(Request $request): RedirectResponse
    {
        $request->user()->unreadNotifications->markAsRead();

        return redirect()
            ->route('backend.notifications-settings.index')
            ->with('success', 'Semua notifikasi ditandai sudah dibaca.');
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30', Rule::unique('users', 'phone')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $data['name'];
        $user->phone = $data['phone'] ?? null;

        if (! empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        $user->save();

        return redirect()
            ->route('backend.notifications-settings.index')
            ->with('success', 'Profil akun berhasil diperbarui.');
    }
}
