
<header
    x-data="{ scrolled: false, searchOpen: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 10)"
    :class="scrolled ? 'shadow-md py-2' : 'shadow-sm py-3'"
    class="hidden md:block sticky top-0 z-40 bg-white/95 backdrop-blur transition-all duration-200"
>
    
    <div class="max-w-7xl mx-auto px-6 flex items-center justify-between">
        <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-2">
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
        </a>

        <div class="flex items-center gap-4">
            <div class="relative">
                <button @click="searchOpen = !searchOpen" class="p-2 rounded-full hover:bg-slate-100 text-slate-500" aria-label="Cari">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5">
                        <circle cx="11" cy="11" r="7"/><path d="m21 21-4.35-4.35"/>
                    </svg>
                </button>
                <form method="GET" action="<?php echo e(route('news.index')); ?>"
                      x-show="searchOpen" x-transition @click.outside="searchOpen = false"
                      class="absolute right-0 top-full mt-2 w-80 bg-white shadow-card-hover rounded-lg p-2 border border-slate-100">
                    <input type="text" name="q" placeholder="Cari berita kesehatan..."
                           class="w-full border-0 focus:ring-0 text-sm px-2 py-1.5" autofocus>
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

    
    <nav class="max-w-7xl mx-auto px-6 mt-3 flex items-center gap-6 overflow-x-auto text-sm font-medium text-slate-600 border-t border-slate-100 pt-2.5">
        <a href="<?php echo e(route('home')); ?>" class="hover:text-primary whitespace-nowrap <?php echo e(request()->routeIs('home') ? 'text-primary font-semibold' : ''); ?>">Home</a>
        <a href="<?php echo e(route('news.index')); ?>" class="hover:text-primary whitespace-nowrap">News</a>
        <a href="<?php echo e(route('hospitals.index')); ?>" class="hover:text-primary whitespace-nowrap">Hospital</a>
        <a href="<?php echo e(route('news.category', 'health-tips')); ?>" class="hover:text-primary whitespace-nowrap">Health Tips</a>
        <a href="<?php echo e(route('news.category', 'health-technology')); ?>" class="hover:text-primary whitespace-nowrap">Technology</a>
        <a href="<?php echo e(route('news.category', 'research')); ?>" class="hover:text-primary whitespace-nowrap">Research</a>
        <a href="<?php echo e(route('news.category', 'lifestyle')); ?>" class="hover:text-primary whitespace-nowrap">Lifestyle</a>
        <a href="<?php echo e(route('news.category', 'opinion')); ?>" class="hover:text-primary whitespace-nowrap">Opinion</a>
        <a href="<?php echo e(route('doctors.index')); ?>" class="hover:text-primary whitespace-nowrap">Dokter</a>
        <a href="<?php echo e(route('infographics.index')); ?>" class="hover:text-primary whitespace-nowrap">Infografis</a>
        <a href="<?php echo e(route('calculator')); ?>" class="hover:text-primary whitespace-nowrap font-semibold text-secondary-600">🧮 Kalkulator Kesehatan</a>
        <a href="#video" class="hover:text-primary whitespace-nowrap">Video</a>
    </nav>
</header>
<?php /**PATH D:\koding\Website\healthcare-id\resources\views/partials/navbar-desktop.blade.php ENDPATH**/ ?>