<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function __construct(private ImageUploadService $imageUploadService) {}

    public function index()
    {
        $videos = Video::query()->latest()->paginate(15);

        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateVideo($request);
        $thumbnail = $request->hasFile('thumbnail')
            ? $this->imageUploadService->uploadAsWebp($request->file('thumbnail'), 'videos')
            : null;

        try {
            $video = Video::create([
                ...$validated,
                'thumbnail' => $thumbnail,
                'is_active' => $request->boolean('is_active'),
            ]);
        } catch (\Throwable $exception) {
            $this->imageUploadService->delete($thumbnail);
            throw $exception;
        }

        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil ditambahkan.');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $validated = $this->validateVideo($request, $video);
        $oldThumbnail = $video->thumbnail;
        $newThumbnail = $request->hasFile('thumbnail')
            ? $this->imageUploadService->uploadAsWebp($request->file('thumbnail'), 'videos')
            : null;

        try {
            $video->update([
                ...$validated,
                'thumbnail' => $newThumbnail ?? $video->thumbnail,
                'is_active' => $request->boolean('is_active'),
            ]);
        } catch (\Throwable $exception) {
            $this->imageUploadService->delete($newThumbnail);
            throw $exception;
        }

        if ($newThumbnail) {
            $this->imageUploadService->delete($oldThumbnail);
        }

        return redirect()->route('admin.videos.index')->with('success', 'Video berhasil diperbarui.');
    }

    public function destroy(Video $video)
    {
        $thumbnail = $video->thumbnail;
        $video->delete();
        $this->imageUploadService->delete($thumbnail);

        return back()->with('success', 'Video berhasil dihapus.');
    }

    private function validateVideo(Request $request, ?Video $video = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'youtube_id' => ['required', 'string', 'regex:/^[A-Za-z0-9_-]{11}$/'],
            'description' => ['nullable', 'string', 'max:5000'],
            'thumbnail' => ['nullable', 'image', 'max:5120', 'mimes:jpg,jpeg,png,webp'],
        ]);
    }
}
