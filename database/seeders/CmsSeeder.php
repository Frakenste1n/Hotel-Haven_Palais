<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        if (Setting::query()->exists()) {
            Setting::forgetCache();

            return;
        }

        Setting::query()->create([
                'site_name' => 'Haven Palais',
                'site_tagline' => 'Resort & Spa',
                'site_description' => 'Suaka peristirahatan tebing kapur paling eksklusif di pesisir barat daya Bali.',
                'site_email' => 'concierge@havenpalais.com',
                'site_phone' => '+62 (021) 8800 900',
                'site_whatsapp' => '+6281234567890',
                'site_address' => 'Jalan Pantai Suluban No. 88, Pecatu, Kuta Selatan, Kabupaten Badung, Bali 80361, Indonesia',
                'site_maps_url' => 'https://maps.google.com',
                'hero_title' => 'Kemewahan Abadi',
                'hero_subtitle' => 'di Tepi Samudra',
                'hero_description' => 'Nikmati ketenangan eksklusif, panorama pesisir spektakuler, dan keramahan kelas dunia bintang lima yang dipadukan dengan kemegahan arsitektur tropis kontemporer.',
                'about_title' => 'Harmoni Keheningan Tebing Uluwatu & Keanggunan Keramahan Abadi',
                'about_description' => 'Lahir dari penghormatan mendalam terhadap deburan Samudra Hindia dan kearifan lokal Bali, Haven Palais adalah tempat perlindungan jiwa di mana kemewahan bertemu ketenteraman tanpa batas.',
                'sejarah' => 'Berakar pada perjumpaan emosional di tebing perawan Uluwatu lebih dari satu dekade lalu, Haven Palais diciptakan sebagai penghormatan terhadap kemegahan samudra dan kemurnian spiritual Bali Selatan.',
                'asal_usul' => 'Arsitektur kami merajut keanggunan neoklasik proporsional Eropa dengan kekayaan vernakular Nusantara.',
                'founder_name' => 'Bapak Dewa Wicaksana',
                'founder_position' => 'Co-Founder & Principal Architect',
                'facebook_url' => 'https://facebook.com/',
                'instagram_url' => 'https://instagram.com/',
                'youtube_url' => 'https://youtube.com/',
                'tiktok_url' => 'https://www.tiktok.com/',
        ]);

        Setting::forgetCache();
    }
}
