<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Infographic;
use App\Models\NewsletterSubscriber;
use App\Models\Tag;
use App\Models\User;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ============ USERS ============
        $superAdmin = User::create([
            'name' => 'Health Admin1',
            'email' => 'admin@healthcare.id',
            'password' => 'Admin#2026',
            'role' => 'super_admin',
            'bio' => 'Pengelola utama portal Healthcare.id.',
            'is_active' => true,
        ]);

        $editor = User::create([
            'name' => 'Dr. Amelia Putri',
            'email' => 'editor@healthcare.id',
            'password' => 'password',
            'role' => 'editor',
            'bio' => 'Editor kesehatan dengan pengalaman 8 tahun di jurnalisme medis.',
            'is_active' => true,
        ]);

        $author = User::create([
            'name' => 'Rangga Saputra',
            'email' => 'author@healthcare.id',
            'password' => 'password',
            'role' => 'author',
            'bio' => 'Penulis lepas topik kesehatan & gaya hidup.',
            'is_active' => true,
        ]);

        // ============ CATEGORIES ============
        $categoryData = [
            ['name' => 'Kesehatan Umum', 'slug' => 'kesehatan-umum', 'icon' => '🩺', 'color' => '#2563EB', 'sort_order' => 1, 'description' => 'Berita dan informasi kesehatan umum sehari-hari.'],
            ['name' => 'Health Tips', 'slug' => 'health-tips', 'icon' => '💡', 'color' => '#10B981', 'sort_order' => 2, 'description' => 'Tips praktis menjaga kesehatan tubuh dan pikiran.'],
            ['name' => 'Teknologi Kesehatan', 'slug' => 'health-technology', 'icon' => '🤖', 'color' => '#8B5CF6', 'sort_order' => 3, 'description' => 'Inovasi dan teknologi terbaru di dunia medis.'],
            ['name' => 'Penelitian', 'slug' => 'research', 'icon' => '🧬', 'color' => '#F59E0B', 'sort_order' => 4, 'description' => 'Ringkasan hasil penelitian & studi kesehatan terbaru.'],
            ['name' => 'Gaya Hidup', 'slug' => 'lifestyle', 'icon' => '❤️', 'color' => '#EC4899', 'sort_order' => 5, 'description' => 'Gaya hidup sehat, olahraga, dan nutrisi.'],
            ['name' => 'Opini', 'slug' => 'opinion', 'icon' => '✍️', 'color' => '#64748B', 'sort_order' => 6, 'description' => 'Opini dan analisis pakar kesehatan.'],
        ];

        $categories = collect($categoryData)->map(function ($cat) {
            $category = Category::create($cat);

            // Trait HasSlug bisa meng-generate ulang slug dari 'name' pada beberapa
            // kondisi. Paksa slug tetap sesuai yang kita tentukan (mis. 'health-technology'
            // bukan 'teknologi-kesehatan') agar pencarian kategori berdasarkan slug
            // di bawah tidak gagal.
            if ($category->slug !== $cat['slug']) {
                $category->forceFill(['slug' => $cat['slug']])->saveQuietly();
            }

            return $category->fresh();
        });

        // ============ TAGS ============
        $tagNames = ['Jantung', 'Diabetes', 'Nutrisi', 'Mental Health', 'Olahraga', 'Vaksin', 'Anak', 'Lansia', 'BPJS', 'Covid-19', 'Kanker', 'Kehamilan'];
        $tags = collect($tagNames)->map(fn ($name) => Tag::create(['name' => $name]));

        // ============ ARTICLES (dummy, gambar dari Picsum) ============
        $articleTitles = [
            ['title' => 'Kemenkes Luncurkan Program Skrining Jantung Gratis di 500 Puskesmas', 'category' => 'kesehatan-umum', 'flags' => ['is_headline']],
            ['title' => 'Studi Terbaru: Tidur Kurang dari 6 Jam Tingkatkan Risiko Hipertensi', 'category' => 'research', 'flags' => ['is_trending']],
            ['title' => 'WHO Peringatkan Lonjakan Kasus Resistensi Antibiotik di Asia Tenggara', 'category' => 'kesehatan-umum', 'flags' => ['is_breaking', 'is_trending']],
            ['title' => '7 Kebiasaan Pagi yang Bisa Menurunkan Risiko Diabetes Tipe 2', 'category' => 'health-tips', 'flags' => ['is_trending']],
            ['title' => 'RS di Jakarta Mulai Terapkan Rekam Medis Berbasis AI', 'category' => 'health-technology', 'flags' => ['is_featured']],
            ['title' => 'Robot Bedah Generasi Terbaru Resmi Digunakan di RS Rujukan Nasional', 'category' => 'health-technology', 'flags' => []],
            ['title' => 'Peneliti UI Temukan Senyawa Herbal Potensial untuk Anti-Inflamasi', 'category' => 'research', 'flags' => []],
            ['title' => 'Vaksin Kombinasi Baru untuk Anak Dapat Izin Edar BPOM', 'category' => 'kesehatan-umum', 'flags' => ['is_breaking']],
            ['title' => '10 Menu Sarapan Sehat Rendah Gula untuk Penderita Diabetes', 'category' => 'health-tips', 'flags' => []],
            ['title' => 'Olahraga 30 Menit Sehari Terbukti Turunkan Risiko Depresi', 'category' => 'lifestyle', 'flags' => []],
            ['title' => 'Kenapa Generasi Muda Perlu Waspada Kesehatan Mental di Era Digital', 'category' => 'opinion', 'flags' => []],
            ['title' => 'Pentingnya Medical Check-Up Rutin Setelah Usia 40 Tahun', 'category' => 'health-tips', 'flags' => []],
            ['title' => 'Terapi Gen Menunjukkan Hasil Menjanjikan untuk Penyakit Langka', 'category' => 'research', 'flags' => ['is_featured']],
            ['title' => 'Panduan Lengkap Memilih Asuransi Kesehatan Tambahan di Luar BPJS', 'category' => 'opinion', 'flags' => []],
            ['title' => 'Aplikasi Telemedicine Kini Bisa Terhubung Langsung dengan Rekam Medis RS', 'category' => 'health-technology', 'flags' => []],
            ['title' => 'Mengenal Diet Mediterania dan Manfaatnya bagi Kesehatan Jantung', 'category' => 'lifestyle', 'flags' => ['is_trending']],
            ['title' => 'Kasus DBD Meningkat di Musim Hujan, Ini Langkah Pencegahannya', 'category' => 'kesehatan-umum', 'flags' => []],
            ['title' => 'Manfaat Puasa Intermiten bagi Metabolisme Tubuh Menurut Riset', 'category' => 'research', 'flags' => []],
        ];

        $excerptPool = [
            'Langkah ini diharapkan dapat meningkatkan deteksi dini penyakit tidak menular di kalangan masyarakat.',
            'Temuan ini menjadi perhatian serius bagi tenaga medis dan pembuat kebijakan kesehatan nasional.',
            'Para ahli menyarankan masyarakat untuk lebih waspada dan menerapkan pola hidup sehat sejak dini.',
            'Inovasi ini menjadi bagian dari transformasi digital di sektor layanan kesehatan Indonesia.',
            'Riset ini melibatkan ribuan responden dari berbagai kota besar di Indonesia selama dua tahun terakhir.',
        ];

        $paragraphPool = [
            '<p>Perkembangan ini menjadi sorotan utama di kalangan tenaga medis maupun masyarakat umum. Berbagai pihak menyambut baik langkah tersebut sebagai upaya konkret dalam meningkatkan kualitas layanan kesehatan di Indonesia.</p>',
            '<p>Menurut para pakar, inisiatif semacam ini perlu didukung dengan edukasi masyarakat yang berkelanjutan agar manfaatnya bisa dirasakan secara merata, termasuk di daerah dengan akses layanan kesehatan yang masih terbatas.</p>',
            '<p>Sejumlah rumah sakit rujukan telah menyatakan kesiapannya untuk mengadopsi pendekatan baru ini dalam waktu dekat. Proses transisi akan dilakukan secara bertahap dengan pelatihan intensif bagi tenaga kesehatan.</p>',
            '<p>Data awal menunjukkan hasil yang menjanjikan, meski para peneliti menekankan perlunya studi lanjutan dengan skala yang lebih besar untuk memastikan validitas temuan secara menyeluruh.</p>',
            '<blockquote>"Ini adalah langkah penting menuju sistem kesehatan yang lebih responsif dan berbasis data," ujar salah satu narasumber dalam keterangannya.</blockquote>',
            '<p>Masyarakat diimbau untuk terus mengikuti perkembangan informasi resmi dari otoritas kesehatan setempat guna mendapatkan panduan yang paling akurat dan terkini.</p>',
        ];

        $authors = [$editor, $author, $superAdmin];
        $createdArticles = collect();

        foreach ($articleTitles as $i => $data) {
            $category = $categories->firstWhere('slug', $data['category']) ?? $categories->first();
            $content = collect($paragraphPool)->shuffle()->take(4)->implode('');

            $article = Article::create([
                'title' => $data['title'],
                'excerpt' => $excerptPool[$i % count($excerptPool)],
                'content' => $content,
                'featured_image' => "https://picsum.photos/seed/healthcare-{$i}/1200/750",
                'featured_image_alt' => $data['title'],
                'category_id' => $category->id,
                'author_id' => $authors[$i % count($authors)]->id,
                'is_headline' => in_array('is_headline', $data['flags']),
                'is_trending' => in_array('is_trending', $data['flags']),
                'is_breaking' => in_array('is_breaking', $data['flags']),
                'is_featured' => in_array('is_featured', $data['flags']),
                'status' => 'published',
                'published_at' => now()->subDays(count($articleTitles) - $i),
                'views_count' => rand(120, 15000),
            ]);

            $article->tags()->attach($tags->random(rand(1, 3))->pluck('id'));
            $createdArticles->push($article);
        }

        // ============ COMMENTS (dummy) ============
        $commentBodies = [
            'Artikel yang sangat bermanfaat, terima kasih infonya!',
            'Apakah ini berlaku juga untuk pasien BPJS?',
            'Semoga programnya bisa sampai ke daerah saya juga.',
            'Sudah saya coba tipsnya, hasilnya lumayan terasa.',
            'Perlu ada sosialisasi lebih lanjut ke masyarakat awam.',
        ];
        foreach ($createdArticles->random(10) as $article) {
            Comment::create([
                'article_id' => $article->id,
                'guest_name' => collect(['Budi Santoso', 'Siti Aminah', 'Andi Wijaya', 'Rina Kartika', 'Joko Prasetyo'])->random(),
                'guest_email' => 'pembaca@example.com',
                'body' => collect($commentBodies)->random(),
                'status' => collect(['approved', 'approved', 'pending'])->random(),
            ]);
        }

        // ============ HOSPITALS (dummy) ============
        $hospitalData = [
            ['name' => 'RSUP Dr. Cipto Mangunkusumo', 'city' => 'Jakarta Pusat', 'province' => 'DKI Jakarta', 'type' => 'RS Umum'],
            ['name' => 'RS Premier Bintaro', 'city' => 'Tangerang Selatan', 'province' => 'Banten', 'type' => 'RS Umum'],
            ['name' => 'RS Hasan Sadikin', 'city' => 'Bandung', 'province' => 'Jawa Barat', 'type' => 'RS Umum'],
            ['name' => 'RS Jantung dan Pembuluh Darah Harapan Kita', 'city' => 'Jakarta Barat', 'province' => 'DKI Jakarta', 'type' => 'RS Khusus'],
            ['name' => 'RSUD Dr. Soetomo', 'city' => 'Surabaya', 'province' => 'Jawa Timur', 'type' => 'RS Umum'],
            ['name' => 'Klinik Sehat Keluarga', 'city' => 'Yogyakarta', 'province' => 'DI Yogyakarta', 'type' => 'Klinik'],
            ['name' => 'RS Siloam Kebon Jeruk', 'city' => 'Jakarta Barat', 'province' => 'DKI Jakarta', 'type' => 'RS Umum'],
            ['name' => 'RSUD Wangaya', 'city' => 'Denpasar', 'province' => 'Bali', 'type' => 'RS Umum'],
        ];

        $facilitiesPool = ['IGD 24 Jam', 'ICU', 'Laboratorium', 'Radiologi', 'Apotek 24 Jam', 'Ruang Operasi', 'Rawat Inap', 'Poliklinik Spesialis'];

        $hospitals = collect($hospitalData)->map(function ($h, $i) use ($facilitiesPool) {
            return Hospital::create([
                'name' => $h['name'],
                'logo' => "https://picsum.photos/seed/hospital-logo-{$i}/200/200",
                'cover_image' => "https://picsum.photos/seed/hospital-cover-{$i}/1200/500",
                'type' => $h['type'],
                'city' => $h['city'],
                'province' => $h['province'],
                'address' => 'Jl. Kesehatan No. '.rand(1, 99).", {$h['city']}",
                'phone' => '021-'.rand(1000000, 9999999),
                'email' => Str::slug($h['name']).'@rs-dummy.co.id',
                'website' => 'https://'.Str::slug($h['name']).'.co.id',
                'rating' => round(rand(35, 50) / 10, 1),
                'reviews_count' => rand(50, 2500),
                'description' => 'Rumah sakit yang menyediakan layanan kesehatan lengkap dengan tenaga medis profesional dan fasilitas modern untuk kenyamanan pasien.',
                'facilities' => collect($facilitiesPool)->shuffle()->take(rand(4, 6))->values()->all(),
                'is_bpjs' => (bool) rand(0, 1),
                'is_active' => true,
            ]);
        });

        // ============ DOCTORS (dummy) ============
        $doctorData = [
            ['name' => 'dr. Bagus Prasetyo, Sp.JP', 'specialty' => 'Spesialis Jantung'],
            ['name' => 'dr. Maya Anindya, Sp.A', 'specialty' => 'Spesialis Anak'],
            ['name' => 'dr. Hendra Kusuma, Sp.PD', 'specialty' => 'Spesialis Penyakit Dalam'],
            ['name' => 'dr. Fitriani Wulandari, Sp.OG', 'specialty' => 'Spesialis Kandungan'],
            ['name' => 'dr. Arief Rachman, Sp.B', 'specialty' => 'Spesialis Bedah'],
            ['name' => 'dr. Nadia Salsabila, Sp.KJ', 'specialty' => 'Spesialis Kesehatan Jiwa'],
            ['name' => 'dr. Yusuf Hidayat, Sp.M', 'specialty' => 'Spesialis Mata'],
            ['name' => 'dr. Clara Dewi, Sp.KK', 'specialty' => 'Spesialis Kulit & Kelamin'],
            ['name' => 'dr. Rizky Ramadhan, Sp.OT', 'specialty' => 'Spesialis Ortopedi'],
            ['name' => 'dr. Intan Permata, Sp.THT', 'specialty' => 'Spesialis THT'],
        ];

        foreach ($doctorData as $i => $d) {
            Doctor::create([
                'name' => $d['name'],
                'photo' => 'https://i.pravatar.cc/400?img='.($i + 10),
                'specialty' => $d['specialty'],
                'hospital_id' => $hospitals->random()->id,
                'str_number' => 'STR-'.rand(100000, 999999),
                'bio' => 'Berpengalaman lebih dari '.rand(5, 20)." tahun dalam menangani pasien di bidang {$d['specialty']}, aktif dalam berbagai seminar dan pelatihan medis nasional maupun internasional.",
                'years_experience' => rand(5, 20),
                'is_active' => true,
            ]);
        }

        // ============ VIDEOS (dummy, embed YouTube publik) ============
        $videoData = [
            ['title' => 'Cara Mudah Menjaga Kesehatan Jantung Setiap Hari', 'youtube_id' => 'dQw4w9WgXcQ'],
            ['title' => 'Tips Tidur Berkualitas ala Dokter Spesialis', 'youtube_id' => 'jNQXAC9IVRw'],
            ['title' => 'Mengenal Gejala Awal Diabetes yang Sering Diabaikan', 'youtube_id' => 'M7lc1UVf-VE'],
            ['title' => 'Panduan Nutrisi Seimbang untuk Keluarga', 'youtube_id' => 'ZZ5LpwO-An4'],
        ];
        foreach ($videoData as $v) {
            Video::create([
                'title' => $v['title'],
                'youtube_id' => $v['youtube_id'],
                'description' => 'Video edukasi kesehatan yang membahas topik penting untuk menjaga kualitas hidup sehari-hari.',
                'is_active' => true,
            ]);
        }

        // ============ INFOGRAPHICS (dummy) ============
        $infographicData = [
            ['title' => 'Panduan Cuci Tangan yang Benar', 'category' => 'health-tips'],
            ['title' => '5 Tanda Tubuh Kekurangan Vitamin D', 'category' => 'health-tips'],
            ['title' => 'Alur Skrining Kesehatan Jantung', 'category' => 'kesehatan-umum'],
        ];
        foreach ($infographicData as $i => $info) {
            Infographic::create([
                'title' => $info['title'],
                'image' => "https://picsum.photos/seed/infografis-{$i}/900/1200",
                'category_id' => $categories->firstWhere('slug', $info['category'])->id,
                'description' => 'Infografis edukatif untuk membantu masyarakat memahami informasi kesehatan secara visual dan mudah dicerna.',
                'is_active' => true,
            ]);
        }

        // ============ NEWSLETTER SUBSCRIBERS (dummy) ============
        foreach (['pembaca1@example.com', 'pembaca2@example.com', 'pembaca3@example.com'] as $email) {
            NewsletterSubscriber::create([
                'email' => $email,
                'is_confirmed' => true,
                'subscribed_at' => now()->subDays(rand(1, 60)),
            ]);
        }
    }
}
