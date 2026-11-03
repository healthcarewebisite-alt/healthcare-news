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
     <?php $__env->slot('title', null, []); ?> <?php echo e($page['title']); ?> - Healthcare.id <?php $__env->endSlot(); ?>

    <article class="max-w-4xl mx-auto px-4 md:px-6 py-12 md:py-16">
        <p class="text-xs font-bold uppercase tracking-[0.2em] text-primary">Healthcare.id</p>
        <h1 class="mt-3 text-3xl md:text-4xl font-extrabold text-inkdark"><?php echo e($page['title']); ?></h1>

        <div class="mt-8 space-y-5 text-base leading-8 text-slate-600">
            <?php $__currentLoopData = $page['paragraphs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($paragraph); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if(!empty($page['email'])): ?>
                <p>
                    <span class="font-semibold text-inkdark"><?php echo e($page['email_label'] ?: 'Email'); ?>:</span>
                    <a class="text-primary hover:underline" href="mailto:<?php echo e($page['email']); ?>"><?php echo e($page['email']); ?></a>
                </p>
            <?php endif; ?>

            <?php if(!empty($page['address'])): ?>
                <p><span class="font-semibold text-inkdark">Alamat:</span> <?php echo e($page['address']); ?></p>
            <?php endif; ?>

            <?php if(!empty($page['phone'])): ?>
                <p>
                    <span class="font-semibold text-inkdark">Telepon:</span>
                    <a class="text-primary hover:underline" href="tel:<?php echo e(preg_replace('/[^0-9+]/', '', $page['phone'])); ?>"><?php echo e($page['phone']); ?></a>
                </p>
            <?php endif; ?>
        </div>
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
<?php /**PATH /home/maul/Desktop/coding/php/healthcare-news/resources/views/pages/information.blade.php ENDPATH**/ ?>