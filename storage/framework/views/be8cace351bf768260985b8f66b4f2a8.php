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
     <?php $__env->slot('title', null, []); ?> Kelola Infografis <?php $__env->endSlot(); ?>

    <div class="admin-card">
        <div class="flex items-center justify-between mb-5">
            <h2 class="font-bold text-inkdark">Daftar Infografis</h2>
            <a href="<?php echo e(route('admin.infographics.create')); ?>" class="admin-btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                Tambah Infografis
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr><th>Gambar</th><th>Judul</th><th>Kategori</th><th>Status</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $infographics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><img src="<?php echo e($info->image_url); ?>" loading="lazy" class="w-14 h-14 object-cover rounded-lg" alt="<?php echo e($info->title); ?>"></td>
                        <td class="font-medium text-inkdark max-w-xs truncate"><?php echo e($info->title); ?></td>
                        <td><?php echo e($info->category?->name ?? '-'); ?></td>
                        <td>
                            <span class="px-2 py-0.5 rounded-full text-xs font-semibold <?php echo e($info->is_active ? 'bg-secondary-50 text-secondary-700' : 'bg-slate-100 text-slate-500'); ?>">
                                <?php echo e($info->is_active ? 'Aktif' : 'Nonaktif'); ?>

                            </span>
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <a href="<?php echo e(route('admin.infographics.edit', $info)); ?>" class="text-primary hover:underline text-sm font-medium">Edit</a>
                                <form method="POST" action="<?php echo e(route('admin.infographics.destroy', $info)); ?>" onsubmit="return confirm('Yakin ingin menghapus infografis ini?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-breaking hover:underline text-sm font-medium">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="5" class="text-center text-slate-400 py-8">Belum ada infografis.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-5"><?php echo e($infographics->links()); ?></div>
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
<?php /**PATH D:\koding\Website\healthcare-id\resources\views/admin/infographics/index.blade.php ENDPATH**/ ?>