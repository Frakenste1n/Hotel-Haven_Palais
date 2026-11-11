<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    use HasFactory;

    public const DEFAULT_LOGO = 'https://lh3.googleusercontent.com/aida/AEtjO1VmGhoXmWcVDhYNqJ8JHe8OU-qWjEpJ8Op2_G3-L-mFREQkQA99a5hQQNKi9lefS9pQmekQYnvgZADhK4SDT1ZzHMUHpaQsfhRokm-Eo_zvgj0NB2lHYRT8eIvrmQTHYHAI5KpHxbV3tZGYKHlcdSa6KEHY1Q9qP8aE5H7NfTLz7_oMTdODWycblfJO2cnkvDJzcxQCMAX5FtvrLoHcPjeW6i0wDoEWud30wh8Csj06';

    public const DEFAULT_HERO = 'https://lh3.googleusercontent.com/aida-public/AB6AXuCcQYGY8KDAgLK4dqUbBESI4hd4BZ9iA3vlSRwRDU_PfYFQbWK-Fmb5FiUU2BJY4sdRSnUhhbISTAgC3zT7Imq5Pm_AfsjGHqImchlUO6nrWf90QTvWtRL8-_ra0UxldwvfwLuCGkBA5TDr2hdS3Y9BbJgDs26if1icIihna0rOIBa5_ytUBG8krmqbuC_opD30GzRmzCWwYZFsx9XmkFcZDW-d_n39AcT1aEOg0jQ';

    public const DEFAULT_ABOUT = 'https://lh3.googleusercontent.com/aida-public/AB6AXuApJPuKkXiz_0v8inNPf0dDH1CMKqX05cctm12eN55GM9ElEvQGkGzdI6-sfr35VKVm9tCvoG1cohxbvSSa2ClhKKHRRJAlC5MNFMUx755BkQj0wLMfVqwQZewTXvP_B1uJcpYDWmNby21patSw4-NJbDvDexXBF8g43JjYTT8KQQJzGYOr3xn2gU6Rsfob9pgTlJb0KeYNuejSwVEKFamK8AhfbJNTtgLIzpUJzQk';

    public const IMAGE_COLUMNS = [
        'site_logo',
        'site_favicon',
        'hero_image',
        'about_image',
        'founder_image',
    ];

    protected $fillable = [
        'site_name',
        'site_tagline',
        'site_logo',
        'site_favicon',
        'site_description',
        'site_email',
        'site_phone',
        'site_whatsapp',
        'site_address',
        'site_maps_url',
        'hero_title',
        'hero_subtitle',
        'hero_description',
        'hero_image',
        'about_title',
        'about_description',
        'about_image',
        'sejarah',
        'asal_usul',
        'founder_name',
        'founder_image',
        'founder_position',
        'facebook_url',
        'instagram_url',
        'tiktok_url',
        'youtube_url',
    ];

    public static function current(): ?self
    {
        return Cache::remember('site_settings_row', 600, function () {
            return static::query()->first();
        });
    }

    public static function forgetCache(): void
    {
        Cache::forget('site_settings_row');
    }

    public function fileUrl(string $column, ?string $fallback = null): ?string
    {
        $path = $this->getAttribute($column);

        if (is_string($path) && $path !== '') {
            return asset('storage/'.$path);
        }

        return $fallback;
    }

    public function deleteImage(string $column): void
    {
        $path = $this->getAttribute($column);

        if (is_string($path) && $path !== '') {
            Storage::disk('public')->delete($path);
        }
    }

    public function deleteAllImages(): void
    {
        foreach (self::IMAGE_COLUMNS as $column) {
            $this->deleteImage($column);
        }
    }

    public static function formSections(): array
    {
        return [
            'identitas' => [
                'title' => 'Identitas Website',
                'fields' => [
                    ['name' => 'site_name', 'label' => 'Nama Situs', 'type' => 'text', 'required' => true],
                    ['name' => 'site_tagline', 'label' => 'Tagline', 'type' => 'text'],
                    ['name' => 'site_logo', 'label' => 'Logo', 'type' => 'image'],
                    ['name' => 'site_favicon', 'label' => 'Favicon', 'type' => 'image'],
                    ['name' => 'site_description', 'label' => 'Deskripsi Situs', 'type' => 'textarea'],
                ],
            ],
            'kontak' => [
                'title' => 'Kontak',
                'fields' => [
                    ['name' => 'site_email', 'label' => 'Email', 'type' => 'email'],
                    ['name' => 'site_phone', 'label' => 'Telepon', 'type' => 'text'],
                    ['name' => 'site_whatsapp', 'label' => 'WhatsApp', 'type' => 'text'],
                    ['name' => 'site_address', 'label' => 'Alamat', 'type' => 'textarea'],
                    ['name' => 'site_maps_url', 'label' => 'URL Google Maps', 'type' => 'text'],
                ],
            ],
            'hero' => [
                'title' => 'Hero',
                'fields' => [
                    ['name' => 'hero_title', 'label' => 'Judul Hero', 'type' => 'text'],
                    ['name' => 'hero_subtitle', 'label' => 'Subjudul Hero', 'type' => 'text'],
                    ['name' => 'hero_description', 'label' => 'Deskripsi Hero', 'type' => 'textarea'],
                    ['name' => 'hero_image', 'label' => 'Gambar Hero', 'type' => 'image'],
                ],
            ],
            'tentang' => [
                'title' => 'About',
                'fields' => [
                    ['name' => 'about_title', 'label' => 'Judul About', 'type' => 'text'],
                    ['name' => 'about_description', 'label' => 'Deskripsi About', 'type' => 'textarea'],
                    ['name' => 'about_image', 'label' => 'Gambar About', 'type' => 'image'],
                    ['name' => 'sejarah', 'label' => 'Sejarah', 'type' => 'textarea'],
                    ['name' => 'asal_usul', 'label' => 'Asal Usul', 'type' => 'textarea'],
                    ['name' => 'founder_name', 'label' => 'Nama Tokoh Pendiri', 'type' => 'text'],
                    ['name' => 'founder_position', 'label' => 'Jabatan Tokoh Pendiri', 'type' => 'text'],
                    ['name' => 'founder_image', 'label' => 'Gambar Tokoh Pendiri', 'type' => 'image'],
                ],
            ],
            'sosial' => [
                'title' => 'Media Sosial',
                'fields' => [
                    ['name' => 'facebook_url', 'label' => 'Facebook', 'type' => 'text'],
                    ['name' => 'instagram_url', 'label' => 'Instagram', 'type' => 'text'],
                    ['name' => 'tiktok_url', 'label' => 'TikTok', 'type' => 'text'],
                    ['name' => 'youtube_url', 'label' => 'YouTube', 'type' => 'text'],
                ],
            ],
        ];
    }

    protected static function booted(): void
    {
        static::saved(fn () => static::forgetCache());
        static::deleted(function (self $setting) {
            $setting->deleteAllImages();
            static::forgetCache();
        });
    }
}
