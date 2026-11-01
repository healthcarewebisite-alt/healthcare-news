<x-layouts.app>
    <x-slot:title>{{ $infographic->title }} - Healthcare.id</x-slot:title>
    <x-slot:description>{{ Str::limit(strip_tags($infographic->description), 160) }}</x-slot:description>
    <x-slot:image>{{ $infographic->image_url }}</x-slot:image>

    <div class="max-w-4xl mx-auto px-4 md:px-6 py-8">
        <nav class="text-xs text-slate-400 mb-3">
            <a href="{{ route('home') }}" class="hover:text-primary">Home</a> /
            <a href="{{ route('infographics.index') }}" class="hover:text-primary">Infografis</a>
        </nav>

        @if($infographic->category)
            <span class="badge-category">{{ $infographic->category->icon }} {{ $infographic->category->name }}</span>
        @endif
        <h1 class="mt-3 text-2xl md:text-3xl font-extrabold text-inkdark">{{ $infographic->title }}</h1>

        @if($infographic->description)
            <p class="mt-3 text-slate-600">{{ $infographic->description }}</p>
        @endif

        <div class="mt-6 rounded-card overflow-hidden shadow-card">
            <img src="{{ $infographic->image_url }}" alt="{{ $infographic->title }}" loading="eager" class="w-full h-auto">
        </div>

        @if($related->count())
        <div class="mt-10">
            <h2 class="section-title mb-4">Infografis Lainnya</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach($related as $item)
                    <a href="{{ route('infographics.show', $item->slug) }}" class="news-card block">
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy" class="w-full aspect-[3/4] object-cover">
                        <p class="p-2 text-xs font-semibold text-inkdark line-clamp-2">{{ $item->title }}</p>
                    </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</x-layouts.app>
