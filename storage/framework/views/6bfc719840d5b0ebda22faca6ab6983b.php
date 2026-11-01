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
     <?php $__env->slot('title', null, []); ?> Direktori Dokter - Healthcare.id <?php $__env->endSlot(); ?>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-6">
        <h1 class="section-title mb-5">Direktori Dokter</h1>

        <form method="GET" class="flex flex-col sm:flex-row gap-3 mb-6">
            <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari nama dokter..." class="admin-input flex-1">
            <select name="spesialis" class="admin-input sm:w-56" onchange="this.form.submit()">
                <option value="">Semua Spesialisasi</option>
                <?php $__currentLoopData = $specialties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $spec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($spec); ?>" <?php if(request('spesialis')===$spec): echo 'selected'; endif; ?>><?php echo e($spec); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <button type="submit" class="btn-primary">Cari</button>
        </form>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
            <?php $__empty_1 = true; $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(route('doctors.show', $doctor->slug)); ?>" class="news-card p-4 flex flex-col items-center text-center gap-2">
                    <img src="<?php echo e($doctor->photo_url); ?>" alt="<?php echo e($doctor->name); ?>" loading="lazy" class="w-20 h-20 object-cover rounded-full">
                    <h3 class="font-semibold text-sm text-inkdark line-clamp-1"><?php echo e($doctor->name); ?></h3>
                    <p class="text-xs text-slate-400"><?php echo e($doctor->specialty); ?></p>
                    <?php if($doctor->hospital): ?>
                        <p class="text-xs text-slate-400 line-clamp-1"><?php echo e($doctor->hospital->name); ?></p>
                    <?php endif; ?>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="col-span-full text-center text-slate-400 py-12">Tidak ada dokter yang ditemukan.</p>
            <?php endif; ?>
        </div>

        <div class="mt-8"><?php echo e($doctors->links()); ?></div>
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
<?php /**PATH D:\koding\Website\healthcare-id\resources\views/doctors/index.blade.php ENDPATH**/ ?>