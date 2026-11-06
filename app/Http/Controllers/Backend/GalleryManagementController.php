<?php

namespace App\Http\Controllers\Backend;

use App\Models\Gallery;
use App\Models\GalleryCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class GalleryManagementController extends Controller
{
    public function index(Request $request): View
    {
        $activeTab = $request->get('tab', 'categories');
        
        $categories = GalleryCategory::withCount('galleries')->orderBy('sort_order')->paginate(10);
        $galleries = Gallery::with('category')->orderBy('sort_order')->paginate(10);

        return view('backend.gallery.index', compact('activeTab', 'categories', 'galleries'));
    }

    // Categories
    public function storeCategory(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:gallery_categories,slug'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        GalleryCategory::create([
            'name' => $data['name'],
            'slug' => $data['slug'] ?? $this->uniqueSlug($data['name'], GalleryCategory::class),
            'description' => $data['description'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('backend.gallery.index', ['tab' => 'categories'])
            ->with('success', 'Kategori galeri berhasil dibuat.');
    }

    public function updateCategory(Request $request, GalleryCategory $galleryCategory): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('gallery_categories', 'slug')->ignore($galleryCategory->id)],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $galleryCategory->update([
            'name' => $data['name'],
            'slug' => $data['slug'] ?? $this->uniqueSlug($data['name'], GalleryCategory::class, $galleryCategory->id),
            'description' => $data['description'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('backend.gallery.index', ['tab' => 'categories'])
            ->with('success', 'Kategori galeri berhasil diperbarui.');
    }

    public function destroyCategory(GalleryCategory $galleryCategory): RedirectResponse
    {
        if ($galleryCategory->galleries()->exists()) {
            return back()->with('error', 'Kategori masih memiliki item galeri.');
        }

        $galleryCategory->delete();

        return redirect()
            ->route('backend.gallery.index', ['tab' => 'categories'])
            ->with('success', 'Kategori galeri berhasil dihapus.');
    }

    // Gallery Items
    public function storeGallery(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'gallery_category_id' => ['required', 'exists:gallery_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'file' => ['required', 'file', 'max:10240', 'mimes:jpg,jpeg,png,webp,gif,mp4,webm'],
            'file_type' => ['required', Rule::in(['image', 'video'])],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $path = $request->file('file')->store('galleries', 'public');

        Gallery::create([
            'gallery_category_id' => $data['gallery_category_id'],
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'file_path' => $path,
            'file_type' => $data['file_type'],
            'sort_order' => $data['sort_order'] ?? 0,
            'is_published' => $request->boolean('is_published', true),
        ]);

        return redirect()
            ->route('backend.gallery.index', ['tab' => 'galleries'])
            ->with('success', 'Item galeri berhasil dibuat.');
    }

    public function updateGallery(Request $request, Gallery $gallery): RedirectResponse
    {
        $data = $request->validate([
            'gallery_category_id' => ['required', 'exists:gallery_categories,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'file' => ['nullable', 'file', 'max:10240', 'mimes:jpg,jpeg,png,webp,gif,mp4,webm'],
            'file_type' => ['required', Rule::in(['image', 'video'])],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $payload = [
            'gallery_category_id' => $data['gallery_category_id'],
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'file_type' => $data['file_type'],
            'sort_order' => $data['sort_order'] ?? 0,
            'is_published' => $request->boolean('is_published', true),
        ];

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($gallery->file_path);
            $payload['file_path'] = $request->file('file')->store('galleries', 'public');
        }

        $gallery->update($payload);

        return redirect()
            ->route('backend.gallery.index', ['tab' => 'galleries'])
            ->with('success', 'Item galeri berhasil diperbarui.');
    }

    public function destroyGallery(Gallery $gallery): RedirectResponse
    {
        Storage::disk('public')->delete($gallery->file_path);
        $gallery->delete();

        return redirect()
            ->route('backend.gallery.index', ['tab' => 'galleries'])
            ->with('success', 'Item galeri berhasil dihapus.');
    }
}
