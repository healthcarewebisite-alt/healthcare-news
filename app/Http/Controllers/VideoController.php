<?php

namespace App\Http\Controllers;

use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::active()->latest()->paginate(12);

        return view('videos.index', compact('videos'));
    }

    public function show(string $slug)
    {
        $video = Video::active()->where('slug', $slug)->firstOrFail();

        return view('videos.show', compact('video'));
    }
}
