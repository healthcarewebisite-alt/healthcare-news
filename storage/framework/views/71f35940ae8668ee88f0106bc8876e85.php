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
     <?php $__env->slot('title', null, []); ?> <?php echo e($video->title); ?> - Healthcare.id <?php $__env->endSlot(); ?>
     <?php $__env->slot('description', null, []); ?> <?php echo e($video->description); ?> <?php $__env->endSlot(); ?>

    <article class="mx-auto max-w-5xl px-4 py-8 md:px-6">
        <a href="<?php echo e(route('videos.index')); ?>" class="text-sm font-semibold text-primary hover:underline">&larr; Semua Video</a>
        <h1 class="mt-4 text-2xl font-extrabold text-inkdark md:text-4xl"><?php echo e($video->title); ?></h1>
        <div class="mt-6 aspect-video overflow-hidden rounded-xl bg-black">
            <iframe src="<?php echo e($video->embed_url); ?>" title="<?php echo e($video->title); ?>" class="h-full w-full" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <?php if($video->description): ?>
            <p class="mt-5 whitespace-pre-line leading-relaxed text-slate-600"><?php echo e($video->description); ?></p>
        <?php endif; ?>
    </article>
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
<?php /**PATH /home/maul/Desktop/coding/php/healthcare-news/resources/views/videos/show.blade.php ENDPATH**/ ?>