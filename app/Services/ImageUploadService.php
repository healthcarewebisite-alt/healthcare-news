<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

/**
 * Service terpusat untuk upload gambar.
 * SEMUA gambar yang masuk (featured image artikel, gambar di dalam
 * konten Trix editor, logo RS, foto dokter, avatar user, dll)
 * otomatis dikonversi menjadi .webp untuk optimasi ukuran & performa.
 */
class ImageUploadService
{
    protected ImageManager $manager;

    public function __construct()
    {
        // Driver GD dipakai karena tersedia default di PHP;
        // ganti ke Driver\Imagick\Driver jika extension imagick tersedia di server.
        $this->manager = new ImageManager(new Driver());
    }

    /**
     * Upload & konversi gambar ke WebP.
     *
     * @param UploadedFile $file      File gambar dari request
     * @param string       $folder    Sub-folder tujuan di disk 'public' (mis: 'articles', 'hospitals', 'doctors', 'avatars', 'editor')
     * @param int|null     $maxWidth  Resize lebar maksimum (null = tanpa resize)
     * @return string                 Path relatif hasil simpan (mis: 'articles/judul-abc123.webp')
     */
    public function uploadAsWebp(UploadedFile $file, string $folder, ?int $maxWidth = null): string
    {
        $maxWidth = $maxWidth ?? (int) env('IMAGE_MAX_WIDTH', 1600);
        $quality = (int) env('IMAGE_WEBP_QUALITY', 82);

        $image = $this->manager->read($file->getRealPath());

        // Resize proporsional hanya jika lebar gambar melebihi batas maksimum
        if ($image->width() > $maxWidth) {
            $image->scaleDown(width: $maxWidth);
        }

        $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
            . '-' . Str::random(8) . '.webp';

        $relativePath = trim($folder, '/') . '/' . $filename;

        $encoded = $image->toWebp($quality);

        Storage::disk('public')->put($relativePath, (string) $encoded);

        return $relativePath;
    }

    /**
     * Hapus gambar lama dari disk (dipakai saat update/replace gambar).
     */
    public function delete(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
