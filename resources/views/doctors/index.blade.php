<x-layouts.app>
    <x-slot:title>Direktori Dokter - Healthcare.id</x-slot:title>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-6">
        <h1 class="section-title mb-5">Direktori Dokter</h1>

        <form method="GET" class="flex flex-col sm:flex-row gap-3 mb-6">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama dokter..." class="admin-input flex-1">
            <select name="spesialis" class="admin-input sm:w-56" onchange="this.form.submit()">
                <option value="">Semua Spesialisasi</option>
                @foreach($specialties as $spec)
                    <option value="{{ $spec }}" @selected(request('spesialis')===$spec)>{{ $spec }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn-primary">Cari</button>
        </form>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
            @forelse($doctors as $doctor)
                <a href="{{ route('doctors.show', $doctor->slug) }}" class="news-card p-4 flex flex-col items-center text-center gap-2">
                    <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}" loading="lazy" class="w-20 h-20 object-cover rounded-full">
                    <h3 class="font-semibold text-sm text-inkdark line-clamp-1">{{ $doctor->name }}</h3>
                    <p class="text-xs text-slate-400">{{ $doctor->specialty }}</p>
                    @if($doctor->hospital)
                        <p class="text-xs text-slate-400 line-clamp-1">{{ $doctor->hospital->name }}</p>
                    @endif
                </a>
            @empty
                <p class="col-span-full text-center text-slate-400 py-12">Tidak ada dokter yang ditemukan.</p>
            @endforelse
        </div>

        <div class="mt-8">{{ $doctors->links() }}</div>
    </div>
</x-layouts.app>
