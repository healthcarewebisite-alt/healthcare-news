<?php echo csrf_field(); ?>
<?php if(isset($user)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

<div class="admin-card max-w-2xl">
    <label class="admin-label">Nama Lengkap</label>
    <input type="text" name="name" value="<?php echo e(old('name', $user->name ?? '')); ?>" required class="admin-input">
    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-breaking mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <label class="admin-label mt-4">Email</label>
    <input type="email" name="email" value="<?php echo e(old('email', $user->email ?? '')); ?>" required class="admin-input">
    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-breaking mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <label class="admin-label mt-4"><?php echo e(isset($user) ? 'Kata Sandi Baru (kosongkan jika tidak diubah)' : 'Kata Sandi'); ?></label>
    <input type="password" name="password" class="admin-input" <?php echo e(isset($user) ? '' : 'required'); ?> minlength="8">
    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-breaking mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <label class="admin-label mt-4">Role</label>
    <select name="role" required class="admin-input">
        <option value="member" <?php if(old('role', $user->role ?? '')==='member'): echo 'selected'; endif; ?>>Member</option>
        <option value="author" <?php if(old('role', $user->role ?? '')==='author'): echo 'selected'; endif; ?>>Author (dapat menulis berita sendiri)</option>
        <option value="editor" <?php if(old('role', $user->role ?? '')==='editor'): echo 'selected'; endif; ?>>Editor (kelola semua konten)</option>
        <option value="super_admin" <?php if(old('role', $user->role ?? '')==='super_admin'): echo 'selected'; endif; ?>>Super Admin (akses penuh)</option>
    </select>

    <label class="admin-label mt-4">Bio</label>
    <textarea name="bio" rows="3" class="admin-input"><?php echo e(old('bio', $user->bio ?? '')); ?></textarea>

    <label class="admin-label mt-4">Avatar</label>
    <?php if(isset($user) && $user->avatar): ?>
        <img src="<?php echo e($user->avatar_url); ?>" class="w-16 h-16 object-cover rounded-full mb-2">
    <?php endif; ?>
    <input type="file" name="avatar" accept="image/*" class="admin-input">
    <p class="text-xs text-slate-400 mt-1">Otomatis dikonversi ke WebP.</p>

    <label class="flex items-center gap-2 mt-4 text-sm text-slate-700">
        <input type="checkbox" name="is_active" value="1" <?php if(old('is_active', $user->is_active ?? true)): echo 'checked'; endif; ?> class="rounded border-slate-300 text-primary focus:ring-primary">
        Akun aktif
    </label>

    <button type="submit" class="admin-btn-primary mt-5">
        <?php echo e(isset($user) ? 'Simpan Perubahan' : 'Tambah Pengguna'); ?>

    </button>
</div>
<?php /**PATH D:\koding\Website\healthcare-id\resources\views/admin/users/_form.blade.php ENDPATH**/ ?>