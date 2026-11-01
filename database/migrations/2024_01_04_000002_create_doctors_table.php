<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('photo')->nullable(); // path .webp
            $table->string('specialty'); // Spesialis: Jantung, Anak, dll
            $table->foreignId('hospital_id')->nullable()->constrained('hospitals')->nullOnDelete();
            $table->string('str_number')->nullable(); // No. Surat Tanda Registrasi
            $table->text('bio')->nullable();
            $table->unsignedInteger('years_experience')->nullable();
            $table->json('schedule')->nullable(); // jadwal praktik
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('specialty');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
