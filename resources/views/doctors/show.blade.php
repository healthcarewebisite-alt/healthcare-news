<x-layouts.app>
    <x-slot:title>{{ $doctor->name }} - Healthcare.id</x-slot:title>
    <x-slot:description>{{ Str::limit(strip_tags($doctor->bio), 160) }}</x-slot:description>
    <x-slot:image>{{ $doctor->photo_url }}</x-slot:image>
    <x-slot:type>profile</x-slot:type>

    <div class="max-w-4xl mx-auto px-4 md:px-6 py-10">
        <div class="admin-card flex flex-col sm:flex-row gap-6 items-center sm:items-start text-center sm:text-left">
            <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}" class="w-28 h-28 object-cover rounded-full flex-shrink-0">
            <div>
                <h1 class="text-xl md:text-2xl font-extrabold text-inkdark">{{ $doctor->name }}</h1>
                <p class="text-primary font-medium">{{ $doctor->specialty }}</p>
                @if($doctor->hospital)
                    <a href="{{ route('hospitals.show', $doctor->hospital->slug) }}" class="text-sm text-slate-500 hover:text-primary">
                        {{ $doctor->hospital->name }}
                    </a>
                @endif
                <div class="flex flex-wrap gap-2 mt-3 justify-center sm:justify-start">
                    @if($doctor->years_experience)
                        <span class="text-xs bg-slate-100 text-slate-600 px-3 py-1 rounded-full">{{ $doctor->years_experience }} tahun pengalaman</span>
                    @endif
                    @if($doctor->str_number)
                        <span class="text-xs bg-slate-100 text-slate-600 px-3 py-1 rounded-full">STR: {{ $doctor->str_number }}</span>
                    @endif
                </div>
            </div>
        </div>

        @if($doctor->bio)
        <div class="admin-card mt-5">
            <h2 class="font-bold text-inkdark mb-2">Tentang</h2>
            <p class="text-sm text-slate-600 leading-relaxed">{{ $doctor->bio }}</p>
        </div>
        @endif
    </div>
</x-layouts.app>
