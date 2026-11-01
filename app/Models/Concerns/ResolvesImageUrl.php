<?php

namespace App\Models\Concerns;

trait ResolvesImageUrl
{
    /**
     * Mengubah nilai kolom gambar menjadi URL yang bisa diakses browser.
     * - Jika sudah berupa URL penuh (mis. data dummy dari seeder yang memakai
     *   gambar eksternal), kembalikan apa adanya.
     * - Jika berupa path relatif (hasil upload asli lewat ImageUploadService),
     *   susun jadi URL storage lokal.
     */
    protected function resolveImageUrl(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return asset('storage/' . $path);
    }
}
