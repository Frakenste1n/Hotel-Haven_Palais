# 4. Role dan Hak Akses

Role di bawah ini dibuat `RolePermissionSeeder`. Slug inilah yang dibaca `User::isStaff()` dan `User::allows()`. Role baru dapat ditambah dari menu Staff & Access, tetapi enam role berikut adalah bawaan seeder.

Customer **bukan** staf. Middleware `staff` mengeluarkannya dari `/admin` meskipun suatu saat permission ditambahkan ke role itu.

## Tugas tiap role

| Role | Slug | Tugas menurut deskripsi seeder dan permission yang dipasang |
| --- | --- | --- |
| Super Admin | `super_admin` | Akses penuh. `allows()` mengembalikan benar untuk setiap slug tanpa membaca tabel permission |
| Admin | `admin` | Mengelola konten, properti, tamu, reservasi, pembayaran, housekeeping, ulasan, pesan, laporan, dan user. Tidak menerima `roles.*` dan `permissions.*` |
| Receptionist | `receptionist` | Melihat dashboard, customer, kamar, dan pembayaran. Mengelola tamu dan reservasi serta check-in/check-out |
| Finance | `finance` | Melihat dashboard, reservasi, dan laporan. Mengelola metode pembayaran serta mencatat, mengubah, memverifikasi, dan merefund pembayaran |
| Housekeeping | `housekeeping` | Melihat dashboard, melihat dan mengubah unit kamar, serta membuat dan mengubah tugas kebersihan |
| Customer | `customer` | Tidak punya satupun permission panel. Login lewat `/login`, mengirim ulasan untuk reservasi sendiri yang sudah check-out |

## Cara membaca matriks

Kolom memakai huruf aksi yang ada di seeder:

`V` view, `C` create, `U` update, `D` delete, `I` check-in, `O` check-out, `Y` verify, `R` refund, `M` moderate.

Tanda `—` berarti slug itu tidak diberikan ke role. Super Admin ditandai `semua` karena bypass kode, bukan karena daftar di bawah diulang satu per satu.

`payments.delete` **tidak dibuat** seeder. Route hapus pembayaran tetap meminta slug itu. Hanya Super Admin yang lolos, karena `allows()` tidak memeriksa katalog. Admin dan Finance tidak memilikinya.

## Matriks permission

| Modul | Super Admin | Admin | Receptionist | Finance | Housekeeping | Customer |
| --- | --- | --- | --- | --- | --- | --- |
| dashboard | semua | V | V | V | V | — |
| website_cms | semua | V C U D | — | — | — | — |
| banners | semua | V C U D | — | — | — | — |
| page_contents | semua | V C U D | — | — | — | — |
| settings | semua | V C U D | — | — | — | — |
| users | semua | V C U D | — | — | — | — |
| roles | semua | — | — | — | — | — |
| permissions | semua | — | — | — | — | — |
| room_categories | semua | V C U D | — | — | — | — |
| room_types | semua | V C U D | V | — | — | — |
| rooms | semua | V C U D | V | — | V U | — |
| room_facilities | semua | V C U D | — | — | — | — |
| facility_categories | semua | V C U D | — | — | — | — |
| resort_facilities | semua | V C U D | — | — | — | — |
| promotions | semua | V C U D | — | — | — | — |
| packages | semua | V C U D | — | — | — | — |
| gallery_categories | semua | V C U D | — | — | — | — |
| galleries | semua | V C U D | — | — | — | — |
| customers | semua | V C U D | V | — | — | — |
| guests | semua | V C U D | V C U | — | — | — |
| reservations | semua | V C U D | V C U | V | — | — |
| front_desk | semua | V I O | V I O | — | — | — |
| payment_methods | semua | V C U D | — | V C U | — | — |
| payments | semua | V C U Y R | V | V C U Y R | — | — |
| housekeeping | semua | V C U D | — | — | V C U | — |
| reviews | semua | V M D | — | — | — | — |
| contact_messages | semua | V U D | — | — | — | — |
| reports | semua | V | — | V | — | — |
| activity_logs | semua | V | — | — | — | — |
| notifications | semua | V C U D | V | V | V | — |

## Akibat pada menu

Sidebar menyembunyikan menu bila tidak ada satupun slug `can` yang lolos `allows()`.

| Menu | Role bawaan yang melihatnya |
| --- | --- |
| Dashboard | Semua staf |
| Website Management, Gallery, Resort Facilities, Promotions | Super Admin, Admin |
| Room Management | Super Admin, Admin, Receptionist, Housekeeping |
| Booking Management | Super Admin, Admin, Receptionist, Finance |
| Payment Management | Super Admin, Admin, Receptionist, Finance |
| Housekeeping | Super Admin, Admin, Housekeeping |
| Reviews & Messages | Super Admin, Admin |
| Staff & Access | Super Admin, Admin. Admin hanya sampai tab user karena tidak punya `roles.view` dan `permissions.view` |
| Reports & Analytics | Super Admin, Admin, Finance. Finance tidak melihat tab activity log |
| Notifications & Settings | Semua staf bawaan, karena semuanya punya `notifications.view` |

Melihat menu tidak sama dengan boleh mengubah. Receptionist melihat Room Management tetapi hanya tab yang `rooms.view` atau `room_types.view`. Finance melihat Booking Management tetapi hanya data reservasi. Tombol dan panel yang sudah dibungkus `@allows` tidak ikut ter-render.

## Batas yang tidak tertulis di matriks

- Customer tidak membuka `/admin` sama sekali.
- Staf tidak login lewat `POST /login`.
- User nonaktif gagal di kedua form login.
- Hapus role `super_admin` ditolak controller.
- Akun yang sedang dipakai tidak dapat menonaktifkan diri atau melepas role stafnya.
- Super Admin aktif terakhir tidak dapat dinonaktifkan atau dilepas role-nya.
- Route notifikasi tidak memeriksa `notifications.view`. Perlindungan menu ada di sidebar, bukan di middleware route itu.
