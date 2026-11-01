<x-layouts.app>
    <x-slot:title>Berita Kesehatan Terbaru</x-slot:title>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-6">
        <h1 class="section-title mb-2">Semua Berita</h1>
        @if(request('q'))
            <p class="text-sm text-slate-500 mb-5">Hasil pencarian untuk "{{ request('q') }}"</p>
        @endif

        <form method="GET" class="flex flex-col sm:flex-row gap-3 mb-6">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari berita..." class="admin-input flex-1">
            <select name="kategori" class="admin-input sm:w-56" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->slug }}" @selected(request('kategori')===$cat->slug)>{{ $cat->icon }} {{ $cat->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn-primary">Cari</button>
        </form>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($articles as $article)
                <x-article-card :article="$article" />
            @empty
                <p class="col-span-full text-center text-slate-400 py-12">Tidak ada berita yang ditemukan.</p>
            @endforelse
        </div>

        <div class="mt-8">{{ $articles->links() }}</div>
    </div>
</x-layouts.app>
