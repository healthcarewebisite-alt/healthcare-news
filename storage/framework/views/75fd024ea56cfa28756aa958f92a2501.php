<?php if (isset($component)) { $__componentOriginalaf25f15ef26fc3d179956a9918eaad4d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalaf25f15ef26fc3d179956a9918eaad4d = $attributes; } ?>
<?php $component = App\View\Components\Layouts\Admin::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Layouts\Admin::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('title', null, []); ?> Moderasi Komentar <?php $__env->endSlot(); ?>

    <div class="admin-card">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-5">
            <h2 class="font-bold text-inkdark">Daftar Komentar</h2>
            <form method="GET" class="flex gap-2">
                <select name="status" onchange="this.form.submit()" class="admin-input">
                    <option value="">Semua Status</option>
                    <option value="pending" <?php if(request('status')==='pending'): echo 'selected'; endif; ?>>Pending</option>
                    <option value="approved" <?php if(request('status')==='approved'): echo 'selected'; endif; ?>>Approved</option>
                    <option value="spam" <?php if(request('status')==='spam'): echo 'selected'; endif; ?>>Spam</option>
                </select>
            </form>
        </div>

        <div class="flex flex-col gap-3">
            <?php $__empty_1 = true; $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="border border-slate-100 rounded-lg p-4">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-inkdark"><?php echo e($comment->author_name); ?></p>
                        <p class="text-xs text-slate-400">pada "<?php echo e($comment->article->title); ?>" &bull; <?php echo e($comment->created_at->diffForHumans()); ?></p>
                        <p class="text-sm text-slate-600 mt-2"><?php echo e($comment->body); ?></p>
                    </div>
                    <span class="flex-shrink-0 px-2 py-0.5 rounded-full text-xs font-semibold
                        <?php echo e($comment->status === 'approved' ? 'bg-secondary-50 text-secondary-700' : ($comment->status === 'pending' ? 'bg-amber-50 text-amber-600' : 'bg-breaking-50 text-breaking-700')); ?>">
                        <?php echo e(ucfirst($comment->status)); ?>

                    </span>
                </div>
                <div class="flex gap-3 mt-3">
                    <?php if($comment->status !== 'approved'): ?>
                    <form method="POST" action="<?php echo e(route('admin.comments.update-status', $comment)); ?>">
                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" class="text-secondary-600 hover:underline text-xs font-semibold">Setujui</button>
                    </form>
                    <?php endif; ?>
                    <?php if($comment->status !== 'spam'): ?>
                    <form method="POST" action="<?php echo e(route('admin.comments.update-status', $comment)); ?>">
                        <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                        <input type="hidden" name="status" value="spam">
                        <button type="submit" class="text-amber-600 hover:underline text-xs font-semibold">Tandai Spam</button>
                    </form>
                    <?php endif; ?>
                    <form method="POST" action="<?php echo e(route('admin.comments.destroy', $comment)); ?>" onsubmit="return confirm('Hapus komentar ini?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="text-breaking hover:underline text-xs font-semibold">Hapus</button>
                    </form>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p class="text-center text-slate-400 py-8">Belum ada komentar.</p>
            <?php endif; ?>
        </div>
        <div class="mt-5"><?php echo e($comments->links()); ?></div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalaf25f15ef26fc3d179956a9918eaad4d)): ?>
<?php $attributes = $__attributesOriginalaf25f15ef26fc3d179956a9918eaad4d; ?>
<?php unset($__attributesOriginalaf25f15ef26fc3d179956a9918eaad4d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalaf25f15ef26fc3d179956a9918eaad4d)): ?>
<?php $component = $__componentOriginalaf25f15ef26fc3d179956a9918eaad4d; ?>
<?php unset($__componentOriginalaf25f15ef26fc3d179956a9918eaad4d); ?>
<?php endif; ?>
<?php /**PATH D:\koding\Website\healthcare-id\resources\views/admin/comments/index.blade.php ENDPATH**/ ?>