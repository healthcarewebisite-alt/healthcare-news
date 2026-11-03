<x-layouts.app>
    <x-slot:title>{{ $video->title }} - Healthcare.id</x-slot:title>
    <x-slot:description>{{ $video->description }}</x-slot:description>

    <article class="mx-auto max-w-5xl px-4 py-8 md:px-6">
        <a href="{{ route('videos.index') }}" class="text-sm font-semibold text-primary hover:underline">&larr; Semua Video</a>
        <h1 class="mt-4 text-2xl font-extrabold text-inkdark md:text-4xl">{{ $video->title }}</h1>
        <div class="mt-6 aspect-video overflow-hidden rounded-xl bg-black">
            <iframe src="{{ $video->embed_url }}" title="{{ $video->title }}" class="h-full w-full" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        @if($video->description)
            <p class="mt-5 whitespace-pre-line leading-relaxed text-slate-600">{{ $video->description }}</p>
        @endif
    </article>
</x-layouts.app>
