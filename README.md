# Healthcare.id — Portal Berita Kesehatan Nasional

Portal berita kesehatan dibangun dengan **Laravel 11 + PHP 8.2 + Blade + Tailwind CSS**,
database **MySQL**, editor **Trix WYSIWYG** dengan konversi gambar otomatis ke **WebP**,
navbar desktop & mobile terpisah, admin dashboard bergaya **TailAdmin**, lazy loading gambar,
dan carousel hero (Swiper) di halaman utama.

## Prasyarat

- [Laravel Herd](https://herd.laravel.com/) (PHP 8.2+, sudah termasuk Composer & Node)
- MySQL (aktifkan service MySQL di Herd, atau pakai MySQL lokal/Laragon)
- Node.js (sudah termasuk di Herd)

## Instalasi

1. **Letakkan folder project** di direktori situs Herd (mis. `~/Herd/healthcare-id`).

2. **Install dependency PHP:**
   ```bash
   composer install
   ```

3. **Install dependency JS & build asset:**
   ```bash
   npm install
   npm run build
   ```
   *(gunakan `npm run dev` saat development agar Vite hot-reload aktif)*

4. **Siapkan file environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Buat database MySQL** bernama `healthcare_id` (via Herd UI, TablePlus, atau `mysql -u root -e "CREATE DATABASE healthcare_id"`).
   Sesuaikan kredensial di `.env` jika berbeda dari default.

6. **Buat symlink storage** (wajib agar gambar upload/WebP bisa diakses publik):
   ```bash
   php artisan storage:link
   ```

7. **Jalankan migration & seeder:**
   ```bash
   php artisan migrate --seed
   ```

8. **Buka site via Herd:**
   Herd otomatis membuatkan domain `http://healthcare-id.test` berdasarkan nama folder.
   Jika belum, jalankan `herd link` di dalam folder project.

## Akun Default

Setelah `php artisan migrate --seed`, akun Super Admin berikut tersedia:

- **Email:** admin@healthcare.id
- **Password:** password

Login di `http://healthcare-id.test/login`, lalu akan diarahkan ke `/admin` (dashboard ala TailAdmin).

## Struktur Fitur Utama

| Fitur | Lokasi |
|---|---|
| Homepage (hero carousel, breaking news, direktori RS/dokter) | `resources/views/pages/home.blade.php` |
| Navbar Desktop | `resources/views/partials/navbar-desktop.blade.php` |
| Navbar Mobile (drawer + bottom nav) | `resources/views/partials/navbar-mobile.blade.php` |
| CRUD Berita + Trix WYSIWYG | `app/Http/Controllers/Admin/ArticleController.php` |
| Media Library + pemilihan gambar di editor | `app/Http/Controllers/Admin/MediaController.php` |
| CRUD Video YouTube + halaman publik | `app/Http/Controllers/Admin/VideoController.php` |
| CMS halaman informasi | `app/Http/Controllers/Admin/ContentPageController.php` |
| Konversi gambar otomatis ke WebP | `app/Services/ImageUploadService.php` |
| Dashboard Admin ala TailAdmin | `resources/views/layouts/admin.blade.php` |
| Role & middleware akses admin | `app/Http/Middleware/EnsureUserHasRole.php` |

## Role Pengguna

- **super_admin** — akses penuh termasuk kelola pengguna
- **editor** — kelola semua berita, kategori, media, video, RS, dokter, komentar
- **author** — hanya kelola draft/artikel revisi miliknya; dapat mengajukan review dan tidak dapat menerbitkan
- **member** — akun publik (belum ada fitur khusus member di versi ini)

## Alur Editorial

- Artikel baru disimpan sebagai **Draft**.
- Author mengajukan draft untuk **Review**; setelah diajukan, author tidak dapat mengubahnya sampai editor memberi keputusan.
- Editor dapat menerbitkan, menolak dengan catatan revisi, atau menjadwalkan artikel.
- Artikel terjadwal diterbitkan otomatis oleh Laravel Scheduler. Di server, jalankan `php artisan schedule:run` setiap menit melalui cron. Untuk development, gunakan `php artisan schedule:work`.
- Editor dapat mengarsipkan artikel terbit. Author hanya dapat melihat dan mengubah artikel miliknya sendiri yang masih Draft atau perlu revisi.
- Editor dapat mengelola media WebP; media yang masih direferensikan konten tidak dapat dihapus. Pada editor berita, gambar dari Media Library dapat disisipkan langsung ke konten.
- Video YouTube dikelola dari panel admin dan video aktif tampil di halaman `/video` serta beranda. Rubrik Pharmacy, Medical Devices, People, dan Digital Cover disediakan oleh migration kategori CMS.
- Halaman About Us, Advertise, Magazine, Contact Us, Privacy Policy, dan Event & Promotion dikelola melalui **Admin → Halaman Informasi**. Teks ditampilkan sebagai paragraf dan HTML tidak dieksekusi.

## Validasi

Jalankan pemeriksaan fitur dengan `php artisan test`, format PHP dengan `vendor/bin/pint --test`, dan build aset produksi dengan `npm run build`.

## Catatan Teknis

- Semua gambar upload (featured image berita, gambar di dalam Trix editor, logo RS, foto dokter, avatar user)
  **otomatis dikonversi ke `.webp`** via `ImageUploadService` (Intervention Image v3, driver GD).
- Kualitas & lebar maksimum WebP bisa diatur lewat `.env`: `IMAGE_WEBP_QUALITY` dan `IMAGE_MAX_WIDTH`.
- Gambar di halaman frontend memakai atribut `loading="lazy"` (native lazy loading browser), kecuali gambar
  hero headline yang memakai `loading="eager" fetchpriority="high"` agar LCP tetap cepat.
- Hero carousel di homepage memakai **Swiper.js** dengan autoplay 5 detik.
