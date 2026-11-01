@csrf
@if(isset($category)) @method('PUT') @endif

<div class="admin-card max-w-2xl">
    <label class="admin-label">Nama Kategori</label>
    <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" required class="admin-input" placeholder="Mis: Kesehatan Ibu & Anak">
    @error('name') <p class="text-xs text-breaking mt-1">{{ $message }}</p> @enderror

    <label class="admin-label mt-4">Icon (Emoji)</label>
    <input type="text" name="icon" value="{{ old('icon', $category->icon ?? '') }}" maxlength="10" class="admin-input" placeholder="Mis: 🩺">

    <label class="admin-label mt-4">Warna</label>
    <input type="color" name="color" value="{{ old('color', $category->color ?? '#2563EB') }}" class="admin-input h-11 w-24 p-1">

    <label class="admin-label mt-4">Kategori Induk (Opsional)</label>
    <select name="parent_id" class="admin-input">
        <option value="">Tidak ada (kategori utama)</option>
        @foreach($parents as $parent)
            <option value="{{ $parent->id }}" @selected(old('parent_id', $category->parent_id ?? '')==$parent->id)>{{ $parent->name }}</option>
        @endforeach
    </select>

    <label class="admin-label mt-4">Deskripsi</label>
    <textarea name="description" rows="3" class="admin-input">{{ old('description', $category->description ?? '') }}</textarea>

    <label class="admin-label mt-4">Urutan Tampil</label>
    <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}" class="admin-input" min="0">

    <label class="flex items-center gap-2 mt-4 text-sm text-slate-700">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->is_active ?? true)) class="rounded border-slate-300 text-primary focus:ring-primary">
        Aktifkan kategori ini
    </label>

    <button type="submit" class="admin-btn-primary mt-5">
        {{ isset($category) ? 'Simpan Perubahan' : 'Tambah Kategori' }}
    </button>
</div>
