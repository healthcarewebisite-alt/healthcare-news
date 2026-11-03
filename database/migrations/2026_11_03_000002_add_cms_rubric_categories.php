<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private const CATEGORIES = [
        ['name' => 'Pharmacy', 'slug' => 'pharmacy', 'icon' => '💊', 'color' => '#059669', 'sort_order' => 7, 'description' => 'Berita farmasi dan industri obat.'],
        ['name' => 'Medical Devices', 'slug' => 'medical-devices', 'icon' => '🩺', 'color' => '#2563EB', 'sort_order' => 8, 'description' => 'Informasi alat dan teknologi kesehatan.'],
        ['name' => 'People', 'slug' => 'people', 'icon' => '👥', 'color' => '#7C3AED', 'sort_order' => 9, 'description' => 'Profil tokoh dan insan healthcare.'],
        ['name' => 'Digital Cover', 'slug' => 'digital-cover', 'icon' => '📖', 'color' => '#DB2777', 'sort_order' => 10, 'description' => 'Cerita sampul digital Healthcare.id.'],
    ];

    public function up(): void
    {
        foreach (self::CATEGORIES as $category) {
            DB::table('categories')->insertOrIgnore([
                ...$category,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void {}
};
