# 1. Pohon Proyek

Pohon di bawah memuat direktori yang ada di akar repositori dan isi yang dipakai aplikasi. Folder `vendor/` (dependensi Composer) dan isi cache `storage/framework/` tidak dijabarkan baris per baris.

```text
Hotel-Haven_Palais/
├── app/
│   ├── Console/Kernel.php
│   ├── Exceptions/Handler.php
│   ├── Http/
│   │   ├── Kernel.php
│   │   ├── Controllers/
│   │   │   ├── Controller.php
│   │   │   ├── Backend/
│   │   │   └── Frontend/
│   │   └── Middleware/
│   ├── Models/
│   └── Providers/
├── bootstrap/
├── config/
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeders/
├── public/
│   ├── index.php
│   ├── backend/
│   └── storage/          (tautan ke storage/app/public bila storage:link dijalankan)
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│       ├── backend/
│       ├── components/
│       └── frontend/
├── routes/
│   ├── web.php
│   ├── api.php
│   └── console.php
├── storage/
├── tests/Feature/
├── AI_CONTEXT/           (catatan kerja, bukan runtime)
├── artisan
├── composer.json
├── package.json
├── phpunit.xml
├── vite.config.js
└── README.md
```

## Folder akar

| Path | Fungsi |
| --- | --- |
| `app/` | Kode aplikasi: controller, model, middleware, provider |
| `bootstrap/` | Bootstrap framework dan cache paket yang sudah di-discover |
| `config/` | Konfigurasi auth, session, database, filesystem, dan lainnya |
| `database/` | Migrasi skema, factory, dan seeder |
| `public/` | Document root web. `index.php` adalah pintu masuk HTTP |
| `resources/` | Blade, CSS, dan JavaScript sumber |
| `routes/` | Definisi route web, API, dan console |
| `storage/` | Session file, log, cache, dan unggahan disk `public` |
| `tests/` | Pengujian fitur PHPUnit |
| `AI_CONTEXT/` | Catatan pengembangan. Tidak diload oleh Laravel |

## `app/Http/Controllers`

Controller dasar `app/Http/Controllers/Controller.php` adalah controller Laravel standar.

`app/Http/Controllers/Backend/Controller.php` menambahkan tiga bantuan yang dipakai halaman admin:

- `uniqueSlug()` membuat slug unik. Nama yang tidak menghasilkan huruf diubah menjadi dasar `item`, lalu diberi akhiran `-2`, `-3`, bila bentrok.
- `emptyPage()` mengembalikan paginator kosong bila pengguna tidak boleh melihat sebuah tab.
- `allowedTab()` memilih tab pertama yang permission-nya dimiliki pengguna.

| Controller | Halaman / tugas |
| --- | --- |
| `AuthController` | Login dan logout staf di `/admin/login` |
| `DashboardController` | Ringkasan operasional |
| `WebsiteManagementController` | Pengaturan situs, banner, konten halaman |
| `GalleryManagementController` | Kategori dan item galeri |
| `RoomManagementController` | Kategori, tipe, unit, fasilitas, dan foto kamar |
| `ResortFacilitiesController` | Kategori, fasilitas resort, dan fotonya |
| `PromotionsPackagesController` | Promo dan paket |
| `BookingManagementController` | Reservasi, customer, tamu, check-in, check-out |
| `PaymentManagementController` | Metode pembayaran dan transaksi tercatat |
| `HousekeepingController` | Tugas kebersihan |
| `ReviewsMessagesController` | Moderasi ulasan dan pesan kontak yang sudah tersimpan |
| `StaffAccessController` | User, role, dan permission |
| `ReportsAnalyticsController` | Laporan dan activity log |
| `NotificationsSettingsController` | Notifikasi milik user yang login dan profil sendiri |
| `Frontend/CustomerAuthController` | Login, register, dan logout customer |
| `Frontend/ReviewController` | Penerimaan ulasan `POST /ulasan` |

Di folder `Backend/` juga masih ada controller lama per entitas (`RoomController`, `PaymentController`, dan sejenisnya). Route `routes/web.php` yang aktif tidak memanggil controller lama itu. Menu admin memakai controller konsolidasi pada tabel di atas.

## `app/Http/Middleware`

| Berkas | Alias | Peran |
| --- | --- | --- |
| `Authenticate.php` | `auth` | Mengarahkan tamu yang belum login. Path `admin` ke login staf, path lain ke login customer |
| `RedirectIfAuthenticated.php` | `guest` | Pengguna yang sudah login tidak membuka form login. Staf diarahkan ke dashboard, selain itu ke beranda |
| `EnsureStaff.php` | `staff` | Menolak user non-staf atau nonaktif dari `/admin` |
| `EnsurePermission.php` | `permission` | Menolak dengan HTTP 403 bila user tidak memiliki salah satu slug yang diminta |
| `VerifyCsrfToken.php` | bagian grup `web` | Memeriksa token CSRF. Daftar pengecualian kosong |
| `EncryptCookies.php`, `TrimStrings.php`, `TrustProxies.php` | global / `web` | Middleware bawaan Laravel yang tetap aktif |

## `app/Models`

Satu model Eloquent untuk satu tabel domain. Relasi role memakai `user_roles` dan `role_permissions`. Model dengan `SoftDeletes` menghapus lewat kolom `deleted_at`, bukan menghapus baris secara fisik: `User`, `Role` tidak memakainya, sedangkan kamar, reservasi, pembayaran, promo, galeri, fasilitas, banner, dan ulasan memakainya. `Role` dan `Permission` tidak memakai soft delete.

`User` menyimpan aturan staf (`STAFF_ROLES`), pengecekan `allows()`, dan `staffHome()`. `Reservation::syncPaymentConfirmation()` menyesuaikan status `pending_payment` dan `confirmed` dengan jumlah pembayaran berstatus `paid`. `Review::submit()` adalah aturan pengiriman ulasan customer.

## `app/Providers`

| Provider | Peran yang dipakai aplikasi |
| --- | --- |
| `AppServiceProvider` | Paginator Tailwind, directive Blade `@allows`, view composer `$site` untuk view `backend.*` dan `frontend.*` |
| `RouteServiceProvider` | Memuat `routes/web.php` dan `routes/api.php`. Mengikat parameter `{customer}` hanya ke user berrole `customer` |
| `AuthServiceProvider` | Tidak mendaftarkan policy atau gate |

## View

`resources/views/backend/` berisi layout admin, sidebar, dan satu Blade per menu (`dashboard`, `website-management`, `room-management`, `resort-facilities`, `promotions-packages`, `gallery`, `booking-management`, `payment-management`, `housekeeping`, `reviews-messages`, `staff-access`, `reports-analytics`, `notifications-settings`, serta `auth/login`).

`resources/views/frontend/` berisi halaman publik: `beranda`, `kamar`, `fasilitas`, `reservasi`, `tentang`, `ulasan`, dan `login/login.blade.php`. Route customer saat ini me-render `frontend.customer.login` dan `frontend.customer.register`. Kedua nama view itu tidak ada di folder view. Berkas `frontend/login/login.blade.php` tidak dipanggil route yang aktif.

## Route, database, dan aset

| Path | Fungsi |
| --- | --- |
| `routes/web.php` | Seluruh route situs dan, di bawah komentar `// backend`, seluruh route `/admin` |
| `routes/api.php` | Satu route bawaan Sanctum, `GET /api/user` |
| `database/migrations/` | Skema MySQL/SQLite aplikasi, dari user dan role sampai housekeeping dan settings |
| `database/seeders/DatabaseSeeder.php` | Memanggil `RolePermissionSeeder`, `AdminUserSeeder`, `CmsSeeder`, lalu `DummyDataSeeder` |
| `public/backend/css/app.css` dan `public/backend/js/app.js` | Aset panel admin yang dilayani langsung |
| `public/index.php` | Front controller |
| `tests/Feature/` | Uji customer auth, ulasan, role, pembayaran, dan alur menginap |

`package.json` dan `vite.config.js` ada untuk aset Laravel Vite. Halaman admin yang aktif memuat Tailwind dari CDN dan berkas di `public/backend/`, bukan dari bundle Vite.
