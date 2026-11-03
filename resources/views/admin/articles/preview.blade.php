<x-layouts.app>
    <x-slot:title>Pratinjau: {{ $article->title }}</x-slot:title>
    <x-slot:description>{{ $article->meta_description ?: $article->excerpt }}</x-slot:description>

    <div class="bg-amber-100 px-4 py-3 text-center text-sm font-semibold text-amber-900">
        Pratinjau internal — artikel ini belum tentu sudah diterbitkan.
        <a href="{{ route('admin.articles.edit', $article) }}" class="ml-2 underline">Kembali ke editor</a>
    </div>
    <article class="mx-auto max-w-4xl px-4 py-10 md:px-6">
        <p class="text-sm font-semibold text-primary">{{ $article->category->name }}</p>
        <h1 class="mt-2 text-3xl font-extrabold leading-tight text-inkdark md:text-5xl">{{ $article->title }}</h1>
        @if($article->excerpt)
            <p class="mt-4 text-lg leading-relaxed text-slate-600">{{ $article->excerpt }}</p>
        @endif
        <p class="mt-4 text-sm text-slate-500">Oleh {{ $article->author->name }}</p>

        @if($article->featured_image)
            <img src="{{ $article->featured_image_url }}" alt="{{ $article->featured_image_alt ?: $article->title }}" class="mt-8 aspect-video w-full rounded-xl object-cover">
        @endif

        <div class="article-content mt-8">{!! $article->content !!}</div>
    </article>
</x-layouts.app>
