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
     <?php $__env->slot('title', null, []); ?> <?php echo e($article->meta_title ?: $article->title); ?> <?php $__env->endSlot(); ?>
     <?php $__env->slot('description', null, []); ?> <?php echo e($article->meta_description ?: $article->excerpt); ?> <?php $__env->endSlot(); ?>
     <?php $__env->slot('image', null, []); ?> <?php echo e($article->featured_image_url); ?> <?php $__env->endSlot(); ?>
     <?php $__env->slot('type', null, []); ?> article <?php $__env->endSlot(); ?>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-6 grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <article class="lg:col-span-8">
            <nav class="text-xs text-slate-400 mb-3">
                <a href="<?php echo e(route('home')); ?>" class="hover:text-primary">Home</a> /
                <a href="<?php echo e(route('news.category', $article->category->slug)); ?>" class="hover:text-primary"><?php echo e($article->category->name); ?></a>
            </nav>

            <span class="badge-category"><?php echo e($article->category->icon); ?> <?php echo e($article->category->name); ?></span>
            <h1 class="mt-3 text-2xl md:text-3xl font-extrabold text-inkdark leading-tight"><?php echo e($article->title); ?></h1>

            <div class="mt-3 flex items-center gap-3 text-sm text-slate-500">
                <span class="font-medium text-inkdark"><?php echo e($article->author->name); ?></span>
                <span>&bull;</span>
                <span><?php echo e($article->published_at?->translatedFormat('d F Y, H:i')); ?></span>
                <span>&bull;</span>
                <span><?php echo e($article->reading_time); ?> menit baca</span>
                <span>&bull;</span>
                <span><?php echo e(number_format($article->views_count)); ?> views</span>
            </div>

            <div class="mt-5 rounded-card overflow-hidden">
                <img src="<?php echo e($article->featured_image_url); ?>" alt="<?php echo e($article->featured_image_alt ?? $article->title); ?>"
                     loading="eager" fetchpriority="high" class="w-full h-auto object-cover">
            </div>

            
            <div class="article-content mt-6">
                <?php echo $article->content; ?>

            </div>

            <?php if($article->tags->count()): ?>
            <div class="mt-6 flex flex-wrap gap-2">
                <?php $__currentLoopData = $article->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="text-xs bg-slate-100 text-slate-600 px-3 py-1 rounded-full">#<?php echo e($tag->name); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

            
            <section class="mt-10 pt-8 border-t border-slate-200">
                <h2 class="font-bold text-lg text-inkdark mb-5">Komentar (<?php echo e($article->approvedComments->count()); ?>)</h2>

                <?php if(session('success')): ?>
                    <p class="mb-4 text-sm bg-secondary-50 text-secondary-700 rounded-lg px-4 py-2.5"><?php echo e(session('success')); ?></p>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('news.comment.store', $article)); ?>" class="mb-8 flex flex-col gap-3">
                    <?php echo csrf_field(); ?>
                    <?php if(auth()->guard()->guest()): ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <input type="text" name="guest_name" placeholder="Nama Anda" required class="admin-input">
                        <input type="email" name="guest_email" placeholder="Email Anda" required class="admin-input">
                    </div>
                    <?php endif; ?>
                    <textarea name="body" rows="3" required minlength="3" placeholder="Tulis komentar Anda..." class="admin-input"></textarea>
                    <button type="submit" class="btn-primary w-fit">Kirim Komentar</button>
                </form>

                <div class="flex flex-col gap-5">
                    <?php $__empty_1 = true; $__currentLoopData = $article->approvedComments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex gap-3">
                        <div class="w-9 h-9 rounded-full bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-sm flex-shrink-0">
                            <?php echo e(strtoupper(substr($comment->author_name, 0, 1))); ?>

                        </div>
                        <div>
                            <p class="text-sm font-semibold text-inkdark"><?php echo e($comment->author_name); ?></p>
                            <p class="text-xs text-slate-400"><?php echo e($comment->created_at->diffForHumans()); ?></p>
                            <p class="text-sm text-slate-600 mt-1"><?php echo e($comment->body); ?></p>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-sm text-slate-400">Jadilah yang pertama berkomentar.</p>
                    <?php endif; ?>
                </div>
            </section>
        </article>

        
        <aside class="lg:col-span-4 flex flex-col gap-6">
            <div>
                <h2 class="section-title mb-4">Berita Terkait</h2>
                <div class="flex flex-col gap-4">
                    <?php $__currentLoopData = $relatedArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('news.show', $related->slug)); ?>" class="flex gap-3 group">
                            <img src="<?php echo e($related->featured_image_url); ?>" alt="<?php echo e($related->title); ?>" loading="lazy"
                                 class="w-20 h-16 object-cover rounded-lg flex-shrink-0">
                            <p class="text-sm font-semibold text-inkdark line-clamp-2 group-hover:text-primary transition-colors"><?php echo e($related->title); ?></p>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div>
                <h2 class="section-title mb-4">Populer</h2>
                <div class="flex flex-col gap-3">
                    <?php $__currentLoopData = $popularArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $pop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('news.show', $pop->slug)); ?>" class="flex gap-3 items-start">
                            <span class="w-6 h-6 rounded-full bg-primary-50 text-primary-700 font-bold text-xs flex items-center justify-center flex-shrink-0"><?php echo e($i + 1); ?></span>
                            <p class="text-sm font-medium text-inkdark line-clamp-2"><?php echo e($pop->title); ?></p>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </aside>
    </div>
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
<?php /**PATH /home/maul/Desktop/coding/php/healthcare-news/resources/views/news/show.blade.php ENDPATH**/ ?>