<?php

namespace App\Http\Controllers\Backend;

use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Reservation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class PaymentManagementController extends Controller
{
    public function index(Request $request): View
    {
        $activeTab = $this->allowedTab($request, [
            'methods' => 'payment_methods.view',
            'transactions' => 'payments.view',
        ], 'transactions');
        $user = $request->user();

        $paymentMethods = $user->allows('payment_methods.view')
            ? PaymentMethod::orderBy('sort_order')->paginate(10)->withQueryString()
            : $this->emptyPage();
        $payments = ! $user->allows('payments.view')
            ? $this->emptyPage()
            : Payment::with(['reservation', 'paymentMethod', 'verifier'])
            ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
            ->when($request->filled('q'), function ($q) use ($request) {
                $term = '%' . $request->q . '%';
                $q->where(function ($inner) use ($term) {
                    $inner->where('invoice_number', 'like', $term)
                        ->orWhereHas('reservation', fn ($reservation) => $reservation->where('booking_code', 'like', $term));
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('backend.payment-management.index', compact('activeTab', 'paymentMethods', 'payments'));
    }

    // Payment Methods
    public function storePaymentMethod(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:50', 'unique:payment_methods,code'],
            'type' => ['required', Rule::in(['bank_transfer', 'cash', 'ewallet', 'credit_card', 'other'])],
            'account_number' => ['nullable', 'string', 'max:100'],
            'account_name' => ['nullable', 'string', 'max:255'],
            'instructions' => ['nullable', 'string'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $logoPath = $request->hasFile('logo')
            ? $request->file('logo')->store('payment-methods', 'public')
            : null;

        PaymentMethod::create([
            'name' => $data['name'],
            'code' => filled($data['code'] ?? null) ? $data['code'] : $this->paymentMethodCode($data['name']),
            'type' => $data['type'],
            'account_number' => $data['account_number'] ?? null,
            'account_name' => $data['account_name'] ?? null,
            'instructions' => $data['instructions'] ?? null,
            'logo_path' => $logoPath,
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $data['sort_order'] ?? 0,
        ]);

        return redirect()
            ->route('backend.payment-management.index', ['tab' => 'methods'])
            ->with('success', 'Metode pembayaran berhasil dibuat.');
    }

    public function updatePaymentMethod(Request $request, PaymentMethod $paymentMethod): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:50', Rule::unique('payment_methods', 'code')->ignore($paymentMethod->id)],
            'type' => ['required', Rule::in(['bank_transfer', 'cash', 'ewallet', 'credit_card', 'other'])],
            'account_number' => ['nullable', 'string', 'max:100'],
            'account_name' => ['nullable', 'string', 'max:255'],
            'instructions' => ['nullable', 'string'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $payload = [
            'name' => $data['name'],
            'code' => $data['code'] ?? $paymentMethod->code,
            'type' => $data['type'],
            'account_number' => $data['account_number'] ?? null,
            'account_name' => $data['account_name'] ?? null,
            'instructions' => $data['instructions'] ?? null,
            'is_active' => $request->boolean('is_active'),
            'sort_order' => $data['sort_order'] ?? 0,
        ];

        if ($request->hasFile('logo')) {
            if ($paymentMethod->logo_path) {
                Storage::disk('public')->delete($paymentMethod->logo_path);
            }
            $payload['logo_path'] = $request->file('logo')->store('payment-methods', 'public');
        }

        $paymentMethod->update($payload);

        return redirect()
            ->route('backend.payment-management.index', ['tab' => 'methods'])
            ->with('success', 'Metode pembayaran berhasil diperbarui.');
    }

    public function destroyPaymentMethod(PaymentMethod $paymentMethod): RedirectResponse
    {
        if ($paymentMethod->payments()->withTrashed()->exists()) {
            return back()->with('error', 'Metode pembayaran masih digunakan transaksi.');
        }

        if ($paymentMethod->logo_path) {
            Storage::disk('public')->delete($paymentMethod->logo_path);
        }

        $paymentMethod->delete();

        return redirect()
            ->route('backend.payment-management.index', ['tab' => 'methods'])
            ->with('success', 'Metode pembayaran berhasil dihapus.');
    }

    // Transactions
    public function storePayment(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'reservation_id' => ['required', 'exists:reservations,id'],
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'status' => ['required', Rule::in(['unpaid', 'waiting_verification', 'paid', 'rejected'])],
            'proof' => ['nullable', 'image', 'max:4096'],
            'reference_code' => ['nullable', 'string', 'max:100'],
            'notes' => ['nullable', 'string'],
        ]);
        $this->assertPaymentTargets($data);

        $proofPath = $request->hasFile('proof')
            ? $request->file('proof')->store('payments', 'public')
            : null;

        $message = DB::transaction(function () use ($data, $proofPath) {
            $payment = Payment::create([
                'reservation_id' => $data['reservation_id'],
                'payment_method_id' => $data['payment_method_id'],
                'invoice_number' => $this->generateInvoiceNumber(),
                'amount' => $data['amount'],
                'status' => 'unpaid',
                'proof_path' => $proofPath,
                'reference_code' => $data['reference_code'] ?? null,
                'notes' => $data['notes'] ?? null,
            ]);

            $previousStatus = $payment->reservation?->status;
            $this->applyPaymentStatus($payment, $data['status']);
            $payment->reservation?->syncPaymentConfirmation();

            return $this->withReservationNote(
                'Pembayaran berhasil dibuat.',
                $previousStatus,
                Reservation::find($payment->reservation_id)?->status
            );
        });

        return redirect()
            ->route('backend.payment-management.index', ['tab' => 'transactions'])
            ->with('success', $message);
    }

    public function updatePayment(Request $request, Payment $payment): RedirectResponse
    {
        $data = $request->validate([
            'reservation_id' => ['required', 'exists:reservations,id'],
            'payment_method_id' => ['required', 'exists:payment_methods,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'status' => ['required', Rule::in(['unpaid', 'waiting_verification', 'paid', 'rejected', 'refunded'])],
            'proof' => ['nullable', 'image', 'max:4096'],
            'reference_code' => ['nullable', 'string', 'max:100'],
            'notes' => ['nullable', 'string'],
            'rejection_reason' => ['nullable', 'string', 'max:255'],
        ]);

        if ($data['status'] === 'refunded' && ! in_array($payment->status, ['paid', 'refunded'], true)) {
            throw ValidationException::withMessages([
                'status' => 'Hanya pembayaran yang sudah lunas yang dapat diubah menjadi refund.',
            ]);
        }

        $this->assertPaymentTargets($data, $payment);

        $message = DB::transaction(function () use ($request, $payment, $data) {
            $previousReservationId = $payment->reservation_id;
            $rejectionReason = $request->exists('rejection_reason')
                ? ($data['rejection_reason'] ?? null)
                : $payment->rejection_reason;

            $payload = [
                'reservation_id' => $data['reservation_id'],
                'payment_method_id' => $data['payment_method_id'],
                'amount' => $data['amount'],
                'reference_code' => $data['reference_code'] ?? null,
                'notes' => $data['notes'] ?? null,
            ];

            if ($request->hasFile('proof')) {
                if ($payment->proof_path) {
                    Storage::disk('public')->delete($payment->proof_path);
                }
                $payload['proof_path'] = $request->file('proof')->store('payments', 'public');
            }

            $payment->update($payload);
            $this->applyPaymentStatus($payment, $data['status'], $rejectionReason);

            $tracked = Reservation::whereIn('id', array_unique([
                $previousReservationId,
                $payment->reservation_id,
            ]))->get()->keyBy('id');
            $previousStatus = $tracked->get($payment->reservation_id)?->status;
            $tracked->each->syncPaymentConfirmation();

            return $this->withReservationNote(
                'Pembayaran berhasil diperbarui.',
                $previousStatus,
                Reservation::find($payment->reservation_id)?->status
            );
        });

        return redirect()
            ->route('backend.payment-management.index', ['tab' => 'transactions'])
            ->with('success', $message);
    }

    public function verifyPayment(Request $request, Payment $payment): RedirectResponse
    {
        if (! in_array($payment->status, ['waiting_verification', 'unpaid'], true)) {
            return back()->with('error', 'Pembayaran tidak dapat diverifikasi pada status saat ini.');
        }

        if (bccomp((string) $payment->amount, '0', 2) !== 1) {
            return back()->with('error', 'Nominal pembayaran harus lebih dari nol.');
        }

        $message = DB::transaction(function () use ($payment) {
            $previousStatus = $payment->reservation?->status;
            $this->applyPaymentStatus($payment, 'paid');
            $payment->reservation?->syncPaymentConfirmation();

            return $this->withReservationNote(
                'Pembayaran berhasil diverifikasi.',
                $previousStatus,
                Reservation::find($payment->reservation_id)?->status
            );
        });

        return redirect()
            ->route('backend.payment-management.index', ['tab' => 'transactions'])
            ->with('success', $message);
    }

    public function refundPayment(Request $request, Payment $payment): RedirectResponse
    {
        if ($payment->status !== 'paid') {
            return back()->with('error', 'Hanya pembayaran berstatus paid yang dapat direfund.');
        }

        $data = $request->validate([
            'notes' => ['nullable', 'string'],
        ]);

        $message = DB::transaction(function () use ($payment, $data) {
            $previousStatus = $payment->reservation?->status;
            if (array_key_exists('notes', $data)) {
                $payment->update(['notes' => $data['notes']]);
            }
            $this->applyPaymentStatus($payment, 'refunded');
            $payment->reservation?->syncPaymentConfirmation();

            return $this->withReservationNote(
                'Refund berhasil dicatat.',
                $previousStatus,
                Reservation::find($payment->reservation_id)?->status
            );
        });

        return redirect()
            ->route('backend.payment-management.index', ['tab' => 'transactions'])
            ->with('success', $message);
    }

    public function destroyPayment(Payment $payment): RedirectResponse
    {
        if ($payment->status === 'paid') {
            return back()->with('error', 'Pembayaran yang sudah lunas tidak dapat dihapus.');
        }

        if ($payment->proof_path) {
            Storage::disk('public')->delete($payment->proof_path);
        }

        $payment->delete();

        return redirect()
            ->route('backend.payment-management.index', ['tab' => 'transactions'])
            ->with('success', 'Pembayaran berhasil dihapus.');
    }

    private function generateInvoiceNumber(): string
    {
        do {
            $code = 'INV-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));
        } while (Payment::withTrashed()->where('invoice_number', $code)->exists());

        return $code;
    }

    private function paymentMethodCode(string $name): string
    {
        $base = Str::upper(Str::slug($name, '_'));
        if ($base === '') {
            $base = 'METHOD';
        }
        $base = substr($base, 0, 40);

        $code = $base;
        $suffix = 2;
        while (PaymentMethod::withTrashed()->where('code', $code)->exists()) {
            $code = $base.'_'.$suffix;
            $suffix++;
        }

        return $code;
    }

    private function assertPaymentTargets(array $data, ?Payment $payment = null): void
    {
        $reservation = Reservation::find($data['reservation_id']);
        $sameReservation = $payment && (int) $payment->reservation_id === (int) $reservation?->id;
        if (! $reservation || (! $sameReservation && in_array($reservation->status, ['cancelled', 'expired'], true))) {
            throw ValidationException::withMessages([
                'reservation_id' => 'Reservasi yang dibatalkan atau kedaluwarsa tidak dapat menerima pembayaran.',
            ]);
        }

        $method = PaymentMethod::withTrashed()->find($data['payment_method_id']);
        $sameMethod = $payment && (int) $payment->payment_method_id === (int) $method?->id;
        if (! $method || $method->trashed() || (! $sameMethod && ! $method->is_active)) {
            throw ValidationException::withMessages([
                'payment_method_id' => 'Metode pembayaran tidak aktif.',
            ]);
        }
    }

    private function applyPaymentStatus(Payment $payment, string $status, ?string $rejectionReason = null): void
    {
        if ($status === 'paid') {
            $payment->update([
                'status' => 'paid',
                'paid_at' => $payment->paid_at ?? now(),
                'verified_by' => $payment->verified_by ?? auth()->id(),
                'verified_at' => $payment->verified_at ?? now(),
                'rejection_reason' => null,
            ]);

            return;
        }

        $leavingPaid = $payment->status === 'paid' || $payment->paid_at !== null;

        $payment->update([
            'status' => $status,
            'paid_at' => null,
            'verified_by' => $leavingPaid ? null : $payment->verified_by,
            'verified_at' => $leavingPaid ? null : $payment->verified_at,
            'rejection_reason' => $status === 'rejected' ? $rejectionReason : null,
        ]);
    }

    private function withReservationNote(string $message, ?string $beforeStatus, ?string $afterStatus): string
    {
        if ($beforeStatus === 'pending_payment' && $afterStatus === 'confirmed') {
            return $message.' Reservasi dikonfirmasi karena pembayaran sudah menutup tagihan.';
        }

        if ($beforeStatus === 'confirmed' && $afterStatus === 'pending_payment') {
            return $message.' Reservasi kembali menunggu pelunasan.';
        }

        return $message;
    }
}
