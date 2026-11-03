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
     <?php $__env->slot('title', null, []); ?> <?php echo e($hospital->name); ?> - Healthcare.id <?php $__env->endSlot(); ?>
     <?php $__env->slot('description', null, []); ?> <?php echo e(Str::limit(strip_tags($hospital->description), 160)); ?> <?php $__env->endSlot(); ?>
     <?php $__env->slot('image', null, []); ?> <?php echo e($hospital->cover_image_url ?? $hospital->logo_url); ?> <?php $__env->endSlot(); ?>

    <div class="relative">
        <div class="aspect-[21/9] md:aspect-[21/6] overflow-hidden bg-slate-200">
            <img src="<?php echo e($hospital->cover_image_url ?? $hospital->logo_url); ?>" alt="<?php echo e($hospital->name); ?>" loading="eager" class="w-full h-full object-cover">
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 md:px-6 py-6 grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="flex items-center gap-4">
                <img src="<?php echo e($hospital->logo_url); ?>" alt="<?php echo e($hospital->name); ?>" class="w-16 h-16 object-contain rounded-lg bg-slate-50 border border-slate-100 -mt-10 relative z-10 bg-white">
                <div>
                    <h1 class="text-xl md:text-2xl font-extrabold text-inkdark"><?php echo e($hospital->name); ?></h1>
                    <p class="text-sm text-slate-500"><?php echo e($hospital->type); ?> &bull; <?php echo e($hospital->city); ?>, <?php echo e($hospital->province); ?></p>
                </div>
            </div>

            <?php if($hospital->description): ?>
            <div class="mt-5 prose prose-slate max-w-none text-sm">
                <p><?php echo e($hospital->description); ?></p>
            </div>
            <?php endif; ?>

            <?php if($hospital->facilities): ?>
            <div class="mt-5">
                <h2 class="font-bold text-inkdark mb-2">Fasilitas</h2>
                <div class="flex flex-wrap gap-2">
                    <?php $__currentLoopData = $hospital->facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="text-xs bg-slate-100 text-slate-600 px-3 py-1.5 rounded-full"><?php echo e($facility); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if($hospital->doctors->count()): ?>
            <div class="mt-8">
                <h2 class="font-bold text-inkdark mb-3">Dokter di <?php echo e($hospital->name); ?></h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                    <?php $__currentLoopData = $hospital->doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('doctors.show', $doctor->slug)); ?>" class="news-card p-3 flex flex-col items-center text-center gap-1.5">
                            <img src="<?php echo e($doctor->photo_url); ?>" alt="<?php echo e($doctor->name); ?>" loading="lazy" class="w-14 h-14 object-cover rounded-full">
                            <p class="text-xs font-semibold text-inkdark line-clamp-1"><?php echo e($doctor->name); ?></p>
                            <span class="text-xs text-slate-400"><?php echo e($doctor->specialty); ?></span>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <aside class="admin-card h-fit">
            <h2 class="font-bold text-inkdark mb-3">Informasi Kontak</h2>
            <div class="flex flex-col gap-3 text-sm">
                <div>
                    <p class="text-slate-400 text-xs">Alamat</p>
                    <p class="text-inkdark"><?php echo e($hospital->address); ?></p>
                </div>
                <?php if($hospital->phone): ?>
                <div>
                    <p class="text-slate-400 text-xs">Telepon</p>
                    <p class="text-inkdark"><?php echo e($hospital->phone); ?></p>
                </div>
                <?php endif; ?>
                <?php if($hospital->email): ?>
                <div>
                    <p class="text-slate-400 text-xs">Email</p>
                    <p class="text-inkdark"><?php echo e($hospital->email); ?></p>
                </div>
                <?php endif; ?>
                <?php if($hospital->website): ?>
                <div>
                    <p class="text-slate-400 text-xs">Website</p>
                    <a href="<?php echo e($hospital->website); ?>" target="_blank" class="text-primary hover:underline"><?php echo e($hospital->website); ?></a>
                </div>
                <?php endif; ?>
                <div>
                    <p class="text-slate-400 text-xs">Rating</p>
                    <p class="text-inkdark font-semibold">&#9733; <?php echo e($hospital->rating); ?> (<?php echo e($hospital->reviews_count); ?> ulasan)</p>
                </div>
                <?php if($hospital->is_bpjs): ?>
                    <span class="w-fit text-xs bg-primary-50 text-primary-700 px-3 py-1 rounded-full font-medium">Menerima BPJS Kesehatan</span>
                <?php endif; ?>
            </div>
        </aside>
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
<?php /**PATH /home/maul/Desktop/coding/php/healthcare-news/resources/views/hospitals/show.blade.php ENDPATH**/ ?>