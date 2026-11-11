# 5. Dokumentasi Fitur

Fitur dikelompokkan menurut menu yang ada di sidebar dan route publik. Kolom akses memakai role bawaan seeder. Super Admin selalu termasuk karena bypass permission.

## Situs publik

| Fitur | Deskripsi | Fungsi pada kode | Role |
| --- | --- | --- | --- |
| Beranda, kamar, fasilitas, reservasi, tentang | Halaman informasi | Closure route mengembalikan Blade. Tidak menulis database | Pengunjung |
| Ulasan, tampilan | Halaman `GET /ulasan` | Mengembalikan Blade publik | Pengunjung |
| Kirim ulasan | `POST /ulasan` | `ReviewController@store` lalu `Review::submit()` | Customer yang login |
| Login customer | `GET` dan `POST /login` | `CustomerAuthController` | Pengunjung yang bukan staf |
| Register customer | `GET` dan `POST /register` | Membuat user, role `customer`, dan profil kosong | Pengunjung |
| Logout customer | `POST /logout` | Mengakhiri sesi ke beranda | User yang login |

`GET` login dan register memanggil view `frontend.customer.login` dan `frontend.customer.register`. Kedua berkas itu tidak ada di `resources/views`. `POST` login, register, dan logout tidak membutuhkan view tersebut.

Halaman informasi tidak membaca `page_contents`. Data situs yang dipakai bersama view adalah baris `settings` lewat variabel `$site`.

## Dashboard

| Fitur | Deskripsi | Fungsi | Role |
| --- | --- | --- | --- |
| Ringkasan hari ini | Angka reservasi, kedatangan, tamu in-house, pendapatan, kamar, verifikasi, dan pesan | `DashboardController@index` membaca model terkait | Semua staf |

Pendapatan memakai pembayaran berstatus `paid`.

## Konten website

| Fitur | Deskripsi | Fungsi | Role |
| --- | --- | --- | --- |
| Pengaturan situs | Nama, logo, favicon, dan pengaturan lain pada model `Setting` | `storeSettings` | Super Admin, Admin (`settings.update`) |
| Banner | Unggah dan urutan banner | CRUD banner | Super Admin, Admin |
| Konten halaman | Pasangan `page_key` dan `section_key` | CRUD `page_contents` | Super Admin, Admin |
| Galeri | Kategori dan item foto promosi | CRUD galeri. Kategori yang masih punya item tidak dihapus | Super Admin, Admin |

Foto galeri terpisah dari foto kamar dan foto fasilitas resort.

## Properti

| Fitur | Deskripsi | Fungsi | Role |
| --- | --- | --- | --- |
| Kategori kamar | Pengelompokan tipe | CRUD. Tidak dihapus bila masih ada tipe | Super Admin, Admin |
| Tipe kamar | Harga dasar, kapasitas, fasilitas, foto | CRUD tipe dan foto. Tidak dihapus bila masih ada unit atau detail reservasi | Super Admin, Admin. Receptionist hanya melihat |
| Unit kamar | Nomor, lantai, status operasional | Status `available`, `occupied`, `maintenance`, `out_of_order`, `cleaning` | Super Admin, Admin penuh. Housekeeping melihat dan mengubah. Receptionist melihat |
| Fasilitas kamar | Fasilitas yang dapat dipasang ke tipe | CRUD | Super Admin, Admin |
| Fasilitas resort | Kategori, fasilitas, dan foto area resort | CRUD. Kategori yang masih dipakai tidak dihapus | Super Admin, Admin |
| Promo | Kode, jenis diskon persen atau nominal, masa berlaku, kuota, minimum malam dan nominal | CRUD. Tidak dihapus bila masih dipakai reservasi | Super Admin, Admin |
| Paket | Harga, jumlah malam, masa berlaku, tipe kamar terkait | CRUD. Harga dipakai saat reservasi memilih paket | Super Admin, Admin |

## Booking dan front desk

| Fitur | Deskripsi | Fungsi | Role |
| --- | --- | --- | --- |
| Reservasi | Kode booking, tanggal, tamu, detail kamar, promo, paket, pajak, dan biaya tambahan | Hitung total, cek ketersediaan, tolak lompatan status menginap | Super Admin, Admin, Receptionist membuat dan mengubah. Finance hanya melihat |
| Hapus reservasi | Soft delete | Ditolak bila status `checked_in` atau `checked_out` | Super Admin, Admin |
| Customer | Akun berrole customer beserta profil | Create, update, soft delete. Route hanya mengikat user customer | Super Admin, Admin. Receptionist hanya melihat |
| Tamu | Data tamu yang tidak harus punya akun | CRUD. Hapus ditolak bila masih ada reservasi | Super Admin, Admin. Receptionist membuat dan mengubah, tidak menghapus |
| Check-in | Dari reservasi `confirmed` | Mengisi `room_id`, status kamar `occupied`, `checked_in_at` | Super Admin, Admin, Receptionist |
| Check-out | Dari reservasi `checked_in` | Kamar menjadi `cleaning`, tugas turnover dibuat | Super Admin, Admin, Receptionist |

Cara kerja reservasi:

1. Malam dihitung dari check-in ke check-out, minimal satu.
2. Subtotal adalah jumlah `harga per malam × malam` tiap baris.
3. Bila promo dipilih dan syaratnya lolos, diskon promo dipakai. Diskon yang diketik tidak boleh lebih besar dari nilai promo. Bila diskon dikosongkan, nilai promo yang dipakai.
4. Bila paket dipilih, harga paket ditambahkan ke total setelah syarat tanggal, jumlah malam, dan tipe kamar lolos.
5. Total tidak boleh negatif.
6. Untuk status `pending_payment` dan `confirmed`, total dibandingkan dengan jumlah pembayaran `paid`.

## Pembayaran

| Fitur | Deskripsi | Fungsi | Role |
| --- | --- | --- | --- |
| Metode | Transfer, tunai, e-wallet, kartu, atau lain. Kode unik, logo, rekening, instruksi | CRUD. Centang nonaktif benar-benar tersimpan | Super Admin, Admin. Finance membuat dan mengubah, tidak menghapus |
| Transaksi | Invoice, nominal, bukti, referensi, status | Status `unpaid`, `waiting_verification`, `paid`, `rejected`, `refunded` | Super Admin, Admin, Finance. Receptionist hanya melihat |
| Verifikasi | Menandai lunas | Hanya dari `unpaid` atau `waiting_verification`, nominal lebih dari nol | Super Admin, Admin, Finance |
| Refund | Menandai dana dikembalikan | Hanya dari `paid`. Reservasi `confirmed` dapat kembali `pending_payment` bila sisa tidak menutup total | Super Admin, Admin, Finance |
| Hapus transaksi | Soft delete selain yang `paid` | Route meminta `payments.delete`, slug ini tidak di-seed | Hanya Super Admin, lewat bypass |

Aplikasi tidak menerima pembayaran dari customer dan tidak memanggil gateway.

## Housekeeping

| Fitur | Deskripsi | Fungsi | Role |
| --- | --- | --- | --- |
| Tugas | Kamar, petugas, jenis, prioritas, jadwal, status | Status `pending`, `in_progress`, `completed`, `verified` | Super Admin, Admin. Housekeeping membuat dan mengubah, tidak menghapus |
| Daftar staf kebersihan | User dengan role housekeeping, admin, atau super admin | Ditampilkan pada halaman yang sama | Yang boleh membuka halaman |

`started_at` diisi saat pertama menjadi `in_progress`. `completed_at` diisi saat `completed` atau `verified`. `verified_by` dan `verified_at` diisi saat `verified`.

## Ulasan dan pesan

| Fitur | Deskripsi | Fungsi | Role |
| --- | --- | --- | --- |
| Moderasi ulasan | Mengubah status `pending`, `approved`, `rejected` | Menyimpan moderator dan waktu | Super Admin, Admin |
| Hapus ulasan | Soft delete | `destroyReview` | Super Admin, Admin |
| Pesan kontak | Status `new`, `read`, `followed_up`, plus catatan | Update dan delete data yang sudah ada | Super Admin, Admin |

## Sistem

| Fitur | Deskripsi | Fungsi | Role |
| --- | --- | --- | --- |
| User staf | Nama, email, telepon, password, role, status aktif | CRUD dengan batas akun sendiri dan Super Admin terakhir | Super Admin, Admin |
| Role | Nama, slug, permission | CRUD. Slug kosong dihasilkan dari nama. Role `super_admin` tidak dihapus | Super Admin |
| Permission | Nama, slug `modul.aksi`, modul | CRUD katalog | Super Admin |
| Laporan | Ringkasan, reservasi, pendapatan, okupansi, pembayaran | Agregasi baca | Super Admin, Admin. Finance melihat ringkasan, pendapatan, dan pembayaran |
| Activity log | Daftar `activity_logs` | Tab laporan | Super Admin, Admin |
| Notifikasi | Notifikasi Laravel milik user login | Tandai terbaca | Semua staf yang dapat membuka URL |
| Profil sendiri | Nama, telepon, password | `updateProfile` | Semua staf yang dapat membuka URL |

Password baru pada profil, user staf, dan customer minimal 8 karakter dan wajib konfirmasi bila diisi. Kolom password model memakai cast `hashed`, sehingga nilai yang sudah berupa hash tidak di-hash ulang.
