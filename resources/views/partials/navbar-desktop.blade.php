{{-- Navbar khusus DESKTOP (md ke atas). Disembunyikan di mobile. --}}
<header
    x-data="{ scrolled: false, searchOpen: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 10)"
    @keydown.escape.window="if (searchOpen) { searchOpen = false; $refs.desktopSearchButton.focus() }"
    :class="scrolled ? 'shadow-md py-2' : 'shadow-sm py-3'"
    class="hidden md:block sticky top-0 z-40 bg-white/95 backdrop-blur transition-all duration-200"
>
    {{-- Brand, tagline, and utility actions --}}
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between gap-6">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <x-logo />
            <span class="border-l border-slate-200 pl-3 text-sm font-medium tracking-wide text-slate-500">Health First</span>
        </a>

        <div class="flex items-center gap-4">
            <div class="relative">
                <button x-ref="desktopSearchButton" @click="searchOpen = !searchOpen; if (searchOpen) $nextTick(() => $refs.desktopSearch.focus())" :aria-expanded="searchOpen.toString()" aria-controls="desktop-search" class="min-h-11 min-w-11 p-2 rounded-full hover:bg-slate-100 text-slate-500" aria-label="Cari">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5">
                        <circle cx="11" cy="11" r="7" aria-hidden="true"/><path d="m21 21-4.35-4.35" aria-hidden="true"/>
                    </svg>
                </button>
                <form id="desktop-search" role="search" method="GET" action="{{ route('news.index') }}"
                      x-show="searchOpen" x-transition @click.outside="searchOpen = false"
                      class="absolute right-0 top-full mt-2 w-80 bg-white shadow-card-hover rounded-lg p-2 border border-slate-100">
                    <label class="sr-only" for="desktop-search-input">Cari berita</label>
                    <div class="flex gap-2">
                        <input id="desktop-search-input" x-ref="desktopSearch" type="search" name="q" placeholder="Cari berita kesehatan..."
                               class="min-w-0 flex-1 border-slate-200 rounded-md focus:border-primary focus:ring-primary text-sm px-2 py-1.5">
                        <button type="submit" class="btn-primary !px-3 !py-2">Cari</button>
                    </div>
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

    <div class="border-t border-slate-100">
        <div class="mx-auto flex max-w-7xl justify-center px-6 py-3">
            <div class="flex h-[90px] w-full max-w-[970px] items-center justify-center border border-dashed border-slate-200 bg-slate-50 text-xs font-medium uppercase tracking-[0.2em] text-slate-400">
                Banner
            </div>
        </div>
    </div>

    {{-- Rubric navigation --}}
    <nav aria-label="Navigasi utama" class="max-w-7xl mx-auto px-6 flex items-center gap-5 overflow-x-auto text-sm font-semibold text-slate-600 border-t border-slate-100 py-3">
        <a href="{{ route('home') }}" class="hover:text-primary whitespace-nowrap {{ request()->routeIs('home') ? 'text-primary' : '' }}">Home</a>
        <a href="{{ route('news.index') }}" class="hover:text-primary whitespace-nowrap">News</a>
        <a href="{{ route('hospitals.index') }}" class="hover:text-primary whitespace-nowrap">Hospitals</a>
        <a href="{{ route('rubrics.show', 'pharmacy') }}" class="hover:text-primary whitespace-nowrap">Pharmacy</a>
        <a href="{{ route('rubrics.show', 'medical-devices') }}" class="hover:text-primary whitespace-nowrap">Medical Devices</a>
        <a href="{{ route('rubrics.show', 'lifestyle') }}" class="hover:text-primary whitespace-nowrap">Lifestyle</a>
        <a href="{{ route('rubrics.show', 'people') }}" class="hover:text-primary whitespace-nowrap">People</a>
        <a href="{{ route('videos.index') }}" class="hover:text-primary whitespace-nowrap">Video</a>
        <a href="{{ route('rubrics.show', 'digital-cover') }}" class="hover:text-primary whitespace-nowrap">Digital Cover</a>
    </nav>
</header>
