# Konteks kebutuhan proyek Healthcare.id

Sumber: `Website Healthcare.pdf` (dokumen kebutuhan proyek).

## Identitas dan tujuan
- Portal berita bertema **Healthcare & Lifestyle** dengan domain `healthcare.id`.
- Tagline: **Health First**.
- Logo masih berstatus proses.
- Acuan bentuk/tampilan situs: `beautynesia.id`.
- Healthcare.id ingin menjadi platform media terdepan yang menulis tentang healthcare, dengan karya jurnalistik untuk rumah sakit, perusahaan alat kesehatan, farmasi, investor, pengelola, dan pembuat kebijakan di Indonesia.
- Indonesia Healthcare Magazine terbit setiap dua bulan, membahas isu dan cerita healthcare secara mendalam; sirkulasi ditujukan ke manajemen senior rumah sakit, perusahaan alat kesehatan/farmasi, dan pembuat kebijakan kesehatan.

## Rubrikasi
- Hospitals
- Pharmacy
- Medical Devices
- Lifestyle
- People
- Video
- News
- Digital Cover

## Struktur halaman dan fitur
- **Beranda:** Most Popular, Latest Article (dokumen menulis “Lates Article”), dan Video.
- **Header:** logo, banner, tagline.
- **Pencarian:** sediakan fitur Search.
- **Footer:** About Us, Advertise, Magazine, Contact Us, Privacy Policy, Event & Promotion.

## Konten halaman informasi
- **About Us:** jelaskan amanah menjaga kesehatan, visi platform, audiens karya jurnalistik, serta majalah healthcare dua bulanan dan distribusinya.
- **Advertise:** informasi pemasangan iklan dan kontak iklan majalah/digital.
- **Magazine:** tercantum sebagai halaman/tautan footer; rincian konten belum dijelaskan lebih lanjut.
- **Contact Us:** tampilkan email redaksi dan alamat/kontak redaksi majalah.

## Kontak yang diberikan
- Iklan majalah dan digital: `advertising@healthcare.com`
- Redaksi: `redaksi@healthcare.id`
- Alamat: Redaksi Majalah Healthcare Indonesia, Jalan Adenium, Gria Jakarta, Blok O4, No. 5, Tangerang Selatan 15415
- Telepon: `+62 812-8906-2919`

## Catatan implementasi
- Privacy Policy serta Event & Promotion disebut sebagai tautan footer, tetapi isi/detail halaman belum ditentukan.
- Banner, logo, dan aset editorial belum disertakan dalam dokumen.

## Backlog kerja proyek
Daftar ini adalah rencana bertahap, bukan perubahan kode. Status awal semua item: belum dimulai.

1. **Memetakan kondisi proyek saat ini** — tinjau halaman, komponen, rute, data, dan aset Laravel yang tersedia; cocokkan dengan dokumen dan catat gap tanpa mengubah kode.
2. **Menetapkan struktur situs dan rubrikasi** — tentukan navigasi dan URL konsisten untuk Hospitals, Pharmacy, Medical Devices, Lifestyle, People, Video, News, dan Digital Cover sesuai pola proyek.
3. **Menyesuaikan identitas dan layout global** — Healthcare.id, tagline Health First, acuan visual beautynesia.id, header/banner, pencarian, footer, dan navigasi responsif.
4. **Menyelaraskan halaman beranda** — Most Popular, Latest Article, dan Video menggunakan konten dinamis proyek.
5. **Melengkapi halaman rubrikasi editorial** — semua rubrik dapat dinavigasi dan menampilkan konten sesuai.
6. **Menyediakan halaman informasi dan kontak** — About Us, Advertise, Magazine, dan Contact Us dengan isi serta kontak pada dokumen kebutuhan.
7. **Menetapkan tujuan tautan footer** — Privacy Policy serta Event & Promotion; klarifikasi konten yang belum ditentukan sebelum finalisasi.
8. **Memoles responsivitas dan aksesibilitas** — uji mobile/desktop, navigasi, pencarian, tautan, label, kontras, dan interaksi dasar.
9. **Memvalidasi hasil proyek** — jalankan build dan pemeriksaan/test yang tersedia, tinjau halaman/rute publik, dan catat tindak lanjut.

Urutan kerja: audit terlebih dahulu; struktur situs dan layout global mengikuti hasil audit; halaman beranda, rubrik, dan informasi dibangun berdasarkan struktur/layout; kemudian responsivitas dan aksesibilitas, lalu validasi. Tidak ada file proyek yang diubah saat backlog ini dibuat.

## Progres implementasi — 2 November 2026
- **Selesai:** audit awal, struktur/rute rubrik, layout header dan footer, beranda Most Popular/Latest Article/Video, halaman rubrik editorial, halaman About Us/Advertise/Magazine/Contact Us, serta tujuan footer Privacy Policy dan Event & Promotion.
- **Selesai:** pemolesan responsivitas dan aksesibilitas dasar pada desktop/mobile.
- **Perubahan kode:** rubrik yang belum memiliki kategori atau artikel tetap menampilkan halaman dengan keadaan kosong, bukan tautan mati. Isi Privacy Policy dan Event & Promotion masih berupa pemberitahuan bahwa kontennya sedang disiapkan karena dokumen sumber belum memberi detail.
- **Validasi terbaru:** `npm run build` berhasil. Browser menguji lebar 320, 375, 390, 768, 1024, dan 1440 px tanpa overflow horizontal; fokus keyboard drawer, tombol escape, pemulihan fokus, pencarian, serta reduced motion juga lulus. PHPUnit sudah dikonfigurasi dengan `phpunit.xml.dist` dan tiga tes fitur publik lulus (17 assertion). Ekstensi PDO SQLite tidak tersedia di PHP lokal, jadi tes GET memakai koneksi DB yang dikonfigurasi aplikasi dan tidak menulis data. PHPUnit melaporkan dua deprecation dari konfigurasi database di dependency Laravel untuk konstanta PDO MySQL yang deprecated pada PHP 8.5.

## Rencana CMS / panel admin
Panel yang ada sudah mencakup CRUD artikel, kategori, rumah sakit, dokter, infografik, komentar, dan pengguna; ada login, role, dashboard, serta upload gambar artikel. Rencana ini menyempurnakan dan melengkapi modul yang ada, bukan membangun ulang.

1. **Memetakan gap CMS yang sudah ada** — audit form, controller, validasi, permission, dan alur publik terlebih dahulu. **Selesai:** ditemukan akses ID langsung yang memungkinkan author mengedit/menghapus artikel pengguna lain, status publish bisa dipalsukan dari form, metrik dashboard global terlihat oleh author, dan belum ada status/alur review.
2. **Memastikan akses dan role CMS** — verifikasi batas super_admin/editor/author pada tiap aksi. **Selesai:** author dibatasi pada artikel sendiri yang berstatus draft/rejected; akses editor tetap melalui role middleware; hanya editor/super_admin dapat memoderasi konten, dan dashboard author hanya menampilkan data artikelnya sendiri.
3. **Menyempurnakan workflow editorial** — draft, review, persetujuan, penjadwalan, terbit, arsip. **Selesai:** status draft/in_review/scheduled/published/rejected/archived; catatan reviewer; aksi submit, publish, schedule, reject, archive; publikasi terjadwal via Laravel Scheduler.
4. **Meningkatkan editor artikel** — rubrik, konten, gambar/alt, SEO, headline/popular/breaking, validasi, preview.
5. **Mengelola media editorial** — audit upload, seleksi media, validasi aset, alt text, dan pembersihan file yang benar.
6. **Mengelola rubrik dan konten terkait** — pemetaan delapan rubrik, serta video/digital cover dan keadaan konten kosong.
7. **Mengelola halaman informasi dari CMS** — About Us, Advertise, Magazine, Contact Us, Privacy Policy, Event & Promotion yang saat ini hard-coded.
8. **Menyempurnakan dashboard dan moderasi** — antrean review, komentar pending, statistik, dan aksi cepat sesuai role.
9. **Menguji dan menyiapkan CMS** — tes izin/CRUD/workflow/media/halaman, build/format, dokumentasi alur admin.

Urutan kerja bergantung pada audit gap dan akses; fitur artikel, media, rubrik, halaman, serta dashboard dikerjakan sesuai dependensi di todo sesi; tes menyeluruh menjadi tahap akhir. Tidak ada perubahan kode dibuat saat rencana ini disusun.

### Progres CMS — 3 November 2026
- Poin 1–3 selesai. Migrasi workflow editorial sudah diterapkan ke database development lokal.
- Validasi: `php artisan test` lulus (8 test, 35 assertion), Pint lulus, build Vite lulus, dan `php artisan schedule:list` menampilkan job publikasi tiap menit.
- PHPUnit mengeluarkan deprecation dari konstanta PDO MySQL di konfigurasi dependency Laravel pada PHP 8.5.
- Server produksi perlu menjalankan Laravel Scheduler tiap menit (`php artisan schedule:run` via cron atau `php artisan schedule:work` lokal).
- Poin 4–6 sedang dikerjakan setelah pengguna meminta lanjut; poin 7–9 ditahan untuk tahap berikutnya.

### Progres CMS — 3 November 2026
- **Poin 4 selesai — editor artikel:** slug opsional dan validasi unik, preview artikel internal, preview lokal gambar utama, serta upload gambar baru dibersihkan bila penyimpanan database gagal.
- **Poin 5 selesai — media:** Media Library untuk gambar WebP, pemilihan/sisipkan gambar ke Trix, proteksi aset yang masih direferensikan, dan penghapusan aset tak terpakai.
- **Poin 6 selesai — rubrik/video:** CRUD video YouTube untuk editor, halaman daftar/detail video publik, tautan video di navigasi dan beranda, serta kategori Pharmacy, Medical Devices, People, dan Digital Cover melalui migration.
- Perbaikan: thumbnail lama video kini dihapus berdasarkan path yang disimpan sebelum update.
- Tes tambahan mencakup editor/pratinjau artikel, akses role, media terpakai/tak terpakai, CRUD dan visibilitas video, serta halaman rubrik.
- Validasi: `php artisan test` lulus (13 test, 69 assertion), `npm run build` lulus, Pint lulus, route admin/publik video dan route media terdaftar, `git diff --check` bersih. PHPUnit tetap menampilkan deprecation `PDO::MYSQL_ATTR_*` dari dependency Laravel di PHP 8.5.
- Pada checkpoint penyelesaian poin 4–6, poin 7–9 masih ditahan sampai pengguna meninjau; pekerjaan dilanjutkan pada progres berikutnya.

### Progres CMS — 3 November 2026 (penyelesaian)
- **Poin 7 selesai — halaman informasi:** konten About Us, Advertise, Magazine, Contact Us, Privacy Policy, dan Event & Promotion dipindahkan ke database; editor/super_admin dapat mengubah judul, isi teks, dan kontak. HTML tidak dieksekusi pada halaman publik.
- **Poin 8 selesai — dashboard/moderasi:** dashboard editor menampilkan antrean artikel review dan komentar pending dengan tautan ke daftar terfilter; filter status komentar divalidasi. Statistik/akses dashboard author tetap dibatasi pada kontennya sendiri.
- **Poin 9 selesai — validasi/dokumentasi:** dokumentasi CMS dan perintah validasi diperbarui di README. Migration halaman informasi sudah dijalankan.
- Validasi akhir: `php artisan test` lulus (17 tes, 94 assertion), `npm run build`, Pint, route admin halaman, migration status, dan pemeriksaan whitespace untuk file terkait lulus.
- Catatan: PHPUnit menandai tes sebagai deprecated karena konstanta `PDO::MYSQL_ATTR_*` yang dipakai dependency Laravel pada PHP 8.5; bukan kegagalan tes.
- Seluruh poin CMS 1–9 selesai. Tidak ada tahap CMS berikutnya yang dimulai.
