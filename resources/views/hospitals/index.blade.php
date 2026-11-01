<x-layouts.app>
    <x-slot:title>Direktori Rumah Sakit - Healthcare.id</x-slot:title>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-6">
        <h1 class="section-title mb-5">Direktori Rumah Sakit</h1>

        <form method="GET" class="flex flex-col sm:flex-row gap-3 mb-6">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama rumah sakit..." class="admin-input flex-1">
            <select name="kota" class="admin-input sm:w-48" onchange="this.form.submit()">
                <option value="">Semua Kota</option>
                @foreach($cities as $city)
                    <option value="{{ $city }}" @selected(request('kota')===$city)>{{ $city }}</option>
                @endforeach
            </select>
            <label class="flex items-center gap-2 text-sm text-slate-600 px-2">
                <input type="checkbox" name="bpjs" value="1" @checked(request('bpjs')) onchange="this.form.submit()" class="rounded border-slate-300 text-primary focus:ring-primary">
                BPJS
            </label>
            <button type="submit" class="btn-primary">Cari</button>
        </form>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse($hospitals as $hospital)
                <a href="{{ route('hospitals.show', $hospital->slug) }}" class="news-card p-4 flex gap-4">
                    <img src="{{ $hospital->logo_url }}" alt="{{ $hospital->name }}" loading="lazy" class="w-16 h-16 object-contain rounded-lg bg-slate-50 flex-shrink-0">
                    <div class="min-w-0">
                        <h3 class="font-bold text-inkdark line-clamp-1">{{ $hospital->name }}</h3>
                        <p class="text-xs text-slate-400">{{ $hospital->type }} &bull; {{ $hospital->city }}</p>
                        <p class="text-xs font-medium text-secondary-600 mt-1">&#9733; {{ $hospital->rating }} ({{ $hospital->reviews_count }} ulasan)</p>
                        @if($hospital->is_bpjs)
                            <span class="inline-block mt-1 text-xs bg-primary-50 text-primary-700 px-2 py-0.5 rounded-full">BPJS</span>
                        @endif
                    </div>
                </a>
            @empty
                <p class="col-span-full text-center text-slate-400 py-12">Tidak ada rumah sakit yang ditemukan.</p>
            @endforelse
        </div>

        <div class="mt-8">{{ $hospitals->links() }}</div>
    </div>
</x-layouts.app>
