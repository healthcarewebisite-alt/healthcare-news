<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['article']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['article']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<a href="<?php echo e(route('news.show', $article->slug)); ?>" class="news-card group block">
    <div class="aspect-[16/10] overflow-hidden bg-slate-100">
        <img
            src="<?php echo e($article->featured_image_url); ?>"
            alt="<?php echo e($article->featured_image_alt ?? $article->title); ?>"
            loading="lazy"
            decoding="async"
            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
        >
    </div>
    <div class="p-4">
        <span class="badge-category"><?php echo e($article->category->icon); ?> <?php echo e($article->category->name); ?></span>
        <h3 class="mt-2 font-bold text-inkdark leading-snug line-clamp-2 group-hover:text-primary transition-colors">
            <?php echo e($article->title); ?>

        </h3>
        <?php if($article->excerpt): ?>
            <p class="mt-1.5 text-sm text-slate-500 line-clamp-2"><?php echo e($article->excerpt); ?></p>
        <?php endif; ?>
        <div class="mt-3 flex items-center gap-2 text-xs text-slate-400">
            <span><?php echo e($article->author->name); ?></span>
            <span>&bull;</span>
            <span><?php echo e($article->published_at?->translatedFormat('d M Y')); ?></span>
        </div>
    </div>
</a>
<?php /**PATH /home/maul/Desktop/coding/php/healthcare-news/resources/views/components/article-card.blade.php ENDPATH**/ ?>