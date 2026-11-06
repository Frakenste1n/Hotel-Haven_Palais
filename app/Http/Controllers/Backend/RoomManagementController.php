<?php

namespace App\Http\Controllers\Backend;

use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\RoomFacility;
use App\Models\RoomImage;
use App\Models\RoomType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RoomManagementController extends Controller
{
    public function index(Request $request): View
    {
        $activeTab = $this->allowedTab($request, [
            'categories' => 'room_categories.view',
            'types' => 'room_types.view',
            'units' => 'rooms.view',
            'facilities' => 'room_facilities.view',
            'photos' => 'room_types.view',
        ], 'categories');
        $user = $request->user();

        $categories = $user->allows('room_categories.view')
            ? RoomCategory::withCount('roomTypes')->orderBy('sort_order')->paginate(10)
            : $this->emptyPage();
        $roomTypes = $user->allows('room_types.view')
            ? RoomType::with(['category', 'facilities'])->withCount('rooms')->latest()->paginate(10, ['*'], 'types_page')->withQueryString()
            : $this->emptyPage();
        $rooms = $user->allows('rooms.view')
            ? Room::with('roomType')
                ->when($request->filled('status'), fn ($q) => $q->where('status', $request->status))
                ->when($request->filled('q'), function ($q) use ($request) {
                    $term = '%' . $request->q . '%';
                    $q->where(function ($inner) use ($term) {
                        $inner->where('room_number', 'like', $term)
                            ->orWhere('floor', 'like', $term)
                            ->orWhereHas('roomType', fn ($type) => $type->where('name', 'like', $term));
                    });
                })
                ->latest()
                ->paginate(10)
            : $this->emptyPage();
        $facilities = $user->allows('room_facilities.view')
            ? RoomFacility::orderBy('name')->paginate(10, ['*'], 'facilities_page')->withQueryString()
            : $this->emptyPage();
        $roomImages = $user->allows('room_types.view')
            ? RoomImage::with('roomType')->orderBy('sort_order')->paginate(12, ['*'], 'images_page')->withQueryString()
            : $this->emptyPage();

        return view('backend.room-management.index', compact('activeTab', 'categories', 'roomTypes', 'rooms', 'facilities', 'roomImages'));
    }

    // Room Categories
    public function storeCategory(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:room_categories,slug'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        RoomCategory::create([
            'name' => $data['name'],
            'slug' => $data['slug'] ?? $this->uniqueSlug($data['name'], RoomCategory::class),
            'description' => $data['description'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('backend.room-management.index', ['tab' => 'categories'])
            ->with('success', 'Kategori kamar berhasil dibuat.');
    }

    public function updateCategory(Request $request, RoomCategory $roomCategory): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('room_categories', 'slug')->ignore($roomCategory->id)],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $roomCategory->update([
            'name' => $data['name'],
            'slug' => $data['slug'] ?? $this->uniqueSlug($data['name'], RoomCategory::class, $roomCategory->id),
            'description' => $data['description'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('backend.room-management.index', ['tab' => 'categories'])
            ->with('success', 'Kategori kamar berhasil diperbarui.');
    }

    public function destroyCategory(RoomCategory $roomCategory): RedirectResponse
    {
        if ($roomCategory->roomTypes()->exists()) {
            return back()->with('error', 'Kategori masih digunakan tipe kamar.');
        }

        $roomCategory->delete();

        return redirect()
            ->route('backend.room-management.index', ['tab' => 'categories'])
            ->with('success', 'Kategori kamar berhasil dihapus.');
    }

    // Room Types
    public function storeType(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'room_category_id' => ['required', 'exists:room_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:room_types,slug'],
            'description' => ['nullable', 'string'],
            'summary' => ['nullable', 'string'],
            'base_price' => ['required', 'numeric', 'min:0'],
            'capacity_adults' => ['required', 'integer', 'min:1'],
            'capacity_children' => ['nullable', 'integer', 'min:0'],
            'bed_type' => ['nullable', 'string', 'max:100'],
            'room_size' => ['nullable', 'numeric', 'min:0'],
            'max_occupancy' => ['nullable', 'integer', 'min:1'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'facility_ids' => ['nullable', 'array'],
            'facility_ids.*' => ['integer', 'exists:room_facilities,id'],
        ]);

        $roomType = RoomType::create([
            'room_category_id' => $data['room_category_id'],
            'name' => $data['name'],
            'slug' => $data['slug'] ?? $this->uniqueSlug($data['name'], RoomType::class),
            'description' => $data['description'] ?? null,
            'summary' => $data['summary'] ?? null,
            'base_price' => $data['base_price'],
            'capacity_adults' => $data['capacity_adults'],
            'capacity_children' => $data['capacity_children'] ?? 0,
            'bed_type' => $data['bed_type'] ?? null,
            'room_size' => $data['room_size'] ?? null,
            'max_occupancy' => $data['max_occupancy'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        $roomType->facilities()->sync($data['facility_ids'] ?? []);

        return redirect()
            ->route('backend.room-management.index', ['tab' => 'types'])
            ->with('success', 'Tipe kamar berhasil dibuat.');
    }

    public function updateType(Request $request, RoomType $roomType): RedirectResponse
    {
        $data = $request->validate([
            'room_category_id' => ['required', 'exists:room_categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('room_types', 'slug')->ignore($roomType->id)],
            'description' => ['nullable', 'string'],
            'summary' => ['nullable', 'string'],
            'base_price' => ['required', 'numeric', 'min:0'],
            'capacity_adults' => ['required', 'integer', 'min:1'],
            'capacity_children' => ['nullable', 'integer', 'min:0'],
            'bed_type' => ['nullable', 'string', 'max:100'],
            'room_size' => ['nullable', 'numeric', 'min:0'],
            'max_occupancy' => ['nullable', 'integer', 'min:1'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'facility_ids' => ['nullable', 'array'],
            'facility_ids.*' => ['integer', 'exists:room_facilities,id'],
        ]);

        $roomType->update([
            'room_category_id' => $data['room_category_id'],
            'name' => $data['name'],
            'slug' => $data['slug'] ?? $this->uniqueSlug($data['name'], RoomType::class, $roomType->id),
            'description' => $data['description'] ?? null,
            'summary' => $data['summary'] ?? null,
            'base_price' => $data['base_price'],
            'capacity_adults' => $data['capacity_adults'],
            'capacity_children' => $data['capacity_children'] ?? 0,
            'bed_type' => $data['bed_type'] ?? null,
            'room_size' => $data['room_size'] ?? null,
            'max_occupancy' => $data['max_occupancy'] ?? null,
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        $roomType->facilities()->sync($data['facility_ids'] ?? []);

        return redirect()
            ->route('backend.room-management.index', ['tab' => 'types'])
            ->with('success', 'Tipe kamar berhasil diperbarui.');
    }

    public function destroyType(RoomType $roomType): RedirectResponse
    {
        if ($roomType->rooms()->exists() || $roomType->reservationDetails()->exists()) {
            return back()->with('error', 'Tipe kamar masih digunakan dan tidak dapat dihapus.');
        }

        $roomType->facilities()->detach();
        $roomType->delete();

        return redirect()
            ->route('backend.room-management.index', ['tab' => 'types'])
            ->with('success', 'Tipe kamar berhasil dihapus.');
    }

    // Room Units
    public function storeRoom(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'room_type_id' => ['required', 'exists:room_types,id'],
            'room_number' => ['required', 'string', 'max:50', 'unique:rooms,room_number'],
            'floor' => ['nullable', 'string', 'max:20'],
            'status' => ['required', Rule::in(['available', 'occupied', 'maintenance', 'out_of_order', 'cleaning'])],
            'notes' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        Room::create([
            'room_type_id' => $data['room_type_id'],
            'room_number' => $data['room_number'],
            'floor' => $data['floor'] ?? null,
            'status' => $data['status'],
            'notes' => $data['notes'] ?? null,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('backend.room-management.index', ['tab' => 'units'])
            ->with('success', 'Unit kamar berhasil dibuat.');
    }

    public function updateRoom(Request $request, Room $room): RedirectResponse
    {
        $data = $request->validate([
            'room_type_id' => ['required', 'exists:room_types,id'],
            'room_number' => ['required', 'string', 'max:50', Rule::unique('rooms', 'room_number')->ignore($room->id)],
            'floor' => ['nullable', 'string', 'max:20'],
            'status' => ['required', Rule::in(['available', 'occupied', 'maintenance', 'out_of_order', 'cleaning'])],
            'notes' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $room->update([
            'room_type_id' => $data['room_type_id'],
            'room_number' => $data['room_number'],
            'floor' => $data['floor'] ?? null,
            'status' => $data['status'],
            'notes' => $data['notes'] ?? null,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('backend.room-management.index', ['tab' => 'units'])
            ->with('success', 'Unit kamar berhasil diperbarui.');
    }

    public function destroyRoom(Room $room): RedirectResponse
    {
        if ($room->reservationDetails()->exists()) {
            return back()->with('error', 'Unit kamar masih terkait reservasi.');
        }

        $room->delete();

        return redirect()
            ->route('backend.room-management.index', ['tab' => 'units'])
            ->with('success', 'Unit kamar berhasil dihapus.');
    }

    // Room Facilities
    public function storeFacility(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        RoomFacility::create([
            'name' => $data['name'],
            'icon' => $data['icon'] ?? null,
            'description' => $data['description'] ?? null,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('backend.room-management.index', ['tab' => 'facilities'])
            ->with('success', 'Fasilitas kamar berhasil dibuat.');
    }

    public function updateFacility(Request $request, RoomFacility $facility): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $facility->update([
            'name' => $data['name'],
            'icon' => $data['icon'] ?? null,
            'description' => $data['description'] ?? null,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('backend.room-management.index', ['tab' => 'facilities'])
            ->with('success', 'Fasilitas kamar berhasil diperbarui.');
    }

    public function destroyFacility(RoomFacility $facility): RedirectResponse
    {
        $facility->delete();

        return redirect()
            ->route('backend.room-management.index', ['tab' => 'facilities'])
            ->with('success', 'Fasilitas kamar berhasil dihapus.');
    }

    public function storeImage(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'room_type_id' => ['required', 'exists:room_types,id'],
            'image' => ['required', 'image', 'max:4096'],
            'caption' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_primary' => ['nullable', 'boolean'],
        ]);

        $roomType = RoomType::findOrFail($data['room_type_id']);
        $isPrimary = $request->boolean('is_primary');

        if ($isPrimary) {
            $roomType->images()->update(['is_primary' => false]);
        }

        $roomType->images()->create([
            'image_path' => $request->file('image')->store('room-images', 'public'),
            'caption' => $data['caption'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_primary' => $isPrimary,
        ]);

        return redirect()
            ->route('backend.room-management.index', ['tab' => 'photos'])
            ->with('success', 'Foto kamar berhasil ditambahkan.');
    }

    public function updateImage(Request $request, RoomImage $roomImage): RedirectResponse
    {
        $data = $request->validate([
            'room_type_id' => ['required', 'exists:room_types,id'],
            'image' => ['nullable', 'image', 'max:4096'],
            'caption' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_primary' => ['nullable', 'boolean'],
        ]);

        $payload = [
            'room_type_id' => $data['room_type_id'],
            'caption' => $data['caption'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_primary' => $request->boolean('is_primary'),
        ];

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($roomImage->image_path);
            $payload['image_path'] = $request->file('image')->store('room-images', 'public');
        }

        if ($payload['is_primary']) {
            RoomImage::where('room_type_id', $data['room_type_id'])->where('id', '!=', $roomImage->id)->update(['is_primary' => false]);
        }

        $roomImage->update($payload);

        return redirect()
            ->route('backend.room-management.index', ['tab' => 'photos'])
            ->with('success', 'Foto kamar berhasil diperbarui.');
    }

    public function destroyImage(RoomImage $roomImage): RedirectResponse
    {
        Storage::disk('public')->delete($roomImage->image_path);
        $roomImage->delete();

        return redirect()
            ->route('backend.room-management.index', ['tab' => 'photos'])
            ->with('success', 'Foto kamar berhasil dihapus.');
    }
}
