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
     <?php $__env->slot('title', null, []); ?> Kelola Rumah Sakit <?php $__env->endSlot(); ?>

    <div class="admin-card">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">
            <h2 class="font-bold text-inkdark">Direktori Rumah Sakit</h2>
            <a href="<?php echo e(route('admin.hospitals.create')); ?>" class="admin-btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" /></svg>
                Tambah Rumah Sakit
            </a>
        </div>

        <form method="GET" class="mb-5">
            <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari nama rumah sakit..." class="admin-input max-w-sm">
        </form>

        <div class="overflow-x-auto">
            <table class="w-full admin-table">
                <thead>
                    <tr><th>Logo</th><th>Nama</th><th>Kota</th><th>Tipe</th><th>Rating</th><th>BPJS</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $hospitals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hospital): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><img src="<?php echo e($hospital->logo_url); ?>" loading="lazy" class="w-10 h-10 object-contain rounded-lg bg-slate-50" alt="<?php echo e($hospital->name); ?>"></td>
                        <td class="font-medium text-inkdark"><?php echo e($hospital->name); ?></td>
                        <td><?php echo e($hospital->city); ?></td>
                        <td><?php echo e($hospital->type); ?></td>
                        <td>&#9733; <?php echo e($hospital->rating); ?></td>
                        <td><?php echo e($hospital->is_bpjs ? 'Ya' : 'Tidak'); ?></td>
                        <td>
                            <div class="flex gap-2">
                                <a href="<?php echo e(route('admin.hospitals.edit', $hospital)); ?>" class="text-primary hover:underline text-sm font-medium">Edit</a>
                                <form method="POST" action="<?php echo e(route('admin.hospitals.destroy', $hospital)); ?>" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-breaking hover:underline text-sm font-medium">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" class="text-center text-slate-400 py-8">Belum ada data rumah sakit.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-5"><?php echo e($hospitals->links()); ?></div>
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
<?php /**PATH D:\koding\Website\healthcare-id\resources\views/admin/hospitals/index.blade.php ENDPATH**/ ?>