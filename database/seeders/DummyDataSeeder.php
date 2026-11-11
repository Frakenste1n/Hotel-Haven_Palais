<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\Banner;
use App\Models\ContactMessage;
use App\Models\FacilityCategory;
use App\Models\FacilityImage;
use App\Models\Gallery;
use App\Models\GalleryCategory;
use App\Models\Guest;
use App\Models\HousekeepingTask;
use App\Models\Package;
use App\Models\PageContent;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Promotion;
use App\Models\Reservation;
use App\Models\ReservationDetail;
use App\Models\ResortFacility;
use App\Models\Review;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\RoomFacility;
use App\Models\RoomImage;
use App\Models\RoomType;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $image = $this->placeholder();

        $this->fillBranding($image);

        $customer = User::query()->where('email', 'customer@havenpalais.test')->firstOrFail();
        $finance = User::query()->where('email', 'finance@havenpalais.test')->firstOrFail();
        $housekeeper = User::query()->where('email', 'housekeeping@havenpalais.test')->firstOrFail();
        $admin = User::query()->where('email', 'admin@havenpalais.test')->firstOrFail();

        Banner::updateOrCreate(
            ['title' => 'Selamat datang di Haven Palais'],
            [
                'subtitle' => 'Tepi tebing Uluwatu',
                'description' => 'Banner dummy untuk halaman utama.',
                'image_path' => $image,
                'cta_text' => 'Lihat kamar',
                'cta_url' => '/kamar',
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        PageContent::updateOrCreate(
            ['page_key' => 'home', 'section_key' => 'welcome'],
            [
                'title' => 'Selamat datang',
                'content' => 'Konten dummy untuk bagian pembuka halaman beranda.',
                'image_path' => $image,
                'sort_order' => 1,
                'is_active' => true,
            ]
        );

        $category = RoomCategory::updateOrCreate(
            ['slug' => 'suite'],
            ['name' => 'Suite', 'description' => 'Kamar suite dengan pemandangan laut.', 'sort_order' => 1, 'is_active' => true]
        );

        $wifi = RoomFacility::updateOrCreate(
            ['name' => 'Wi-Fi'],
            ['icon' => 'wifi', 'description' => 'Internet cepat di seluruh kamar.', 'is_active' => true]
        );

        $roomType = RoomType::updateOrCreate(
            ['slug' => 'ocean-suite'],
            [
                'room_category_id' => $category->id,
                'name' => 'Ocean Suite',
                'description' => 'Suite dummy dengan balkon menghadap samudra.',
                'summary' => '1 kamar tidur, balkon privat.',
                'base_price' => 2500000,
                'capacity_adults' => 2,
                'capacity_children' => 1,
                'bed_type' => 'King',
                'room_size' => 48,
                'max_occupancy' => 3,
                'is_featured' => true,
                'is_active' => true,
            ]
        );
        $roomType->facilities()->sync([$wifi->id]);

        RoomImage::updateOrCreate(
            ['room_type_id' => $roomType->id, 'image_path' => $image],
            ['caption' => 'Tampak balkon Ocean Suite', 'sort_order' => 1, 'is_primary' => true]
        );

        $room = Room::updateOrCreate(
            ['room_number' => '101'],
            ['room_type_id' => $roomType->id, 'floor' => '1', 'status' => 'available', 'notes' => 'Unit dummy.', 'is_active' => true]
        );

        $facilityCategory = FacilityCategory::updateOrCreate(
            ['slug' => 'rekreasi'],
            ['name' => 'Rekreasi', 'description' => 'Fasilitas rekreasi resort.', 'sort_order' => 1, 'is_active' => true]
        );

        $facility = ResortFacility::updateOrCreate(
            ['slug' => 'infinity-pool'],
            [
                'facility_category_id' => $facilityCategory->id,
                'name' => 'Infinity Pool',
                'description' => 'Kolam renang dummy di tepi tebing.',
                'location' => 'Sayap barat',
                'operating_hours' => '06.00 - 20.00',
                'is_chargeable' => false,
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        FacilityImage::updateOrCreate(
            ['resort_facility_id' => $facility->id, 'image_path' => $image],
            ['caption' => 'Infinity Pool', 'sort_order' => 1, 'is_primary' => true]
        );

        $promotion = Promotion::updateOrCreate(
            ['code' => 'WELCOME10'],
            [
                'name' => 'Welcome 10%',
                'slug' => 'welcome-10',
                'summary' => 'Diskon 10% untuk menginap pertama.',
                'description' => 'Promo dummy.',
                'discount_type' => 'percentage',
                'discount_value' => 10,
                'min_nights' => 1,
                'is_active' => true,
            ]
        );

        $package = Package::updateOrCreate(
            ['slug' => 'honeymoon-2-malam'],
            [
                'name' => 'Honeymoon 2 Malam',
                'summary' => 'Paket menginap singkat.',
                'description' => 'Termasuk sarapan untuk dua orang.',
                'price' => 5200000,
                'benefits' => ['Sarapan', 'Late checkout'],
                'nights' => 2,
                'is_active' => true,
            ]
        );
        $package->roomTypes()->sync([$roomType->id]);

        $galleryCategory = GalleryCategory::updateOrCreate(
            ['slug' => 'pemandangan'],
            ['name' => 'Pemandangan', 'description' => 'Foto suasana resort.', 'sort_order' => 1, 'is_active' => true]
        );

        Gallery::updateOrCreate(
            ['title' => 'Tebing saat senja'],
            [
                'gallery_category_id' => $galleryCategory->id,
                'description' => 'Item galeri dummy.',
                'file_path' => $image,
                'file_type' => 'image',
                'sort_order' => 1,
                'is_published' => true,
            ]
        );

        $guest = Guest::updateOrCreate(
            ['email' => 'ayu.lestari@example.com'],
            [
                'user_id' => $customer->id,
                'full_name' => 'Ayu Lestari',
                'phone' => '081234567895',
                'id_type' => 'ktp',
                'id_number' => '5171012345670001',
                'address' => 'Jl. Melati No. 12, Denpasar',
                'nationality' => 'Indonesia',
                'date_of_birth' => '1995-04-12',
                'gender' => 'female',
            ]
        );

        $method = PaymentMethod::updateOrCreate(
            ['code' => 'bca_transfer'],
            [
                'name' => 'Transfer BCA',
                'type' => 'bank_transfer',
                'account_number' => '1234567890',
                'account_name' => 'Haven Palais',
                'instructions' => 'Transfer sesuai nominal invoice.',
                'is_active' => true,
                'sort_order' => 1,
            ]
        );

        $checkIn = now()->addDays(3)->toDateString();
        $checkOut = now()->addDays(5)->toDateString();
        $reservation = Reservation::updateOrCreate(
            ['booking_code' => 'HP-DUMMY-001'],
            [
                'user_id' => $customer->id,
                'guest_id' => $guest->id,
                'promotion_id' => $promotion->id,
                'package_id' => $package->id,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'adults' => 2,
                'children' => 0,
                'rooms_count' => 1,
                'subtotal' => 5000000,
                'discount_amount' => 500000,
                'tax_amount' => 450000,
                'extra_fee' => 0,
                'total_amount' => 4950000,
                'status' => 'confirmed',
                'special_requests' => 'Kamar lantai atas bila tersedia.',
            ]
        );

        ReservationDetail::updateOrCreate(
            ['reservation_id' => $reservation->id, 'room_type_id' => $roomType->id],
            [
                'room_id' => $room->id,
                'quantity' => 1,
                'nights' => 2,
                'price_per_night' => 2500000,
                'subtotal' => 5000000,
                'guests_count' => 2,
            ]
        );

        Payment::updateOrCreate(
            ['invoice_number' => 'INV-DUMMY-001'],
            [
                'reservation_id' => $reservation->id,
                'payment_method_id' => $method->id,
                'amount' => 4950000,
                'status' => 'paid',
                'reference_code' => 'TRX-DUMMY-001',
                'paid_at' => now(),
                'verified_by' => $finance->id,
                'verified_at' => now(),
                'notes' => 'Pembayaran dummy yang sudah diverifikasi.',
            ]
        );

        Review::updateOrCreate(
            ['reservation_id' => $reservation->id],
            [
                'user_id' => $customer->id,
                'rating' => 5,
                'comment' => 'Menginap dummy yang sangat nyaman.',
                'status' => 'approved',
                'moderated_by' => $admin->id,
                'moderated_at' => now(),
            ]
        );

        ContactMessage::updateOrCreate(
            ['email' => 'tamu@example.com', 'subject' => 'Tanya ketersediaan akhir pekan'],
            [
                'name' => 'Budi Santoso',
                'phone' => '081298765432',
                'message' => 'Apakah Ocean Suite tersedia akhir pekan ini?',
                'status' => 'new',
            ]
        );

        HousekeepingTask::updateOrCreate(
            ['room_id' => $room->id, 'task_type' => 'cleaning', 'notes' => 'Tugas dummy persiapan kamar 101.'],
            [
                'assigned_to' => $housekeeper->id,
                'reservation_id' => $reservation->id,
                'status' => 'pending',
                'priority' => 'medium',
                'scheduled_at' => now()->addDay(),
            ]
        );

        ActivityLog::updateOrCreate(
            ['action' => 'seed', 'module' => 'system', 'description' => 'Data dummy awal berhasil diisi.'],
            [
                'user_id' => $admin->id,
                'subject_type' => Reservation::class,
                'subject_id' => $reservation->id,
                'new_values' => ['booking_code' => $reservation->booking_code],
                'ip_address' => '127.0.0.1',
            ]
        );

        if ($admin->notifications()->where('data->title', 'Reservasi dummy masuk')->doesntExist()) {
            $admin->notifications()->create([
                'id' => (string) Str::uuid(),
                'type' => 'App\\Notifications\\DummyNotice',
                'data' => [
                    'title' => 'Reservasi dummy masuk',
                    'message' => 'Booking HP-DUMMY-001 sudah dikonfirmasi.',
                ],
            ]);
        }
    }

    private function placeholder(): string
    {
        $path = 'seed/placeholder.jpg';

        if (! Storage::disk('public')->exists($path)) {
            Storage::disk('public')->put($path, base64_decode(
                '/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxISEhUQEhIVFRUVFRUVFRUWFxUVFRUYHSggGBolGxUVITEhJSkrLi4uFx8zODMtNygtLisBCgoKDg0OGhAQGy0lHyUtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIAAgACAMBIgACEQEDEQH/xAAbAAABBQEBAAAAAAAAAAAAAAADAAIEBQYBB//EABQBAQAAAAAAAAAAAAAAAAAAAAD/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/8QAFBEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8A0p6l1pQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA//9k='
            ));
        }

        return $path;
    }

    private function fillBranding(string $image): void
    {
        $setting = Setting::query()->first();

        if (! $setting) {
            return;
        }

        $setting->fill([
            'site_logo' => $setting->site_logo ?: $image,
            'site_favicon' => $setting->site_favicon ?: $image,
        ]);
        $setting->save();
    }
}
