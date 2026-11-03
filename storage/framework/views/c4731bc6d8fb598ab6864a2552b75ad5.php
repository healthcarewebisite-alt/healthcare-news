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
     <?php $__env->slot('title', null, []); ?> Kelola Video <?php $__env->endSlot(); ?>

    <div class="admin-card">
        <div class="mb-5 flex flex-col justify-between gap-3 sm:flex-row sm:items-center">
            <div>
                <h2 class="font-bold text-inkdark">Video Healthcare</h2>
                <p class="mt-1 text-sm text-slate-500">Video aktif tampil pada halaman Video dan beranda.</p>
            </div>
            <a href="<?php echo e(route('admin.videos.create')); ?>" class="admin-btn-primary">Tambah Video</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead><tr><th>Thumbnail</th><th>Judul</th><th>YouTube ID</th><th>Status</th><th>Aksi</th></tr></thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><img src="<?php echo e($video->thumbnail_url); ?>" alt="" class="h-14 w-24 rounded object-cover"></td>
                            <td class="font-medium text-inkdark"><?php echo e($video->title); ?></td>
                            <td><?php echo e($video->youtube_id); ?></td>
                            <td><?php echo e($video->is_active ? 'Aktif' : 'Nonaktif'); ?></td>
                            <td>
                                <div class="flex gap-3">
                                    <a href="<?php echo e(route('admin.videos.edit', $video)); ?>" class="text-primary hover:underline">Edit</a>
                                    <form method="POST" action="<?php echo e(route('admin.videos.destroy', $video)); ?>" onsubmit="return confirm('Hapus video ini?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button class="text-breaking hover:underline">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="py-8 text-center text-slate-500">Belum ada video.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-5"><?php echo e($videos->links()); ?></div>
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
<?php /**PATH /home/maul/Desktop/coding/php/healthcare-news/resources/views/admin/videos/index.blade.php ENDPATH**/ ?>