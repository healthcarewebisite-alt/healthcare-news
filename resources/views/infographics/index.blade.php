<x-layouts.app>
    <x-slot:title>Infografis Kesehatan - Healthcare.id</x-slot:title>
    <x-slot:description>Kumpulan infografis edukatif seputar kesehatan yang mudah dipahami secara visual.</x-slot:description>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-6">
        <h1 class="section-title mb-5">Infografis Kesehatan</h1>

        <form method="GET" class="flex flex-wrap gap-3 mb-6">
            <select name="kategori" class="admin-input sm:w-56" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->slug }}" @selected(request('kategori')===$cat->slug)>{{ $cat->icon }} {{ $cat->name }}</option>
                @endforeach
            </select>
        </form>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
            @forelse($infographics as $info)
                <a href="{{ route('infographics.show', $info->slug) }}" class="news-card block">
                    <img src="{{ $info->image_url }}" alt="{{ $info->title }}" loading="lazy" class="w-full aspect-[3/4] object-cover">
                    <div class="p-3">
                        @if($info->category)
                            <span class="badge-category mb-1">{{ $info->category->icon }} {{ $info->category->name }}</span>
                        @endif
                        <p class="text-sm font-semibold text-inkdark line-clamp-2 mt-1">{{ $info->title }}</p>
                    </div>
                </a>
            @empty
                <p class="col-span-full text-center text-slate-400 py-12">Belum ada infografis yang tersedia.</p>
            @endforelse
        </div>

        <div class="mt-8">{{ $infographics->links() }}</div>
    </div>
</x-layouts.app>
