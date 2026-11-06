<?php

namespace App\Http\Controllers\Backend;

use App\Models\Package;
use App\Models\Promotion;
use App\Models\RoomType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class PromotionsPackagesController extends Controller
{
    public function index(Request $request): View
    {
        $activeTab = $request->get('tab', 'promotions');
        
        $promotions = Promotion::latest()->paginate(10);
        $packages = Package::with('roomTypes')->latest()->paginate(10);

        return view('backend.promotions-packages.index', compact('activeTab', 'promotions', 'packages'));
    }

    // Promotions
    public function storePromotion(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:promotions,code'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:promotions,slug'],
            'summary' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'discount_type' => ['required', Rule::in(['percentage', 'fixed'])],
            'discount_value' => ['required', 'numeric', 'min:0'],
            'min_nights' => ['nullable', 'integer', 'min:1'],
            'min_amount' => ['nullable', 'numeric', 'min:0'],
            'max_uses' => ['nullable', 'integer', 'min:1'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'terms' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('promotions', 'public')
            : null;

        Promotion::create([
            'code' => strtoupper($data['code']),
            'name' => $data['name'],
            'slug' => $data['slug'] ?? $this->uniqueSlug($data['name'], Promotion::class),
            'summary' => $data['summary'] ?? null,
            'description' => $data['description'] ?? null,
            'image_path' => $imagePath,
            'discount_type' => $data['discount_type'],
            'discount_value' => $data['discount_value'],
            'min_nights' => $data['min_nights'] ?? null,
            'min_amount' => $data['min_amount'] ?? null,
            'max_uses' => $data['max_uses'] ?? null,
            'starts_at' => $data['starts_at'] ?? null,
            'ends_at' => $data['ends_at'] ?? null,
            'terms' => $data['terms'] ?? null,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('backend.promotions-packages.index', ['tab' => 'promotions'])
            ->with('success', 'Promo berhasil dibuat.');
    }

    public function updatePromotion(Request $request, Promotion $promotion): RedirectResponse
    {
        $data = $request->validate([
            'code' => ['required', 'string', 'max:50', Rule::unique('promotions', 'code')->ignore($promotion->id)],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('promotions', 'slug')->ignore($promotion->id)],
            'summary' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'discount_type' => ['required', Rule::in(['percentage', 'fixed'])],
            'discount_value' => ['required', 'numeric', 'min:0'],
            'min_nights' => ['nullable', 'integer', 'min:1'],
            'min_amount' => ['nullable', 'numeric', 'min:0'],
            'max_uses' => ['nullable', 'integer', 'min:1'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'terms' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $payload = [
            'code' => strtoupper($data['code']),
            'name' => $data['name'],
            'slug' => $data['slug'] ?? $this->uniqueSlug($data['name'], Promotion::class, $promotion->id),
            'summary' => $data['summary'] ?? null,
            'description' => $data['description'] ?? null,
            'discount_type' => $data['discount_type'],
            'discount_value' => $data['discount_value'],
            'min_nights' => $data['min_nights'] ?? null,
            'min_amount' => $data['min_amount'] ?? null,
            'max_uses' => $data['max_uses'] ?? null,
            'starts_at' => $data['starts_at'] ?? null,
            'ends_at' => $data['ends_at'] ?? null,
            'terms' => $data['terms'] ?? null,
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('image')) {
            if ($promotion->image_path) {
                Storage::disk('public')->delete($promotion->image_path);
            }
            $payload['image_path'] = $request->file('image')->store('promotions', 'public');
        }

        $promotion->update($payload);

        return redirect()
            ->route('backend.promotions-packages.index', ['tab' => 'promotions'])
            ->with('success', 'Promo berhasil diperbarui.');
    }

    public function destroyPromotion(Promotion $promotion): RedirectResponse
    {
        if ($promotion->reservations()->exists()) {
            return back()->with('error', 'Promo masih digunakan pada reservasi.');
        }

        if ($promotion->image_path) {
            Storage::disk('public')->delete($promotion->image_path);
        }

        $promotion->delete();

        return redirect()
            ->route('backend.promotions-packages.index', ['tab' => 'promotions'])
            ->with('success', 'Promo berhasil dihapus.');
    }

    // Packages
    public function storePackage(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:packages,slug'],
            'summary' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'price' => ['required', 'numeric', 'min:0'],
            'benefits' => ['nullable', 'string'],
            'nights' => ['nullable', 'integer', 'min:1'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'is_active' => ['nullable', 'boolean'],
            'room_type_ids' => ['nullable', 'array'],
            'room_type_ids.*' => ['integer', 'exists:room_types,id'],
        ]);

        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('packages', 'public')
            : null;

        $package = Package::create([
            'name' => $data['name'],
            'slug' => $data['slug'] ?? $this->uniqueSlug($data['name'], Package::class),
            'summary' => $data['summary'] ?? null,
            'description' => $data['description'] ?? null,
            'image_path' => $imagePath,
            'price' => $data['price'],
            'benefits' => $this->parseBenefits($data['benefits'] ?? null),
            'nights' => $data['nights'] ?? null,
            'starts_at' => $data['starts_at'] ?? null,
            'ends_at' => $data['ends_at'] ?? null,
            'is_active' => $request->boolean('is_active', true),
        ]);

        $package->roomTypes()->sync($data['room_type_ids'] ?? []);

        return redirect()
            ->route('backend.promotions-packages.index', ['tab' => 'packages'])
            ->with('success', 'Paket berhasil dibuat.');
    }

    public function updatePackage(Request $request, Package $package): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('packages', 'slug')->ignore($package->id)],
            'summary' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'price' => ['required', 'numeric', 'min:0'],
            'benefits' => ['nullable', 'string'],
            'nights' => ['nullable', 'integer', 'min:1'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
            'is_active' => ['nullable', 'boolean'],
            'room_type_ids' => ['nullable', 'array'],
            'room_type_ids.*' => ['integer', 'exists:room_types,id'],
        ]);

        $payload = [
            'name' => $data['name'],
            'slug' => $data['slug'] ?? $this->uniqueSlug($data['name'], Package::class, $package->id),
            'summary' => $data['summary'] ?? null,
            'description' => $data['description'] ?? null,
            'price' => $data['price'],
            'benefits' => $this->parseBenefits($data['benefits'] ?? null),
            'nights' => $data['nights'] ?? null,
            'starts_at' => $data['starts_at'] ?? null,
            'ends_at' => $data['ends_at'] ?? null,
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('image')) {
            if ($package->image_path) {
                Storage::disk('public')->delete($package->image_path);
            }
            $payload['image_path'] = $request->file('image')->store('packages', 'public');
        }

        $package->update($payload);
        $package->roomTypes()->sync($data['room_type_ids'] ?? []);

        return redirect()
            ->route('backend.promotions-packages.index', ['tab' => 'packages'])
            ->with('success', 'Paket berhasil diperbarui.');
    }

    public function destroyPackage(Package $package): RedirectResponse
    {
        if ($package->reservations()->exists()) {
            return back()->with('error', 'Paket masih digunakan pada reservasi.');
        }

        if ($package->image_path) {
            Storage::disk('public')->delete($package->image_path);
        }

        $package->roomTypes()->detach();
        $package->delete();

        return redirect()
            ->route('backend.promotions-packages.index', ['tab' => 'packages'])
            ->with('success', 'Paket berhasil dihapus.');
    }

    private function parseBenefits(?string $benefits): ?array
    {
        if ($benefits === null || trim($benefits) === '') {
            return null;
        }

        return collect(preg_split("/\r\n|\n|\r/", $benefits))
            ->map(fn ($item) => trim($item))
            ->filter()
            ->values()
            ->all();
    }
}
