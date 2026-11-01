<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable(); // Ringkasan
            $table->longText('content'); // Konten HTML dari Trix editor
            $table->string('featured_image')->nullable(); // path .webp hasil konversi otomatis
            $table->string('featured_image_alt')->nullable();

            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('author_id')->constrained('users')->cascadeOnDelete();

            // Flag tampilan sesuai Struktur Homepage di konsep
            $table->boolean('is_headline')->default(false);   // Hero News - Berita Utama (70%)
            $table->boolean('is_trending')->default(false);    // Hero News - Trending (30%)
            $table->boolean('is_breaking')->default(false);    // Breaking News strip merah berjalan
            $table->boolean('is_featured')->default(false);    // Featured Article (editor pick)

            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();

            $table->unsignedBigInteger('views_count')->default(0);

            // SEO
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'published_at']);
            $table->index('is_headline');
            $table->index('is_breaking');
            $table->index('is_trending');
            $table->index('is_featured');
        });

        Schema::create('article_tag', function (Blueprint $table) {
            $table->foreignId('article_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->primary(['article_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_tag');
        Schema::dropIfExists('articles');
    }
};
