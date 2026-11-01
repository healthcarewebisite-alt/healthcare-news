{{-- Navbar khusus DESKTOP (md ke atas). Disembunyikan di mobile. --}}
<header
    x-data="{ scrolled: false, searchOpen: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 10)"
    :class="scrolled ? 'shadow-md py-2' : 'shadow-sm py-3'"
    class="hidden md:block sticky top-0 z-40 bg-white/95 backdrop-blur transition-all duration-200"
>
    {{-- Baris atas: Logo, Search, Login --}}
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <x-logo />
        </a>

        <div class="flex items-center gap-4">
            <div class="relative">
                <button @click="searchOpen = !searchOpen" class="p-2 rounded-full hover:bg-slate-100 text-slate-500" aria-label="Cari">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5">
                        <circle cx="11" cy="11" r="7"/><path d="m21 21-4.35-4.35"/>
                    </svg>
                </button>
                <form method="GET" action="{{ route('news.index') }}"
                      x-show="searchOpen" x-transition @click.outside="searchOpen = false"
                      class="absolute right-0 top-full mt-2 w-80 bg-white shadow-card-hover rounded-lg p-2 border border-slate-100">
                    <input type="text" name="q" placeholder="Cari berita kesehatan..."
                           class="w-full border-0 focus:ring-0 text-sm px-2 py-1.5" autofocus>
                </form>
            </div>

            @auth
                @if(auth()->user()->canManageArticles())
                    <a href="{{ route('admin.dashboard') }}" class="btn-outline !py-2 !px-4 text-sm">Dashboard</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-primary !py-2 !px-4 text-sm">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-primary !py-2 !px-4 text-sm">Login</a>
            @endauth
        </div>
    </div>

    {{-- Baris menu navigasi utama --}}
    <nav class="max-w-7xl mx-auto px-6 mt-3 flex items-center gap-6 overflow-x-auto text-sm font-medium text-slate-600 border-t border-slate-100 pt-2.5">
        <a href="{{ route('home') }}" class="hover:text-primary whitespace-nowrap {{ request()->routeIs('home') ? 'text-primary font-semibold' : '' }}">Home</a>
        <a href="{{ route('news.index') }}" class="hover:text-primary whitespace-nowrap">News</a>
        <a href="{{ route('hospitals.index') }}" class="hover:text-primary whitespace-nowrap">Hospital</a>
        <a href="{{ route('news.category', 'health-tips') }}" class="hover:text-primary whitespace-nowrap">Health Tips</a>
        <a href="{{ route('news.category', 'health-technology') }}" class="hover:text-primary whitespace-nowrap">Technology</a>
        <a href="{{ route('news.category', 'research') }}" class="hover:text-primary whitespace-nowrap">Research</a>
        <a href="{{ route('news.category', 'lifestyle') }}" class="hover:text-primary whitespace-nowrap">Lifestyle</a>
        <a href="{{ route('news.category', 'opinion') }}" class="hover:text-primary whitespace-nowrap">Opinion</a>
        <a href="{{ route('doctors.index') }}" class="hover:text-primary whitespace-nowrap">Dokter</a>
        <a href="{{ route('infographics.index') }}" class="hover:text-primary whitespace-nowrap">Infografis</a>
        <a href="{{ route('calculator') }}" class="hover:text-primary whitespace-nowrap font-semibold text-secondary-600">🧮 Kalkulator Kesehatan</a>
        <a href="#video" class="hover:text-primary whitespace-nowrap">Video</a>
    </nav>
</header>
