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
     <?php $__env->slot('title', null, []); ?> Halaman Informasi <?php $__env->endSlot(); ?>

    <div class="admin-card">
        <div class="mb-5">
            <h2 class="font-bold text-inkdark">Halaman Informasi</h2>
            <p class="mt-1 text-sm text-slate-500">Kelola konten halaman yang ditautkan pada situs publik.</p>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr><th>Judul</th><th>URL</th><th>Kontak</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="font-medium text-inkdark"><?php echo e($page->title); ?></td>
                            <td><a href="<?php echo e(route('pages.show', $page->slug)); ?>" class="text-primary hover:underline">/<?php echo e($page->slug); ?></a></td>
                            <td><?php echo e($page->email ?: '—'); ?></td>
                            <td><a href="<?php echo e(route('admin.pages.edit', $page)); ?>" class="font-medium text-primary hover:underline">Edit</a></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php /**PATH /home/maul/Desktop/coding/php/healthcare-news/resources/views/admin/pages/index.blade.php ENDPATH**/ ?>