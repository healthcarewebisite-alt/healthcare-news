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
     <?php $__env->slot('title', null, []); ?> Pratinjau: <?php echo e($article->title); ?> <?php $__env->endSlot(); ?>
     <?php $__env->slot('description', null, []); ?> <?php echo e($article->meta_description ?: $article->excerpt); ?> <?php $__env->endSlot(); ?>

    <div class="bg-amber-100 px-4 py-3 text-center text-sm font-semibold text-amber-900">
        Pratinjau internal — artikel ini belum tentu sudah diterbitkan.
        <a href="<?php echo e(route('admin.articles.edit', $article)); ?>" class="ml-2 underline">Kembali ke editor</a>
    </div>
    <article class="mx-auto max-w-4xl px-4 py-10 md:px-6">
        <p class="text-sm font-semibold text-primary"><?php echo e($article->category->name); ?></p>
        <h1 class="mt-2 text-3xl font-extrabold leading-tight text-inkdark md:text-5xl"><?php echo e($article->title); ?></h1>
        <?php if($article->excerpt): ?>
            <p class="mt-4 text-lg leading-relaxed text-slate-600"><?php echo e($article->excerpt); ?></p>
        <?php endif; ?>
        <p class="mt-4 text-sm text-slate-500">Oleh <?php echo e($article->author->name); ?></p>

        <?php if($article->featured_image): ?>
            <img src="<?php echo e($article->featured_image_url); ?>" alt="<?php echo e($article->featured_image_alt ?: $article->title); ?>" class="mt-8 aspect-video w-full rounded-xl object-cover">
        <?php endif; ?>

        <div class="article-content mt-8"><?php echo $article->content; ?></div>
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
<?php /**PATH /home/maul/Desktop/coding/php/healthcare-news/resources/views/admin/articles/preview.blade.php ENDPATH**/ ?>