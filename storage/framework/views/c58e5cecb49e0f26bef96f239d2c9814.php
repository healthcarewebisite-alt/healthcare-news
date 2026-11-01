
<header
    x-data="{ scrolled: false, drawerOpen: false, searchOpen: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 10)"
    :class="scrolled ? 'shadow-md' : 'shadow-sm'"
    class="md:hidden sticky top-0 z-40 bg-white transition-shadow duration-200"
>
    <div class="flex items-center justify-between px-4 py-3">
        <button @click="drawerOpen = true" class="p-2 -ml-2 text-inkdark" aria-label="Buka menu">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6">
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
        </a>

        <button @click="searchOpen = true" class="p-2 -mr-2 text-inkdark" aria-label="Cari">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5">
                <circle cx="11" cy="11" r="7"/><path d="m21 21-4.35-4.35"/>
            </svg>
        </button>
    </div>

    
    <div x-show="searchOpen" x-transition x-cloak class="px-4 pb-3">
        <form method="GET" action="<?php echo e(route('news.index')); ?>" class="flex items-center gap-2">
            <input type="text" name="q" placeholder="Cari berita kesehatan..." class="admin-input flex-1 !py-2 text-sm" autofocus>
            <button type="button" @click="searchOpen = false" class="text-sm text-slate-500 px-2">Batal</button>
        </form>
    </div>

    
    <div x-show="drawerOpen" x-transition.opacity x-cloak
         @click="drawerOpen = false"
         class="fixed inset-0 bg-black/40 z-50"></div>

    <div x-show="drawerOpen" x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         class="fixed inset-y-0 left-0 z-50 w-[80%] max-w-xs bg-white shadow-xl overflow-y-auto">
        <div class="flex items-center justify-between px-4 py-4 border-b border-slate-100">
            <span class="text-lg font-extrabold text-inkdark">Menu</span>
            <button @click="drawerOpen = false" class="p-1 text-slate-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <nav class="flex flex-col py-2 text-sm font-medium text-slate-700">
            <a href="<?php echo e(route('home')); ?>" class="px-4 py-3 hover:bg-slate-50 border-b border-slate-50">Home</a>
            <a href="<?php echo e(route('news.index')); ?>" class="px-4 py-3 hover:bg-slate-50 border-b border-slate-50">Berita</a>
            <a href="<?php echo e(route('hospitals.index')); ?>" class="px-4 py-3 hover:bg-slate-50 border-b border-slate-50">Rumah Sakit</a>
            <a href="<?php echo e(route('doctors.index')); ?>" class="px-4 py-3 hover:bg-slate-50 border-b border-slate-50">Dokter</a>
            <a href="<?php echo e(route('news.category', 'health-technology')); ?>" class="px-4 py-3 hover:bg-slate-50 border-b border-slate-50">Teknologi Kesehatan</a>
            <a href="<?php echo e(route('news.category', 'research')); ?>" class="px-4 py-3 hover:bg-slate-50 border-b border-slate-50">Penelitian</a>
            <a href="<?php echo e(route('news.category', 'health-tips')); ?>" class="px-4 py-3 hover:bg-slate-50 border-b border-slate-50">Gaya Hidup Sehat</a>
            <a href="<?php echo e(route('news.category', 'opinion')); ?>" class="px-4 py-3 hover:bg-slate-50 border-b border-slate-50">Opini</a>
            <a href="<?php echo e(route('infographics.index')); ?>" class="px-4 py-3 hover:bg-slate-50 border-b border-slate-50">Infografis</a>
            <a href="<?php echo e(route('calculator')); ?>" class="px-4 py-3 hover:bg-slate-50 border-b border-slate-50 font-semibold text-secondary-600">🧮 Kalkulator Kesehatan</a>

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


<nav class="md:hidden fixed bottom-0 inset-x-0 z-40 bg-white border-t border-slate-200 grid grid-cols-4 text-xs">
    <a href="<?php echo e(route('home')); ?>" class="flex flex-col items-center gap-0.5 py-2.5 <?php echo e(request()->routeIs('home') ? 'text-primary' : 'text-slate-500'); ?>">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="m3 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L22.5 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75" />
        </svg>
        Beranda
    </a>
    <a href="<?php echo e(route('news.index')); ?>" class="flex flex-col items-center gap-0.5 py-2.5 <?php echo e(request()->routeIs('news.*') ? 'text-primary' : 'text-slate-500'); ?>">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12h-9m9 3h-9m3-6h-3m9-9v3.375c0 .621.504 1.125 1.125 1.125h3.375M4.5 3.75h5.379a2.25 2.25 0 0 1 1.591.659l5.121 5.121a2.25 2.25 0 0 1 .659 1.59V19.5a2.25 2.25 0 0 1-2.25 2.25H4.5a2.25 2.25 0 0 1-2.25-2.25V6a2.25 2.25 0 0 1 2.25-2.25Z" />
        </svg>
        Berita
    </a>
    <a href="<?php echo e(route('hospitals.index')); ?>" class="flex flex-col items-center gap-0.5 py-2.5 <?php echo e(request()->routeIs('hospitals.*') ? 'text-primary' : 'text-slate-500'); ?>">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
        </svg>
        RS
    </a>
    <a href="<?php echo e(route('doctors.index')); ?>" class="flex flex-col items-center gap-0.5 py-2.5 <?php echo e(request()->routeIs('doctors.*') ? 'text-primary' : 'text-slate-500'); ?>">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.964 0a9 9 0 1 0-11.964 0m11.964 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
        Dokter
    </a>
</nav>


<div class="md:hidden h-14"></div>
<?php /**PATH D:\koding\Website\healthcare-id\resources\views/partials/navbar-mobile.blade.php ENDPATH**/ ?>