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
| Konversi gambar otomatis ke WebP | `app/Services/ImageUploadService.php` |
| Dashboard Admin ala TailAdmin | `resources/views/layouts/admin.blade.php` |
| Role & middleware akses admin | `app/Http/Middleware/EnsureUserHasRole.php` |

## Role Pengguna

- **super_admin** — akses penuh termasuk kelola pengguna
- **editor** — kelola semua berita, kategori, RS, dokter, komentar
- **author** — hanya kelola berita miliknya sendiri
- **member** — akun publik (belum ada fitur khusus member di versi ini)

## Catatan Teknis

- Semua gambar upload (featured image berita, gambar di dalam Trix editor, logo RS, foto dokter, avatar user)
  **otomatis dikonversi ke `.webp`** via `ImageUploadService` (Intervention Image v3, driver GD).
- Kualitas & lebar maksimum WebP bisa diatur lewat `.env`: `IMAGE_WEBP_QUALITY` dan `IMAGE_MAX_WIDTH`.
- Gambar di halaman frontend memakai atribut `loading="lazy"` (native lazy loading browser), kecuali gambar
  hero headline yang memakai `loading="eager" fetchpriority="high"` agar LCP tetap cepat.
- Hero carousel di homepage memakai **Swiper.js** dengan autoplay 5 detik.
