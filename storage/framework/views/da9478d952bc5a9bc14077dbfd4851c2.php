
<header
    x-data="{ scrolled: false, searchOpen: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 10)"
    @keydown.escape.window="if (searchOpen) { searchOpen = false; $refs.desktopSearchButton.focus() }"
    :class="scrolled ? 'shadow-md py-2' : 'shadow-sm py-3'"
    class="hidden md:block sticky top-0 z-40 bg-white/95 backdrop-blur transition-all duration-200"
>
    
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between gap-6">
        <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-3">
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
            <span class="border-l border-slate-200 pl-3 text-sm font-medium tracking-wide text-slate-500">Health First</span>
        </a>

        <div class="flex items-center gap-4">
            <div class="relative">
                <button x-ref="desktopSearchButton" @click="searchOpen = !searchOpen; if (searchOpen) $nextTick(() => $refs.desktopSearch.focus())" :aria-expanded="searchOpen.toString()" aria-controls="desktop-search" class="min-h-11 min-w-11 p-2 rounded-full hover:bg-slate-100 text-slate-500" aria-label="Cari">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5">
                        <circle cx="11" cy="11" r="7" aria-hidden="true"/><path d="m21 21-4.35-4.35" aria-hidden="true"/>
                    </svg>
                </button>
                <form id="desktop-search" role="search" method="GET" action="<?php echo e(route('news.index')); ?>"
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

            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->canManageArticles()): ?>
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn-outline !py-2 !px-4 text-sm">Dashboard</a>
                <?php endif; ?>
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-primary !py-2 !px-4 text-sm">Keluar</button>
                </form>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="btn-primary !py-2 !px-4 text-sm">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="border-t border-slate-100">
        <div class="mx-auto flex max-w-7xl justify-center px-6 py-3">
            <div class="flex h-[90px] w-full max-w-[970px] items-center justify-center border border-dashed border-slate-200 bg-slate-50 text-xs font-medium uppercase tracking-[0.2em] text-slate-400">
                Banner
            </div>
        </div>
    </div>

    
    <nav aria-label="Navigasi utama" class="max-w-7xl mx-auto px-6 flex items-center gap-5 overflow-x-auto text-sm font-semibold text-slate-600 border-t border-slate-100 py-3">
        <a href="<?php echo e(route('home')); ?>" class="hover:text-primary whitespace-nowrap <?php echo e(request()->routeIs('home') ? 'text-primary' : ''); ?>">Home</a>
        <a href="<?php echo e(route('news.index')); ?>" class="hover:text-primary whitespace-nowrap">News</a>
        <a href="<?php echo e(route('hospitals.index')); ?>" class="hover:text-primary whitespace-nowrap">Hospitals</a>
        <a href="<?php echo e(route('rubrics.show', 'pharmacy')); ?>" class="hover:text-primary whitespace-nowrap">Pharmacy</a>
        <a href="<?php echo e(route('rubrics.show', 'medical-devices')); ?>" class="hover:text-primary whitespace-nowrap">Medical Devices</a>
        <a href="<?php echo e(route('rubrics.show', 'lifestyle')); ?>" class="hover:text-primary whitespace-nowrap">Lifestyle</a>
        <a href="<?php echo e(route('rubrics.show', 'people')); ?>" class="hover:text-primary whitespace-nowrap">People</a>
        <a href="<?php echo e(route('videos.index')); ?>" class="hover:text-primary whitespace-nowrap">Video</a>
        <a href="<?php echo e(route('rubrics.show', 'digital-cover')); ?>" class="hover:text-primary whitespace-nowrap">Digital Cover</a>
    </nav>
</header>
<?php /**PATH /home/maul/Desktop/coding/php/healthcare-news/resources/views/partials/navbar-desktop.blade.php ENDPATH**/ ?>