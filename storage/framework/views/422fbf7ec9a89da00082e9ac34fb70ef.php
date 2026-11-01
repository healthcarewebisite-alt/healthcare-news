<?php echo csrf_field(); ?>
<?php if(isset($infographic)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

<div class="admin-card max-w-2xl">
    <label class="admin-label">Judul</label>
    <input type="text" name="title" value="<?php echo e(old('title', $infographic->title ?? '')); ?>" required class="admin-input">
    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-breaking mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <label class="admin-label mt-4">Kategori (Opsional)</label>
    <select name="category_id" class="admin-input">
        <option value="">Tidak ada</option>
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($cat->id); ?>" <?php if(old('category_id', $infographic->category_id ?? '')==$cat->id): echo 'selected'; endif; ?>><?php echo e($cat->icon); ?> <?php echo e($cat->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <label class="admin-label mt-4">Deskripsi</label>
    <textarea name="description" rows="3" class="admin-input"><?php echo e(old('description', $infographic->description ?? '')); ?></textarea>

    <label class="admin-label mt-4">Gambar Infografis</label>
    <?php if(isset($infographic) && $infographic->image): ?>
        <img src="<?php echo e($infographic->image_url); ?>" class="w-full max-w-xs rounded-lg mb-2">
    <?php endif; ?>
    <input type="file" name="image" accept="image/*" class="admin-input" <?php echo e(isset($infographic) ? '' : 'required'); ?>>
    <p class="text-xs text-slate-400 mt-1">Otomatis dikonversi ke WebP.</p>
    <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-breaking mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <label class="flex items-center gap-2 mt-4 text-sm text-slate-700">
        <input type="checkbox" name="is_active" value="1" <?php if(old('is_active', $infographic->is_active ?? true)): echo 'checked'; endif; ?> class="rounded border-slate-300 text-primary focus:ring-primary">
        Aktifkan (tampilkan di homepage)
    </label>

    <button type="submit" class="admin-btn-primary mt-5">
        <?php echo e(isset($infographic) ? 'Simpan Perubahan' : 'Tambah Infografis'); ?>

    </button>
</div>
<?php /**PATH D:\koding\Website\healthcare-id\resources\views/admin/infographics/_form.blade.php ENDPATH**/ ?>