<?php if (isset($component)) { $__componentOriginalfa710ee477a7171fb238cadd060c5959 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfa710ee477a7171fb238cadd060c5959 = $attributes; } ?>
<?php $component = App\View\Components\Layouts\App::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Layouts\App::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('title', null, []); ?> Healthcare.id - Portal Berita Kesehatan Nasional <?php $__env->endSlot(); ?>

    
    <?php if($breakingNews->count()): ?>
    <div class="bg-breaking text-white">
        <div class="max-w-7xl mx-auto px-4 md:px-6 flex items-center h-10 overflow-hidden">
            <span class="flex-shrink-0 bg-white text-breaking font-bold text-xs px-2.5 py-1 rounded mr-3">BREAKING</span>
            <div class="relative flex-1 overflow-hidden h-full flex items-center">
                <div class="whitespace-nowrap animate-marquee flex gap-10 text-sm font-medium">
                    <?php $__currentLoopData = $breakingNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('news.show', $news->slug)); ?>" class="hover:underline"><?php echo e($news->title); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    
    <section class="max-w-7xl mx-auto px-4 md:px-6 py-6 grid grid-cols-1 lg:grid-cols-10 gap-5">
        
        <div class="lg:col-span-7">
            <?php if($headline): ?>
            <div class="hero-swiper relative rounded-card overflow-hidden shadow-card">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="<?php echo e(route('news.show', $headline->slug)); ?>" class="block relative aspect-[16/9] md:aspect-[16/8]">
                            <img src="<?php echo e($headline->featured_image_url); ?>" alt="<?php echo e($headline->title); ?>"
                                 loading="eager" fetchpriority="high"
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-5 md:p-7">
                                <span class="badge-category !bg-primary !text-white"><?php echo e($headline->category->icon); ?> <?php echo e($headline->category->name); ?></span>
                                <h1 class="mt-3 text-white text-xl md:text-3xl font-extrabold leading-tight line-clamp-3">
                                    <?php echo e($headline->title); ?>

                                </h1>
                                <p class="mt-2 text-slate-200 text-sm md:text-base line-clamp-2 hidden md:block">
                                    <?php echo e($headline->excerpt); ?>

                                </p>
                            </div>
                        </a>
                    </div>
                    
                    <?php $__currentLoopData = $trending->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="swiper-slide">
                        <a href="<?php echo e(route('news.show', $slide->slug)); ?>" class="block relative aspect-[16/9] md:aspect-[16/8]">
                            <img src="<?php echo e($slide->featured_image_url); ?>" alt="<?php echo e($slide->title); ?>" loading="lazy"
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-5 md:p-7">
                                <span class="badge-category !bg-primary !text-white"><?php echo e($slide->category->icon); ?> <?php echo e($slide->category->name); ?></span>
                                <h2 class="mt-3 text-white text-xl md:text-2xl font-extrabold leading-tight line-clamp-2">
                                    <?php echo e($slide->title); ?>

                                </h2>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="hero-pagination absolute bottom-3 right-5 z-10 flex gap-1.5 w-auto"></div>
                <button class="hero-prev hidden md:flex absolute left-3 top-1/2 -translate-y-1/2 z-10 w-9 h-9 rounded-full bg-white/20 hover:bg-white/40 items-center justify-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button class="hero-next hidden md:flex absolute right-3 top-1/2 -translate-y-1/2 z-10 w-9 h-9 rounded-full bg-white/20 hover:bg-white/40 items-center justify-center text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
            <?php endif; ?>
        </div>

        
        <div class="lg:col-span-3 flex flex-col gap-3">
            <div class="flex items-center justify-between">
                <h2 class="section-title !text-base">Most Popular</h2>
                <a href="<?php echo e(route('news.index')); ?>" class="text-xs font-semibold text-primary hover:underline">Semua</a>
            </div>
            <?php $__empty_1 = true; $__currentLoopData = $popularArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(route('news.show', $item->slug)); ?>" class="flex gap-3 items-start bg-white rounded-lg p-2.5 hover:shadow-card transition-shadow">
                    <span class="flex-shrink-0 w-7 h-7 rounded-full bg-primary-50 text-primary-700 font-bold text-sm flex items-center justify-center"><?php echo e($i + 1); ?></span>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-inkdark line-clamp-2 leading-snug"><?php echo e($item->title); ?></p>
                        <span class="text-xs text-slate-400"><?php echo e($item->published_at?->diffForHumans()); ?></span>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="rounded-lg bg-white p-4 text-sm text-slate-500">Belum ada artikel populer.</p>
            <?php endif; ?>
        </div>
    </section>

    
    <section class="max-w-7xl mx-auto px-4 md:px-6 py-8">
        <h2 class="section-title mb-5">Kategori Berita</h2>
        <div class="grid grid-cols-3 md:grid-cols-6 gap-3 md:gap-4">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('news.category', $cat->slug)); ?>" class="news-card flex flex-col items-center justify-center py-5 px-2 text-center gap-2">
                    <span class="text-3xl"><?php echo e($cat->icon); ?></span>
                    <span class="text-xs md:text-sm font-semibold text-inkdark"><?php echo e($cat->name); ?></span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    
    <section class="max-w-7xl mx-auto px-4 md:px-6 py-8">
        <h2 class="section-title mb-5">Latest Article</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            <?php $__currentLoopData = $latestArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if (isset($component)) { $__componentOriginal2ef36d4355cd7834c6b42ce99ba2ff15 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ef36d4355cd7834c6b42ce99ba2ff15 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.article-card','data' => ['article' => $article]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('article-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['article' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($article)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ef36d4355cd7834c6b42ce99ba2ff15)): ?>
<?php $attributes = $__attributesOriginal2ef36d4355cd7834c6b42ce99ba2ff15; ?>
<?php unset($__attributesOriginal2ef36d4355cd7834c6b42ce99ba2ff15); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ef36d4355cd7834c6b42ce99ba2ff15)): ?>
<?php $component = $__componentOriginal2ef36d4355cd7834c6b42ce99ba2ff15; ?>
<?php unset($__componentOriginal2ef36d4355cd7834c6b42ce99ba2ff15); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    
    <?php if($featuredArticle): ?>
    <section class="bg-slate-100 py-10">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <h2 class="section-title mb-5">Artikel Pilihan Editor</h2>
            <a href="<?php echo e(route('news.show', $featuredArticle->slug)); ?>" class="grid md:grid-cols-2 gap-6 bg-white rounded-card shadow-card overflow-hidden group">
                <div class="aspect-video md:aspect-auto overflow-hidden">
                    <img src="<?php echo e($featuredArticle->featured_image_url); ?>" alt="<?php echo e($featuredArticle->title); ?>" loading="lazy"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                </div>
                <div class="p-6 flex flex-col justify-center">
                    <span class="badge-category w-fit"><?php echo e($featuredArticle->category->icon); ?> <?php echo e($featuredArticle->category->name); ?></span>
                    <h3 class="mt-3 text-xl md:text-2xl font-extrabold text-inkdark leading-tight group-hover:text-primary transition-colors">
                        <?php echo e($featuredArticle->title); ?>

                    </h3>
                    <p class="mt-2 text-slate-500 line-clamp-3"><?php echo e($featuredArticle->excerpt); ?></p>
                </div>
            </a>
        </div>
    </section>
    <?php endif; ?>

    
    <?php if($healthTips->count()): ?>
    <section class="max-w-7xl mx-auto px-4 md:px-6 py-8">
        <h2 class="section-title mb-5">Health Tips</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <?php $__currentLoopData = $healthTips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('news.show', $tip->slug)); ?>" class="news-card p-4 flex flex-col gap-2">
                    <span class="text-secondary-600 font-bold text-sm">&check; <?php echo e($tip->category->name); ?></span>
                    <p class="font-semibold text-sm text-inkdark line-clamp-2"><?php echo e($tip->title); ?></p>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <?php endif; ?>

    
    <section class="max-w-7xl mx-auto px-4 md:px-6 py-8 grid md:grid-cols-2 gap-8">
        <div>
            <h2 class="section-title mb-5">Penelitian</h2>
            <div class="flex flex-col gap-4">
                <?php $__currentLoopData = $research; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginal2ef36d4355cd7834c6b42ce99ba2ff15 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ef36d4355cd7834c6b42ce99ba2ff15 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.article-card','data' => ['article' => $item]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('article-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['article' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ef36d4355cd7834c6b42ce99ba2ff15)): ?>
<?php $attributes = $__attributesOriginal2ef36d4355cd7834c6b42ce99ba2ff15; ?>
<?php unset($__attributesOriginal2ef36d4355cd7834c6b42ce99ba2ff15); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ef36d4355cd7834c6b42ce99ba2ff15)): ?>
<?php $component = $__componentOriginal2ef36d4355cd7834c6b42ce99ba2ff15; ?>
<?php unset($__componentOriginal2ef36d4355cd7834c6b42ce99ba2ff15); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div>
            <h2 class="section-title mb-5">Teknologi Kesehatan</h2>
            <div class="flex flex-col gap-4">
                <?php $__currentLoopData = $technology; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginal2ef36d4355cd7834c6b42ce99ba2ff15 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ef36d4355cd7834c6b42ce99ba2ff15 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.article-card','data' => ['article' => $item]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('article-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['article' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($item)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ef36d4355cd7834c6b42ce99ba2ff15)): ?>
<?php $attributes = $__attributesOriginal2ef36d4355cd7834c6b42ce99ba2ff15; ?>
<?php unset($__attributesOriginal2ef36d4355cd7834c6b42ce99ba2ff15); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ef36d4355cd7834c6b42ce99ba2ff15)): ?>
<?php $component = $__componentOriginal2ef36d4355cd7834c6b42ce99ba2ff15; ?>
<?php unset($__componentOriginal2ef36d4355cd7834c6b42ce99ba2ff15); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    
    <section id="video" class="max-w-7xl mx-auto px-4 md:px-6 py-8">
        <div class="mb-5 flex items-center justify-between">
            <h2 class="section-title">Video</h2>
            <a href="<?php echo e(route('videos.index')); ?>" class="text-sm font-semibold text-primary hover:underline">Semua Video</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <?php $__empty_1 = true; $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(route('videos.show', $video->slug)); ?>" class="news-card group relative">
                    <div class="aspect-video overflow-hidden bg-slate-200">
                        <img src="<?php echo e($video->thumbnail_url); ?>" alt="<?php echo e($video->title); ?>" loading="lazy"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <span class="absolute inset-0 flex items-center justify-center">
                        <span class="w-12 h-12 rounded-full bg-white/90 flex items-center justify-center text-primary shadow-lg group-hover:scale-110 transition-transform">&#9654;</span>
                    </span>
                    <p class="p-3 text-sm font-semibold text-inkdark line-clamp-2"><?php echo e($video->title); ?></p>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="col-span-full rounded-xl bg-white p-6 text-sm text-slate-500">Video akan segera hadir.</p>
            <?php endif; ?>
        </div>
    </section>

    
    <?php if($infographics->count()): ?>
    <section class="bg-primary-50 py-10">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="section-title">Infografis</h2>
                <a href="<?php echo e(route('infographics.index')); ?>" class="text-sm font-semibold text-primary hover:underline">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <?php $__currentLoopData = $infographics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('infographics.show', $info->slug)); ?>" class="news-card block">
                        <img src="<?php echo e($info->image_url); ?>" alt="<?php echo e($info->title); ?>" loading="lazy" class="w-full aspect-[3/4] object-cover">
                        <p class="p-3 text-sm font-semibold text-inkdark line-clamp-2"><?php echo e($info->title); ?></p>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    
    <?php if($hospitals->count()): ?>
    <section class="max-w-7xl mx-auto px-4 md:px-6 py-8">
        <div class="flex items-center justify-between mb-5">
            <h2 class="section-title">Direktori Rumah Sakit</h2>
            <a href="<?php echo e(route('hospitals.index')); ?>" class="text-sm font-semibold text-primary hover:underline">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <?php $__currentLoopData = $hospitals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hospital): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('hospitals.show', $hospital->slug)); ?>" class="news-card p-4 flex flex-col items-center text-center gap-2">
                    <img src="<?php echo e($hospital->logo_url); ?>" alt="<?php echo e($hospital->name); ?>" loading="lazy" class="w-14 h-14 object-contain rounded-full bg-slate-50">
                    <p class="text-xs font-semibold text-inkdark line-clamp-2"><?php echo e($hospital->name); ?></p>
                    <span class="text-xs text-slate-400"><?php echo e($hospital->city); ?></span>
                    <span class="text-xs font-medium text-secondary-600">&#9733; <?php echo e($hospital->rating); ?></span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <?php endif; ?>

    
    <?php if($doctors->count()): ?>
    <section class="bg-white py-10 border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="flex items-center justify-between mb-5">
                <h2 class="section-title">Direktori Dokter</h2>
                <a href="<?php echo e(route('doctors.index')); ?>" class="text-sm font-semibold text-primary hover:underline">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('doctors.show', $doctor->slug)); ?>" class="news-card p-3 flex flex-col items-center text-center gap-2">
                        <img src="<?php echo e($doctor->photo_url); ?>" alt="<?php echo e($doctor->name); ?>" loading="lazy" class="w-16 h-16 object-cover rounded-full">
                        <p class="text-xs font-semibold text-inkdark line-clamp-1"><?php echo e($doctor->name); ?></p>
                        <span class="text-xs text-slate-400 line-clamp-1"><?php echo e($doctor->specialty); ?></span>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    
    <section class="max-w-7xl mx-auto px-4 md:px-6 py-8">
        <a href="<?php echo e(route('calculator')); ?>" class="block rounded-card bg-gradient-to-r from-secondary-600 to-primary p-6 md:p-8 text-white overflow-hidden relative group">
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

    

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfa710ee477a7171fb238cadd060c5959)): ?>
<?php $attributes = $__attributesOriginalfa710ee477a7171fb238cadd060c5959; ?>
<?php unset($__attributesOriginalfa710ee477a7171fb238cadd060c5959); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfa710ee477a7171fb238cadd060c5959)): ?>
<?php $component = $__componentOriginalfa710ee477a7171fb238cadd060c5959; ?>
<?php unset($__componentOriginalfa710ee477a7171fb238cadd060c5959); ?>
<?php endif; ?>
<?php /**PATH /home/maul/Desktop/coding/php/healthcare-news/resources/views/pages/home.blade.php ENDPATH**/ ?>