<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CustomerAuthController extends Controller
{
    public function showLoginForm(): View|RedirectResponse
    {
        if ($redirect = $this->redirectAuthenticated()) {
            return $redirect;
        }

        return view('frontend.login.login');
    }

    public function login(Request $request): RedirectResponse
    {
        if ($redirect = $this->redirectAuthenticated()) {
            return $redirect;
        }

        $request->merge([
            'email' => mb_strtolower((string) $request->input('email')),
        ]);

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

        if ($user->isStaff() || ! $user->hasRole('customer')) {
            Auth::logout();

            return back()
                ->withErrors(['email' => 'Akun ini tidak dapat masuk melalui halaman customer.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return $this->redirectAfterLogin();
    }

    public function showRegisterForm(): View|RedirectResponse
    {
        if ($redirect = $this->redirectAuthenticated()) {
            return $redirect;
        }

        return view('frontend.login.register');
    }

    public function register(Request $request): RedirectResponse
    {
        if ($redirect = $this->redirectAuthenticated()) {
            return $redirect;
        }

        $request->merge([
            'email' => mb_strtolower((string) $request->input('email')),
        ]);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['nullable', 'string', 'max:30', 'unique:users,phone'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $role = Role::query()->where('slug', 'customer')->where('is_active', true)->first();

        if (! $role) {
            throw ValidationException::withMessages([
                'email' => 'Registrasi customer belum tersedia.',
            ]);
        }

        $user = DB::transaction(function () use ($data, $role) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'password' => $data['password'],
                'is_active' => true,
            ]);

            $user->roles()->attach($role->id);
            $user->customerProfile()->create([]);

            return $user;
        });

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()
            ->route('home')
            ->with('success', 'Akun customer berhasil dibuat.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    private function redirectAuthenticated(): ?RedirectResponse
    {
        $user = Auth::user();

        if (! $user) {
            return null;
        }

        if ($user->isStaff()) {
            return redirect()->route('backend.dashboard');
        }

        return redirect()->route('home');
    }

    private function redirectAfterLogin(): RedirectResponse
    {
        $target = redirect()->intended(route('home'))->getTargetUrl();

        if (str_contains($target, '/admin')) {
            return redirect()->route('home');
        }

        return redirect()->to($target);
    }
}
