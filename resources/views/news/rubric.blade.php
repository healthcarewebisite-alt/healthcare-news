<x-layouts.app>
    <x-slot:title>{{ $rubric['name'] }} - Healthcare.id</x-slot:title>

    <section class="max-w-7xl mx-auto px-4 md:px-6 py-8">
        <div class="mb-6 border-b border-slate-200 pb-4">
            <p class="text-xs font-bold uppercase tracking-[0.2em] text-primary">Rubrik</p>
            <h1 class="mt-2 text-3xl font-extrabold text-inkdark">{{ $rubric['name'] }}</h1>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($articles as $article)
                <x-article-card :article="$article" />
            @empty
                <p class="col-span-full rounded-xl bg-white px-5 py-12 text-center text-slate-500">
                    Belum ada artikel untuk rubrik ini.
                </p>
            @endforelse
        </div>

        <div class="mt-8">{{ $articles->links() }}</div>
    </section>
</x-layouts.app>
