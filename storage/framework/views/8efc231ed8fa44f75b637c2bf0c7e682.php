
<header
    x-data="{
        scrolled: false,
        drawerOpen: false,
        searchOpen: false,
        trapDrawerFocus(event) {
            const items = [...this.$refs.drawer.querySelectorAll('a[href], button:not([disabled])')];
            if (!items.length) return;
            const first = items[0];
            const last = items[items.length - 1];
            if (event.shiftKey && document.activeElement === first) {
                event.preventDefault();
                last.focus();
            } else if (!event.shiftKey && document.activeElement === last) {
                event.preventDefault();
                first.focus();
            }
        }
    }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 10); $watch('drawerOpen', (open) => { if (!open) $nextTick(() => $refs.menuButton.focus()) }); $watch('searchOpen', (open) => { if (!open) $nextTick(() => $refs.searchButton.focus()) })"
    @keydown.escape.window="if (drawerOpen) drawerOpen = false; searchOpen = false"
    :class="scrolled ? 'shadow-md' : 'shadow-sm'"
    class="md:hidden sticky top-0 z-40 bg-white transition-shadow duration-200"
>
    <div class="flex items-center justify-between px-4 py-3">
        <button x-ref="menuButton" @click="drawerOpen = true; $nextTick(() => $refs.drawer.querySelector('button').focus())"
                :aria-expanded="drawerOpen.toString()" aria-controls="mobile-menu"
                class="min-h-11 min-w-11 p-2 -ml-2 text-inkdark"
                aria-label="Buka menu">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
            </svg>
        </button>

        <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-1.5">
            <?php if (isset($component)) { $__componentOriginal987d96ec78ed1cf75b349e2e5981978f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal987d96ec78ed1cf75b349e2e5981978f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.logo','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal987d96ec78ed1cf75b349e2e5981978f)): ?>
<?php $attributes = $__attributesOriginal987d96ec78ed1cf75b349e2e5981978f; ?>
<?php unset($__attributesOriginal987d96ec78ed1cf75b349e2e5981978f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal987d96ec78ed1cf75b349e2e5981978f)): ?>
<?php $component = $__componentOriginal987d96ec78ed1cf75b349e2e5981978f; ?>
<?php unset($__componentOriginal987d96ec78ed1cf75b349e2e5981978f); ?>
<?php endif; ?>
            <span class="text-[10px] font-semibold tracking-wide text-slate-500">Health First</span>
        </a>

        <button x-ref="searchButton" @click="searchOpen = !searchOpen; if (searchOpen) $nextTick(() => $refs.mobileSearch.focus())"
                :aria-expanded="searchOpen.toString()" aria-controls="mobile-search"
                class="min-h-11 min-w-11 p-2 -mr-2 text-inkdark"
                aria-label="Cari">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5" aria-hidden="true">
                <circle cx="11" cy="11" r="7"/><path d="m21 21-4.35-4.35"/>
            </svg>
        </button>
    </div>

    <div id="mobile-search" x-show="searchOpen" x-transition x-cloak class="px-4 pb-3">
        <form role="search" method="GET" action="<?php echo e(route('news.index')); ?>" class="flex items-center gap-2">
            <label class="sr-only" for="mobile-search-input">Cari berita</label>
            <input id="mobile-search-input" x-ref="mobileSearch" type="search" name="q" placeholder="Cari berita kesehatan..." class="admin-input min-w-0 flex-1 !py-2 text-sm">
            <button type="submit" class="btn-primary !px-3 !py-2">Cari</button>
            <button type="button" @click="searchOpen = false" class="min-h-11 px-2 text-sm text-slate-600 underline">Tutup</button>
        </form>
    </div>

    <button x-show="drawerOpen" x-transition.opacity x-cloak
            type="button" @click="drawerOpen = false"
            class="fixed inset-0 bg-black/40 z-50 cursor-default"
            aria-label="Tutup menu"></button>

    <div id="mobile-menu" x-ref="drawer" x-show="drawerOpen" x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         role="dialog" aria-modal="true" aria-label="Navigasi utama"
         @keydown.tab="trapDrawerFocus($event)"
         class="fixed inset-y-0 left-0 z-50 w-[min(85vw,20rem)] bg-white shadow-xl overflow-y-auto overscroll-contain">
        <div class="flex items-center justify-between px-4 py-4 border-b border-slate-100">
            <span class="text-lg font-extrabold text-inkdark">Menu</span>
            <button @click="drawerOpen = false" class="min-h-11 min-w-11 p-2 text-slate-600" aria-label="Tutup menu">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <nav aria-label="Rubrik" class="flex flex-col py-2 text-sm font-medium text-slate-700">
            <a href="<?php echo e(route('home')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['min-h-11 px-4 py-3 hover:bg-slate-50 border-b border-slate-50', 'text-primary font-semibold' => request()->routeIs('home')]); ?>" <?php if(request()->routeIs('home')): ?> aria-current="page" <?php endif; ?>>Home</a>
            <a href="<?php echo e(route('news.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['min-h-11 px-4 py-3 hover:bg-slate-50 border-b border-slate-50', 'text-primary font-semibold' => request()->routeIs('news.*')]); ?>" <?php if(request()->routeIs('news.*')): ?> aria-current="page" <?php endif; ?>>News</a>
            <a href="<?php echo e(route('hospitals.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['min-h-11 px-4 py-3 hover:bg-slate-50 border-b border-slate-50', 'text-primary font-semibold' => request()->routeIs('hospitals.*')]); ?>" <?php if(request()->routeIs('hospitals.*')): ?> aria-current="page" <?php endif; ?>>Hospitals</a>
            <a href="<?php echo e(route('rubrics.show', 'pharmacy')); ?>" class="min-h-11 px-4 py-3 hover:bg-slate-50 border-b border-slate-50">Pharmacy</a>
            <a href="<?php echo e(route('rubrics.show', 'medical-devices')); ?>" class="min-h-11 px-4 py-3 hover:bg-slate-50 border-b border-slate-50">Medical Devices</a>
            <a href="<?php echo e(route('rubrics.show', 'lifestyle')); ?>" class="min-h-11 px-4 py-3 hover:bg-slate-50 border-b border-slate-50">Lifestyle</a>
            <a href="<?php echo e(route('rubrics.show', 'people')); ?>" class="min-h-11 px-4 py-3 hover:bg-slate-50 border-b border-slate-50">People</a>
            <a href="<?php echo e(route('videos.index')); ?>" class="min-h-11 px-4 py-3 hover:bg-slate-50 border-b border-slate-50">Video</a>
            <a href="<?php echo e(route('rubrics.show', 'digital-cover')); ?>" class="min-h-11 px-4 py-3 hover:bg-slate-50 border-b border-slate-50">Digital Cover</a>

            <div class="px-4 pt-4">
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->canManageArticles()): ?>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn-outline w-full mb-2 !py-2.5">Dashboard</a>
                    <?php endif; ?>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn-primary w-full !py-2.5">Keluar</button>
                    </form>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="btn-primary w-full !py-2.5">Login</a>
                <?php endif; ?>
            </div>
        </nav>
    </div>
</header>

<nav aria-label="Navigasi cepat" class="mobile-bottom-nav md:hidden fixed bottom-0 inset-x-0 z-40 bg-white border-t border-slate-200 grid grid-cols-4 text-xs">
    <a href="<?php echo e(route('home')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['min-h-14 flex flex-col items-center justify-center gap-0.5', 'text-primary' => request()->routeIs('home'), 'text-slate-600' => !request()->routeIs('home')]); ?>" <?php if(request()->routeIs('home')): ?> aria-current="page" <?php endif; ?>>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="m3 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L22.5 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75" />
        </svg>
        Beranda
    </a>
    <a href="<?php echo e(route('news.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['min-h-14 flex flex-col items-center justify-center gap-0.5', 'text-primary' => request()->routeIs('news.*'), 'text-slate-600' => !request()->routeIs('news.*')]); ?>" <?php if(request()->routeIs('news.*')): ?> aria-current="page" <?php endif; ?>>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12h-9m9 3h-9m3-6h-3m9-9v3.375c0 .621.504 1.125 1.125 1.125h3.375M4.5 3.75h5.379a2.25 2.25 0 0 1 1.591.659l5.121 5.121a2.25 2.25 0 0 1 .659 1.59V19.5a2.25 2.25 0 0 1-2.25 2.25H4.5a2.25 2.25 0 0 1-2.25-2.25V6a2.25 2.25 0 0 1 2.25-2.25Z" />
        </svg>
        Berita
    </a>
    <a href="<?php echo e(route('hospitals.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['min-h-14 flex flex-col items-center justify-center gap-0.5', 'text-primary' => request()->routeIs('hospitals.*'), 'text-slate-600' => !request()->routeIs('hospitals.*')]); ?>" <?php if(request()->routeIs('hospitals.*')): ?> aria-current="page" <?php endif; ?>>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
        </svg>
        RS
    </a>
    <a href="<?php echo e(route('doctors.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['min-h-14 flex flex-col items-center justify-center gap-0.5', 'text-primary' => request()->routeIs('doctors.*'), 'text-slate-600' => !request()->routeIs('doctors.*')]); ?>" <?php if(request()->routeIs('doctors.*')): ?> aria-current="page" <?php endif; ?>>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.964 0a9 9 0 1 0-11.964 0m11.964 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
        Dokter
    </a>
</nav>

<div class="mobile-bottom-nav-spacer md:hidden"></div>
<?php /**PATH /home/maul/Desktop/coding/php/healthcare-news/resources/views/partials/navbar-mobile.blade.php ENDPATH**/ ?>