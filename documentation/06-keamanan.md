# 6. Keamanan

Bagian ini hanya mencakup mekanisme yang ada di kode dan konfigurasi. Bila sebuah kontrol tidak dipasang, hal itu ditulis secara eksplisit.

## Authentication

Aplikasi memakai satu session guard, `web`, dan model `User`.

- Login staf dan customer sama-sama memakai `Auth::attempt()`.
- Session id di-regenerate setelah login berhasil.
- Logout meng-invalidasi session dan meregenerasi token CSRF.
- User `is_active = false` ditolak di login staf, login customer, dan middleware `staff`.
- Staf tidak dapat masuk lewat form customer. Customer dan user tanpa role staf tidak melewati middleware `staff`.
- Form login admin memakai `autocomplete`, dan tombol menampilkan password hanya mengubah tipe input di browser.

Tidak ada verifikasi email, reset password, atau kunci percobaan login pada route web. Alias `throttle` tersedia, tetapi route login tidak memakainya. Route API memakai throttle `api` 60 permintaan per menit.

## Authorization

Otorisasi berlapis:

1. `auth` memastikan ada sesi.
2. `staff` memastikan role staf yang aktif.
3. `permission` memanggil `User::allows()` dengan satu atau lebih slug. Satu slug yang cocok sudah cukup.
4. `@allows` dan `allowedTab()` menyembunyikan menu, tab, dan sebagian tombol.
5. Binding `{customer}` hanya menemukan role `customer`.

`super_admin` melewati pemeriksaan slug. Role lain hanya memiliki slug yang tersambung di `role_permissions`.

Tidak ada policy atau gate di `AuthServiceProvider`.

Route notifikasi tidak memakai middleware `permission`. Setiap user yang lolos `staff` dapat membuka halaman itu bila mengetahui URL.

Slug `payments.delete` dipakai route tetapi tidak dibuat seeder. Selain Super Admin, pemanggilan route itu menghasilkan 403.

## Password hashing

Model `User` men-cast `password` sebagai `hashed`. Saat nilai disimpan, Laravel meng-hash hanya bila nilai itu belum berbentuk hash. `Auth::attempt()` membandingkan password mentah dengan hash di database.

Register customer, pembuatan user staf, pembuatan customer oleh admin, dan ganti password profil mewajibkan panjang minimal 8 serta field konfirmasi. Login hanya mewajibkan password terisi.

Dokumentasi ini tidak menuliskan kata sandi akun mana pun.

## CSRF

Grup middleware `web` memasang `VerifyCsrfToken`. Properti `$except` kosong, jadi tidak ada URI web yang dilewati.

Form Blade admin dan form customer memakai `@csrf`. Permintaan yang mengubah data tanpa token ditolak framework.

Route `api.php` tidak memakai CSRF. Satu-satunya route itu memakai `auth:sanctum`, dan fitur hotel tidak mengirim token Sanctum.

## XSS

Blade `{{ }}` meng-escape teks sebelum masuk HTML. Output JSON untuk atribut `data-record` memakai `json_encode` dengan `JSON_HEX_TAG`, `JSON_HEX_APOS`, `JSON_HEX_AMP`, dan `JSON_HEX_QUOT`.

Beberapa atribut dinamis memakai `{!! !!}` hanya sebagai pembungkus hasil `json_encode` yang sudah diberi flag tersebut.

Konten yang diketik pengguna dan kemudian ditampilkan dengan `{{ }}` tidak dieksekusi sebagai HTML. Bila suatu view menulis HTML mentah dari database, itu tidak menjadi pola umum controller.

## SQL injection

Penulisan dan pembacaan data memakai Eloquent dan query builder. Nilai filter, termasuk kata cari, diikat sebagai parameter. Tidak ada penyusunan SQL dari string input pada controller yang aktif.

Penghapusan banyak model memakai soft delete, sehingga baris tetap ada dan relasi tidak langsung memutus foreign key. Controller yang menghapus induk tetap menolak bila anak yang belum terhapus masih ada, misalnya kategori yang masih punya tipe.

## Validasi input

Controller menulis lewat `$request->validate()` atau `ValidationException`. Contoh yang mengikat bisnis:

| Area | Aturan |
| --- | --- |
| Auth | Email wajib dan berbentuk email. Password register minimal 8 dan `confirmed` |
| Reservasi | Tanggal check-out setelah check-in, minimal satu dewasa, detail kamar wajib, kuantitas 1, harga numerik |
| Kamar | Status unit hanya nilai enum yang diizinkan. Nomor kamar unik |
| Pembayaran | Nominal minimal 0,01. Status hanya nilai yang diizinkan. Reservasi batal atau kedaluwarsa dan metode nonaktif ditolak untuk transaksi baru |
| Ulasan | Rating 1–5, komentar maksimal 2000 karakter, foto opsional |
| Role | Slug kosong diganti slug dari nama, dengan dasar `item` bila nama tidak berisi huruf atau angka |

`ConvertEmptyStringsToNull` dan `TrimStrings` berjalan sebelum validasi. Pengecualian trim mengikuti middleware Laravel bawaan.

## Session

Konfigurasi `config/session.php`:

| Pengaturan | Nilai pada berkas |
| --- | --- |
| Driver | `SESSION_DRIVER`, default `file`, berkas di `storage/framework/sessions` |
| Lifetime | `SESSION_LIFETIME`, default 120 menit |
| Expire on close | `false` |
| Encrypt session | `false` |
| HTTP only | `true`, cookie tidak dibaca JavaScript |
| Same site | `lax` |
| Secure cookie | `SESSION_SECURE_COOKIE`. Tidak dipaksa `true` di berkas config |

Cookie aplikasi dienkripsi middleware `EncryptCookies` memakai kunci aplikasi. Itu terpisah dari opsi `encrypt` session, yang saat ini mati sehingga isi payload session file tidak dienkripsi sebelum disimpan.

Login meregenerasi session id. Logout meng-invalidasi session.

## Unggah berkas

Berkas disimpan di disk `public` (`storage/app/public`) dan diakses lewat URL `/storage` setelah `storage:link`.

| Pemakaian | Aturan validasi pada controller |
| --- | --- |
| Ulasan | `image`, mime `jpg`, `jpeg`, `png`, `webp`, maksimal 4096 KB |
| Logo metode, bukti bayar, foto kamar, fasilitas, galeri, promo, banner, logo situs | Aturan `image` dan batas kilobyte pada masing-masing method |

File lama dihapus dari disk bila diganti atau record-nya dihapus. Tidak ada pemindaian malware. Nama berkas yang disimpan dihasilkan storage Laravel, bukan nama asli yang dipakai sebagai path mentah.

## Batas yang perlu diketahui

- Tidak ada payment gateway, sehingga tidak ada tanda tangan webhook pembayaran.
- Login web tidak dibatasi jumlah percobaan.
- Session file tidak dienkripsi oleh opsi `session.encrypt`.
- Halaman notifikasi tidak memakai middleware permission.
- `GET` form customer mengarah ke view yang belum ada, sehingga tampilan login customer belum dapat dirender meskipun `POST`-nya ada.
- Activity log dapat ditampilkan, tetapi controller menu tidak menulis log untuk setiap aksi.
