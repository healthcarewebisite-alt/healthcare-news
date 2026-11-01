@props(['article'])

<a href="{{ route('news.show', $article->slug) }}" class="news-card group block">
    <div class="aspect-[16/10] overflow-hidden bg-slate-100">
        <img
            src="{{ $article->featured_image_url }}"
            alt="{{ $article->featured_image_alt ?? $article->title }}"
            loading="lazy"
            decoding="async"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
        >
    </div>
    <div class="p-4">
        <span class="badge-category">{{ $article->category->icon }} {{ $article->category->name }}</span>
        <h3 class="mt-2 font-bold text-inkdark leading-snug line-clamp-2 group-hover:text-primary transition-colors">
            {{ $article->title }}
        </h3>
        @if($article->excerpt)
            <p class="mt-1.5 text-sm text-slate-500 line-clamp-2">{{ $article->excerpt }}</p>
        @endif
        <div class="mt-3 flex items-center gap-2 text-xs text-slate-400">
            <span>{{ $article->author->name }}</span>
            <span>&bull;</span>
            <span>{{ $article->published_at?->translatedFormat('d M Y') }}</span>
        </div>
    </div>
</a>
