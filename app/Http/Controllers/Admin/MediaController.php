<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Infographic;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    private const FOLDERS = ['articles', 'editor', 'hospitals', 'doctors', 'avatars', 'infographics', 'videos'];

    public function index(Request $request)
    {
        $disk = Storage::disk('public');
        $paths = collect(self::FOLDERS)
            ->flatMap(fn (string $folder) => $disk->allFiles($folder))
            ->filter(fn (string $path) => strtolower(pathinfo($path, PATHINFO_EXTENSION)) === 'webp')
            ->unique()
            ->sortByDesc(fn (string $path) => $disk->lastModified($path))
            ->values();

        $perPage = 48;
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pagePaths = $paths->slice(($page - 1) * $perPage, $perPage);
        $referencedPaths = $this->referencedPaths($paths);
        $media = $pagePaths->map(fn (string $path) => [
            'path' => $path,
            'url' => $disk->url($path),
            'size' => $disk->size($path),
            'used' => in_array($path, $referencedPaths, true),
        ]);
        $media = new LengthAwarePaginator(
            $media,
            $paths->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        $selectionMode = $request->boolean('select');

        return view('admin.media.index', compact('media', 'selectionMode'));
    }

    public function destroy(string $path)
    {
        abort_unless($this->isManagedWebp($path), 404);
        abort_unless(Storage::disk('public')->exists($path), 404);
        abort_if(in_array($path, $this->referencedPaths(collect([$path])), true), 409, 'Media sedang digunakan konten dan tidak dapat dihapus.');

        Storage::disk('public')->delete($path);

        return back()->with('success', 'Media berhasil dihapus.');
    }

    private function isManagedWebp(string $path): bool
    {
        return pathinfo($path, PATHINFO_EXTENSION) === 'webp'
            && collect(self::FOLDERS)->contains(fn (string $folder) => str_starts_with($path, $folder.'/'))
            && ! str_contains($path, '..');
    }

    private function referencedPaths($paths): array
    {
        $referenced = collect()
            ->merge(Article::query()->whereNotNull('featured_image')->pluck('featured_image'))
            ->merge(Hospital::query()->whereNotNull('logo')->pluck('logo'))
            ->merge(Hospital::query()->whereNotNull('cover_image')->pluck('cover_image'))
            ->merge(Doctor::query()->whereNotNull('photo')->pluck('photo'))
            ->merge(Infographic::query()->whereNotNull('image')->pluck('image'))
            ->merge(Video::query()->whereNotNull('thumbnail')->pluck('thumbnail'))
            ->merge(User::query()->whereNotNull('avatar')->pluck('avatar'))
            ->filter()
            ->unique()
            ->values();

        $contentPaths = $paths->values();
        Article::query()->whereNotNull('content')->select('content')->cursor()->each(function (Article $article) use ($contentPaths, $referenced) {
            foreach ($contentPaths as $path) {
                if (str_contains($article->content, $path)) {
                    $referenced->push($path);
                }
            }
        });

        return $referenced->unique()->values()->all();
    }
}
