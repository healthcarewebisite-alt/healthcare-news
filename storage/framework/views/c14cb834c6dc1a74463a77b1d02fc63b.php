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
     <?php $__env->slot('title', null, []); ?> <?php echo e($doctor->name); ?> - Healthcare.id <?php $__env->endSlot(); ?>
     <?php $__env->slot('description', null, []); ?> <?php echo e(Str::limit(strip_tags($doctor->bio), 160)); ?> <?php $__env->endSlot(); ?>
     <?php $__env->slot('image', null, []); ?> <?php echo e($doctor->photo_url); ?> <?php $__env->endSlot(); ?>
     <?php $__env->slot('type', null, []); ?> profile <?php $__env->endSlot(); ?>

    <div class="max-w-4xl mx-auto px-4 md:px-6 py-10">
        <div class="admin-card flex flex-col sm:flex-row gap-6 items-center sm:items-start text-center sm:text-left">
            <img src="<?php echo e($doctor->photo_url); ?>" alt="<?php echo e($doctor->name); ?>" class="w-28 h-28 object-cover rounded-full flex-shrink-0">
            <div>
                <h1 class="text-xl md:text-2xl font-extrabold text-inkdark"><?php echo e($doctor->name); ?></h1>
                <p class="text-primary font-medium"><?php echo e($doctor->specialty); ?></p>
                <?php if($doctor->hospital): ?>
                    <a href="<?php echo e(route('hospitals.show', $doctor->hospital->slug)); ?>" class="text-sm text-slate-500 hover:text-primary">
                        <?php echo e($doctor->hospital->name); ?>

                    </a>
                <?php endif; ?>
                <div class="flex flex-wrap gap-2 mt-3 justify-center sm:justify-start">
                    <?php if($doctor->years_experience): ?>
                        <span class="text-xs bg-slate-100 text-slate-600 px-3 py-1 rounded-full"><?php echo e($doctor->years_experience); ?> tahun pengalaman</span>
                    <?php endif; ?>
                    <?php if($doctor->str_number): ?>
                        <span class="text-xs bg-slate-100 text-slate-600 px-3 py-1 rounded-full">STR: <?php echo e($doctor->str_number); ?></span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php if($doctor->bio): ?>
        <div class="admin-card mt-5">
            <h2 class="font-bold text-inkdark mb-2">Tentang</h2>
            <p class="text-sm text-slate-600 leading-relaxed"><?php echo e($doctor->bio); ?></p>
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
<?php /**PATH D:\koding\Website\healthcare-id\resources\views/doctors/show.blade.php ENDPATH**/ ?>