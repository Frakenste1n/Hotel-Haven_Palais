<?php

namespace Database\Seeders;

use App\Models\FacilityCategory;
use App\Models\ResortFacility;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ResortFacilitySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Rekreasi',
                'slug' => 'rekreasi',
                'description' => 'Fasilitas rekreasi resort.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Gastronomy',
                'slug' => 'gastronomy',
                'description' => 'Fasilitas kuliner dan pengalaman bersantap.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Hiburan & Budaya',
                'slug' => 'hiburan-budaya',
                'description' => 'Fasilitas hiburan dan pengalaman budaya.',
                'sort_order' => 3,
            ],
            [
                'name' => 'VIP Service',
                'slug' => 'vip-service',
                'description' => 'Layanan eksklusif dan fasilitas VIP.',
                'sort_order' => 4,
            ],
        ];

        $categoryIds = [];

        foreach ($categories as $categoryData) {
            $category = FacilityCategory::withTrashed()
                ->where('slug', $categoryData['slug'])
                ->first();

            if (!$category) {
                $category = FacilityCategory::create([
                    ...$categoryData,
                    'is_active' => true,
                ]);
            } else {
                if ($category->trashed()) {
                    $category->restore();
                }
            }

            $categoryIds[$categoryData['slug']] = $category->id;
        }

        $facilities = [
            [
                'name' => 'Infinity Horizon Cliff Pool',
                'category' => 'rekreasi',
                'description' => 'Kolam renang bertingkat 75 meter menggantung di bibir tebing kapur dengan panorama samudra lepas, sunbed terapung berlapis sutra mikro, dan poolside juice bar segar.',
                'operating_hours' => '06:00 - 20:00 WITA',
            ],
            [
                'name' => 'Serenity Spa & Thalassotherapy',
                'category' => 'rekreasi',
                'description' => 'Paviliun spa privat dengan terapi herbal tradisional Bali, sauna aroma cedarwood, hot & cold vitality pools, serta perawatan holistik bersertifikasi internasional.',
                'operating_hours' => '09:00 - 22:00 WITA',
            ],
            [
                'name' => 'Yoga Pavilion & Fitness Sanctuary',
                'category' => 'rekreasi',
                'description' => 'Pusat kebugaran berteknologi Technogym terbaru dan dek yoga tepi tebing berangin sejuk dengan kelas terpandu meditasi sunrise & sunset setiap hari.',
                'operating_hours' => '24 Jam Akses Tamu',
            ],
            [
                'name' => 'Palais Haute Cuisine & Degustation',
                'category' => 'gastronomy',
                'description' => 'Restoran fine dining kelas dunia dengan menu Prancis kontemporer berbalut rempah lokal Nusantara, dan koleksi 2.500+ botol anggur langka dipandu Head Sommelier.',
                'operating_hours' => '18:00 - 23:00 WITA',
            ],
            [
                'name' => 'Oceanfront Starlight Cabana',
                'category' => 'gastronomy',
                'description' => 'Pengalaman bersantap malam romantis privat di anjungan tebing berbintang dengan tata lilin estetik, deburan ombak magis, dan hidangan 7-course tailor-made chef pribadi.',
                'operating_hours' => 'Eksklusif Malam Hari',
            ],
            [
                'name' => 'Horizon Sunset Cocktail Lounge',
                'category' => 'gastronomy',
                'description' => 'Bar teras lantai atas menyajikan artisan mixology dengan infusi rempah tropis, champagne vintage terkurasi, dan sajian canapé eksklusif ditemani alunan lounge ritmis.',
                'operating_hours' => '16:30 - 00:00 WITA',
            ],
            [
                'name' => 'Private Open-Air Amphitheatre',
                'category' => 'hiburan-budaya',
                'description' => 'Panggung seni teater bawah bintang menampilkan pertunjukan budaya tari tradisional Bali, konser akustik intim, dan apresiasi sastra pesisir dalam atmosfer sakral.',
                'operating_hours' => 'Jadwal Mingguan',
            ],
            [
                'name' => 'Private Cove Beach Club & Yacht',
                'category' => 'hiburan-budaya',
                'description' => 'Akses lift tebing privat menuju teluk pasir putih murni. Lengkap dengan armada private yacht charter, paddleboard, dan pemanduan snorkeling terumbu karang alami.',
                'operating_hours' => '08:00 - 18:30 WITA',
            ],
            [
                'name' => 'CinePalais Private Cinema',
                'category' => 'hiburan-budaya',
                'description' => 'Bioskop privat berkapasitas 14 tamu dengan sistem tata suara Bang & Olufsen, sofa kulit reclining kustom, kurasi film festival, dan gourmet concession bar.',
                'operating_hours' => 'Reservasi Sesi Privat',
            ],
            [
                'name' => 'Private Helipad & Fleet Maybach',
                'category' => 'vip-service',
                'description' => 'Pendaratan helikopter langsung di dalam area resor untuk transfer bandara cepat 15 menit, didukung armada sedan Mercedes-Maybach berpemandu bersertifikasi VIP.',
                'operating_hours' => 'Siaga 24 Jam',
            ],
            [
                'name' => 'Dedicated Butler & Concierge',
                'category' => 'vip-service',
                'description' => 'Asisten pribadi yang mendedikasikan waktu penuh untuk menyusun itinerari pribadi, penataan bagasi tanpa cela, hingga reservasi prioritas di restoran terkemuka pulau Dewata.',
                'operating_hours' => '24/7 Dedicated',
            ],
        ];

        foreach ($facilities as $index => $facilityData) {
            $slug = Str::slug($facilityData['name']);

            ResortFacility::withTrashed()->updateOrCreate(
                ['slug' => $slug],
                [
                    'facility_category_id' => $categoryIds[$facilityData['category']],
                    'name' => $facilityData['name'],
                    'description' => $facilityData['description'],
                    'operating_hours' => $facilityData['operating_hours'],
                    'is_chargeable' => false,
                    'fee' => null,
                    'is_active' => true,
                    'sort_order' => $index + 1,
                    'deleted_at' => null,
                ]
            );
        }
    }
}
