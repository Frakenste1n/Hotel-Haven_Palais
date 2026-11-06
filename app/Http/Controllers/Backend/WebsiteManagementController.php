<?php

namespace App\Http\Controllers\Backend;

use App\Models\Banner;
use App\Models\PageContent;
use App\Models\Setting;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class WebsiteManagementController extends Controller
{
    public function index(Request $request): View
    {
        $setting = Setting::query()->first() ?? new Setting();
        $banners = Banner::orderBy('sort_order')->latest()->paginate(8, ['*'], 'banners_page')->withQueryString();
        $pageContents = PageContent::orderBy('page_key')->orderBy('sort_order')->paginate(8, ['*'], 'contents_page')->withQueryString();

        return view('backend.website-management.index', compact('setting', 'banners', 'pageContents'));
    }

    public function storeSettings(Request $request): RedirectResponse
    {
        $setting = Setting::query()->first();

        if (! $setting) {
            $setting = new Setting();
        }

        $setting->fill($this->validateSettings($request));
        $this->syncImages($request, $setting);
        $setting->save();

        return redirect()
            ->to(route('backend.website-management.index').'#pengaturan')
            ->with('success', 'Pengaturan website berhasil disimpan.');
    }

    public function storeBanner(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['required', 'image', 'max:4096'],
            'cta_text' => ['nullable', 'string', 'max:255'],
            'cta_url' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
        ]);

        $path = $request->file('image')->store('banners', 'public');

        Banner::create([
            'title' => $data['title'],
            'subtitle' => $data['subtitle'] ?? null,
            'description' => $data['description'] ?? null,
            'image_path' => $path,
            'cta_text' => $data['cta_text'] ?? null,
            'cta_url' => $data['cta_url'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
            'starts_at' => $data['starts_at'] ?? null,
            'ends_at' => $data['ends_at'] ?? null,
        ]);

        return redirect()
            ->to(route('backend.website-management.index').'#banner')
            ->with('success', 'Banner berhasil dibuat.');
    }

    public function updateBanner(Request $request, Banner $banner): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'cta_text' => ['nullable', 'string', 'max:255'],
            'cta_url' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
        ]);

        $payload = [
            'title' => $data['title'],
            'subtitle' => $data['subtitle'] ?? null,
            'description' => $data['description'] ?? null,
            'cta_text' => $data['cta_text'] ?? null,
            'cta_url' => $data['cta_url'] ?? null,
            'sort_order' => $data['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
            'starts_at' => $data['starts_at'] ?? null,
            'ends_at' => $data['ends_at'] ?? null,
        ];

        if ($request->hasFile('image')) {
            if ($banner->image_path) {
                Storage::disk('public')->delete($banner->image_path);
            }
            $payload['image_path'] = $request->file('image')->store('banners', 'public');
        }

        $banner->update($payload);

        return redirect()
            ->to(route('backend.website-management.index').'#banner')
            ->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroyBanner(Banner $banner): RedirectResponse
    {
        if ($banner->image_path) {
            Storage::disk('public')->delete($banner->image_path);
        }

        $banner->delete();

        return redirect()
            ->to(route('backend.website-management.index').'#banner')
            ->with('success', 'Banner berhasil dihapus.');
    }

    public function storePageContent(Request $request): RedirectResponse
    {
        $data = $this->validatedPageContent($request);
        $data['image_path'] = $request->hasFile('image')
            ? $request->file('image')->store('page-contents', 'public')
            : null;
        $data['is_active'] = $request->boolean('is_active', true);
        unset($data['image']);
        PageContent::create($data);

        return redirect()->to(route('backend.website-management.index').'#konten')->with('success', 'Konten halaman berhasil dibuat.');
    }

    public function updatePageContent(Request $request, PageContent $pageContent): RedirectResponse
    {
        $data = $this->validatedPageContent($request, $pageContent);
        if ($request->hasFile('image')) {
            if ($pageContent->image_path) {
                Storage::disk('public')->delete($pageContent->image_path);
            }
            $data['image_path'] = $request->file('image')->store('page-contents', 'public');
        }
        $data['is_active'] = $request->boolean('is_active', true);
        unset($data['image']);
        $pageContent->update($data);

        return redirect()->to(route('backend.website-management.index').'#konten')->with('success', 'Konten halaman berhasil diperbarui.');
    }

    public function destroyPageContent(PageContent $pageContent): RedirectResponse
    {
        if ($pageContent->image_path) {
            Storage::disk('public')->delete($pageContent->image_path);
        }
        $pageContent->delete();

        return redirect()->to(route('backend.website-management.index').'#konten')->with('success', 'Konten halaman berhasil dihapus.');
    }

    private function validatedPageContent(Request $request, ?PageContent $pageContent = null): array
    {
        return $request->validate([
            'page_key' => ['required', 'string', 'max:100'],
            'section_key' => [
                'required',
                'string',
                'max:100',
                Rule::unique('page_contents')
                    ->where(fn ($query) => $query->where('page_key', $request->page_key))
                    ->ignore($pageContent?->id),
            ],
            'title' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ]);
    }

    private function validateSettings(Request $request): array
    {
        $rules = [];

        foreach (Setting::formSections() as $section) {
            foreach ($section['fields'] as $field) {
                if ($field['type'] === 'image') {
                    $rules[$field['name']] = ['nullable', 'image', 'max:4096'];
                    $rules['remove.'.$field['name']] = ['nullable', 'boolean'];
                    continue;
                }

                $rule = ['nullable', 'string'];
                if (! empty($field['required'])) {
                    $rule = ['required', 'string', 'max:255'];
                } elseif ($field['type'] === 'email') {
                    $rule = ['nullable', 'email', 'max:255'];
                } elseif ($field['type'] === 'text') {
                    $rule = ['nullable', 'string', 'max:2000'];
                }

                $rules[$field['name']] = $rule;
            }
        }

        $data = $request->validate($rules);
        unset($data['remove']);

        foreach (Setting::IMAGE_COLUMNS as $column) {
            unset($data[$column]);
        }

        return $data;
    }

    private function syncImages(Request $request, Setting $setting): void
    {
        foreach (Setting::IMAGE_COLUMNS as $column) {
            if ($request->boolean('remove.'.$column) || $request->hasFile($column)) {
                $setting->deleteImage($column);
                $setting->{$column} = null;
            }

            if ($request->hasFile($column)) {
                $setting->{$column} = $request->file($column)->store('settings', 'public');
            }
        }
    }
}
