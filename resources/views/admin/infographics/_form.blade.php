@csrf
@if(isset($infographic)) @method('PUT') @endif

<div class="admin-card max-w-2xl">
    <label class="admin-label">Judul</label>
    <input type="text" name="title" value="{{ old('title', $infographic->title ?? '') }}" required class="admin-input">
    @error('title') <p class="text-xs text-breaking mt-1">{{ $message }}</p> @enderror

    <label class="admin-label mt-4">Kategori (Opsional)</label>
    <select name="category_id" class="admin-input">
        <option value="">Tidak ada</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" @selected(old('category_id', $infographic->category_id ?? '')==$cat->id)>{{ $cat->icon }} {{ $cat->name }}</option>
        @endforeach
    </select>

    <label class="admin-label mt-4">Deskripsi</label>
    <textarea name="description" rows="3" class="admin-input">{{ old('description', $infographic->description ?? '') }}</textarea>

    <label class="admin-label mt-4">Gambar Infografis</label>
    @if(isset($infographic) && $infographic->image)
        <img src="{{ $infographic->image_url }}" class="w-full max-w-xs rounded-lg mb-2">
    @endif
    <input type="file" name="image" accept="image/*" class="admin-input" {{ isset($infographic) ? '' : 'required' }}>
    <p class="text-xs text-slate-400 mt-1">Otomatis dikonversi ke WebP.</p>
    @error('image') <p class="text-xs text-breaking mt-1">{{ $message }}</p> @enderror

    <label class="flex items-center gap-2 mt-4 text-sm text-slate-700">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $infographic->is_active ?? true)) class="rounded border-slate-300 text-primary focus:ring-primary">
        Aktifkan (tampilkan di homepage)
    </label>

    <button type="submit" class="admin-btn-primary mt-5">
        {{ isset($infographic) ? 'Simpan Perubahan' : 'Tambah Infografis' }}
    </button>
</div>
