<x-layouts.app>
    <x-slot:title>{{ $hospital->name }} - Healthcare.id</x-slot:title>
    <x-slot:description>{{ Str::limit(strip_tags($hospital->description), 160) }}</x-slot:description>
    <x-slot:image>{{ $hospital->cover_image_url ?? $hospital->logo_url }}</x-slot:image>

    <div class="relative">
        <div class="aspect-[21/9] md:aspect-[21/6] overflow-hidden bg-slate-200">
            <img src="{{ $hospital->cover_image_url ?? $hospital->logo_url }}" alt="{{ $hospital->name }}" loading="eager" class="w-full h-full object-cover">
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-6 grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="flex items-center gap-4">
                <img src="{{ $hospital->logo_url }}" alt="{{ $hospital->name }}" class="w-16 h-16 object-contain rounded-lg bg-slate-50 border border-slate-100 -mt-10 relative z-10 bg-white">
                <div>
                    <h1 class="text-xl md:text-2xl font-extrabold text-inkdark">{{ $hospital->name }}</h1>
                    <p class="text-sm text-slate-500">{{ $hospital->type }} &bull; {{ $hospital->city }}, {{ $hospital->province }}</p>
                </div>
            </div>

            @if($hospital->description)
            <div class="mt-5 prose prose-slate max-w-none text-sm">
                <p>{{ $hospital->description }}</p>
            </div>
            @endif

            @if($hospital->facilities)
            <div class="mt-5">
                <h2 class="font-bold text-inkdark mb-2">Fasilitas</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach($hospital->facilities as $facility)
                        <span class="text-xs bg-slate-100 text-slate-600 px-3 py-1.5 rounded-full">{{ $facility }}</span>
                    @endforeach
                </div>
            </div>
            @endif

            @if($hospital->doctors->count())
            <div class="mt-8">
                <h2 class="font-bold text-inkdark mb-3">Dokter di {{ $hospital->name }}</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    @foreach($hospital->doctors as $doctor)
                        <a href="{{ route('doctors.show', $doctor->slug) }}" class="news-card p-3 flex flex-col items-center text-center gap-1.5">
                            <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}" loading="lazy" class="w-14 h-14 object-cover rounded-full">
                            <p class="text-xs font-semibold text-inkdark line-clamp-1">{{ $doctor->name }}</p>
                            <span class="text-xs text-slate-400">{{ $doctor->specialty }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <aside class="admin-card h-fit">
            <h2 class="font-bold text-inkdark mb-3">Informasi Kontak</h2>
            <div class="flex flex-col gap-3 text-sm">
                <div>
                    <p class="text-slate-400 text-xs">Alamat</p>
                    <p class="text-inkdark">{{ $hospital->address }}</p>
                </div>
                @if($hospital->phone)
                <div>
                    <p class="text-slate-400 text-xs">Telepon</p>
                    <p class="text-inkdark">{{ $hospital->phone }}</p>
                </div>
                @endif
                @if($hospital->email)
                <div>
                    <p class="text-slate-400 text-xs">Email</p>
                    <p class="text-inkdark">{{ $hospital->email }}</p>
                </div>
                @endif
                @if($hospital->website)
                <div>
                    <p class="text-slate-400 text-xs">Website</p>
                    <a href="{{ $hospital->website }}" target="_blank" class="text-primary hover:underline">{{ $hospital->website }}</a>
                </div>
                @endif
                <div>
                    <p class="text-slate-400 text-xs">Rating</p>
                    <p class="text-inkdark font-semibold">&#9733; {{ $hospital->rating }} ({{ $hospital->reviews_count }} ulasan)</p>
                </div>
                @if($hospital->is_bpjs)
                    <span class="w-fit text-xs bg-primary-50 text-primary-700 px-3 py-1 rounded-full font-medium">Menerima BPJS Kesehatan</span>
                @endif
            </div>
        </aside>
    </div>
</x-layouts.app>
