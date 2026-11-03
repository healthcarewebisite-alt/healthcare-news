<?php echo csrf_field(); ?>
<?php if(isset($article)): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
    
    <div class="lg:col-span-2 flex flex-col gap-5">
        <div class="admin-card">
            <label class="admin-label">Judul Berita</label>
            <input type="text" name="title" value="<?php echo e(old('title', $article->title ?? '')); ?>" required
                   class="admin-input text-base font-semibold" placeholder="Judul berita...">
            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-breaking mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <label class="admin-label mt-4">Ringkasan</label>
            <textarea name="excerpt" rows="2" maxlength="500" class="admin-input"
                      placeholder="Ringkasan singkat berita (maks 500 karakter)..."><?php echo e(old('excerpt', $article->excerpt ?? '')); ?></textarea>
            <p class="mt-1 text-xs text-slate-500">Maksimal 500 karakter.</p>
            <?php $__errorArgs = ['excerpt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-breaking mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        
        <div class="admin-card">
            <label class="admin-label">Konten Berita</label>
            <p class="text-xs text-slate-400 mb-2">
                Gunakan toolbar untuk memformat teks. Gambar yang disisipkan akan otomatis dikonversi ke format WebP.
            </p>
            <a href="<?php echo e(route('admin.media.index', ['select' => 1])); ?>" target="_blank" class="mb-3 inline-block text-sm font-semibold text-primary hover:underline">Pilih gambar dari Media Library</a>
            <input id="content" type="hidden" name="content" value="<?php echo e(old('content', $article->content ?? '')); ?>">
            <trix-editor input="content" class="trix-content" aria-label="Konten berita"></trix-editor>
            <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-breaking mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="admin-card">
            <h3 class="font-semibold text-inkdark mb-3">SEO</h3>
            <label class="admin-label">Meta Title</label>
            <input type="text" name="meta_title" value="<?php echo e(old('meta_title', $article->meta_title ?? '')); ?>" class="admin-input" placeholder="Kosongkan untuk memakai judul berita">

            <label class="admin-label mt-3">Meta Description</label>
            <textarea name="meta_description" rows="2" maxlength="255" class="admin-input"><?php echo e(old('meta_description', $article->meta_description ?? '')); ?></textarea>
        </div>
    </div>

    
    <div class="flex flex-col gap-5">
        <div class="admin-card">
            <p class="admin-label">Status Editorial</p>
            <p class="text-sm text-slate-600">
                <?php if(isset($article)): ?>
                    <?php echo e(['draft' => 'Draft', 'in_review' => 'Menunggu review', 'scheduled' => 'Terjadwal', 'published' => 'Terbit', 'rejected' => 'Perlu revisi', 'archived' => 'Arsip'][$article->status] ?? ucfirst($article->status)); ?>

                <?php else: ?>
                    Draft
                <?php endif; ?>
            </p>
            <?php if(isset($article) && $article->review_notes): ?>
                <p class="mt-2 rounded-lg bg-amber-50 p-3 text-sm text-amber-800"><?php echo e($article->review_notes); ?></p>
            <?php endif; ?>
            <button type="submit" class="admin-btn-primary w-full justify-center mt-4">
                <?php echo e(isset($article) ? 'Simpan Perubahan' : 'Simpan sebagai Draft'); ?>

            </button>
            <p class="mt-2 text-xs text-slate-500">Terbitkan atau ajukan review dari daftar berita setelah menyimpan.</p>
        </div>

        <div class="admin-card">
            <label for="article-category" class="admin-label">Rubrik / Kategori</label>
            <select id="article-category" name="category_id" required class="admin-input">
                <option value="">Pilih kategori</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cat->id); ?>" <?php if(old('category_id', $article->category_id ?? '')==$cat->id): echo 'selected'; endif; ?>>
                        <?php echo e($cat->icon); ?> <?php echo e($cat->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-breaking mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <label class="admin-label mt-3">Tag</label>
            <select name="tags[]" multiple class="admin-input h-28">
                <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($tag->id); ?>" <?php if(isset($article) && $article->tags->contains($tag->id)): echo 'selected'; endif; ?>><?php echo e($tag->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <p class="text-xs text-slate-400 mt-1">Tahan Ctrl/Cmd untuk memilih lebih dari satu.</p>
        </div>

        <div class="admin-card">
            <label class="admin-label">Gambar Utama (Featured Image)</label>
            <?php if(isset($article) && $article->featured_image): ?>
                <img id="featured-image-preview" src="<?php echo e($article->featured_image_url); ?>" class="w-full aspect-video object-cover rounded-lg mb-2" alt="Pratinjau gambar utama">
            <?php else: ?>
                <img id="featured-image-preview" class="hidden w-full aspect-video object-cover rounded-lg mb-2" alt="Pratinjau gambar utama">
            <?php endif; ?>
            <input id="featured-image-input" type="file" name="featured_image" accept="image/jpeg,image/png,image/webp" class="admin-input">
            <p class="text-xs text-slate-400 mt-1">Otomatis dikonversi & dikompresi ke format WebP. Maks 5MB.</p>
            <?php $__errorArgs = ['featured_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-breaking mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <label class="admin-label mt-3">Teks Alt Gambar</label>
            <input type="text" name="featured_image_alt" value="<?php echo e(old('featured_image_alt', $article->featured_image_alt ?? '')); ?>" class="admin-input" placeholder="Deskripsi gambar untuk SEO & aksesibilitas">
        </div>

        <div class="admin-card">
            <label for="article-slug" class="admin-label">Slug URL (Opsional)</label>
            <input id="article-slug" type="text" name="slug" value="<?php echo e(old('slug', $article->slug ?? '')); ?>" maxlength="255" class="admin-input" placeholder="Dibuat otomatis dari judul">
            <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-breaking mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <p class="mt-1 text-xs text-slate-500">Kosongkan agar slug dibuat otomatis dari judul.</p>
        </div>

        <div class="admin-card">
            <h3 class="font-semibold text-inkdark mb-3">Prapratinjau Artikel</h3>
            <?php if(isset($article)): ?>
                <a href="<?php echo e(route('admin.articles.preview', $article)); ?>" target="_blank" rel="noopener" class="admin-btn-primary w-full justify-center">Buka pratinjau tersimpan</a>
                <p class="mt-2 text-xs text-slate-500">Simpan perubahan sebelum membuka pratinjau.</p>
            <?php else: ?>
                <p class="text-sm text-slate-600">Simpan artikel sebagai draft terlebih dahulu, lalu buka pratinjau dari halaman edit.</p>
            <?php endif; ?>
        </div>

        <?php if(auth()->user()->isEditor()): ?>
        <div class="admin-card">
            <h3 class="font-semibold text-inkdark mb-3">Tampilan di Homepage</h3>
            <label class="flex items-center gap-2 mb-2.5 text-sm text-slate-700">
                <input type="checkbox" name="is_headline" value="1" <?php if(old('is_headline', $article->is_headline ?? false)): echo 'checked'; endif; ?> class="rounded border-slate-300 text-primary focus:ring-primary">
                Berita Utama (Hero Headline)
            </label>
            <label class="flex items-center gap-2 mb-2.5 text-sm text-slate-700">
                <input type="checkbox" name="is_trending" value="1" <?php if(old('is_trending', $article->is_trending ?? false)): echo 'checked'; endif; ?> class="rounded border-slate-300 text-primary focus:ring-primary">
                Trending
            </label>
            <label class="flex items-center gap-2 mb-2.5 text-sm text-slate-700">
                <input type="checkbox" name="is_breaking" value="1" <?php if(old('is_breaking', $article->is_breaking ?? false)): echo 'checked'; endif; ?> class="rounded border-slate-300 text-primary focus:ring-primary">
                Breaking News
            </label>
            <label class="flex items-center gap-2 text-sm text-slate-700">
                <input type="checkbox" name="is_featured" value="1" <?php if(old('is_featured', $article->is_featured ?? false)): echo 'checked'; endif; ?> class="rounded border-slate-300 text-primary focus:ring-primary">
                Artikel Pilihan Editor (Featured)
            </label>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /home/maul/Desktop/coding/php/healthcare-news/resources/views/admin/articles/_form.blade.php ENDPATH**/ ?>