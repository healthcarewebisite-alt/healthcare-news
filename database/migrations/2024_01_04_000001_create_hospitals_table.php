<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo')->nullable(); // path .webp
            $table->string('cover_image')->nullable(); // path .webp
            $table->string('type')->nullable(); // RS Umum, RS Khusus, Klinik
            $table->string('city');
            $table->string('province');
            $table->text('address');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->decimal('rating', 2, 1)->default(0);
            $table->unsignedInteger('reviews_count')->default(0);
            $table->text('description')->nullable();
            $table->json('facilities')->nullable(); // ["IGD 24 Jam", "ICU", "Laboratorium", ...]
            $table->boolean('is_bpjs')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['city', 'province']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hospitals');
    }
};
