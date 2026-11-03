<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const PAGES = [
        [
            'slug' => 'about',
            'title' => 'About Us',
            'content' => 'Di Healthcare.id, kami percaya bahwa kesehatan adalah amanah yang harus dijaga.

Healthcare.id memiliki visi menjadi platform media terdepan yang menulis tentang healthcare. Karya jurnalistik kami ditujukan bagi rumah sakit, perusahaan alat kesehatan, farmasi, investor, pengelola, dan pembuat kebijakan di Indonesia.

Indonesia Healthcare Magazine diterbitkan setiap dua bulan, membahas isu dan cerita secara mendalam seputar healthcare. Majalah ini disirkulasikan kepada jajaran manajemen senior di rumah sakit, perusahaan alat kesehatan dan farmasi, serta pembuat kebijakan kesehatan.',
        ],
        [
            'slug' => 'advertise',
            'title' => 'Advertise',
            'content' => 'Untuk informasi pemasangan iklan di Healthcare.id, hubungi tim Magazine and Digital Advertising.',
            'email' => 'advertising@healthcare.com',
            'email_label' => 'Magazine and Digital Advertising',
        ],
        [
            'slug' => 'magazine',
            'title' => 'Magazine',
            'content' => 'Indonesia Healthcare Magazine terbit setiap dua bulan dengan pembahasan mendalam seputar isu dan cerita healthcare.

Sirkulasi majalah ditujukan kepada jajaran manajemen senior rumah sakit, perusahaan alat kesehatan dan farmasi, serta pembuat kebijakan kesehatan.',
        ],
        [
            'slug' => 'contact',
            'title' => 'Contact Us',
            'content' => 'Hubungi redaksi Majalah Healthcare Indonesia melalui informasi berikut.',
            'email' => 'redaksi@healthcare.id',
            'email_label' => 'Redaksi',
            'address' => 'Redaksi Majalah Healthcare Indonesia, Jalan Adenium, Gria Jakarta, Blok O4, No. 5, Tangerang Selatan 15415',
            'phone' => '+62 812-8906-2919',
        ],
        [
            'slug' => 'privacy-policy',
            'title' => 'Privacy Policy',
            'content' => 'Informasi kebijakan privasi sedang disiapkan.',
        ],
        [
            'slug' => 'event-promotion',
            'title' => 'Event & Promotion',
            'content' => 'Informasi event dan promosi sedang disiapkan.',
        ],
    ];

    public function up(): void
    {
        Schema::create('content_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->longText('content');
            $table->string('email')->nullable();
            $table->string('email_label')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();
        });

        foreach (self::PAGES as $page) {
            DB::table('content_pages')->insert([
                ...$page,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('content_pages');
    }
};
