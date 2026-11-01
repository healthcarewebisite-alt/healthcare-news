@csrf
@if(isset($article)) @method('PUT') @endif

<div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
    {{-- Kolom utama: judul, ringkasan, konten Trix --}}
    <div class="lg:col-span-2 flex flex-col gap-5">
        <div class="admin-card">
            <label class="admin-label">Judul Berita</label>
            <input type="text" name="title" value="{{ old('title', $article->title ?? '') }}" required
                   class="admin-input text-base font-semibold" placeholder="Judul berita...">
            @error('title') <p class="text-xs text-breaking mt-1">{{ $message }}</p> @enderror

            <label class="admin-label mt-4">Ringkasan</label>
            <textarea name="excerpt" rows="2" maxlength="500" class="admin-input"
                      placeholder="Ringkasan singkat berita (maks 500 karakter)...">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
            @error('excerpt') <p class="text-xs text-breaking mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- WYSIWYG Trix Editor - gambar yang diunggah otomatis dikonversi ke WebP --}}
        <div class="admin-card">
            <label class="admin-label">Konten Berita</label>
            <p class="text-xs text-slate-400 mb-2">
                Gunakan toolbar untuk memformat teks. Gambar yang disisipkan akan otomatis dikonversi ke format WebP.
            </p>
            <input id="content" type="hidden" name="content" value="{{ old('content', $article->content ?? '') }}">
            <trix-editor input="content" class="trix-content"></trix-editor>
            @error('content') <p class="text-xs text-breaking mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="admin-card">
            <h3 class="font-semibold text-inkdark mb-3">SEO</h3>
            <label class="admin-label">Meta Title</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $article->meta_title ?? '') }}" class="admin-input" placeholder="Kosongkan untuk memakai judul berita">

            <label class="admin-label mt-3">Meta Description</label>
            <textarea name="meta_description" rows="2" maxlength="255" class="admin-input">{{ old('meta_description', $article->meta_description ?? '') }}</textarea>
        </div>
    </div>

    {{-- Sidebar: publish, kategori, gambar utama, flag tampilan --}}
    <div class="flex flex-col gap-5">
        <div class="admin-card">
            <label class="admin-label">Status</label>
            <select name="status" class="admin-input">
                <option value="draft" @selected(old('status', $article->status ?? 'draft')==='draft')>Draft</option>
                <option value="published" @selected(old('status', $article->status ?? '')==='published')>Published</option>
                <option value="archived" @selected(old('status', $article->status ?? '')==='archived')>Archived</option>
            </select>

            <label class="admin-label mt-3">Tanggal Terbit</label>
            <input type="datetime-local" name="published_at"
                   value="{{ old('published_at', isset($article->published_at) ? $article->published_at->format('Y-m-d\TH:i') : '') }}"
                   class="admin-input">
            <p class="text-xs text-slate-400 mt-1">Kosongkan untuk menggunakan waktu saat ini ketika status Published.</p>

            <button type="submit" class="admin-btn-primary w-full justify-center mt-4">
                {{ isset($article) ? 'Simpan Perubahan' : 'Publikasikan Berita' }}
            </button>
        </div>

        <div class="admin-card">
            <label class="admin-label">Kategori</label>
            <select name="category_id" required class="admin-input">
                <option value="">Pilih kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(old('category_id', $article->category_id ?? '')==$cat->id)>
                        {{ $cat->icon }} {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <p class="text-xs text-breaking mt-1">{{ $message }}</p> @enderror

            <label class="admin-label mt-3">Tag</label>
            <select name="tags[]" multiple class="admin-input h-28">
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}" @selected(isset($article) && $article->tags->contains($tag->id))>{{ $tag->name }}</option>
                @endforeach
            </select>
            <p class="text-xs text-slate-400 mt-1">Tahan Ctrl/Cmd untuk memilih lebih dari satu.</p>
        </div>

        <div class="admin-card">
            <label class="admin-label">Gambar Utama (Featured Image)</label>
            @if(isset($article) && $article->featured_image)
                <img src="{{ $article->featured_image_url }}" class="w-full aspect-video object-cover rounded-lg mb-2" alt="Gambar saat ini">
            @endif
            <input type="file" name="featured_image" accept="image/*" class="admin-input">
            <p class="text-xs text-slate-400 mt-1">Otomatis dikonversi & dikompresi ke format WebP. Maks 5MB.</p>
            @error('featured_image') <p class="text-xs text-breaking mt-1">{{ $message }}</p> @enderror

            <label class="admin-label mt-3">Teks Alt Gambar</label>
            <input type="text" name="featured_image_alt" value="{{ old('featured_image_alt', $article->featured_image_alt ?? '') }}" class="admin-input" placeholder="Deskripsi gambar untuk SEO & aksesibilitas">
        </div>

        <div class="admin-card">
            <h3 class="font-semibold text-inkdark mb-3">Tampilan di Homepage</h3>
            <label class="flex items-center gap-2 mb-2.5 text-sm text-slate-700">
                <input type="checkbox" name="is_headline" value="1" @checked(old('is_headline', $article->is_headline ?? false)) class="rounded border-slate-300 text-primary focus:ring-primary">
                Berita Utama (Hero Headline)
            </label>
            <label class="flex items-center gap-2 mb-2.5 text-sm text-slate-700">
                <input type="checkbox" name="is_trending" value="1" @checked(old('is_trending', $article->is_trending ?? false)) class="rounded border-slate-300 text-primary focus:ring-primary">
                Trending
            </label>
            <label class="flex items-center gap-2 mb-2.5 text-sm text-slate-700">
                <input type="checkbox" name="is_breaking" value="1" @checked(old('is_breaking', $article->is_breaking ?? false)) class="rounded border-slate-300 text-primary focus:ring-primary">
                Breaking News
            </label>
            <label class="flex items-center gap-2 text-sm text-slate-700">
                <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $article->is_featured ?? false)) class="rounded border-slate-300 text-primary focus:ring-primary">
                Artikel Pilihan Editor (Featured)
            </label>
        </div>
    </div>
</div>
