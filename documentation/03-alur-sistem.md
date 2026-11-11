# 3. Alur Sistem

Diagram berikut mengikuti controller dan route yang aktif. Kotak keputusan memakai kondisi yang benar-benar diperiksa kode.

## Peta modul

```mermaid
flowchart LR
    subgraph publik [Situs publik]
        H[Beranda dan halaman info]
        CL[Login dan register customer]
        RV[Kirim ulasan]
    end
    subgraph panel [Panel /admin]
        D[Dashboard]
        W[Website dan Gallery]
        P[Kamar, fasilitas, promo]
        B[Booking dan front desk]
        Y[Pembayaran]
        HK[Housekeeping]
        RM[Ulasan dan pesan]
        S[Staf, laporan, notifikasi]
    end
    CL --> H
    RV --> RM
    B --> Y
    B --> HK
    Y --> B
```

Halaman publik `/`, `/kamar`, `/fasilitas`, `/reservasi`, `/tentang`, dan `GET /ulasan` langsung mengembalikan Blade. Mereka tidak membuat reservasi atau pembayaran.

## Login staf

```mermaid
flowchart TD
    A[GET /admin/login] --> B{Sudah login?}
    B -->|staf| C[Dashboard]
    B -->|bukan staf| D[Beranda]
    B -->|belum| E[Form login admin]
    E --> F[POST email dan password]
    F --> G{Attempt berhasil?}
    G -->|tidak| H[Kembali dengan error email]
    G -->|ya| I{Aktif dan staf?}
    I -->|tidak| J[Logout lalu kembali dengan error]
    I -->|ya| K[Regenerate session]
    K --> L[Redirect intended atau staffHome]
```

## Logout staf dan customer

```mermaid
flowchart TD
    A[POST logout] --> B{Middleware auth lolos?}
    B -->|tidak| C[Redirect ke login yang sesuai path]
    B -->|ya| D[Auth logout]
    D --> E[Invalidate session dan regenerate token]
    E --> F{Route}
    F -->|/admin/logout| G[Halaman login admin]
    F -->|/logout| H[Beranda]
```

## Login dan register customer

```mermaid
flowchart TD
    A[POST /register atau /login] --> B{Sudah login?}
    B -->|staf| C[Dashboard]
    B -->|customer| D[Beranda]
    B -->|belum| E{Register atau login?}
    E -->|register| F[Validasi nama, email, telepon, password]
    F --> G{Role customer aktif ada?}
    G -->|tidak| H[Error registrasi belum tersedia]
    G -->|ya| I[Buat user, role, profil kosong]
    I --> J[Login lalu beranda]
    E -->|login| K{Kredensial, aktif, dan bukan staf?}
    K -->|tidak| L[Kembali dengan error]
    K -->|ya| M[Regenerate session lalu intended home]
```

## Reservasi, pelunasan, dan kamar

```mermaid
flowchart TD
    A[Staf menyimpan reservasi] --> B[Cek tanggal, promo, paket, dan kamar kosong]
    B --> C{Status diminta checked_in atau checked_out?}
    C -->|ya, dan belum berstatus itu| D[Tolak: lakukan dari Front Desk]
    C -->|tidak| E[Hitung subtotal, diskon promo, harga paket, total]
    E --> F{Status pending atau confirmed?}
    F -->|ya| G[Samakan dengan pembayaran paid]
    G --> H{Jumlah paid menutup total dan total lebih dari nol?}
    H -->|ya dan masih pending| I[Status menjadi confirmed]
    H -->|tidak dan masih confirmed| J[Status kembali pending_payment]
    F -->|status lain| K[Simpan tanpa mengubah pelunasan]
    I --> L[Check-in hanya jika confirmed]
    J --> L
    L --> M[Pilih kamar aktif yang tidak bentrok]
    M --> N[Kamar occupied dan reservasi checked_in]
    N --> O[Check-out]
    O --> P[Kamar cleaning dan tugas turnover]
```

Aturan yang mengikat alur itu:

- Satu baris detail reservasi hanya untuk satu kamar (`quantity` maksimal 1).
- Kamar `maintenance` dan `out_of_order` tidak dialokasikan.
- Bentrok dihitung dari reservasi yang bukan `cancelled` atau `expired` dan tanggalnya beririsan.
- Check-in menolak status selain `confirmed`.
- Mengubah total reservasi `pending_payment` atau `confirmed` menjalankan `syncPaymentConfirmation()`.
- Meninggalkan `checked_in` menuju status lain melepas kamar yang masih `occupied`, selama tidak ada tamu `checked_in` lain di kamar itu.
- Reservasi `checked_out` tidak dapat diubah statusnya. Reservasi `checked_in` atau `checked_out` tidak dapat dihapus.

## Pembayaran tercatat

Tidak ada panggilan ke penyedia pembayaran. Staf mencatat transaksi.

```mermaid
flowchart TD
    A[Simpan atau ubah pembayaran] --> B{Reservasi batal/kedaluwarsa atau metode nonaktif baru?}
    B -->|ya| C[Validasi ditolak]
    B -->|tidak| D{Status}
    D -->|paid| E[Isi paid_at, verified_by, verified_at]
    D -->|selain paid| F[Kosongkan paid_at dan data verifikasi bila sebelumnya lunas]
    E --> G[Hitung ulang konfirmasi reservasi]
    F --> G
    H[Verify] --> I{Status unpaid atau waiting dan nominal lebih dari nol?}
    I -->|ya| E
    J[Refund] --> K{Status saat ini paid?}
    K -->|ya| L[Status refunded lalu hitung ulang reservasi]
```

Konfirmasi reservasi hanya mengubah `pending_payment` dan `confirmed`. Status `checked_in`, `checked_out`, `cancelled`, dan `expired` tidak diubah oleh pembayaran.

Pembayaran `paid` tidak dapat dihapus. Metode yang masih punya transaksi, termasuk yang sudah di-soft-delete, tidak dapat dihapus.

## Housekeeping

Check-out membuat tugas `turnover` berprioritas tinggi bila belum ada tugas sejenis yang `pending` atau `in_progress` untuk kamar dan reservasi yang sama.

Saat tugas diubah menjadi `verified`, kamar menjadi `available` hanya jika:

- tidak ada reservasi `checked_in` pada kamar itu, dan
- jenis tugas adalah `cleaning`, `inspection`, atau `turnover`.

Tugas `maintenance` yang diverifikasi tidak mengubah status kamar.

## Ulasan

```mermaid
flowchart TD
    A[POST /ulasan] --> B{User login?}
    B -->|tidak| C[Error minta login customer]
    B -->|ya| D{Aktif dan role customer?}
    D -->|tidak| E[Tolak]
    D -->|ya| F{Kode booking milik user dan status checked_out?}
    F -->|tidak| G[Tolak]
    F -->|ya| H{Belum ada ulasan termasuk yang terhapus?}
    H -->|tidak| I[Tolak]
    H -->|ya| J[Simpan status pending]
    J --> K[Staf moderasi: approved, rejected, atau pending]
```

Halaman `GET /ulasan` adalah Blade publik. Kode moderasi ada di panel. Daftar ulasan `approved` belum dirakit ke halaman publik oleh controller.

## Pesan kontak, konten, dan laporan

Tidak ada route publik yang membuat `contact_messages`. Panel hanya membaca, mengubah status (`new`, `read`, `followed_up`), dan menghapus pesan yang sudah ada. Membuka detail pesan `new` mengubahnya menjadi `read`.

Laporan membaca reservasi, pembayaran `paid`, kamar, dan `activity_logs`. Tab yang tidak diizinkan tidak diisi datanya. Penulisan `activity_logs` dari aksi admin tidak dipasang di controller menu yang aktif, sehingga isi log bergantung pada data yang sudah tersimpan.

Notifikasi memakai tabel notifikasi Laravel milik user yang login. Staf menandai satu atau semua notifikasinya sebagai terbaca, dan dapat mengganti nama, telepon, serta password sendiri.
