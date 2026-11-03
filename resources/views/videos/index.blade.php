<x-layouts.app>
    <x-slot:title>Video - Healthcare.id</x-slot:title>

    <section class="mx-auto max-w-7xl px-4 py-8 md:px-6">
        <h1 class="section-title mb-6">Video Healthcare</h1>
        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($videos as $video)
                <a href="{{ route('videos.show', $video->slug) }}" class="news-card group">
                    <img src="{{ $video->thumbnail_url }}" alt="Thumbnail: {{ $video->title }}" loading="lazy" class="aspect-video w-full object-cover">
                    <h2 class="p-4 font-bold text-inkdark group-hover:text-primary">{{ $video->title }}</h2>
                </a>
            @empty
                <p class="col-span-full rounded-xl bg-white p-8 text-center text-slate-500">Video akan segera hadir.</p>
            @endforelse
        </div>
        <div class="mt-6">{{ $videos->links() }}</div>
    </section>
</x-layouts.app>
