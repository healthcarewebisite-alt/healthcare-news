<x-layouts.app>
    <x-slot:title>Healthcare.id - Portal Berita Kesehatan Nasional</x-slot:title>

    {{-- ============ BREAKING NEWS - strip merah berjalan otomatis ============ --}}
    @if($breakingNews->count())
    <div class="bg-breaking text-white">
        <div class="max-w-7xl mx-auto px-4 md:px-6 flex items-center h-10 overflow-hidden">
            <span class="flex-shrink-0 bg-white text-breaking font-bold text-xs px-2.5 py-1 rounded mr-3">BREAKING</span>
            <div class="relative flex-1 overflow-hidden h-full flex items-center">
                <div class="whitespace-nowrap animate-marquee flex gap-10 text-sm font-medium">
                    @foreach($breakingNews as $news)
                        <a href="{{ route('news.show', $news->slug) }}" class="hover:underline">{{ $news->title }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ============ HERO NEWS: Headline (70%) + Most Popular (30%) ============ --}}
    <section class="max-w-7xl mx-auto px-4 md:px-6 py-6 grid grid-cols-1 lg:grid-cols-10 gap-5">
        {{-- Berita Utama - carousel Swiper, gambar besar full width --}}
        <div class="lg:col-span-7">
            @if($headline)
            <div class="hero-swiper relative rounded-card overflow-hidden shadow-card">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="{{ route('news.show', $headline->slug) }}" class="block relative aspect-[16/9] md:aspect-[16/8]">
                            <img src="{{ $headline->featured_image_url }}" alt="{{ $headline->title }}"
                                 loading="eager" fetchpriority="high"
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-5 md:p-7">
                                <span class="badge-category !bg-primary !text-white">{{ $headline->category->icon }} {{ $headline->category->name }}</span>
                                <h1 class="mt-3 text-white text-xl md:text-3xl font-extrabold leading-tight line-clamp-3">
                                    {{ $headline->title }}
                                </h1>
                                <p class="mt-2 text-slate-200 text-sm md:text-base line-clamp-2 hidden md:block">
                                    {{ $headline->excerpt }}
                                </p>
                            </div>
                        </a>
                    </div>
                    {{-- Slide tambahan dari trending agar carousel punya >1 slide --}}
                    @foreach($trending->take(2) as $slide)
                    <div class="swiper-slide">
                        <a href="{{ route('news.show', $slide->slug) }}" class="block relative aspect-[16/9] md:aspect-[16/8]">
                            <img src="{{ $slide->featured_image_url }}" alt="{{ $slide->title }}" loading="lazy"
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-5 md:p-7">
                                <span class="badge-category !bg-primary !text-white">{{ $slide->category->icon }} {{ $slide->category->name }}</span>
                                <h2 class="mt-3 text-white text-xl md:text-2xl font-extrabold leading-tight line-clamp-2">
                                    {{ $slide->title }}
                                </h2>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="hero-pagination absolute bottom-3 right-5 z-10 flex gap-1.5 w-auto"></div>
                <button class="hero-prev hidden md:flex absolute left-3 top-1/2 -translate-y-1/2 z-10 w-9 h-9 rounded-full bg-white/20 hover:bg-white/40 items-center justify-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button class="hero-next hidden md:flex absolute right-3 top-1/2 -translate-y-1/2 z-10 w-9 h-9 rounded-full bg-white/20 hover:bg-white/40 items-center justify-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
            @endif
        </div>

        {{-- Most popular articles --}}
        <div class="lg:col-span-3 flex flex-col gap-3">
            <div class="flex items-center justify-between">
                <h2 class="section-title !text-base">Most Popular</h2>
                <a href="{{ route('news.index') }}" class="text-xs font-semibold text-primary hover:underline">Semua</a>
            </div>
            @forelse($popularArticles as $i => $item)
                <a href="{{ route('news.show', $item->slug) }}" class="flex gap-3 items-start bg-white rounded-lg p-2.5 hover:shadow-card transition-shadow">
                    <span class="flex-shrink-0 w-7 h-7 rounded-full bg-primary-50 text-primary-700 font-bold text-sm flex items-center justify-center">{{ $i + 1 }}</span>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-inkdark line-clamp-2 leading-snug">{{ $item->title }}</p>
                        <span class="text-xs text-slate-400">{{ $item->published_at?->diffForHumans() }}</span>
                    </div>
                </a>
            @empty
                <p class="rounded-lg bg-white p-4 text-sm text-slate-500">Belum ada artikel populer.</p>
            @endforelse
        </div>
    </section>

    {{-- ============ KATEGORI - Grid 6 kategori ============ --}}
    <section class="max-w-7xl mx-auto px-4 md:px-6 py-8">
        <h2 class="section-title mb-5">Kategori Berita</h2>
        <div class="grid grid-cols-3 md:grid-cols-6 gap-3 md:gap-4">
            @foreach($categories as $cat)
                <a href="{{ route('news.category', $cat->slug) }}" class="news-card flex flex-col items-center justify-center py-5 px-2 text-center gap-2">
                    <span class="text-3xl">{{ $cat->icon }}</span>
                    <span class="text-xs md:text-sm font-semibold text-inkdark">{{ $cat->name }}</span>
                </a>
            @endforeach
        </div>
    </section>

    {{-- ============ BERITA TERBARU - dua kolom ============ --}}
    <section class="max-w-7xl mx-auto px-4 md:px-6 py-8">
        <h2 class="section-title mb-5">Latest Article</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($latestArticles as $article)
                <x-article-card :article="$article" />
            @endforeach
        </div>
    </section>

    {{-- ============ FEATURED ARTICLE - background abu muda, gambar landscape ============ --}}
    @if($featuredArticle)
    <section class="bg-slate-100 py-10">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <h2 class="section-title mb-5">Artikel Pilihan Editor</h2>
            <a href="{{ route('news.show', $featuredArticle->slug) }}" class="grid md:grid-cols-2 gap-6 bg-white rounded-card shadow-card overflow-hidden group">
                <div class="aspect-video md:aspect-auto overflow-hidden">
                    <img src="{{ $featuredArticle->featured_image_url }}" alt="{{ $featuredArticle->title }}" loading="lazy"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-6 flex flex-col justify-center">
                    <span class="badge-category w-fit">{{ $featuredArticle->category->icon }} {{ $featuredArticle->category->name }}</span>
                    <h3 class="mt-3 text-xl md:text-2xl font-extrabold text-inkdark leading-tight group-hover:text-primary transition-colors">
                        {{ $featuredArticle->title }}
                    </h3>
                    <p class="mt-2 text-slate-500 line-clamp-3">{{ $featuredArticle->excerpt }}</p>
                </div>
            </a>
        </div>
    </section>
    @endif

    {{-- ============ HEALTH TIPS - empat card ============ --}}
    @if($healthTips->count())
    <section class="max-w-7xl mx-auto px-4 md:px-6 py-8">
        <h2 class="section-title mb-5">Health Tips</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($healthTips as $tip)
                <a href="{{ route('news.show', $tip->slug) }}" class="news-card p-4 flex flex-col gap-2">
                    <span class="text-secondary-600 font-bold text-sm">&check; {{ $tip->category->name }}</span>
                    <p class="font-semibold text-sm text-inkdark line-clamp-2">{{ $tip->title }}</p>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ============ RESEARCH & TECHNOLOGY ============ --}}
    <section class="max-w-7xl mx-auto px-4 md:px-6 py-8 grid md:grid-cols-2 gap-8">
        <div>
            <h2 class="section-title mb-5">Penelitian</h2>
            <div class="flex flex-col gap-4">
                @foreach($research as $item)
                    <x-article-card :article="$item" />
                @endforeach
            </div>
        </div>
        <div>
            <h2 class="section-title mb-5">Teknologi Kesehatan</h2>
            <div class="flex flex-col gap-4">
                @foreach($technology as $item)
                    <x-article-card :article="$item" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============ VIDEO HEALTHCARE - grid YouTube ============ --}}
    <section id="video" class="max-w-7xl mx-auto px-4 md:px-6 py-8">
        <div class="mb-5 flex items-center justify-between">
            <h2 class="section-title">Video</h2>
            <a href="{{ route('videos.index') }}" class="text-sm font-semibold text-primary hover:underline">Semua Video</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @forelse($videos as $video)
                <a href="{{ route('videos.show', $video->slug) }}" class="news-card group relative">
                    <div class="aspect-video overflow-hidden bg-slate-200">
                        <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" loading="lazy"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <span class="absolute inset-0 flex items-center justify-center">
                        <span class="w-12 h-12 rounded-full bg-white/90 flex items-center justify-center text-primary shadow-lg group-hover:scale-110 transition-transform">&#9654;</span>
                    </span>
                    <p class="p-3 text-sm font-semibold text-inkdark line-clamp-2">{{ $video->title }}</p>
                </a>
            @empty
                <p class="col-span-full rounded-xl bg-white p-6 text-sm text-slate-500">Video akan segera hadir.</p>
            @endforelse
        </div>
    </section>

    {{-- ============ INFOGRAFIS ============ --}}
    @if($infographics->count())
    <section class="bg-primary-50 py-10">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="section-title">Infografis</h2>
                <a href="{{ route('infographics.index') }}" class="text-sm font-semibold text-primary hover:underline">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                @foreach($infographics as $info)
                    <a href="{{ route('infographics.show', $info->slug) }}" class="news-card block">
                        <img src="{{ $info->image_url }}" alt="{{ $info->title }}" loading="lazy" class="w-full aspect-[3/4] object-cover">
                        <p class="p-3 text-sm font-semibold text-inkdark line-clamp-2">{{ $info->title }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ============ HOSPITAL DIRECTORY ============ --}}
    @if($hospitals->count())
    <section class="max-w-7xl mx-auto px-4 md:px-6 py-8">
        <div class="flex items-center justify-between mb-5">
            <h2 class="section-title">Direktori Rumah Sakit</h2>
            <a href="{{ route('hospitals.index') }}" class="text-sm font-semibold text-primary hover:underline">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach($hospitals as $hospital)
                <a href="{{ route('hospitals.show', $hospital->slug) }}" class="news-card p-4 flex flex-col items-center text-center gap-2">
                    <img src="{{ $hospital->logo_url }}" alt="{{ $hospital->name }}" loading="lazy" class="w-14 h-14 object-contain rounded-full bg-slate-50">
                    <p class="text-xs font-semibold text-inkdark line-clamp-2">{{ $hospital->name }}</p>
                    <span class="text-xs text-slate-400">{{ $hospital->city }}</span>
                    <span class="text-xs font-medium text-secondary-600">&#9733; {{ $hospital->rating }}</span>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ============ DOCTOR DIRECTORY ============ --}}
    @if($doctors->count())
    <section class="bg-white py-10 border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="section-title">Direktori Dokter</h2>
                <a href="{{ route('doctors.index') }}" class="text-sm font-semibold text-primary hover:underline">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach($doctors as $doctor)
                    <a href="{{ route('doctors.show', $doctor->slug) }}" class="news-card p-3 flex flex-col items-center text-center gap-2">
                        <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}" loading="lazy" class="w-16 h-16 object-cover rounded-full">
                        <p class="text-xs font-semibold text-inkdark line-clamp-1">{{ $doctor->name }}</p>
                        <span class="text-xs text-slate-400 line-clamp-1">{{ $doctor->specialty }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- ============ HEALTH CALCULATOR - Fitur Unggulan ============ --}}
    <section class="max-w-7xl mx-auto px-4 md:px-6 py-8">
        <a href="{{ route('calculator') }}" class="block rounded-card bg-gradient-to-r from-secondary-600 to-primary p-6 md:p-8 text-white overflow-hidden relative group">
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="text-center md:text-left">
                    <span class="inline-block bg-white/20 text-xs font-semibold px-3 py-1 rounded-full mb-2">🧮 Fitur Unggulan</span>
                    <h2 class="text-xl md:text-2xl font-extrabold">Kalkulator Kesehatan</h2>
                    <p class="mt-1 text-white/90 text-sm md:text-base">Hitung BMI, kebutuhan kalori harian, dan usia kehamilan Anda secara gratis & instan.</p>
                </div>
                <span class="btn-primary !bg-white !text-primary hover:!bg-slate-100 whitespace-nowrap flex-shrink-0 group-hover:scale-105 transition-transform">
                    Coba Sekarang &rarr;
                </span>
            </div>
        </a>
    </section>

    {{-- ============ NEWSLETTER - background biru ============ --}}
{{--<section class="bg-primary py-12">
        <div class="max-w-2xl mx-auto px-4 md:px-6 text-center">
            <h2 class="text-2xl md:text-3xl font-extrabold text-white">Dapatkan Berita Kesehatan Terbaru</h2>
            <p class="mt-2 text-primary-100">Berlangganan newsletter kami untuk update kesehatan terpercaya setiap minggu.</p>

            @if(session('success'))
                <p class="mt-4 text-sm bg-white/20 text-white rounded-lg py-2 px-4 inline-block">{{ session('success') }}</p>
            @endif

            <form method="POST" action="{{ route('newsletter.subscribe') }}" class="mt-5 flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                @csrf
                <input type="email" name="email" required placeholder="Alamat email Anda"
                       class="flex-1 rounded-lg px-4 py-3 text-sm border-0 focus:ring-2 focus:ring-white/50">
                <button type="submit" class="bg-inkdark text-white font-semibold rounded-lg px-6 py-3 text-sm hover:bg-slate-800 transition-colors">
                    Subscribe
                </button>
            </form>
            @error('email')
                <p class="mt-2 text-sm text-red-100">{{ $message }}</p>
            @enderror
        </div>
    </section>
--}}
</x-layouts.app>
