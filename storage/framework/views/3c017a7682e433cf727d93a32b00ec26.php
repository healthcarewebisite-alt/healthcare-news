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
     <?php $__env->slot('title', null, []); ?> Media Library <?php $__env->endSlot(); ?>

    <div class="admin-card">
        <div class="mb-6">
            <h2 class="font-bold text-inkdark">Media Library</h2>
            <p class="mt-1 text-sm text-slate-500">Gambar WebP dari artikel, editor, direktori, dan infografis. Gambar yang masih dipakai dilindungi dari penghapusan.</p>
        </div>

        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6">
            <?php $__empty_1 = true; $__currentLoopData = $media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <article class="overflow-hidden rounded-lg border border-slate-200 bg-white">
                    <img src="<?php echo e($item['url']); ?>" alt="" loading="lazy" class="aspect-square w-full object-cover">
                    <div class="p-3">
                        <p class="truncate text-xs font-medium text-inkdark" title="<?php echo e($item['path']); ?>"><?php echo e(basename($item['path'])); ?></p>
                        <p class="mt-1 text-xs text-slate-500"><?php echo e(number_format($item['size'] / 1024, 1)); ?> KB</p>
                        <?php if($selectionMode): ?>
                            <button type="button" class="mt-2 text-xs font-semibold text-primary hover:underline" data-media-url="<?php echo e($item['url']); ?>" onclick="window.opener?.postMessage({ type: 'healthcare-media-select', url: this.dataset.mediaUrl }, window.location.origin); window.close();">Sisipkan ke artikel</button>
                        <?php elseif($item['used']): ?>
                            <span class="mt-2 inline-block rounded-full bg-secondary-50 px-2 py-1 text-xs font-semibold text-secondary-700">Sedang digunakan</span>
                        <?php else: ?>
                            <form method="POST" action="<?php echo e(route('admin.media.destroy', ['path' => $item['path']])); ?>" class="mt-2" onsubmit="return confirm('Hapus media ini secara permanen?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-xs font-semibold text-breaking hover:underline">Hapus media</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="col-span-full py-10 text-center text-sm text-slate-500">Belum ada media editorial.</p>
            <?php endif; ?>
        </div>

        <div class="mt-6"><?php echo e($media->links()); ?></div>
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
<?php /**PATH /home/maul/Desktop/coding/php/healthcare-news/resources/views/admin/media/index.blade.php ENDPATH**/ ?>