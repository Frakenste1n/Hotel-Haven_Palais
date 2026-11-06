# Dokumentasi Teknis — Hotel Haven Palais

Dokumentasi ini disusun dari audit source code aplikasi Laravel pada repositori ini. Isi setiap berkas mengikuti implementasi yang ada, termasuk batasannya.

Aplikasi adalah sistem manajemen resort dengan dua permukaan:

- **Situs publik** pada path `/`, untuk halaman informasi dan pengiriman ulasan.
- **Panel admin** pada prefix `/admin`, untuk operasional staf.

Keduanya memakai sesi web yang sama (`guard` `web`) dan tabel `users` yang sama. Pemisahan dilakukan lewat role, middleware `staff`, dan middleware `permission`.

## Daftar berkas

| Berkas | Isi |
| --- | --- |
| [01-pohon-proyek.md](01-pohon-proyek.md) | Pohon direktori dan fungsi folder serta berkas penting |
| [02-arsitektur-aplikasi.md](02-arsitektur-aplikasi.md) | Pola MVC, alur request, middleware, autentikasi, dan otorisasi |
| [03-alur-sistem.md](03-alur-sistem.md) | Diagram alur login, logout, dan proses utama tiap modul |
| [04-role-dan-hak-akses.md](04-role-dan-hak-akses.md) | Role, tugas, dan matriks permission hasil seeder |
| [05-dokumentasi-fitur.md](05-dokumentasi-fitur.md) | Fitur per modul, peran yang mengakses, dan cara kerja |
| [06-keamanan.md](06-keamanan.md) | Mekanisme keamanan yang benar-benar dipakai kode |

## Ringkasan teknis

| Item | Implementasi |
| --- | --- |
| Framework | Laravel 10 (`laravel/framework` ^10.10) |
| PHP | ^8.1 |
| Pola | MVC Laravel, satu halaman admin per menu |
| Autentikasi | Session guard `web`, provider Eloquent `App\Models\User` |
| Otorisasi | Role banyak-ke-banyak, permission `modul.aksi`, middleware `permission` |
| Paket tambahan | Laravel Sanctum terpasang; route API bawaan `/api/user` tidak dipakai fitur hotel |
| Pembayaran | Pencatatan manual oleh staf. Tidak ada payment gateway |

## Cara membaca

Mulai dari pohon proyek bila Anda baru membuka repositori. Lanjut ke arsitektur untuk memahami satu request, lalu alur sistem dan matriks role sebelum membaca detail fitur. Berkas keamanan merangkum kontrol yang melindungi alur tersebut.
