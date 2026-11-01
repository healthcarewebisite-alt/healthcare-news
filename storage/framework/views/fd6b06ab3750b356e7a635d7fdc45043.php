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
     <?php $__env->slot('title', null, []); ?> Kelola Berita <?php $__env->endSlot(); ?>

    <div class="admin-card">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">
            <h2 class="font-bold text-inkdark">Daftar Berita</h2>
            <a href="<?php echo e(route('admin.articles.create')); ?>" class="admin-btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                Tambah Berita
            </a>
        </div>

        <form method="GET" class="flex flex-col sm:flex-row gap-3 mb-5">
            <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari judul berita..." class="admin-input flex-1">
            <select name="status" class="admin-input sm:w-48">
                <option value="">Semua Status</option>
                <option value="draft" <?php if(request('status')==='draft'): echo 'selected'; endif; ?>>Draft</option>
                <option value="published" <?php if(request('status')==='published'): echo 'selected'; endif; ?>>Published</option>
                <option value="archived" <?php if(request('status')==='archived'): echo 'selected'; endif; ?>>Archived</option>
            </select>
            <select name="kategori" class="admin-input sm:w-48">
                <option value="">Semua Kategori</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cat->id); ?>" <?php if(request('kategori')==$cat->id): echo 'selected'; endif; ?>><?php echo e($cat->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <button type="submit" class="admin-btn-primary">Filter</button>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr>
                        <th>Gambar</th><th>Judul</th><th>Kategori</th><th>Status</th><th>Views</th><th>Tanggal</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <img src="<?php echo e($article->featured_image_url); ?>" loading="lazy" class="w-14 h-10 object-cover rounded-md" alt="<?php echo e($article->title); ?>">
                        </td>
                        <td class="font-medium text-inkdark max-w-xs">
                            <span class="line-clamp-1"><?php echo e($article->title); ?></span>
                            <?php if($article->is_headline): ?><span class="text-xs text-primary">&#9679; Headline</span><?php endif; ?>
                            <?php if($article->is_breaking): ?><span class="text-xs text-breaking ml-1">&#9679; Breaking</span><?php endif; ?>
                        </td>
                        <td><?php echo e($article->category->name); ?></td>
                        <td>
                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold
                                <?php echo e($article->status === 'published' ? 'bg-secondary-50 text-secondary-700' : ($article->status === 'draft' ? 'bg-slate-100 text-slate-600' : 'bg-breaking-50 text-breaking-700')); ?>">
                                <?php echo e(ucfirst($article->status)); ?>

                            </span>
                        </td>
                        <td><?php echo e(number_format($article->views_count)); ?></td>
                        <td><?php echo e($article->created_at->translatedFormat('d M Y')); ?></td>
                        <td>
                            <div class="flex gap-2">
                                <a href="<?php echo e(route('admin.articles.edit', $article)); ?>" class="text-primary hover:underline text-sm font-medium">Edit</a>
                                <form method="POST" action="<?php echo e(route('admin.articles.destroy', $article)); ?>" onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-breaking hover:underline text-sm font-medium">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" class="text-center text-slate-400 py-8">Belum ada berita. Silakan tambah berita baru.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-5"><?php echo e($articles->links()); ?></div>
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
<?php /**PATH D:\koding\Website\healthcare-id\resources\views/admin/articles/index.blade.php ENDPATH**/ ?>