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
     <?php $__env->slot('title', null, []); ?> <?php echo e($infographic->title); ?> - Healthcare.id <?php $__env->endSlot(); ?>
     <?php $__env->slot('description', null, []); ?> <?php echo e(Str::limit(strip_tags($infographic->description), 160)); ?> <?php $__env->endSlot(); ?>
     <?php $__env->slot('image', null, []); ?> <?php echo e($infographic->image_url); ?> <?php $__env->endSlot(); ?>

    <div class="max-w-4xl mx-auto px-4 md:px-6 py-8">
        <nav class="text-xs text-slate-400 mb-3">
            <a href="<?php echo e(route('home')); ?>" class="hover:text-primary">Home</a> /
            <a href="<?php echo e(route('infographics.index')); ?>" class="hover:text-primary">Infografis</a>
        </nav>

        <?php if($infographic->category): ?>
            <span class="badge-category"><?php echo e($infographic->category->icon); ?> <?php echo e($infographic->category->name); ?></span>
        <?php endif; ?>
        <h1 class="mt-3 text-2xl md:text-3xl font-extrabold text-inkdark"><?php echo e($infographic->title); ?></h1>

        <?php if($infographic->description): ?>
            <p class="mt-3 text-slate-600"><?php echo e($infographic->description); ?></p>
        <?php endif; ?>

        <div class="mt-6 rounded-card overflow-hidden shadow-card">
            <img src="<?php echo e($infographic->image_url); ?>" alt="<?php echo e($infographic->title); ?>" loading="eager" class="w-full h-auto">
        </div>

        <?php if($related->count()): ?>
        <div class="mt-10">
            <h2 class="section-title mb-4">Infografis Lainnya</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('infographics.show', $item->slug)); ?>" class="news-card block">
                        <img src="<?php echo e($item->image_url); ?>" alt="<?php echo e($item->title); ?>" loading="lazy" class="w-full aspect-[3/4] object-cover">
                        <p class="p-2 text-xs font-semibold text-inkdark line-clamp-2"><?php echo e($item->title); ?></p>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>
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
<?php /**PATH D:\koding\Website\healthcare-id\resources\views/infographics/show.blade.php ENDPATH**/ ?>