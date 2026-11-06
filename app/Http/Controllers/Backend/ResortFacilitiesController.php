<?php

namespace App\Http\Controllers\Backend;

use App\Models\FacilityCategory;
use App\Models\FacilityImage;
use App\Models\ResortFacility;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ResortFacilitiesController extends Controller
{
    public function index(Request $request): View
    {
        $activeTab = $request->get('tab', 'categories');
        
        $categories = FacilityCategory::withCount('resortFacilities')->orderBy('sort_order')->paginate(10);
        $facilities = ResortFacility::with('category')->orderBy('sort_order')->paginate(10, ['*'], 'facilities_page')->withQueryString();
        $facilityImages = FacilityImage::with('resortFacility')->orderBy('sort_order')->paginate(12, ['*'], 'images_page')->withQueryString();

        return view('backend.resort-facilities.index', compact('activeTab', 'categories', 'facilities', 'facilityImages'));
    }

    // Categories
    public function storeCategory(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:facility_categories,slug'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        FacilityCategory::create([
            'name' => $data['name'],
            'slug' => $data['slug'] ?? $this->uniqueSlug($data['name'], FacilityCategory::class),
            'description' => $data['description'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('backend.resort-facilities.index', ['tab' => 'categories'])
            ->with('success', 'Kategori fasilitas berhasil dibuat.');
    }

    public function updateCategory(Request $request, FacilityCategory $facilityCategory): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('facility_categories', 'slug')->ignore($facilityCategory->id)],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $facilityCategory->update([
            'name' => $data['name'],
            'slug' => $data['slug'] ?? $this->uniqueSlug($data['name'], FacilityCategory::class, $facilityCategory->id),
            'description' => $data['description'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('backend.resort-facilities.index', ['tab' => 'categories'])
            ->with('success', 'Kategori fasilitas berhasil diperbarui.');
    }

    public function destroyCategory(FacilityCategory $facilityCategory): RedirectResponse
    {
        if ($facilityCategory->resortFacilities()->exists()) {
            return back()->with('error', 'Kategori masih digunakan fasilitas resort.');
        }

        $facilityCategory->delete();

        return redirect()
            ->route('backend.resort-facilities.index', ['tab' => 'categories'])
            ->with('success', 'Kategori fasilitas berhasil dihapus.');
    }

    // Facilities
    public function storeFacility(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'facility_category_id' => ['required', 'exists:facility_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:resort_facilities,slug'],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'operating_hours' => ['nullable', 'string', 'max:255'],
            'is_chargeable' => ['nullable', 'boolean'],
            'fee' => ['nullable', 'numeric', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        ResortFacility::create([
            'facility_category_id' => $data['facility_category_id'],
            'name' => $data['name'],
            'slug' => $data['slug'] ?? $this->uniqueSlug($data['name'], ResortFacility::class),
            'description' => $data['description'] ?? null,
            'location' => $data['location'] ?? null,
            'operating_hours' => $data['operating_hours'] ?? null,
            'is_chargeable' => $request->boolean('is_chargeable'),
            'fee' => $data['fee'] ?? null,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $data['sort_order'] ?? 0,
        ]);

        return redirect()
            ->route('backend.resort-facilities.index', ['tab' => 'facilities'])
            ->with('success', 'Fasilitas resort berhasil dibuat.');
    }

    public function updateFacility(Request $request, ResortFacility $resortFacility): RedirectResponse
    {
        $data = $request->validate([
            'facility_category_id' => ['required', 'exists:facility_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('resort_facilities', 'slug')->ignore($resortFacility->id)],
            'description' => ['nullable', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'operating_hours' => ['nullable', 'string', 'max:255'],
            'is_chargeable' => ['nullable', 'boolean'],
            'fee' => ['nullable', 'numeric', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $resortFacility->update([
            'facility_category_id' => $data['facility_category_id'],
            'name' => $data['name'],
            'slug' => $data['slug'] ?? $this->uniqueSlug($data['name'], ResortFacility::class, $resortFacility->id),
            'description' => $data['description'] ?? null,
            'location' => $data['location'] ?? null,
            'operating_hours' => $data['operating_hours'] ?? null,
            'is_chargeable' => $request->boolean('is_chargeable'),
            'fee' => $data['fee'] ?? null,
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $data['sort_order'] ?? 0,
        ]);

        return redirect()
            ->route('backend.resort-facilities.index', ['tab' => 'facilities'])
            ->with('success', 'Fasilitas resort berhasil diperbarui.');
    }

    public function destroyFacility(ResortFacility $resortFacility): RedirectResponse
    {
        $resortFacility->delete();

        return redirect()
            ->route('backend.resort-facilities.index', ['tab' => 'facilities'])
            ->with('success', 'Fasilitas resort berhasil dihapus.');
    }

    public function storeImage(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'resort_facility_id' => ['required', 'exists:resort_facilities,id'],
            'image' => ['required', 'image', 'max:4096'],
            'caption' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_primary' => ['nullable', 'boolean'],
        ]);

        $facility = ResortFacility::findOrFail($data['resort_facility_id']);
        $isPrimary = $request->boolean('is_primary');

        if ($isPrimary) {
            $facility->images()->update(['is_primary' => false]);
        }

        $facility->images()->create([
            'image_path' => $request->file('image')->store('facility-images', 'public'),
            'caption' => $data['caption'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_primary' => $isPrimary,
        ]);

        return redirect()
            ->route('backend.resort-facilities.index', ['tab' => 'photos'])
            ->with('success', 'Foto fasilitas berhasil ditambahkan.');
    }

    public function updateImage(Request $request, FacilityImage $facilityImage): RedirectResponse
    {
        $data = $request->validate([
            'resort_facility_id' => ['required', 'exists:resort_facilities,id'],
            'image' => ['nullable', 'image', 'max:4096'],
            'caption' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_primary' => ['nullable', 'boolean'],
        ]);

        $payload = [
            'resort_facility_id' => $data['resort_facility_id'],
            'caption' => $data['caption'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_primary' => $request->boolean('is_primary'),
        ];

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($facilityImage->image_path);
            $payload['image_path'] = $request->file('image')->store('facility-images', 'public');
        }

        if ($payload['is_primary']) {
            FacilityImage::where('resort_facility_id', $data['resort_facility_id'])
                ->where('id', '!=', $facilityImage->id)
                ->update(['is_primary' => false]);
        }

        $facilityImage->update($payload);

        return redirect()
            ->route('backend.resort-facilities.index', ['tab' => 'photos'])
            ->with('success', 'Foto fasilitas berhasil diperbarui.');
    }

    public function destroyImage(FacilityImage $facilityImage): RedirectResponse
    {
        Storage::disk('public')->delete($facilityImage->image_path);
        $facilityImage->delete();

        return redirect()
            ->route('backend.resort-facilities.index', ['tab' => 'photos'])
            ->with('success', 'Foto fasilitas berhasil dihapus.');
    }
}
