<?php if (isset($component)) { $__componentOriginalaf25f15ef26fc3d179956a9918eaad4d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaf25f15ef26fc3d179956a9918eaad4d = $attributes; } ?>
<?php $component = App\View\Components\Layouts\Admin::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Layouts\Admin::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('title', null, []); ?> Dashboard <?php $__env->endSlot(); ?>

    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="admin-stat-card">
            <div>
                <p class="text-sm text-slate-500">Total Berita</p>
                <p class="text-2xl font-bold text-inkdark mt-1"><?php echo e(number_format($stats['total_articles'])); ?></p>
                <p class="text-xs text-secondary-600 mt-1"><?php echo e($stats['published_articles']); ?> terbit</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-primary-50 flex items-center justify-center text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12h-9m9 3h-9m3-6h-3m9-9v3.375c0 .621.504 1.125 1.125 1.125h3.375M4.5 3.75h5.379a2.25 2.25 0 0 1 1.591.659l5.121 5.121a2.25 2.25 0 0 1 .659 1.59V19.5a2.25 2.25 0 0 1-2.25 2.25H4.5a2.25 2.25 0 0 1-2.25-2.25V6a2.25 2.25 0 0 1 2.25-2.25Z" /></svg>
            </div>
        </div>

        <div class="admin-stat-card">
            <div>
                <p class="text-sm text-slate-500">Total Views</p>
                <p class="text-2xl font-bold text-inkdark mt-1"><?php echo e(number_format($stats['total_views'])); ?></p>
                <p class="text-xs text-slate-400 mt-1">seluruh artikel</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-secondary-50 flex items-center justify-center text-secondary-600">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
            </div>
        </div>

        <div class="admin-stat-card">
            <div>
                <p class="text-sm text-slate-500">Rumah Sakit &amp; Dokter</p>
                <p class="text-2xl font-bold text-inkdark mt-1"><?php echo e($stats['total_hospitals']); ?> / <?php echo e($stats['total_doctors']); ?></p>
                <p class="text-xs text-slate-400 mt-1">terdaftar di direktori</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15" /></svg>
            </div>
        </div>

        <div class="admin-stat-card">
            <div>
                <p class="text-sm text-slate-500">Komentar Pending</p>
                <p class="text-2xl font-bold text-inkdark mt-1"><?php echo e($stats['pending_comments']); ?></p>
                <p class="text-xs text-slate-400 mt-1"><?php echo e($stats['total_subscribers']); ?> subscriber newsletter</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-breaking-50 flex items-center justify-center text-breaking">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" /></svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mt-5">
        
        <div class="lg:col-span-2 admin-card">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-inkdark">Berita Terbaru</h2>
                <a href="<?php echo e(route('admin.articles.index')); ?>" class="text-sm text-primary font-medium hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full admin-table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Penulis</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $recentArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="font-medium text-inkdark max-w-xs truncate"><?php echo e($article->title); ?></td>
                            <td><?php echo e($article->category->name); ?></td>
                            <td>
                                <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                    <?php echo e($article->status === 'published' ? 'bg-secondary-50 text-secondary-700' : ($article->status === 'draft' ? 'bg-slate-100 text-slate-600' : 'bg-breaking-50 text-breaking-700')); ?>">
                                    <?php echo e(ucfirst($article->status)); ?>

                                </span>
                            </td>
                            <td><?php echo e($article->author->name); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="4" class="text-center text-slate-400 py-6">Belum ada berita.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        
        <div class="admin-card">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-inkdark">Komentar Terbaru</h2>
                <a href="<?php echo e(route('admin.comments.index')); ?>" class="text-sm text-primary font-medium hover:underline">Lihat Semua</a>
            </div>
            <div class="flex flex-col gap-3">
                <?php $__empty_1 = true; $__currentLoopData = $recentComments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="pb-3 border-b border-slate-100 last:border-0">
                    <p class="text-sm font-semibold text-inkdark"><?php echo e($comment->author_name); ?></p>
                    <p class="text-xs text-slate-500 line-clamp-2 mt-0.5"><?php echo e($comment->body); ?></p>
                    <p class="text-xs text-slate-400 mt-1">pada "<?php echo e($comment->article->title); ?>"</p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-sm text-slate-400 text-center py-6">Belum ada komentar.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="admin-card mt-5">
        <h2 class="font-bold text-inkdark mb-4">Artikel Terpopuler</h2>
        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr><th>#</th><th>Judul</th><th>Views</th></tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $popularArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($i + 1); ?></td>
                        <td class="font-medium text-inkdark"><?php echo e($article->title); ?></td>
                        <td><?php echo e(number_format($article->views_count)); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="3" class="text-center text-slate-400 py-6">Belum ada data.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalaf25f15ef26fc3d179956a9918eaad4d)): ?>
<?php $attributes = $__attributesOriginalaf25f15ef26fc3d179956a9918eaad4d; ?>
<?php unset($__attributesOriginalaf25f15ef26fc3d179956a9918eaad4d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalaf25f15ef26fc3d179956a9918eaad4d)): ?>
<?php $component = $__componentOriginalaf25f15ef26fc3d179956a9918eaad4d; ?>
<?php unset($__componentOriginalaf25f15ef26fc3d179956a9918eaad4d); ?>
<?php endif; ?>
<?php /**PATH D:\koding\Website\healthcare-id\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>