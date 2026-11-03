<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <?php
        $ogTitle = isset($title) ? strip_tags($title) : 'Healthcare.id - Portal Berita Kesehatan Nasional';
        $ogDescription = isset($description) ? strip_tags($description) : 'Media digital kesehatan nasional: berita, edukasi, riset, inovasi, rumah sakit, teknologi kesehatan, dan kebijakan kesehatan.';
        $ogImageUrl = isset($image) && $image ? $image : asset('images/og-default.jpg');
        $ogType = $type ?? 'website';
    ?>

    <title><?php echo e($ogTitle); ?></title>
    <meta name="description" content="<?php echo e($ogDescription); ?>">
    <link rel="canonical" href="<?php echo e(url()->current()); ?>">

    
    <meta property="og:site_name" content="Healthcare.id">
    <meta property="og:locale" content="id_ID">
    <meta property="og:type" content="<?php echo e($ogType); ?>">
    <meta property="og:title" content="<?php echo e($ogTitle); ?>">
    <meta property="og:description" content="<?php echo e($ogDescription); ?>">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:image" content="<?php echo e($ogImageUrl); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($ogTitle); ?>">
    <meta name="twitter:description" content="<?php echo e($ogDescription); ?>">
    <meta name="twitter:image" content="<?php echo e($ogImageUrl); ?>">

    <?php echo $__env->yieldPushContent('og'); ?>

    <link rel="icon" href="<?php echo e(asset('favicon.ico')); ?>">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|manrope:400,600,700" rel="stylesheet">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo $__env->yieldPushContent('head'); ?>
</head>
<body class="min-h-screen flex flex-col bg-softbg">

    <a href="#main-content" class="skip-link">Lewati ke konten utama</a>

    <?php echo $__env->make('partials.navbar-desktop', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('partials.navbar-mobile', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <main id="main-content" tabindex="-1" class="flex-1">
        <?php echo e($slot); ?>

    </main>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /home/maul/Desktop/coding/php/healthcare-news/resources/views/layouts/app.blade.php ENDPATH**/ ?>