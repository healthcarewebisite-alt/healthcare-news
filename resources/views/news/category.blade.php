<x-layouts.app>
    <x-slot:title>{{ $category->name }} - Healthcare.id</x-slot:title>
    <x-slot:description>{{ $category->description }}</x-slot:description>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-6">
        <div class="flex items-center gap-3 mb-2">
            <h1 class="text-2xl font-extrabold text-inkdark">{{ $category->name }}</h1>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($articles as $article)
                <x-article-card :article="$article" />
            @empty
                <p class="col-span-full text-center text-slate-400 py-12">Belum ada berita di kategori ini.</p>
            @endforelse
        </div>

        <div class="mt-8">{{ $articles->links() }}</div>
    </div>
</x-layouts.app>
