<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLoginForm(): View
    {
        return view('backend.auth.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors(['email' => 'Email atau password tidak valid.'])
                ->onlyInput('email');
        }

        $user = Auth::user();

        if (! $user->is_active) {
            Auth::logout();

            return back()
                ->withErrors(['email' => 'Akun Anda tidak aktif.'])
                ->onlyInput('email');
        }

        if (! $user->isStaff()) {
            Auth::logout();

            return back()
                ->withErrors(['email' => 'Anda tidak memiliki akses ke panel admin.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended($user->staffHome());
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('backend.login');
    }
}
