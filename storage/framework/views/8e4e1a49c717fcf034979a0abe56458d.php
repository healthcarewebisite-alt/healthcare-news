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
     <?php $__env->slot('title', null, []); ?> Direktori Rumah Sakit - Healthcare.id <?php $__env->endSlot(); ?>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-6">
        <h1 class="section-title mb-5">Direktori Rumah Sakit</h1>

        <form method="GET" class="flex flex-col sm:flex-row gap-3 mb-6">
            <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari nama rumah sakit..." class="admin-input flex-1">
            <select name="kota" class="admin-input sm:w-48" onchange="this.form.submit()">
                <option value="">Semua Kota</option>
                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($city); ?>" <?php if(request('kota')===$city): echo 'selected'; endif; ?>><?php echo e($city); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <label class="flex items-center gap-2 text-sm text-slate-600 px-2">
                <input type="checkbox" name="bpjs" value="1" <?php if(request('bpjs')): echo 'checked'; endif; ?> onchange="this.form.submit()" class="rounded border-slate-300 text-primary focus:ring-primary">
                BPJS
            </label>
            <button type="submit" class="btn-primary">Cari</button>
        </form>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            <?php $__empty_1 = true; $__currentLoopData = $hospitals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hospital): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(route('hospitals.show', $hospital->slug)); ?>" class="news-card p-4 flex gap-4">
                    <img src="<?php echo e($hospital->logo_url); ?>" alt="<?php echo e($hospital->name); ?>" loading="lazy" class="w-16 h-16 object-contain rounded-lg bg-slate-50 flex-shrink-0">
                    <div class="min-w-0">
                        <h3 class="font-bold text-inkdark line-clamp-1"><?php echo e($hospital->name); ?></h3>
                        <p class="text-xs text-slate-400"><?php echo e($hospital->type); ?> &bull; <?php echo e($hospital->city); ?></p>
                        <p class="text-xs font-medium text-secondary-600 mt-1">&#9733; <?php echo e($hospital->rating); ?> (<?php echo e($hospital->reviews_count); ?> ulasan)</p>
                        <?php if($hospital->is_bpjs): ?>
                            <span class="inline-block mt-1 text-xs bg-primary-50 text-primary-700 px-2 py-0.5 rounded-full">BPJS</span>
                        <?php endif; ?>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="col-span-full text-center text-slate-400 py-12">Tidak ada rumah sakit yang ditemukan.</p>
            <?php endif; ?>
        </div>

        <div class="mt-8"><?php echo e($hospitals->links()); ?></div>
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
<?php /**PATH /home/maul/Desktop/coding/php/healthcare-news/resources/views/hospitals/index.blade.php ENDPATH**/ ?>