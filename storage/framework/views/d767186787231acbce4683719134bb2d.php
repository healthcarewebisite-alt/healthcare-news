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
     <?php $__env->slot('title', null, []); ?> Infografis Kesehatan - Healthcare.id <?php $__env->endSlot(); ?>
     <?php $__env->slot('description', null, []); ?> Kumpulan infografis edukatif seputar kesehatan yang mudah dipahami secara visual. <?php $__env->endSlot(); ?>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-6">
        <h1 class="section-title mb-5">Infografis Kesehatan</h1>

        <form method="GET" class="flex flex-wrap gap-3 mb-6">
            <select name="kategori" class="admin-input sm:w-56" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cat->slug); ?>" <?php if(request('kategori')===$cat->slug): echo 'selected'; endif; ?>><?php echo e($cat->icon); ?> <?php echo e($cat->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </form>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
            <?php $__empty_1 = true; $__currentLoopData = $infographics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <a href="<?php echo e(route('infographics.show', $info->slug)); ?>" class="news-card block">
                    <img src="<?php echo e($info->image_url); ?>" alt="<?php echo e($info->title); ?>" loading="lazy" class="w-full aspect-[3/4] object-cover">
                    <div class="p-3">
                        <?php if($info->category): ?>
                            <span class="badge-category mb-1"><?php echo e($info->category->icon); ?> <?php echo e($info->category->name); ?></span>
                        <?php endif; ?>
                        <p class="text-sm font-semibold text-inkdark line-clamp-2 mt-1"><?php echo e($info->title); ?></p>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="col-span-full text-center text-slate-400 py-12">Belum ada infografis yang tersedia.</p>
            <?php endif; ?>
        </div>

        <div class="mt-8"><?php echo e($infographics->links()); ?></div>
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
<?php /**PATH D:\koding\Website\healthcare-id\resources\views/infographics/index.blade.php ENDPATH**/ ?>